<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateDireccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccions', function (Blueprint $table) {
            $table->increments('id_Direccion');
            
            $table->integer('id_Barrio')->unsigned();
            $table->foreign('id_Barrio')->references('id_Barrio')->on('barrios');

            $table->integer('id_Distrito')->unsigned();
            $table->foreign('id_Distrito')->references('id_Distrito')->on('distritos');
          
            $table->integer('id_Canton')->unsigned();
            $table->foreign('id_Canton')->references('id_Canton')->on('cantons');

            $table->integer('id_Provincia')->unsigned();
            $table->foreign('id_Provincia')->references('id_Provincia')->on('provincias');

            $table->string('señas_Exactas',255);
            $table->timestamps();
        });

        DB::table("direccions")
        ->insert([
            "id_direccion" => "1",
            "id_Barrio" => "1",
            "id_Distrito" => "1",
            "id_Canton" => "1",
            "id_Provincia" => "5",
            "señas_Exactas" => "Casa de los contenedores",
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direccions');
    }
}
