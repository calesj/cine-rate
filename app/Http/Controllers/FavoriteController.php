<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $movieId = $request->input('movie_id');
        $user = Auth::user();

        // Verifica se o filme já está favoritado
        $isFavorited = $user->favorites()->where('movie_id', $movieId)->exists();

        if ($isFavorited) {
            // Se já estiver favoritado, remova dos favoritos
            $user->favorites()->detach($movieId);
            return response()->json(['favorited' => false, 'message' => 'Removeu dos favoritos']);
        }

        // Caso contrário, adicione aos favoritos
        $user->favorites()->attach($movieId);
        return response()->json(['favorited' => true, 'message' => 'Adicionou aos favoritos']);
    }
}
