<?php

use App\Models\Api;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('apis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('token');
            $table->string('url');
            $table->boolean('is_loading')->default(false);
            $table->timestamps();
        });

        Api::create([
            'name' => 'tmdb',
            'url' => 'https://api.themoviedb.org/3',
            'token' => 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJjYzBhOWJjZTY2NjgyN2QxODIxMTQyYjlkMWIxNDFhNyIsInN1YiI6IjY2MjE2NWM2OGE4OGIyMDE4NWNhN2NhNiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Mff3BOFA8tbkhk3KhyKEzScx8yhAdIDuHUS717VCD0U'
        ]);

        Api::create([
            'name' => 'tmdb_image',
            'url' => 'https://image.tmdb.org/t/p/w500/',
            'token' => 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJjYzBhOWJjZTY2NjgyN2QxODIxMTQyYjlkMWIxNDFhNyIsInN1YiI6IjY2MjE2NWM2OGE4OGIyMDE4NWNhN2NhNiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Mff3BOFA8tbkhk3KhyKEzScx8yhAdIDuHUS717VCD0U'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apis');
    }
};
