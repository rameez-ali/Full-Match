<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->char('title');
            $table->tinyInteger('type')->default(0);
            $table->integer('value');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('num_usage');
            $table->integer('per_user_can_use');
            $table->integer('individual_user_can_use');
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
        Schema::dropIfExists('promo_codes');
    }
}
