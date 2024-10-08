<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Models\Api;
use App\Models\Movie\Genre;
use App\Models\Movie\Movie;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function __construct(
        private readonly Api   $api,
        private readonly Movie $movie,
        private readonly Genre $genre,
        private readonly Http  $http
    )
    {}

    /** Listagem de filmes */
    public function index(): View
    {
        $user = auth()->user();

        $reviews = $user->reviews()->with('movie')->paginate(10);

        $favorites = $user->favorites()->count();

        return view('app.profile.dashboard', compact('user', 'reviews', 'favorites'));
    }

    /** Retorna lista de filmes agrupados por gênero */
    public function moviesByGenre(SearchRequest $request, string $slug): View
    {
        $perPage = $request->input('per_page', 10);

        $genre = $this->genre->where('slug', $slug)->with('movies')->firstOrFail();

        $movies = $this->movie->query();

        $movies->when($request->has('search'), function ($query) use ($request, $slug) {
            $query->where(function ($query) use ($request, $slug) {
                $query->where('title', 'like', '%' . $request->search . '%');
            })->orWhereHas('genres', function ($query) use ($request, $slug) {
                $query->where('name', 'like', '%' . $request->search . '%');
                $query->where('slug', '=', $slug);
            });
        });

        $movies = $movies->paginate($perPage);

        return view('site.genre.movie-list-by-genre', compact('genre', 'movies'));
    }

    public function create()
    {
        // Exibe o formulário para criar um novo post
    }

    public function store(Request $request)
    {
        // Salva um novo post no banco de dados
    }

    /** Detalhes do filme com base no id passado por parametro */
    public function show(string $id)
    {
        $movie = $this->movie
            ->with(['genres']) // Carrega as relações necessárias
            ->withAvg('reviews', 'rating') // Calcula a média de 'rating' diretamente no banco
            ->find($id);

        if (!$movie) {
            return redirect()->route('fallback.route');
        }

        $average = number_format($movie->reviews_avg_rating, 1);

        $reviews = $movie->reviews()->with(['user'])->likesCount()->dislikesCount()->orderByDesc('created_at')->paginate(7);

        $similiarMovies = $movie->similiarMovies($movie->id, $movie->genres)->get()->take(4);

        return view('app.detail', compact('movie', 'reviews', 'similiarMovies', 'average'));
    }

    /** Detalhes da serie com base no id passado por parametro */
    public function showSerie(string $id, PerPageRequest $request)
    {
        $isFavorite = false;

        if (auth()->check()) {
            $user = auth()->user();
            $isFavorite = $user->favorites()->where('movie_id', $id)->exists();
        }

        $perPage = $request->input('per_page', 10);

        $serie = $this->movie->where(['movies.id' => $id])->serie()->with(['genres', 'trailer'])->rating()->firstOrFail();

        if (!$serie) {
            return redirect()->route('fallback.route');
        }

        /** Pegando token da Api de filmes */
        $token = $this->api->whereName('tmdb')->value('token');

        /** Pegando a url padrao da API de filmes */
        $url = $this->api->whereName('tmdb')->value('url');

        /** Companias que fizeram o filme */
        $film = $this->http::withToken($token)->get($url . "/tv/{$id}")->json();

        /** Companhias */
        $companies = $film['production_companies'];

        $seasons = collect($film['seasons'])->sortDesc();

        /** Retornando todas imagens conforme o id passado por parametro */
        $backdrops = $this->http::withToken($token)->get($url . "/tv/{$id}/images")->json();

        $images = [];

        if (!empty($backdrops['backdrops'])) {
            /** Pegando no maximo 3 imagens por filme */
            $images = collect($backdrops['backdrops'])->take(4) ?? false;
        }

        /** Filmes relacionados */
        $relatedSeries = $this->movie->whereHas('genres', function ($query) use ($serie) {
            $query->whereIn('genres.id', $serie->genres->pluck('id'));
        })->where('movies.id','!=', $serie->id)->serie()->rating()->with(['genres'])->limit(5)->get();

        /** Pegando reviews do filme */
        $reviews = $serie->reviews()->orderByDesc('created_at');

        /** Paginação dos reviews */
        $reviews = $reviews->paginate($perPage);

        return view('site.tv.show', compact([
            'serie',
            'images',
            'companies',
            'reviews',
            'relatedSeries',
            'isFavorite',
            'seasons'
        ]));
    }

    public function edit($id)
    {
        // Exibe o formulário para editar um post existente
    }

    public function update(Request $request, $id)
    {
        // Atualiza um post existente no banco de dados
    }

    public function destroy($id)
    {
        // Exclui um post do banco de dados
    }
}
