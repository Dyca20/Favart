<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ValidationsController;
use App\Models\Carrito_de_Compra;
use App\Models\Direccion;
use App\Models\Telefono;
use App\Models\Persona;
use App\Models\User;
use App\Models\Producto;
use App\Models\ProductoCategoria;
use App\Models\Categoria;
use App\Models\Producto_Compra;
use App\Models\Historial_Carrito;
use App\Models\Producto_Historial;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


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
        $categoria = Categoria::all();

        $accesorios = ProductoCategoria::where('id_categoria', 1)->get();


        foreach ($productos as $index => $item) {
            if ($item['cantidad'] >= 1) {
                foreach ($accesorios as $index2 => $item2) {

                    if ($item['id_producto'] == $item2['id_producto']) {
                        array_push($productosAccesorios, $item);
                        unset($productos[$index]);
                    }
                }
            } else {
                unset($productos[$index]);
            }
        }

        return view('catalog', array('productos' => $productos, 'accesorios' => $productosAccesorios, 'categorias' => $productosCategorias, 'categoria' => $categoria));
    }

    public function getCarritoPage()
    {
        $productos = Producto::all();

        $carritoDelUsuario = Carrito_de_Compra::where('id_Usuario', Auth::User()->id_Usuario)->first();

        $productos_compra = Producto_Compra::where('id_Carrito', '=', $carritoDelUsuario->id_Carrito . "%")->get();

        $productosCarrito = array();

        $cantidad = 0;
        $resumen_Precio = 0;
        $descuento = 0;
        $total  = 0;

        foreach ($productos as $producto) :

            foreach ($productos_compra as $producto_compra) {

                if ($producto['id_producto'] == $producto_compra['id_producto']) {

                    $producto['cantidad'] = $producto_compra['cantidad_Carrito'];

                    $cantidad +=  $producto['cantidad'];

                    $resumen_Precio +=  ($producto['cantidad'] * $producto['precio']);

                    $descuento +=  ($producto['cantidad'] * ($producto['descuento'] / 100 * $producto['precio']));

                    $total = $resumen_Precio -  $descuento;

                    array_push($productosCarrito, $producto);
                }
            }

        endforeach;

        $carritoDelUsuario->cantidad =  $cantidad;
        $carritoDelUsuario->resumen_Precio =  $resumen_Precio;
        $carritoDelUsuario->descuento =    $descuento;
        $carritoDelUsuario->total =  $total;
        $carritoDelUsuario->save();

        return view('carrito', array('productos' => $productosCarrito, 'carrito' => $carritoDelUsuario));
    }
    public function getSumProductCarrito($id_producto)
    {
        $producto_compra = Producto_Compra::where('id_producto', $id_producto)->get()->first();
        $producto = Producto::where('id_producto', $id_producto)->get()->first();

        if (1 <= $producto['cantidad']) :

            $producto_compra['cantidad_Carrito'] += 1;
            $producto['cantidad'] -= 1;
            $producto_compra->save();
            $producto->save();
        endif;

        return redirect('/carrito');
    }
    public function getSubProductCarrito($id_producto)
    {
        $producto_compra = Producto_Compra::where('id_producto', $id_producto)->get()->first();
        $producto = Producto::where('id_producto', $id_producto)->get()->first();

        if ($producto_compra['cantidad_Carrito'] == 1) :
            $producto['cantidad'] += 1;
            $producto_compra->delete();
            $producto->save();
        else :
            $producto_compra['cantidad_Carrito'] -= 1;
            $producto['cantidad'] += 1;
            $producto_compra->save();
            $producto->save();
        endif;

        return redirect('/carrito');
    }

    public function getDelProductCarrito($id_producto)
    {
        $producto_compra = Producto_Compra::where('id_producto', $id_producto)->get()->first();
        $producto = Producto::where('id_producto', $id_producto)->get()->first();
        $producto['cantidad'] += $producto_compra['cantidad_Carrito'];
        $producto->save();
        $producto_compra->delete();
        return redirect('/carrito');
    }


    public function getAddProductCarrito($id_producto)
    {
        $carritoDelUsuario = Carrito_de_Compra::where('id_Usuario', Auth::User()->id_Usuario)->first();
        $producto = Producto::where('id_producto', $id_producto)->get()->first();

        if (is_null($carritoDelUsuario)) :

            $id_carrito = Carrito_de_Compra::insertGetId([
                'id_Usuario' => Auth::User()->id_Usuario,
            ]);
            if (1 <= $producto['cantidad']) :
                Producto_Compra::create([
                    'id_Carrito' => $id_carrito,
                    'id_producto' => $id_producto,
                    'cantidad_Carrito' => 1,
                ]);
                $producto['cantidad'] -= 1;
                $producto->save();
            endif;
        else :

            if (Producto_Compra::where('id_producto', $id_producto)->exists()) :

                $producto_compra = Producto_Compra::where('id_producto', $id_producto)->get()->first();

                if ($producto_compra['cantidad_Carrito'] <= 1) :

                    $producto_compra['cantidad_Carrito'] += 1;
                    $producto['cantidad'] -= 1;
                    $producto->save();
                    $producto_compra->save();

                endif;
            else :
                if (1 <= $producto['cantidad']) :
                    Producto_Compra::create([
                        'id_Carrito' => $carritoDelUsuario->id_Carrito,
                        'id_producto' => $id_producto,
                        'cantidad_Carrito' => 1,
                    ]);
                    $producto['cantidad'] -= 1;
                    $producto->save();
                endif;
            endif;

        endif;

        return redirect('/catalog');
    }
    public function getFinishCarrito() ///////////////////////////////////////////////////////////////////////////////////////////////
    {
        $carritoDelUsuario = Carrito_de_Compra::where('id_Usuario', Auth::User()->id_Usuario)->first();
        $productosComprados = Producto_Compra::where('id_Carrito',  $carritoDelUsuario->id_Carrito)->get();

        if ($productosComprados->isEmpty()) :
        else :
            $date = Carbon::now();

            $id_historial = Historial_Carrito::insertGetId([
                'id_Usuario' => $carritoDelUsuario->id_Usuario,
                'resumen_Precio' => $carritoDelUsuario->resumen_Precio,
                'total' => $carritoDelUsuario->total,
                'cantidad' => $carritoDelUsuario->cantidad,
                'descuento' => $carritoDelUsuario->descuento,
                'fecha' => $date,
            ]);

            foreach ($productosComprados as $producto) :
                Producto_Historial::create([
                    'id_historial' => $id_historial,
                    'id_producto' => $producto->id_producto,
                    'cantidad_Carrito' => $producto->cantidad_Carrito,
                ]);
                $producto->delete();
            endforeach;

            $carritoDelUsuario->delete();

            Carrito_de_Compra::create([
                'id_Usuario' => Auth::User()->id_Usuario,
            ]);
        endif;

        return redirect('/carrito');
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

    public function getSearcherPage(Request $request)
    {
        $categoria = Categoria::all();

        $productos =  Producto::where("nombre_Producto", 'like', $request->buscar_producto . "%")->take(20)->get();

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


        return view('catalog', array('productos' => $productos, 'accesorios' => $productosAccesorios, 'categorias' => $productosCategorias, 'categoria' => $categoria));
    }

    public function getSearcherCategoryPage($idCategoria)
    {
        $productos =  Producto::all();

        $productosAccesorios = array();

        $productosEncontrados = array();

        $productosCategorias = ProductoCategoria::all();

        $productosBuscados = ProductoCategoria::where('id_categoria',  $idCategoria)->get();

        $accesorios = ProductoCategoria::where('id_categoria', 1)->get();

        $categoria = Categoria::all();


        if ($productosBuscados->isEmpty()) :
            foreach ($productos as $i => $value) {
                unset($productos[$i]);
            }
        else :
            foreach ($productos as $index => $producto) {

                foreach ($productosBuscados as $index2 => $productoBuscado) {

                    if ($producto['id_producto'] == $productoBuscado['id_producto']) {
                        array_push($productosEncontrados, $producto);
                        foreach ($accesorios as $index3 => $item2) {

                            if ($producto['id_producto'] == $item2['id_producto']) {
                                array_push($productosAccesorios, $producto);
                            }
                        }
                    }
                }
            }
            $productos = $productosEncontrados;
        endif;
        return view('catalog', array('productos' => $productos, 'accesorios' => $productosAccesorios, 'categorias' => $productosCategorias, 'categoria' => $categoria));
    }

    public function getHistoryPage()
    {
        $historialDelUsuario = Historial_Carrito::where('id_Usuario', Auth::User()->id_Usuario)->get();
        $productosHistorial = array();
        foreach ($historialDelUsuario as $historial) {
            $productos = Producto_Historial::where('id_historial',  $historial->id_historial)->get();
            array_push($productosHistorial, $productos);
        }
        $productos =  Producto::all();

        return view('history', array('historiales' => $historialDelUsuario, 'productos' => $productos, 'productosHistorial' => $productosHistorial));
    }

    public function getCarritoHistorialPage($id_historial)
    {
        $productos = Producto::all();

        $historialUsuario = Historial_Carrito::where('id_Usuario', Auth::User()->id_Usuario)->where('id_historial', $id_historial)->first();

        $productos_historial = Producto_Historial::where('id_historial', '=', $id_historial . "%")->get();

        $productosCarrito = array();

        foreach ($productos as $producto) :

            foreach ($productos_historial as $producto_historial) {

                if ($producto['id_producto'] == $producto_historial['id_producto']) {

                    $producto['cantidad'] = $producto_historial['cantidad_Carrito'];

                    array_push($productosCarrito, $producto);
                }
            }

        endforeach;

        return view('carritohistorial', array('productos' => $productosCarrito, 'historial' => $historialUsuario));
    }
}
