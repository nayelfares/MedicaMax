<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->string('en_name');
            $table->string('ar_name')->nullable();
            $table->text('ar_article')->nullable();
            $table->text('en_article')->nullable();
            $table->text('location')->nullable();
            $table->string('company_logo')->nullable();
            $table->integer('status_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('companies', function (Blueprint $table) {
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
        Schema::dropIfExists('companies');
    }
}
