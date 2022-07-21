<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Builder;

class Project extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['title', 'description', 'user_id'];

    protected function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

     /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    #[SearchUsingFullText(['title', 'description'])]
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'description' => $this->description
        ];
    }

    protected static function boot()
    {
        parent::boot();
        
        self::addGlobalScope(function (Builder $builder) {
            $builder->where('user_id', auth()->id());
        });
    }
}
