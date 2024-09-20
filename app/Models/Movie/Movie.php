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

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%');
    }

    public function scopeGenre($query, $slug)
    {
        return $query->whereHas('genres', function ($query) use ($slug) {
            $query->where('slug', $slug);
        });
    }

    public function scopePlayingNow($query)
    {
        return $query->where('playing_now', 1)->orderByDesc('release_date');
    }

    public function scopeSimiliarMovies($query, $id, $genres)
    {
        $array = $genres->pluck('id')->toArray();
        return $query->whereHas('genres', function ($query) use ($array) {
            $query->whereIn('genre_id', $array);
        })->where('movies.id', '!=', $id);
    }
}
