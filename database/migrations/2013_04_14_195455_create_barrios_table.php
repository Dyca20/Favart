<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barrios', function (Blueprint $table) {
            $table->increments('id_Barrio');

            $table->integer('id_Distrito')->unsigned();
            $table->foreign('id_Distrito')->references('id_Distrito')->on('distritos');
          
            $table->integer('id_Canton')->unsigned();
            $table->foreign('id_Canton')->references('id_Canton')->on('cantons');

            $table->integer('id_Provincia')->unsigned();
            $table->foreign('id_Provincia')->references('id_Provincia')->on('provincias');
            
            $table->string('nombre', 25);
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
        Schema::dropIfExists('barrios');
    }
}
