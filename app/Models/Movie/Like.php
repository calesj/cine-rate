<?php

namespace App\Models\Movie;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'user_id',
        'review_id',
    ];

    public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class);
    }
}
