<?php

namespace Database\Factories\Movie;

use App\Models\Movie\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $movieId = Movie::inRandomOrder()->first()->id;
        $userId = User::inRandomOrder()->first()->id;

        return [
            'user_id' => $userId,
            'movie_id' => $movieId,
            'title' => $this->faker->sentence(),
            'description' => $this->faker->realText(),
            'rating' => $this->faker->numberBetween(1, 10),
        ];
    }
}
