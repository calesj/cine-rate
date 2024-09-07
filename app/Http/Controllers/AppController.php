<?php

namespace App\Http\Controllers;

use App\Models\Movie\Movie;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppController extends Controller
{
    public function index(): View
    {   $nowPlaying = Movie::query()->where('playing_now', 1)->with(['genres'])->get(['id', 'title', 'image'])->take(12);
        $movies = Movie::all()->take(10);
        return view('app.index', compact('movies', 'nowPlaying'));
    }
}
