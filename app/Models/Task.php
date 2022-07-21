<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Task extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['title', 'description', 'user_id', 'project_id'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
