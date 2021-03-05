<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('performances')) {
            // テーブルが存在していればリターン
            return;
        }
        Schema::create('performances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('timecard_id')->unsigned();
            $table->boolean('meal_fg')->nullable();
            $table->boolean('outside_fg')->nullable();
            $table->boolean('medical_fg')->nullable();
            $table->integer('note')->default(1);
            $table->timestamps();

            //外部キーを設定する
            $table->foreign('timecard_id')->references('id')->on('timecards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('performances');
    }
}