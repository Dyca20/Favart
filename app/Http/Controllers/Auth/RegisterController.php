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
                'señas_Exactas' => $data['direccion'],
            ]);

            $idPersona = Persona::insertGetId([
                'id_Direccion' => $idDireccion,
                'nombre' => $data['name'],
                'apellidos' => $data['apellidos'],
                'edad'  => $data['edad']
            ]);

            User::create([
                'id_Persona' => $idPersona,
                'nombre_Usuario' => $data['nombre_Usuario'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'rolUsuario' => 1
            ]);

            Telefono::create([
                'id_Persona' => $idPersona,
                'numero_Telefono' => $data['telefono']
            ]);

            return  redirect()->route('login');
        endif;
    }
}
