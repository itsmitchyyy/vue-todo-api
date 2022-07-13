<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    protected function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
