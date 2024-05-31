<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimilarMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('similar_movies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tmdb_id');
            $table->unsignedBigInteger('similar_movie_id');
            $table->string('title');
            $table->string('poster_url')->nullable();
            $table->string('backdrop_url')->nullable();
            $table->date('release_date')->nullable();
            $table->text('overview')->nullable();
            $table->float('vote_average')->nullable();
            $table->integer('vote_count')->nullable();
            $table->string('videourl')->nullable();
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('tmdb_id')->references('tmdb_id')->on('movies')->onDelete('cascade');
            $table->foreign('similar_movie_id')->references('id')->on('movies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('similar_movies');
    }
}
