<?php

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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('overview')->nullable();
            $table->string('type')->default('movie');
            $table->string('image')->nullable();
            $table->boolean('playing_now')->default(false);
            $table->date('release_date')->nullable();
            $table->integer('runtime')->nullable();
            $table->string('classification')->nullable();
            $table->string('trailer')->nullable();
            $table->integer('views')->default(0);
            $table->foreignId('author_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
