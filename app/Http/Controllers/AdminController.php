<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Direccion;
use App\Models\Telefono;
use App\Models\Persona;
use App\Models\User;
use App\Models\Producto;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getWelcomePage()
    {
        return view('admin/welcome');
    }

    public function getHistoryPage()
    {
        return view('admin/history');
    }

    public function getManageInventoryPage()
    {
        $productos = Producto::all();
        return view('admin/inventory', array('productos' => $productos));
    }

    public function getAddProductPage()
    {
        return view('admin/addProduct');
    }

    protected function validator(array $data)
    {

        return Validator::make($data, []);
    }
    public function postAddProductPage(Request $data)
    {


        /*   $validacion = Validator::make($data->all(), $this->reglas_registro(), $this->mensajes_registro());

        if ($validacion->fails()) :
            return back()->withErrors($validacion)->withInput();
        else : 
*/
        $file = $data->file('imagen');

        $name = time() . $file->getClientOriginalName();
        $file->move(public_path() . '/images/productos', $name);

        Producto::create([
            'nombre' => $data['nombre_Producto'],
            'categoria' => $data['categoria'],
            'precio' => $data['precio'],
            'cantidad' => $data['cantidad'],
            'detalles' => $data['detalles'],
            'imagen' => $name,
        ]);

        return  redirect()->route('manageInventory');
        /*  endif; */

        return view('admin/addProduct');
    }

    public function getProductoPage($id)
    {
        $producto = $this->obtenerProducto($id);
        $data = ['producto' => $producto];
        return view('admin/editProduct', $data);
    }

    public function postProductoPage(Request $data, $id)
    {

        $reglas =  $this->reglas_ProductoEditar();
        $mensaje = $this->mensajes_ProductoEditar();

        $validacion = Validator::make($data->all(), $reglas, $mensaje);
        $data->all();

        if ($validacion->fails()) :
            return back()->withErrors($validacion)->withInput();

        else :
            $producto = $this->obtenerProducto($id);

            $producto->cantidad = $data->cantidad;
            $producto->nombre = $data->nombre_Producto;
            $producto->precio = $data->precio;
            $producto->imagen =  $producto->imagen;
            $producto->detalles = $data->detalles;
            $producto->categoria = $data->categoria;
            $producto->save();

            return  redirect()->route('manageInventory');

            return  redirect()->route('admin/' . $producto->id_producto . '/editProduct');

        endif;
    }

    public function getPerfilPage($id)
    {
        $usuario = $this->obtenerUsuario($id);
        $direccion = $this->obtenerDireccion($usuario->Persona->id_direccion);
        $telefono = Telefono::where('id_Persona', $usuario->id_Persona)->first();
        $data = ['usuario' => $usuario, 'telefono' => $telefono, 'direccion' => $direccion];
        return view('admin/perfil', $data);
    }

    public function postPerfilPage(Request $data, $id)
    {
      /*   $reglas =  $this->reglas_registroEditar($data->password);
        $mensaje = $this->mensajes_registroeditar($data->password);

        $validacion = Validator::make($data->all(), $reglas, $mensaje); */
        //  if ($validacion->fails()) :
        //        return back()->withErrors($validacion)->withInput();


        //      else :
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



        return  view('admin/welcome');
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
    protected function obtenerDireccion($id)
    {
        $direccion = Direccion::findOrFail($id);
        return $direccion;
    }
    public function obtenerProducto($id)
    {
        $producto = Producto::findOrFail($id);
        return $producto;
    }

    private function reglas_ProductoEditar()
    {

        $reglas = '';
        $reglas = [
            'nombre_Producto' => ['required', 'string', 'min:4', 'max:25'],
            'categoria' => ['required', 'string', 'min:2', 'max:25'],
            'precio' => ['required', 'numeric', 'max:100000'],
            'cantidad' => ['required', 'numeric', 'max:1000'],
            'detalles' => ['required', 'string', 'min:5', 'max:255'],

        ];

        return $reglas;
    }

    private function mensajes_ProductoEditar()
    {

        $mensaje = '';

        $mensaje = [
            'nombre_Producto.required' => 'El nombre del producto es requerido',
            'nombre_Producto.min' => 'El nombre del producto  debe ser de al menos 5 carácteres',
            'nombre_Producto.max' => 'El nombre del producto  debe máximo de 25 carácteres',
            'categoria.required' => 'La categoria es requerido',
            'categoria.min' => 'La categoria debe ser al menos de 2 carácteres',
            'categoria.max' => 'La categoria es demasiado largo, utiliza un nombre más corto',
            'cantidad.max' => 'La cantidad máxima esta predefinida en 1000',
            'cantidad.required' => 'La cantidad es requerida',
            'cantidad.min' => 'La cantidad no puede ser 0',
            'cantidad.numeric' => 'La cantidad debe ser un número entero',
            'precio.required' => 'El precio es requerido',
            'precio.min' => 'El precio no puede ser 0',
            'precio.max' => 'El precio máximo esta predefinido en ₡100 000',
            'precio.numeric' => 'Este campo solo admite números',

        ];

        return $mensaje;
    }
}
