<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ValidationsController;
use App\Models\Direccion;
use App\Models\Telefono;
use App\Models\Persona;
use App\Models\User;
use App\Models\Producto;
use App\Models\ProductoCategoria;
use App\Models\Categoria;

class PrincipalController extends ValidationsController
{

    public function getWelcomePage()
    {

        return view('welcome');
    }

    public function getCatalogPage()
    {
        $productos = Producto::all();
        $productosAccesorios = array();
        $productosCategorias = ProductoCategoria::all();

        $accesorios = ProductoCategoria::where('id_categoria', 1)->get();


        foreach ($productos as $index => $item) {
            foreach ($accesorios as $index2 => $item2) {

                if ($item['id_producto'] == $item2['id_producto']) {                   
                    array_push($productosAccesorios, $item);  
                    unset($productos[$index]);
                }
            }
        }

        return view('catalog', array('productos' => $productos , 'accesorios' => $productosAccesorios , 'categorias' => $productosCategorias ));
    }
    public function getHistoryPage()
    {
        return view('history');
    }
    public function getPerfilPage($id)
    {
        $usuario = $this->obtenerUsuario($id);
        $direccion = $this->obtenerDireccion($usuario->Persona->id_direccion);
        $telefono = Telefono::where('id_Persona', $usuario->id_Persona)->first();
        $data = ['usuario' => $usuario, 'telefono' => $telefono, 'direccion' => $direccion];
        return view('perfil', $data);
    }

    public function postPerfilPage(Request $data, $id)
    {

        $reglas =  $this->reglas_registroEditar($data->password);
        $mensaje = $this->mensajes_registroeditar($data->password);

        $validacion = Validator::make($data->all(), $reglas, $mensaje);


        if ($validacion->fails()) :
            return back()->withErrors($validacion)->withInput();


        else :
            $persona = $this->obtenerPersona($id);
            $usuario = $this->obtenerUsuario($persona->id_Persona);
            $direccion = $this->obtenerDireccion($persona->id_direccion);
            $telefono = $this->obtenerTelefono($persona->id_Persona);

            $usuario->email = $data->email;
            $usuario->nombre_Usuario = $data->nombre_Usuario;
            if ($data->password != null) :
                $usuario->password = Hash::make($data->password);
            endif;
            $usuario->save();

            $persona->nombre = $data->name;
            $persona->apellidos = $data->apellidos;
            $persona->edad = $data->edad;
            $persona->save();

            $direccion->señas_Exactas = $data->direccion;
            $direccion->save();

            $telefono->numero_Telefono = $data->telefono;
            $telefono->save();



            return  view('/welcome');
        endif;
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

    protected function obtenerDireccion($id)
    {
        $direccion = Direccion::findOrFail($id);
        return $direccion;
    }
}
