<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calidads', function (Blueprint $table) {
            $table->id();
            $table->string("formato");
            $table->integer("nivel");
            $table->unsignedBigInteger('peli_id');
            $table->foreign('peli_id','foreing_pelicula_id')->references('id')
                ->on('peliculas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
        /*Schema::table('peliculas', function (Blueprint $table){
            $table->unsignedBigInteger('calidad_id');
            $table->foreign('calidad_id','foreing_calidad')->references('id')
            ->on('calidads')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('peliculas', function (Blueprint $table){
            $table->dropForeign('foreing_calidad');
            $table->dropColumn('calidad_id');
        });*/

        Schema::dropIfExists('calidads');
    }
}
