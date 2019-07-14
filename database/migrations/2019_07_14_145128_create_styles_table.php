<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStylesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('styles', function (Blueprint $table) {
            $table->increments("id");
            $table->uuid("uuid");
            $table->string("style_name")->unique();
            $table->string("style_bold")->default("normal");
            $table->string("style_italic")->default("normal");
            $table->string("style_under_line")->default("none");
            $table->string("style_text_color")->default("#000000");
            $table->string("style_background_color")->default("ffffff");
            $table->string("style_border")->default("none");
            $table->string("style_font_family")->default("Arial");
            $table->integer("style_font_size")->default(14);
            $table->text("style_text")->nullable();
            $table->integer("style_border_radius")->default(0);
            $table->string("style_border_color")->default("#000000");
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
        Schema::dropIfExists('styles');
    }
}
