<?php

namespace App\Console\Commands;

use App\Jobs\MoviePopulateJob;
use App\Models\Movie\Movie;
use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class MoviePlayingNowCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:now-movie';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Popula o banco com uma pequena quantidade de filmes';

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
            $this->info('Pegando todos os Filmes da pagina ' . $i);
            $popularMovies = Http::withToken($token)->get('https://api.themoviedb.org/3/movie/now_playing?language=pt-br&page=1' . $i)->json();

            /** Pegando o id de todos os filmes que a requisicao retornou, e verificando se ela ja esta salva no banco */
            $existingMovies = verifyExists($popularMovies['results']);

            foreach ($popularMovies['results'] as $movie) {
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

            $progressBar->advance();
        }

        $progressBar->finish();

        $this->info('Fim');

        $this->info('Salvo com sucesso');
    }
}
