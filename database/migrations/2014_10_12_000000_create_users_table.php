<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('idUsuario');

            $table->integer('idPersona')->unsigned();
            $table->foreign('idPersona')->references('idPersona')->on('personas');

            $table->string('nombreUsuario');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('rolUsuario');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table("users")
            ->insert([
                "idUsuario" => 1,
                "idPersona" => 1,
                "nombreUsuario" => "tinimurillo",
                "email" => "tinimurillo@gmail.com",
                "password" => "$2y$10$"."G6qNDfOdZ".".0yr4avd1J02.pV8kRwFy1ZASDe9B7Wvsy7EvcrrJTry",
                "rolUsuario" => 2,
                
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
