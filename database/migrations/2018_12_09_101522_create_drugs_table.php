<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugsTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('drugs', function (Blueprint $table) {
             $table->increments('id');
            $table->uuid('uuid');
            $table->string('en_name');
            $table->string('ar_name')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('form_id')->unsigned()->nullable();
            $table->string('form_unit')->nullable();
            $table->string('amount_of_form')->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('leaflet_id')->unsigned()->nullable();
            $table->float('lay_price')->nullable();
            $table-> float('pharma_price')->nullable();
            $table->integer('status_id')->unsigned()->nullable();
            $table->string('barcodes')->nullable();
            $table->integer('classification_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('drugs',function (Blueprint $table){
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('leaflet_id')->references('id')->on('leaflets')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->foreign('classification_id')->references('id')->on('classifications')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drugs');
    }
}
