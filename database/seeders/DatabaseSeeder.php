<?php

namespace Database\Seeders;

use App\Models\Movie\Like;
use App\Models\Movie\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(100)->create();
        Review::factory(500)->create();
//        Like::factory(150)->create();
    }
}
