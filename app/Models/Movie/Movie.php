<?php

namespace App\Models\Movie;

use App\Models\Favorite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'views',
        'author_id',
    ];

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genre_movie', 'movie_id', 'genre_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function trailer(): HasOne
    {
        return $this->hasOne(Trailer::class);
    }

    /** Scopes */
    public function scopePopular($query)
    {
        return $query->orderBy('views', 'desc');
    }

    public function scopeMostRated($query)
    {
        return $query->leftJoin('reviews', 'movies.id', '=', 'reviews.movie_id')
            ->selectRaw('movies.*, AVG(reviews.rating) as rating')
            ->groupBy('movies.id')
            ->orderByDesc('rating');
    }

    public function scopeRating($query)
    {
        return $query->leftJoin('reviews', 'movies.id', '=', 'reviews.movie_id')
            ->selectRaw('movies.*, AVG(reviews.rating) as rating')
            ->groupBy('movies.id');
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
