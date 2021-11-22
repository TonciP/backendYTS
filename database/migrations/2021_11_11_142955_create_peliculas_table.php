<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeliculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peliculas', function (Blueprint $table) {
            $table->id();
            $table->string("nombre", 200);
            $table->date("ano");
            $table->integer("calificacion_rotten");
            $table->integer("calificacion_IMDB");
            //$table->string("calidad");
            $table->string("director");
            $table->string("video_trailer");
            $table->string("sinopsis", 800);
            $table->string("genero");
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
        Schema::dropIfExists('peliculas');
    }
}
