<?php

namespace App\Console\Commands;

use App\Jobs\GenrePopulateJob;
use Illuminate\Console\Command;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class GenrePopulateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:genre';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Popula o banco com os gêneros da Api';

    /**
     * Execute the console command.
     * @throws ConnectionException
     */
    public function handle(): void
    {
        $token = config('app.tmdb_token');

        $this->info('Pegando todos os generos da API de filmes');

        $genres = Http::withToken($token)->get('https://api.themoviedb.org/3/genre/movie/list?language=pt-br')->json();

        $this->info('Salvando genêro por genêro');

        foreach ($genres['genres'] as $genre) {
            GenrePopulateJob::dispatch($genre);
        }

        $genres = Http::withToken($token)->get('https://api.themoviedb.org/3/genre/tv/list?language=pt-br')->json();

        $this->info('Salvando genêro por genêro');

        foreach ($genres['genres'] as $genre) {
            GenrePopulateJob::dispatch($genre);
        }

        $this->info('Salvo com sucesso');
    }
}
