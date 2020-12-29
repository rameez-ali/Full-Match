<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->char('video_title');
            $table->text('video_banner_image');
            $table->text('video_image');
            $table->text('video_description');
            $table->text('video_url');
            $table->char('video_duration' ,'100');
            $table->bigInteger('category_id');
            $table->bigInteger('genres_id');
            $table->bigInteger('league_id');
            $table->tinyInteger('notify')->default(1);
            $table->bigInteger('sort_by');
            $table->bigInteger('clubs_id');
            $table->bigInteger('players_id');
            $table->tinyInteger('popular_search')->default(0);
            $table->text('promo_video_url');
            $table->tinyInteger('status')->default(1);
            $table->softDeletesTz('deleted_at', 0)->nullable();
            $table->char('lang', '50');
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
        Schema::dropIfExists('videos');
    }
}
