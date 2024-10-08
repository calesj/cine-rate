<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Movie\Movie;
use Illuminate\View\View;

class AppController extends Controller
{
    /** Página Inicial */
    public function index(SearchRequest $request): View
    {
        $query = Movie::select(['id', 'title', 'overview', 'image'])
            ->with(['genres'])
            ->withAvg('reviews', 'rating');

        /** Caso seja uma busca */
        if (!empty($request->search)) {
            $query->search($request->search);
        }

        if (!empty($request->category)) {
            $query->genre($request->category);
        }

        if (!empty($request->search) || !empty($request->category)) {
            $movies = $query->paginate(12)->appends(['search' => $request->search, 'category' => $request->category]);
            return view('app.search', compact('movies'));
        }

        /** Caso nao seja uma busca */
        $nowPlaying = $query->playingNow()->with(['genres'])->get(['id', 'title', 'image'])->take(12);
        $movies = $query->take(10)->get(['id', 'title', 'overview', 'image']); // Usar get() somente aqui

        return view('app.index', compact('movies', 'nowPlaying'));
    }
}
