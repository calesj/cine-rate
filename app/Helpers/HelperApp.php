<?php

use App\Models\Movie\Genre;
use App\Models\Movie\Movie;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/** Retorna todos os gêneros salvos no banco */
function genres(): Collection
{
    return Cache::remember('genres', 60 * 60, function () {
        return Genre::all();
    });
}

/** Retorna o link inteiro da imagem do filme */
function movieImage(?string $imagePath): string
{
    return Cache::remember('image' . $imagePath, 60 * 60, function () use ($imagePath) {
        return config('app.tmdb_image') . $imagePath;
    });
}

/** Procura um genêro com base no seu id */
function genre(string $id): Genre
{
    return Genre::query()->findOrFail($id);
}

/** Formata o número que representa a nota de avaliação */
function avaliate(?float $note): string
{
    if ($note) {
        if ($note >= 10) {
            return (int)$note;
        }
        return number_format($note);
    }
    return 0;
}

/** Verifica se o usuario pode ou não atualizar, ou deletar administradores */
function canAdmin(User $user): void
{
    $owner = auth()->user()->hasRole('Dono');

    if (!$owner) {
        if ($user->hasRole('Administrador') || $user->hasRole('Dono')) {
            abort(403);
        }
    }
}

/** formata data no padrão brasileiro */
function formatDate($date): string
{
    return date_format($date, 'd/m/Y H:i');
}

/** formata o ano de uma data */
function formartYear($date): string
{
    // Crie uma instância de Carbon a partir dessa data
    $date = Carbon::createFromDate($date);
    return $date->year;
}

/** Retorna a data em portugues, Ex: 25 de marco de 2022 */
function releaseDate(?string $data): string
{
    // Crie uma instância de Carbon a partir dessa data
    $date = Carbon::parse($data);

    // Defina a localização para português
    Carbon::setLocale('pt_BR');

    // Formate a data no formato desejado
    return $date->translatedFormat('d \d\e F \d\e Y');
}

/** Limita a quantiade de palavras por texto */
function limitString(string $string, int $limit = 30, string $end = '...'): string
{
    return Str::words($string, $limit, $end);
}

function verifyType(Movie $movie): string
{
    return $movie->type !== 'movie' ? route('serie.show', $movie->id) : route('movie.show', $movie->id);
}
