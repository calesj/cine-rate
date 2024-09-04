<?php

namespace App\Models\Movie;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    protected $fillable = [
        'id',
        'name',
        'slug',
        'status'
    ];

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'genre_movie', 'genre_id', 'movie_id');
    }
}
