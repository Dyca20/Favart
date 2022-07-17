<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\Persona;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApiJsController;
use App\Http\Controllers\Controller;
use App\Models\Telefono;

class PrincipalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getWelcomePage()
    {
        
        return view('welcome');
    }
    public function getCatalogPage()
    {
        return view('catalog');
    }
    public function getPerfilPage($id)
    {
        $usuario = $this->obtenerUsuario($id);
        $telefono = Telefono::where('id_Persona', $usuario->id_Persona)->first();
        $data = ['usuario' => $usuario, 'telefono' => $telefono];
        return view('perfil', $data);
    }

    public function postPerfilPage(Request $request, $id)
    {
   

       
       
        
       $reglas =  $this->reglas_registroEditar($request->password);
       $mensaje = $this->mensajes_registroeditar($request->password);

       $validacion = Validator::make($request->all(), $reglas, $mensaje);

    //  if ($validacion->fails()) :
    //        return back()->withErrors($validacion)->withInput();

            
  //      else :
            $persona = $this->obtenerPersona($id);
            $usuario = $this->obtenerUsuario($persona->id_Persona);

            $telefono = $this->obtenerTelefono($persona->id_Persona);
           
            $usuario->email = $request->email;
            $usuario->nombre_Usuario = $request->nombre_Usuario;
            if ($request->password != null) :
                $usuario->password = Hash::make($request->password);
            endif;
            $usuario->save();
            
            $persona->nombre = $request->name;
            $persona->primer_Apellido = $request->apellidos;
            $persona->segundo_Apellido = $request->apellidos;
            $persona->edad = $request->edad;
            $persona->save();
             
          
          $telefono->numero_Telefono = $request->telefono;
          $telefono->save();
            
       
            return  view( '/welcome');
   //     endif;
    }
    public function obtenerUsuario($id)
    {
        $usuario = User::findOrFail($id);
        return $usuario;
    }
    public function obtenerTelefono($id)
    {
        $telefono = Telefono::findOrFail($id);
        return $telefono;
    }
    protected function obtenerPersona($id)
    {
        $persona = Persona::findOrFail($id);
        return $persona;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function reglas_registroEditar($contraseña){
        
        $reglas = '';
        if ($contraseña != null) :
        $reglas = [
            'nombre_Usuario' => ['required', 'string', 'min:5', 'max:25'],
            'password' => ['required', 'string', 'min:8' ,'required_with:password_confirmation','same:password_confirmation'],
            'password_confirmation' => [ 'min:8'],
            'name' => ['required', 'string', 'min:2','max:25'],
            'apellidos' => ['required', 'string', 'min:5', 'max:25'],
            'email' => ['required', 'email', 'min:5', 'max:255', 'unique:users'],
            'edad' => ['required', 'numeric', 'max:100'],
            'telefono' => 'required | numeric| min:8 ',
        ];
        else :
            $reglas = [
                'nombre_Usuario' => ['required', 'string', 'min:5', 'max:25'],
                'name' => ['required', 'string', 'min:2','max:25'],
                'apellidos' => ['required', 'string', 'min:5', 'max:25'],
                'email' => ['required', 'email', 'min:5', 'max:255', 'unique:users'],
                'edad' => ['required', 'numeric', 'max:100'],
                'telefono' => 'required | numeric| min:8 ',
            ];
        endif;
        return $reglas;
    }

    private function mensajes_registroeditar($contraseña){

        $mensaje = '';
        if ($contraseña != null) :
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
        else :
            $mensaje = [
                'nombre_Usuario.required' => 'El nombre de usuario es requerido',
            'nombre_Usuario.min' => 'El nombre de usuario debe ser de al menos 5 carácteres',
            'nombre_Usuario.max' => 'El nombre de usuario debe máximo de 25 carácteres',
                'name.required' => 'El nombre es requerido' ,
            'name.min' => 'El nombre debe ser al menos de 2 carácteres' ,
            'name.max' => 'El nombre es demasiado largo, utiliza un nombre más corto' ,
            'apellidos.required' => 'Los apellidos son requeridos' ,
            'apellidos.min' => 'Los apellidos deben ser al menos de 5 carácteres' ,
            'apellidos.max' => 'Los apellidos deben ser máximo de 25 carácteres' ,
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
    endif;
    return $mensaje;
    }
}
