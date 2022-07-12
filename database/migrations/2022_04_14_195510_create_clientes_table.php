<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Id_Usuario')->constrained('usuarios');
            $table->string('Nombre', 25);
            $table->string('Primer_Apellido', 25);
            $table->string('Segundo_Apellido', 25);
            $table->float('Edad', 2);
            $table->foreignId('Id_Barrio')->constrained('barrios');
            $table->foreignId('Id_Distrito')->constrained('distritos');
            $table->foreignId('Id_Canton')->constrained('cantons');
            $table->foreignId('Id_Provincia')->constrained('provincias');
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
        Schema::dropIfExists('clientes');
    }
}
