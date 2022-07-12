<?php
namespace App\Services;

use App\Models\User;

class UserService {

    public static function getUser(int $id) {
        return User::find($id);
    }

    public static function getByEmail(string $email) {
        $user = User::whereNotNull('email')->where('email', $email)->first();

        return $user;
    }

    public static function createUser(array $data) {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']), 
            'name' => $data['name']
        ]);
    }
}