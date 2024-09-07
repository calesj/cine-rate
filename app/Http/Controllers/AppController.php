<?php

namespace App\Http\Controllers;

use App\Models\Movie\Movie;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppController extends Controller
{
    /** Página Inicial */
    public function index(Request $request): View
    {
        if (!empty($request->search)) {
            $movies = Movie::search($request->search)->paginate(20);

            return view('app.search', compact('movies'));
        }
        $nowPlaying = Movie::playingNow()->with(['genres'])->get(['id', 'title', 'image'])->take(12);
        $movies = Movie::all()->take(10);
        return view('app.index', compact('movies', 'nowPlaying'));
    }

    /** Página de Busca */
    public function search(): View
    {
        return view('app.index');
    }
}
