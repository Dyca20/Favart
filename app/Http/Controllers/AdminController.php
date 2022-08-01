<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ValidationsController;
use App\Models\Categoria;
use App\Models\Direccion;
use App\Models\Telefono;
use App\Models\Persona;
use App\Models\User;
use App\Models\Producto;
use App\Models\ProductoCategoria;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class AdminController extends ValidationsController
{

    /* Metodos get para generar la vista */

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

    public function getEditProductPage($id)
    {
        $producto = $this->obtenerProducto($id);
        $data = ['producto' => $producto];
        return view('admin/editProduct', $data);
    }

    public function getAddCategoryPage($id)
    {
        $producto = $this->obtenerProducto($id);
        $dataCategorias = '';

        $categorias = Categoria::all();
        $categoriaFormateadas = array();

        $categoriasDelProducto = ProductoCategoria::where('id_producto', $id)->get();
        $categoriasDelProductoNombres = array();

        foreach ($categorias as $categoria) {
            $categoria = ['id_categoria' => $categoria->id_categoria, 'nombre_categoria' => $categoria->nombreCategoria];
            array_push($categoriaFormateadas,  $categoria);
        }

        foreach ($categoriasDelProducto as $categoriaProducto) {

            $id_categoria = $categoriaProducto->id_categoria;
            $nombre_categoria = Categoria::find($categoriaProducto->id_categoria)->nombreCategoria;
            $categoria = ['id_categoria' => $id_categoria, 'nombre_categoria' => $nombre_categoria];
            $dataCategorias .= $nombre_categoria . ' ';
            array_push($categoriasDelProductoNombres,  $categoria);
        }

        foreach ($categoriaFormateadas as $index => $item) {
            foreach ($categoriasDelProductoNombres as $index2 => $item2) {

                if ($item['id_categoria'] == $item2['id_categoria']) {
                    unset($categoriaFormateadas[$index]);
                }
            }
        }

        $categorias = $categoriaFormateadas;
        $producto->categoria = $dataCategorias;
        $producto->save();

        $data = ['producto' => $producto];
        return view('admin/category', array('categorias' => $categorias,  'categoriasProducto' => $categoriasDelProductoNombres), $data);
    }

    public function getEditPerfilPage($id)
    {
        $usuario = $this->obtenerUsuario($id);
        $direccion = $this->obtenerDireccion($usuario->Persona->id_direccion);
        $telefono = Telefono::where('id_Persona', $usuario->id_Persona)->first();
        $data = ['usuario' => $usuario, 'telefono' => $telefono, 'direccion' => $direccion];
        return view('admin/perfil', $data);
    }
    /* Operaciones para los productos */

    public function postAddProductPage(Request $data)
    {

        $validacion = Validator::make($data->all(), $this->reglas_addproduct(), $this->mensajes_addproduct());

        if ($validacion->fails()) :
            return back()->withErrors($validacion)->withInput();
        else :

            $file = $data->file('imagen');

            $name = time() . $file->getClientOriginalName();
            $file->move(public_path() . '/images/productos', $name);

            $this->optimizarImg($name);

            $idProducto = Producto::insertGetId([
                'nombre_Producto' => $data['nombre_Producto'],
                'precio' => $data['precio'],
                'cantidad' => $data['cantidad'],
                'detalles' => $data['detalles'],
                'imagen' => $name,
            ]);

            return  redirect('admin/' . $idProducto . '/addCategory');
        endif;

        return view('admin/addProduct');
    }
    public function optimizarImg($name)
    {
        $optimizerChain = OptimizerChainFactory::create();
        $source = public_path() . '/images/productos/'. $name;
        $optimizerChain->optimize($source);

    }

    public function postEditProductPage(Request $data, $id)
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
            $producto->nombre_Producto = $data->nombre_Producto;
            $producto->precio = $data->precio;
            $producto->detalles = $data->detalles;

            if (is_null($data->imagen)) :

            else :
                unlink('images/productos/' . $producto->imagen);

                $file = $data->file('imagen');
                $name = time() . $file->getClientOriginalName();
                $file->move(public_path() . '/images/productos', $name);

                $producto->imagen =  $name;

            endif;

            $producto->save();

            return  redirect()->route('manageInventory');


        endif;
    }

    public function postDeleteProductPage($id)
    {

        $producto = $this->obtenerProducto($id);

        unlink('images/productos/' . $producto->imagen);
        DB::table('productos')->where('id_producto', '=', $id)->delete();

        return  redirect()->route('manageInventory');
    }


    /* Operaciones para las categorias */

    public function postAddCategoryPage(Request $request, $id)
    {

        $reglas =  $this->rules_AddCategory();
        $mensaje = $this->messages_AddCategory();

        $validacion = Validator::make($request->all(), $reglas, $mensaje);
        $request->all();

        if ($validacion->fails()) :
            return back()->withErrors($validacion)->withInput();

        else :
            Categoria::create([
                'nombreCategoria' => $request['nombreCategoria'],
            ]);

            return  redirect('admin/' . $id . '/addCategory');


        endif;
    }

    public function postAddProductCategoryPage($id_producto, $id_categoria)
    {

        ProductoCategoria::create([
            'id_producto' => $id_producto,
            'id_categoria' => $id_categoria,
        ]);
        return  redirect('admin/' . $id_producto . '/addCategory');
    }

    public function postDeleteProductCategoryPage($id_producto, $id_categoria)
    {

        DB::table('producto_categorias')->where('id_categoria', '=', $id_categoria)->where('id_producto', '=', $id_producto)->delete();

        return  redirect('admin/' . $id_producto . '/addCategory');
    }

    public function postDeleteCategoryPage($id_producto, $id_categoria)
    {

        DB::table('categorias')->where('id_categoria', '=', $id_categoria)->delete();
        return  redirect('admin/' . $id_producto . '/addCategory');
    }


    /* Operaciones para el perfil */

    public function postEditPerfilPage(Request $data, $id)
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

            return  view('admin/welcome');
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
    public function obtenerProducto($id)
    {
        $producto = Producto::findOrFail($id);
        return $producto;
    }


    /* Operaciones para buscador */

    public function getSearcherPage(Request $request)
    {

        $productos =  Producto::where("nombre_Producto", 'like', $request->buscar_producto . "%")->take(10)->get();

        return view('admin/inventory', array('productos' => $productos));
    }
}
