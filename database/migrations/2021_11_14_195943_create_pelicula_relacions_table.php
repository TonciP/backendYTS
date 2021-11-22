<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeliculaRelacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('peliculasrelacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pertenece_pelicula_id');
            $table->unsignedBigInteger('pelicula_id');
            $table->foreign('pertenece_pelicula_id','foreing_pertenece_pelicula')
                ->references('id')
                ->on('peliculas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('pelicula_id','foreing_pelicula')
                ->references('id')
                ->on('peliculas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::table('peliculas_relacions', function (Blueprint $table){
            $table->dropForeign('foreing_pertenece_pelicula');
            $table->dropColumn('pertenece_pelicula_id');

            $table->dropForeign('foreing_pelicula');
            $table->dropColumn('pelicula_id');
        });
        Schema::dropIfExists('peliculas_relacions');
    }
}
