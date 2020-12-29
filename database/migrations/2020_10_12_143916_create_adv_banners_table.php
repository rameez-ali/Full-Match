<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adv_banners', function (Blueprint $table) {
            $table->id();
            $table->char('adv_title');
            $table->text('adv_banner');
            $table->text('adv_url');
            $table->bigInteger('category_id');
            $table->bigInteger('genres_id');
            $table->tinyInteger('visible_at_home')->default(0);
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
        Schema::dropIfExists('adv_banners');
    }
}
