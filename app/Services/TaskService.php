<?php
namespace App\Services;

use App\Models\Task;

class TaskService {

    public static function getTasks() 
    {
        return Task::all();
    }

    public static function createTask(array $data) 
    {
        return Task::create($data);
    }

    public static function searchTask(string $search)
    {
        return Task::search($search)->get();
    }
}