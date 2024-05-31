<?php
// database/migrations/YYYY_MM_DD_create_reviews_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('author_name');
            $table->string('author_username');
            $table->string('avatar_url');
            $table->float('rating')->default(-1); // Adjust as needed
            $table->text('content');
            $table->timestamp('elapsed_time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
