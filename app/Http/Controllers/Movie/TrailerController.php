<?php

namespace App\Http\Controllers\Movie;

use App\Http\Controllers\Controller;

class TrailerController extends Controller
{
    public function index()
    {
        // Retorna a lista de posts
    }

    public function create()
    {
        // Exibe o formulário para criar um novo post
    }

    public function store(Request $request)
    {
        // Salva um novo post no banco de dados
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

}
