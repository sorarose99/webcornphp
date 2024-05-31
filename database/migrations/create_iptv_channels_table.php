<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIptvChannelsTable extends Migration
{
    public function up()
    {
        Schema::create('iptv_channels', function (Blueprint $table) {
            $table->id();
            $table->string('channel_id')->unique();
            $table->string('name');
            $table->text('alt_names')->nullable();
            $table->string('network')->nullable();
            $table->text('owners')->nullable();
            $table->string('country');
            $table->string('subdivision')->nullable();
            $table->string('city')->nullable();
            $table->text('broadcast_area')->nullable();
            $table->text('languages')->nullable();
            $table->text('categories')->nullable();
            $table->boolean('is_nsfw')->default(false);
            $table->dateTime('launched')->nullable();
            $table->dateTime('closed')->nullable();
            $table->string('replaced_by')->nullable();
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->text('m3u8')->nullable(); // M3U8 links
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('iptv_channels');
    }
}
