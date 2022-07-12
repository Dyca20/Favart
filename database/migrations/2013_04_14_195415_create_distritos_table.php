<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distritos', function (Blueprint $table) {
            $table->increments('id_Distrito');
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
        Schema::dropIfExists('distritos');
    }
}
