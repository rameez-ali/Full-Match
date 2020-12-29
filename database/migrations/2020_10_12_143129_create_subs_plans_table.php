<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubsPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subs_plans', function (Blueprint $table) {
            $table->id();
            $table->char('plan_title');
            $table->text('plan_Description');
            $table->decimal('plan_price',8 , 2);
            $table->char('plan_Duration', 100);
            $table->bigInteger('sort_by');
            $table->tinyInteger('notify')->default(1);
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
        Schema::dropIfExists('subs_plans');
    }
}
