<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie_id');
            $table->boolean('adult');
            $table->string('backdrop_path')->nullable();
            $table->integer('budget')->nullable();
            $table->string('homepage')->nullable();
            $table->string('imdb_id')->nullable();
            $table->string('original_language')->nullable();
            $table->string('original_title')->nullable();
            $table->text('overview')->nullable();
            $table->float('popularity')->nullable();
            $table->string('poster_path')->nullable();
            $table->date('release_date')->nullable();
            $table->integer('revenue')->nullable();
            $table->boolean('video');
            $table->integer('runtime')->nullable();
            $table->float('vote_average')->nullable();
            $table->integer('vote_count')->default(0);
            $table->json('production_countries')->nullable();
            $table->json('spoken_languages')->nullable();
            $table->string('tagline')->nullable();
            $table->enum('status', ['rumored', 'planned', 'in_production', 'post_production', 'released', 'canceled'])->nullable();
            $table->unsignedBigInteger('collection_id')->nullable();
            $table->text('videoUrl')->nullable();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_details');
    }
}
