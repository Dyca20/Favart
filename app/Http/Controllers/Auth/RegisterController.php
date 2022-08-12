<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Persona;
use App\Models\Telefono;
use App\Models\Direccion;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ValidationsController;


class RegisterController extends ValidationsController
{

    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function register(Request $data)
    {

        $validacion =  Validator::make($data->all(), $this->reglas_registro(),  $this->mensajes_registro());
        if ($validacion->fails()) :
            return back()->withErrors($validacion)->withInput();
        else :

            $idDireccion = Direccion::insertGetId([
                'señasExactas' => $data['direccion'],
            ]);

            $idPersona = Persona::insertGetId([
                'idDireccion' => $idDireccion,
                'nombre' => $data['name'],
                'apellidos' => $data['apellidos'],
                'edad'  => $data['edad']
            ]);

            User::create([
                'idPersona' => $idPersona,
                'nombreUsuario' => $data['nombreUsuario'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'rolUsuario' => 1
            ]);

            Telefono::create([
                'idPersona' => $idPersona,
                'numeroTelefono' => $data['telefono']
            ]);

            return  redirect()->route('login');
        endif;
    }
}
