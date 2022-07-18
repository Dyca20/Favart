<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Persona;
use App\Models\Telefono;
use App\Models\Direccion;
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
    
        ]);
    }

    protected function register(Request $data)
    {
      

        $validacion = Validator::make($data->all(), $this->reglas_registro(), $this->mensajes_registro());

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

    private function reglas_registro(){
        
        $reglas = [
            'nombre_Usuario' => ['required', 'string', 'min:5', 'max:25'],
            'password' => ['required', 'string', 'min:8' ,'required_with:password_confirmation','same:password_confirmation'],
            'password_confirmation' => [ 'min:8'],
            'name' => ['required', 'string', 'min:2','max:25'],
            'apellidos' => ['required', 'string', 'min:5', 'max:25'],
            'direccion' => ['required', 'string', 'min:10', 'max:255'],
            'email' => ['required', 'email', 'min:5', 'max:255', 'unique:users'],
            'edad' => ['required', 'numeric', 'max:100'],
            'telefono' => 'required | numeric| min:8 ',
        ];
       return $reglas;
    }

    private function mensajes_registro(){

        $mensaje = [
            'nombre_Usuario.required' => 'El nombre de usuario es requerido',
            'nombre_Usuario.min' => 'El nombre de usuario debe ser de al menos 5 carácteres',
            'nombre_Usuario.max' => 'El nombre de usuario debe máximo de 25 carácteres',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe ser al menos de 8 carácteres' ,
            'password.required_with' => 'La contraseña debe ser confirmada' ,
            'password.same' => 'Las contraseñas no coinciden' ,
            'password_confirmation.min' => 'La confirmación no cumple el mínimo de 8 carácteres' ,
            'name.required' => 'El nombre es requerido' ,
            'name.min' => 'El nombre debe ser al menos de 2 carácteres' ,
            'name.max' => 'El nombre es demasiado largo, utiliza un nombre más corto' ,
            'apellidos.required' => 'Los apellidos son requeridos' ,
            'apellidos.min' => 'Los apellidos deben ser al menos de 5 carácteres' ,
            'apellidos.max' => 'Los apellidos deben ser máximo de 25 carácteres' ,
            'direccion.required' => 'La dirección es requerida' ,
            'direccion.min' => 'La dirección es muy corta' ,
            'direccion.max' => 'La dirección es muy larga' ,
            'email.required' => 'El correo electrónico es requerido' ,
            'email.min' => 'El correo electrónico debe contener al menos 5 carácteres' ,
            'email.max' => 'El correo electrónico es demasiado largo' ,
            'email.unique' => 'Ya existe una cuenta asociada a ese correo electrónico' ,
            'email.email' => 'El correo electrónico debe contener la forma ejemplo@ejemplo.com' ,
            'edad.max' => 'La edad es muy alta.' ,
            'edad.required' => 'La edad es requerida' ,
            'edad.min' => 'La edad es muy pequeña' ,
            'edad.numeric' => 'La edad debe ser un número entero' ,
            'telefono.required' => 'El número de teléfono es requerido' ,
            'telefono.min' => 'Los números de teléfono deben ser de 8 dígitos' ,
            'telefono.max' => 'Los números de teléfono deben ser de 8 dígitos' ,
            'telefono.numeric' => 'Este campo solo admite números' ,

        ];

        return $mensaje;
    }
}
