<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
           
            $table->increments('id_Persona');

            $table->integer('id_direccion')->unsigned();
            $table->foreign('id_direccion')->references('id_direccion')->on('direccions');

            $table->string('nombre', 25);
            $table->string('apellidos', 30);
            $table->string('edad', 3);
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
        Schema::dropIfExists('personas');
    }
}
