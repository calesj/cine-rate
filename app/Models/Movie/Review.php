<?php

namespace App\Models\Movie;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'movie_id',
        'title',
        'description',
        'rating'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function scopeLikesCount($query)
    {
        $query->withCount(['likes as likes_count' => function ($query) {
            $query->where('status', 'like');
        }]);
    }

    public function scopeDislikesCount($query)
    {
        $query->withCount(['likes as dislikes_count' => function ($query) {
            $query->where('status', 'dislike');
        }]);
    }
}
