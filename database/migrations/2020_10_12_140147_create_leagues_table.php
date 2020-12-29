<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->id();
            $table->char('league_name');
            $table->text('league_banner');
            $table->text('league_promo_url');
            $table->text('league_profile_image');
            $table->text('league_description');
            $table->bigInteger('sort_by');
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
        Schema::dropIfExists('leagues');
    }
}
