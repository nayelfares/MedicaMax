<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeafletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaflets', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->string('name');
            $table->text('en_leaflet')->nullable();
            $table->text('ar_leaflet')->nullable();
            $table->integer('status_id')->unsigned()->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->timestamps();
             $table->softDeletes();
        });
        Schema::table('leaflets', function (Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaflets');
    }
}
