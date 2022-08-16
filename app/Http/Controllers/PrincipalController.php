<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ValidationsController;
use App\Models\CarritoDeCompra;
use App\Models\Direccion;
use App\Models\Telefono;
use App\Models\Persona;
use App\Models\User;
use App\Models\Producto;
use App\Models\ProductoCategoria;
use App\Models\Categoria;
use App\Models\HistorialCarrito;
use App\Models\Pedido;
use App\Models\ProductoCompra;
use App\Models\ProductoHistorial;
use Illuminate\Support\Facades\Auth;
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

        $accesorios = ProductoCategoria::where('idCategoria', 1)->get();


        foreach ($productos as $index => $producto) {
            if ($producto['cantidad'] >= 1 and $producto->estado == 1) {
                foreach ($accesorios as $index2 => $item2) {

                    if ($producto['idProducto'] == $item2['idProducto']) {
                        array_push($productosAccesorios, $producto);
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

        $carritoDelUsuario = CarritoDeCompra::where('idUsuario', Auth::User()->idUsuario)->first();
        if (is_null($carritoDelUsuario)) :

            $carritoDelUsuario = CarritoDeCompra::create([
                'idUsuario' => Auth::User()->idUsuario,
            ]);

        endif;
        $productosCompra = ProductoCompra::where('idCarrito', '=', $carritoDelUsuario->idCarrito . "%")->get();

        $productosCarrito = array();

        $cantidad = 0;
        $resumenPrecio = 0;
        $descuento = 0;
        $total  = 0;

        foreach ($productos as $producto) :

            foreach ($productosCompra as $productoCompra) {

                if ($producto['idProducto'] == $productoCompra['idProducto']) {

                    $producto['cantidad'] = $productoCompra['cantidadCarrito'];

                    $cantidad +=  $producto['cantidad'];

                    $resumenPrecio +=  ($producto['cantidad'] * $producto['precio']);

                    $descuento +=  ($producto['cantidad'] * ($producto['descuento'] / 100 * $producto['precio']));

                    $total = $resumenPrecio -  $descuento;

                    array_push($productosCarrito, $producto);
                }
            }

        endforeach;

        $carritoDelUsuario->cantidad =  $cantidad;
        $carritoDelUsuario->resumenPrecio =  $resumenPrecio;
        $carritoDelUsuario->descuento =    $descuento;
        $carritoDelUsuario->total =  $total;
        $carritoDelUsuario->save();

        return view('carrito', array('productos' => $productosCarrito, 'carrito' => $carritoDelUsuario));
    }
    public function getSumProductCarrito($idProducto)
    {
        $productoCompra = ProductoCompra::where('idProducto', $idProducto)->get()->first();
        $producto = Producto::where('idProducto', $idProducto)->get()->first();

        if ($productoCompra['cantidadCarrito'] <= $producto['cantidad']) :
            $productoCompra['cantidadCarrito'] += 1;
            $productoCompra->save();
        endif;

        return redirect('/carrito');
    }
    public function getSubProductCarrito($idProducto)
    {
        $productoCompra = ProductoCompra::where('idProducto', $idProducto)->get()->first();

        if ($productoCompra['cantidadCarrito'] == 1) :
            $productoCompra->delete();
        else :
            $productoCompra['cantidadCarrito'] -= 1;
            $productoCompra->save();
        endif;

        return redirect('/carrito');
    }

    public function getDelProductCarrito($idProducto)
    {
        $productoCompra = ProductoCompra::where('idProducto', $idProducto)->get()->first();
        $productoCompra->delete();
        return redirect('/carrito');
    }


    public function postAddProductCarrito(Request $request, $idProducto)
    {
        $carritoDelUsuario = CarritoDeCompra::where('idUsuario', Auth::User()->idUsuario)->first();
        $producto = Producto::where('idProducto', $idProducto)->get()->first();
        $request->all();

        if ($request->cantidad <= $producto['cantidad']) :
            if (is_null($carritoDelUsuario)) :

                $idCarrito = CarritoDeCompra::insertGetId([
                    'idUsuario' => Auth::User()->idUsuario,
                ]);

                ProductoCompra::create([
                    'idCarrito' => $idCarrito,
                    'idProducto' => $idProducto,
                    'cantidadCarrito' => $request->cantidad,
                ]);

            else :

                if (ProductoCompra::where('idProducto', $idProducto)->exists()) :

                    $productoCompra = ProductoCompra::where('idProducto', $idProducto)->get()->first();
                    $productoCompra['cantidadCarrito'] = $request->cantidad;
                    $productoCompra->save();
                else :
                    ProductoCompra::create([
                        'idCarrito' => $carritoDelUsuario->idCarrito,
                        'idProducto' => $idProducto,
                        'cantidadCarrito' => $request->cantidad,
                    ]);
                endif;

            endif;
        endif;

        return redirect('/catalog');
    }
    public function getFinishCarrito()
    {
        $carritoDelUsuario = CarritoDeCompra::where('idUsuario', Auth::User()->idUsuario)->first();
        $productosComprados = ProductoCompra::where('idCarrito',  $carritoDelUsuario->idCarrito)->get();
        $productos = Producto::all();

        if ($productosComprados->isEmpty()) :
        else :
            $condicion = 1;
            foreach ($productosComprados as $productoComprado) :
                foreach ($productos as $producto) :
                    if ($productoComprado->idProducto == $producto->idProducto) :
                        if ($productoComprado->cantidadCarrito > $producto->cantidad) :
                            $condicion += 1;

                        endif;
                    endif;
                endforeach;
            endforeach;
            if ($condicion == 1) :

                $date = Carbon::now();

                $idHistorial = HistorialCarrito::insertGetId([
                    'idUsuario' => $carritoDelUsuario->idUsuario,
                    'resumenPrecio' => $carritoDelUsuario->resumenPrecio,
                    'total' => $carritoDelUsuario->total,
                    'cantidad' => $carritoDelUsuario->cantidad,
                    'descuento' => $carritoDelUsuario->descuento,
                    'fecha' => $date,
                ]);

                Pedido::create([
                    'idUsuario' => $carritoDelUsuario->idUsuario,
                    'idHistorial' => $idHistorial,
                    'estado' => 1,
                ]);

                foreach ($productosComprados as $productoComprado) :
                    $descuento = 0;
                    foreach ($productos as $producto) :
                        if ($productoComprado->idProducto == $producto->idProducto) :

                            $descuento = $producto->descuento;
                            $cantidad = $producto->cantidad;
                            $cantidadVendida = $productoComprado->cantidadCarrito;
                            $cantidad -=  $cantidadVendida;
                            $producto->cantidad = $cantidad;
                            $producto->save();

                        endif;
                    endforeach;

                    ProductoHistorial::create([
                        'idHistorial' => $idHistorial,
                        'idProducto' => $productoComprado->idProducto,
                        'cantidadCarrito' => $productoComprado->cantidadCarrito,
                        'descuento' => $descuento,
                    ]);

                    $productoComprado->delete();
                endforeach;

                $carritoDelUsuario->delete();

                CarritoDeCompra::create([
                    'idUsuario' => Auth::User()->idUsuario,
                ]);
            else :
            endif;
        endif;

        return redirect('/carrito');
    }

    public function getPerfilPage($id)
    {
        $usuario = $this->obtenerUsuario($id);
        $direccion = $this->obtenerDireccion($usuario->Persona->idDireccion);
        $telefono = Telefono::where('idPersona', $usuario->idPersona)->first();
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
            $usuario = $this->obtenerUsuario($persona->idPersona);
            $direccion = $this->obtenerDireccion($persona->idDireccion);
            $telefono = $this->obtenerTelefono($persona->idPersona);

            $usuario->email = $data->email;
            $usuario->nombreUsuario = $data->nombreUsuario;
            if ($data->password != null) :
                $usuario->password = Hash::make($data->password);
            endif;
            $usuario->save();

            $persona->nombre = $data->name;
            $persona->apellidos = $data->apellidos;
            $persona->edad = $data->edad;
            $persona->save();

            $direccion->señasExactas = $data->direccion;
            $direccion->save();

            $telefono->numeroTelefono = $data->telefono;
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

        $productos =  Producto::where("nombreProducto", 'like', $request->buscarProducto . "%")->take(20)->get();

        foreach ($productos as $index => $producto) :
            if ($producto->estado == 0) :
                unset($productos[$index]);
            endif;
        endforeach;

        $productosAccesorios = array();

        $productosCategorias = ProductoCategoria::all();

        $accesorios = ProductoCategoria::where('idCategoria', 1)->get();


        foreach ($productos as $index => $item) {
            foreach ($accesorios as $index2 => $item2) {

                if ($item['idProducto'] == $item2['idProducto']) {
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

        $productosBuscados = ProductoCategoria::where('idCategoria',  $idCategoria)->get();

        $accesorios = ProductoCategoria::where('idCategoria', 1)->get();

        $categoria = Categoria::all();


        if ($productosBuscados->isEmpty()) :
            foreach ($productos as $i => $value) {
                unset($productos[$i]);
            }
        else :
            foreach ($productos as $index => $producto) {

                foreach ($productosBuscados as $index2 => $productoBuscado) {

                    if ($producto['idProducto'] == $productoBuscado['idProducto'] and $producto['estado'] == 1) {
                        array_push($productosEncontrados, $producto);
                        foreach ($accesorios as $index3 => $item2) {

                            if ($producto['idProducto'] == $item2['idProducto']) {
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
        $historialDelUsuario = HistorialCarrito::where('idUsuario', Auth::User()->idUsuario)->get();
        $pedidos = Pedido::all();
        $productos = ProductoHistorial::all();

        $productosHistorial = array();
        $pedidosUsuario = array();
        foreach ($historialDelUsuario as $historial) :
            $productosDelHistorial = array();
            foreach ($productos as $producto) :
                if ($producto->idHistorial == $historial->idHistorial) :
                    array_push($productosDelHistorial, $producto);
                endif;
            endforeach;
            array_push($productosHistorial, $productosDelHistorial);
            foreach ($pedidos as $pedido) :
                if ($pedido->idHistorial == $historial->idHistorial) :
                    array_push($pedidosUsuario, $pedido);
                endif;
            endforeach;
        endforeach;
        $productos =  Producto::all();

        return view('history', array('historiales' => $historialDelUsuario, 'productos' => $productos, 'productosHistorial' => $productosHistorial, 'pedidos' => $pedidosUsuario));
    }

    public function getCarritoHistorialPage($idHistorial)
    {
        $productos = Producto::all();

        $historialUsuario = HistorialCarrito::where('idUsuario', Auth::User()->idUsuario)->where('idHistorial', $idHistorial)->first();

        $productosHistorial = ProductoHistorial::where('idHistorial', '=', $idHistorial . "%")->get();


        $productosCarrito = array();

        foreach ($productos as $producto) :

            foreach ($productosHistorial as $productoHistorial) {

                if ($producto['idProducto'] == $productoHistorial['idProducto']) {

                    $producto['cantidad'] = $productoHistorial['cantidadCarrito'];

                    $producto['descuento'] = $productoHistorial['descuento'];

                    dump($producto['descuento'], $productoHistorial['descuento']);

                    array_push($productosCarrito, $producto);
                }
            }

        endforeach;

        return view('carritohistorial', array('productos' => $productosCarrito, 'historial' => $historialUsuario));
    }
}
