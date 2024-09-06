<?php

namespace App\Jobs;

use App\Models\Movie\Movie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MoviePopulateJob implements ShouldQueue
{
    use Queueable;
    private array $movie;

    /**
     * Create a new job instance.
     */
    public function __construct(
        array $movie
    )
    {
        $this->movie = $movie;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (empty($this->movie['release_date'])) {
            $this->movie['release_date'] = null;
        }

        $array = [
            'id' => $this->movie['id'],
            'title' => $this->movie['title'],
            'overview' => $this->movie['overview'],
            'type' => 'movie',
            'image' => $this->movie['poster_path'],
            'release_date' => $this->movie['release_date'] ?? null,
            'trailer' => $this->movie['release_date'] ?? null,
            'runtime' => $this->movie['runtime'],
            'views' => $this->movie['popularity'],
            'author_id' => 1,
        ];

        if ($this->movie['trailer']) {
            $array['trailer'] = $this->movie['trailer'];
        }

        $movie = Movie::query()->create($array);

        foreach ($this->movie['genre_ids'] as $genre_id) {
            $movie->genres()->attach($genre_id);
        }
    }
}
