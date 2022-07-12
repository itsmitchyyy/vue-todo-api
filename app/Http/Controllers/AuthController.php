<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use App\Models\User;

class AuthController extends Controller
{
    protected UserService $userServices;

    public function __construct(UserService $userService) {
        $this->userServices = $userService;
    }

    public function login(LoginRequest $request) 
    {
        $user = UserService::getByEmail($request->email);

        // if ($user && !$user->email_verified_at) {
        //     return response([
        //         'status_code' => HttpResponse::HTTP_UNAUTHORIZED,
        //         'message' => 'Your email address has not been confirmed. Confirmation information has been sent to your email. Check your email/spam email.',
        //     ], HttpResponse::HTTP_UNAUTHORIZED);
        // }


        if (!Auth::attempt($request->validated())) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')]
            ]);
        }

        $token = $request->user()->createToken('todo_token')->plainTextToken;

        return response(['status_code' => HttpResponse::HTTP_OK, 'data' => ['token' => $token, 'user' => $user]]);
    }

    public function register(RegisterRequest $request) 
    {
        $user = UserService::createUser($request->validated());
        $token = $user->createToken('todo_token')->plainTextToken;
        return response(['status_code' => HttpResponse::HTTP_OK, 'data' => [ 'token' => $token, 'user' => $user]]);
    }

    public function logout() 
    {
        return Auth::logout();
    }
}
