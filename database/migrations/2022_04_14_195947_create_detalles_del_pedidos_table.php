<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesDelPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_del_pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Id_Producto')->constrained('productos');
            $table->float('Resumen_Precio', 6);
            $table->float('Cantidad', 2);
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
        Schema::dropIfExists('detalles_del_pedidos');
    }
}
