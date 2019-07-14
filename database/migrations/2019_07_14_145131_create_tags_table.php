<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments("id");
            $table->uuid("uuid");
            $table->string("tag_code")->unique();
            $table->string("tag_text")->nullable();
            $table->string("tag_bold")->default("normal");
            $table->string("tag_border_color")->default("#000000");
            $table->integer("tag_border_radius")->default(0);
            $table->string("tag_italic")->default("normal");
            $table->string("tag_under_line")->default("none");
            $table->string("tag_text_color")->default("#000000");
            $table->string("tag_background_color")->default("ffffff");
            $table->string("tag_border")->default("none");
            $table->string("tag_font_family")->default("Arial");
            $table->integer("tag_font_size")->default(14);
            $table->integer("tag_sub")->default('0');
            $table->integer("tag_sup")->default('0');
            $table->text("tag_text_for_replace")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
}
