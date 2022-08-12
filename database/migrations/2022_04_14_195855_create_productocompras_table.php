<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productocompras', function (Blueprint $table) {

            $table->increments('idCarritoProducto');

            $table->integer('idCarrito')->unsigned();
            $table->foreign('idCarrito')->references('idCarrito')->on('carritodecompras');

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
        Schema::dropIfExists('productocompras');
    }
}
