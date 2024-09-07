<?php

namespace App\Models\Movie;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    protected $fillable = [
        'id',
        'title',
        'overview',
        'category_id',
        'type',
        'image',
        'release_date',
        'runtime',
        'classification',
        'trailer',
        'views',
        'author_id',
        'playing_now'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'movie_id', 'user_id');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genre_movie', 'movie_id', 'genre_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function scopeSerie($query)
    {
        return $query->where('type', '=', 'serie');
    }

    public function scopeMovie($query)
    {
        return $query->where('type', '=', 'movie');
    }
}
