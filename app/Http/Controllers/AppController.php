<?php

namespace App\Http\Controllers;

use App\Models\Movie\Movie;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $movies = Movie::all()->take(10);
        return view('app.index', compact('movies'));
    }
}
