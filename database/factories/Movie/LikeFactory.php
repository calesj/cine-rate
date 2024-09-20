<?php

namespace Database\Factories\Movie;

use App\Models\Movie\Like;
use App\Models\Movie\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $userId = User::inRandomOrder()->first()->id;
            $reviewId = Review::inRandomOrder()->first()->id;
            $exists = Like::where('user_id', $userId)->where('review_id', $reviewId)->exists();
        } while ($exists);

        return [
            'user_id' => $userId,
            'review_id' => $reviewId,
            'status' => fake()->randomElement(['like', 'dislike']),
        ];
    }
}
