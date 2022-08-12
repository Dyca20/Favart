<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
           
            $table->increments('idPersona');

            $table->integer('idDireccion')->unsigned();
            $table->foreign('idDireccion')->references('idDireccion')->on('direccions');

            $table->string('nombre', 25);
            $table->string('apellidos', 30);
            $table->string('edad', 3);
            $table->timestamps();
        });

        DB::table("personas")
        ->insert([
            "idPersona" => 1,
            "idDireccion" => 1,
            "nombre" => "Francini",
            "apellidos" => "Murillo Porras",
            "edad" => 25,
        ]);
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
