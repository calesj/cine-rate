<?php

namespace App\Console\Commands;

use App\Console\Commands\Traits\MovieTrait;
use App\Jobs\MoviePopulateJob;
use App\Models\Movie\Movie;
use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class MoviePopulateCommand extends Command
{
    use MovieTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:movie';

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
            $popularMovies = Http::withToken($token)->get('https://api.themoviedb.org/3/movie/popular?language=pt-br&page=' . $i)->json();

            /** Pegando o id de todos os filmes que a requisicao retornou, e verificando se ela ja esta salva no banco */
            $existingMovies = Movie::query()->whereIn('id', array_column($popularMovies['results'], 'id'))->pluck('id')->toArray();

            /** Verifica se o filme já esta salvo no banco, se estiver, ele ignora */
            $this->verifyExists($popularMovies['results'], $existingMovies, $token);

            $progressBar->advance();
        }

        $progressBar->finish();

        $this->info('Fim');

        $this->info('Salvo com sucesso');
    }
}
