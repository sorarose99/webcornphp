<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTvShowDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tv_show_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tmdb_id')->unique();
            $table->string('title');
            $table->string('poster_url');
            $table->string('backdrop_url');
            $table->date('release_date');
            $table->json('last_episode_to_air');
            $table->json('genres');
            $table->integer('number_of_seasons');
            $table->float('vote_average', 3, 1); // 3 digits in total with 1 decimal place
            $table->integer('vote_count');
            $table->text('overview');
            $table->string('trailer_url')->nullable();
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
        Schema::dropIfExists('tv_show_details');
    }
}
