<?php

namespace App\Models\Movie;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trailer extends Model
{
    protected $fillable = [
        'movie_id',
        'title',
        'url'
    ];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
