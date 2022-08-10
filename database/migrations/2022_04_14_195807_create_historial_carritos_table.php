<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialCarritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_carritos', function (Blueprint $table) {
            $table->increments('id_historial');

            $table->integer('id_Usuario')->unsigned();
            $table->foreign('id_Usuario')->references('id_Usuario')->on('users');

            $table->float('resumen_Precio');

            $table->float('total');

            $table->integer('cantidad');

            $table->float('descuento');
            
            $table->date('fecha');

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
        Schema::dropIfExists('carrito_de_compras');
    }
}
