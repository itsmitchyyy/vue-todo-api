<?php
namespace App\Services;

use App\Models\Project;

class ProjectService {

    public static function getProjects() {
        return Project::all();
    }

    public static function createProject(array $data) {
        return Project::create($data);
    }
}