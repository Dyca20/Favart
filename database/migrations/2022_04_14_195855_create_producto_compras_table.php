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
        Schema::create('producto_compras', function (Blueprint $table) {
            $table->integer('id_Carrito')->unsigned();
            $table->foreign('id_Carrito')->references('id_Carrito')->on('carrito_de_compras');

            $table->integer('id_Producto')->unsigned();
            $table->foreign('id_Producto')->references('id_Producto')->on('productos');

            $table->integer('cantidad');

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
        Schema::dropIfExists('producto_compras');
    }
}
