<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicaMaxTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medica_max_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->string('code');
            $table->text('tag_text')->nullable();
            $table->string('text_color')->default("#000000");
            $table->string('background_color')->default("ffffff");
            $table->integer('bold')->default('0');
            $table->integer('italic')->default('0');
            $table->integer('under_line')->default('0');
            $table->integer('sup_text')->default('0');
            $table->integer('sub_text')->default('0');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medica_max_tags');
    }
}
