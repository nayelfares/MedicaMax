<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->string('en_name');
            $table->string('ar_name')->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('form_unit')->nullable();
            $table->string('amount')->nullable();
            $table->integer('status_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('forms', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('forms')->onDelete('cascade');
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
        Schema::dropIfExists('forms');
    }
}
