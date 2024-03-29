<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('idProducto');
            $table->integer('cantidad');
            $table->string('nombreProducto', 50);
            $table->float('precio');
            $table->binary('imagen');
            $table->string('detalles', 255);
            $table->string('categoria', 255)->nullable();
            $table->float('descuento')->nullable();
            $table->boolean('estado')->nullable();

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
        Schema::dropIfExists('productos');
    }
}
