<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Persona;
use App\Models\Telefono;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:25'],
            'primer_Apellido' => ['required', 'string', 'max:25'],
            'segundo_Apellido' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'edad' => ['required', 'int', 'max:2'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
    }

    protected function register(Request $data)
    {

        //IF validacion {
        $idPersona = Persona::insertGetId([
            'id_Direccion' => 1,
            'nombre' => $data['name'],
            'primer_Apellido' => $data['apellidos'],
            'segundo_Apellido' => $data['apellidos'],
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
        //} else{
            //mensaje de error return back();
        //}
    }
}
