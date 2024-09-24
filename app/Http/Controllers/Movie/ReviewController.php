<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\LikeRequest;
use App\Http\Requests\ReviewRequest;
use App\Models\Movie\Like;
use App\Models\Movie\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct(
        private readonly Review $review
    )
    {

    }
    public function index()
    {
        // Retorna a lista de posts
    }

    public function create()
    {
        // Exibe o formulário para criar um novo post
    }

    /** Salva review */
    public function store(ReviewRequest $request)
    {
        $user = auth()->user()->id;
        $this->review->create([
            'user_id' => $user,
            'movie_id' => $request->movie_id,
            'title' => $request->title,
            'description' => $request->description,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with(['success' => 'você escreveu um comentário com sucesso!']);
    }

    public function show($id)
    {
        // Exibe um post específico
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

    public function like(LikeRequest $request)
    {
        $userId = auth()->user()->id;

        Like::updateOrCreate(
            [
                'user_id' => $userId,
                'review_id' => $request['review_id'],
            ],
            [
                'status' => $request['status']
            ]
        );

        return redirect()->back()->with(['success' => 'Você avaliou um comentário']);
    }
}
