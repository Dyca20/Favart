<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
           
            $table->increments('id_Pedido');

            $table->integer('id_Usuario')->unsigned();
            $table->foreign('id_Usuario')->references('id_Usuario')->on('users');

            $table->integer('id_Carrito')->unsigned();
            $table->foreign('id_Carrito')->references('id_Carrito')->on('carrito_de_compras');

            $table->date('fecha', 6);
            $table->string('estado', 25);
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
        Schema::dropIfExists('pedidos');
    }
}
