<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompositionQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('composition_quantities', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->string('quantity');
            $table->integer('composition_id')->unsigned();
            $table->timestamps();

        });
        Schema::table('composition_quantities', function (Blueprint $table) {
            $table->foreign('composition_id')->references('id')->on('compositions')->onDelete('cascade');
            $table->unique(array('composition_id', 'quantity'));

        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('composition_quantities');
    }
}
