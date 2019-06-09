<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compositions', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->string('en_name')->unique();
            $table->string('ar_name')->nullable();
            $table->integer('status_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('compositions', function (Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compositions');
    }
}