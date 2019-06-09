<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVisitIndexToClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classifications', function (Blueprint $table) {
            //
            $table->integer('index')->unsigned();
            $table->integer('parent_index')->unsigned();

            $table->string('ar_note')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classifications', function (Blueprint $table) {
            //
        });
    }
}
