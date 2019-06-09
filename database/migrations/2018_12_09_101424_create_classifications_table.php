<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifications', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->string('code',15);
            $table->string('en_term');
            $table->string('classification_level')->nullable();
            $table->string('ar_term')->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('parent_code',15)->nullable();
            $table->integer('status_id')->unsigned()->nullable();
            $table->string('note')->nullable();
            $table->string('ar_note')->nullable();
            $table->string('s_ar_term')->default(null);
            $table->string('text_color')->default("000000");
            $table->string('background_color')->default("ffffff");
            $table->string('bold')->default("normal");
            $table->string('italic')->default("normal");
            $table->string('under_line')->default("none");
            $table->integer('ar_size')->default(18);
            $table->integer('en_size')->default(16);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('classifications', function (Blueprint $table){            
            $table->foreign('parent_id')->references('id')->on('classifications')->onDelete('cascade');
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
        Schema::dropIfExists('classifications');
    }
}
