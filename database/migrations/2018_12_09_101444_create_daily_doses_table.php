<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyDosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::create('daily_doses', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->integer('classification_id')->unsigned();
            $table->integer('giving_id')->unsigned();            
            $table->float('amount')->unsigned();
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

     Schema::table('daily_doses', function (Blueprint $table) {
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');
            $table->foreign('giving_id')->references('id')->on('givings')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_doses');
    }
}
