<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('badges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('efforts_time_level')->default(0)->comment('0=未取得, 1=取得済み');
            $table->tinyInteger('stacking_days_level')->default(0)->comment('0=未取得, 1=取得済み');
            $table->tinyInteger('continuation_days_max')->default(0)->comment('0=未取得, 1=取得済み');
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
        Schema::dropIfExists('badges');
    }
}
