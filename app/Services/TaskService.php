<?php
namespace App\Services;

use App\Models\Task;

class TaskService {

    public static function getTasks() {
        return Task::all();
    }

    public static function createProject(array $data) {
        return Task::create($data);
    }
}