<?php

namespace App\Console\Commands;

use App\Jobs\SeriePopulateJob;
use App\Models\Api;
use App\Models\Movie\Movie;
use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class SeriePopulateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:serie';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws ConnectionException
     */
    public function handle(): void
    {
        $token = config('app.tmdb_token');

        $total = 1;

        $progressBar = $this->output->createProgressBar($total);

        for ($i = 1; $i <= $total; $i++) {
            $this->info('Pegando todos as series da pagina ' . $i);
            $popularMovies = Http::withToken($token)->get('https://api.themoviedb.org/3/tv/popular?language=pt-br&page=' . $i)->json();

            /** Pegando o id de todos os filmes que a requisicao retornou, e verificando se ela ja esta salva no banco */
            $existingMovies = Movie::query()->whereIn('id', array_column($popularMovies['results'], 'id'))->pluck('id')->toArray();

            foreach ($popularMovies['results'] as $movie) {
                if (!in_array($movie['id'], $existingMovies)) {
                    $trailer = Http::withToken($token)->get("https://api.themoviedb.org/3/tv/{$movie['id']}/videos?language=pt-br")->json()['results'];

                    if (empty($trailer)) {
                        $trailer = Http::withToken($token)->get("https://api.themoviedb.org/3/tv/{$movie['id']}/videos")->json()['results'];
                    }

                    if (!$movie['first_air_date']) {
                        $movie['first_air_date'] = null;
                    }

                    $film = Http::withToken($token)->get("https://api.themoviedb.org/3/tv/{$movie['id']}?language=pt-BR")->json();

                    if (empty($film)) {
                        $film = Http::withToken($token)->get("https://api.themoviedb.org/3/tv/{$movie['id']}")->json();
                    }

                    $film['genre_ids'] = $movie['genre_ids'];
                    $film['trailer'] = $trailer[0]['key'] ?? false;
                    $film['first_air_date'] = $movie['first_air_date'];

                    SeriePopulateJob::dispatch($film);
                }
            }

            $progressBar->advance();
        }

        $progressBar->finish();

        $this->info('Fim');

        $this->info('Salvo com sucesso');
    }
}
