<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoHistorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_historials', function (Blueprint $table) {

            $table->increments('idProductoHistorial');

            $table->integer('idHistorial')->unsigned();
            $table->foreign('idHistorial')->references('idHistorial')->on('historial_carritos');
            
            $table->integer('idProducto')->unsigned();
            $table->foreign('idProducto')->references('idProducto')->on('productos');
            
            $table->integer('cantidadCarrito');
            
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
        Schema::dropIfExists('producto_historials');
    }
}
