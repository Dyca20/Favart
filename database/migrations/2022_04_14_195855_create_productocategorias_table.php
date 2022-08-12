<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_categorias', function (Blueprint $table) {

            $table->increments('idProductoCategoria');

            $table->integer('idCategoria')->unsigned();
            $table->foreign('idCategoria')->references('idCategoria')->on('categorias');

            $table->integer('idProducto')->unsigned();
            $table->foreign('idProducto')->references('idProducto')->on('productos') ->onDelete('cascade') ->change();

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
        Schema::dropIfExists('producto_categorias');
    }
}

