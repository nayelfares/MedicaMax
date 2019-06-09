<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChemicalCompositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chemical_compositions', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->integer('drug_id')->unsigned();
            $table->integer('composition_quantity_id')->unsigned();
            $table->integer('composition_id')->unsigned();
            $table->timestamps();                    
            $table->softDeletes();
        });
        Schema::table('chemical_compositions', function (Blueprint $table) {
            $table->foreign('drug_id')->references('id')->on('drugs')->onDelete('cascade');
            $table->foreign('composition_quantity_id')->references('id')->on('composition_quantities')->onDelete('cascade');
            $table->foreign('composition_id')->references('id')->on('compositions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chemical_compositions');
    }
}



