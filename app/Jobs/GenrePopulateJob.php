<?php

namespace App\Jobs;

use App\Models\Movie\Genre;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Str;

class GenrePopulateJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    private array $genre;

    public function __construct(array $genre)
    {
        $this->genre = $genre;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Genre::query()->updateOrCreate(
            [
                'id' => $this->genre['id']
            ],
            [
                'name' => $this->genre['name'],
                'slug' => Str::slug($this->genre['name']),
                'status' => 1,
            ]
        );
    }
}
