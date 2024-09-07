<?php

namespace App\Console\Commands\Traits;

use App\Jobs\MoviePopulateJob;
use App\Models\Movie\Movie;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

trait MovieTrait
{
    function getExistsId(array $movies): array
    {
        return Movie::query()->whereIn('id', array_column($movies, 'id'))->pluck('id')->toArray();
    }

    /**
     * @throws ConnectionException
     */
    public function verifyExists(array $movies, array $existingMovies, $token): void
    {
        foreach ($movies as $movie) {
            /** Verifica se ja existe no banco, senao existir, ele salva */
            if (!in_array($movie['id'], $existingMovies)) {
                $trailer = Http::withToken($token)->get("https://api.themoviedb.org/3/movie/{$movie['id']}/videos?language=pt-br")->json()['results'];

                if (empty($trailer)) {
                    $trailer = Http::withToken($token)->get("https://api.themoviedb.org/3/movie/{$movie['id']}/videos")->json()['results'];
                }

                $film = Http::withToken($token)->get("https://api.themoviedb.org/3/movie/{$movie['id']}?language=pt-BR")->json();
                $film['genre_ids'] = $movie['genre_ids'];
                $film['trailer'] = $trailer[0]['key'] ?? false;
                $film['playing_now'] = 1;

                MoviePopulateJob::dispatch($film);
            }
        }
    }
}
