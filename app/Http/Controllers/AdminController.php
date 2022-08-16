<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ValidationsController;
use App\Models\Categoria;
use App\Models\Direccion;
use App\Models\HistorialCarrito;
use App\Models\Pedido;
use App\Models\Telefono;
use App\Models\Persona;
use App\Models\User;
use App\Models\Producto;
use App\Models\ProductoCategoria;
use App\Models\ProductoHistorial;
use Illuminate\Support\Facades\Auth;
use Spatie\ImageOptimizer\OptimizerChainFactory;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class AdminController extends ValidationsController
{

    /* Metodos get para generar la vista */

    public function getWelcomePage()
    {
        return view('admin/welcome');
    }
    public function getManageInventoryPage()
    {
        $productos = Producto::all();
        foreach ($productos as $index => $producto) :
            if ($producto->estado == 0) :
                unset($productos[$index]);
            endif;
        endforeach;

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

        $categoriasDelProducto = ProductoCategoria::where('idProducto', $id)->get();
        $categoriasDelProductoNombres = array();

        foreach ($categorias as $categoria) {
            $categoria = ['idCategoria' => $categoria->idCategoria, 'nombreCategoria' => $categoria->nombreCategoria];
            array_push($categoriaFormateadas,  $categoria);
        }

        foreach ($categoriasDelProducto as $categoriaProducto) {

            $idCategoria = $categoriaProducto->idCategoria;
            $nombreCategoria = Categoria::find($categoriaProducto->idCategoria)->nombreCategoria;
            $categoria = ['idCategoria' => $idCategoria, 'nombreCategoria' => $nombreCategoria];
            $dataCategorias .= $nombreCategoria . ' ';
            array_push($categoriasDelProductoNombres,  $categoria);
        }

        foreach ($categoriaFormateadas as $index => $item) {
            foreach ($categoriasDelProductoNombres as $index2 => $item2) {

                if ($item['idCategoria'] == $item2['idCategoria']) {
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
        $direccion = $this->obtenerDireccion($usuario->Persona->idDireccion);
        $telefono = Telefono::where('idPersona', $usuario->idPersona)->first();
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
                'nombreProducto' => $data['nombreProducto'],
                'precio' => $data['precio'],
                'cantidad' => $data['cantidad'],
                'detalles' => $data['detalles'],
                'descuento' => $data['descuento'],
                'estado' => 1,
                'imagen' => $name,
            ]);

            return  redirect('admin/' . $idProducto . '/addCategory');
        endif;

        return view('admin/addProduct');
    }
    public function optimizarImg($name)
    {
        $optimizerChain = OptimizerChainFactory::create();
        $source = public_path() . '/images/productos/' . $name;
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
            $producto->nombreProducto = $data->nombreProducto;
            $producto->precio = $data->precio;
            $producto->detalles = $data->detalles;
            $producto->descuento = $data->descuento;


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
        $productohistorial = ProductoHistorial::where('idProducto',  $producto->idProducto)->get();
        if ($productohistorial->isEmpty()) :
            unlink('images/productos/' . $producto->imagen);
            DB::table('productos')->where('idProducto', '=', $id)->delete();
        else :
            $producto->estado = 0;
            $producto->save();
        endif;
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

    public function postAddProductCategoryPage($idProducto, $idCategoria)
    {

        ProductoCategoria::create([
            'idProducto' => $idProducto,
            'idCategoria' => $idCategoria,
        ]);
        return  redirect('admin/' . $idProducto . '/addCategory');
    }

    public function postDeleteProductCategoryPage($idProducto, $idCategoria)
    {

        DB::table('producto_categorias')->where('idCategoria', '=', $idCategoria)->where('idProducto', '=', $idProducto)->delete();

        return  redirect('admin/' . $idProducto . '/addCategory');
    }

    public function postDeleteCategoryPage($idProducto, $idCategoria)
    {

        DB::table('categorias')->where('idCategoria', '=', $idCategoria)->delete();
        return  redirect('admin/' . $idProducto . '/addCategory');
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
        $productos =  Producto::where("nombreProducto", 'like', $request->buscarProducto . "%")->take(10)->get();

        return view('admin/inventory', array('productos' => $productos));
    }

    public function getHistoryPage()
    {
        $historiales = HistorialCarrito::orderBy('fecha', 'DESC')->get();
        $usuarios = User::all();
        $pedidos = Pedido::all();
        $productos = ProductoHistorial::all();

        $productosHistorial = array();
        $pedidosUsuario = array();
        foreach ($historiales as $historial) :
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

        return view('admin/history', array('historiales' => $historiales, 'productos' => $productos, 'productosHistorial' => $productosHistorial, 'users' => $usuarios, 'pedidos' => $pedidos));
    }

    public function getCarritoHistorialPage($idHistorial, $idUsuario)
    {
        $productos = Producto::all();

        $historialUsuario = HistorialCarrito::where('idUsuario', $idUsuario)->where('idHistorial', $idHistorial)->first();

        $productosHistorial = ProductoHistorial::where('idHistorial', '=', $idHistorial . "%")->get();

        $productosCarrito = array();

        foreach ($productos as $producto) :

            foreach ($productosHistorial as $productoHistorial) {

                if ($producto['idProducto'] == $productoHistorial['idProducto']) {

                    $producto['cantidad'] = $productoHistorial['cantidadCarrito'];

                    $producto['descuento'] = $productoHistorial['descuento'];

                    array_push($productosCarrito, $producto);
                }
            }

        endforeach;

        return view('admin/carritohistorial', array('productos' => $productosCarrito, 'historial' => $historialUsuario));
    }

    public function getAccounting()
    {
        $productos = Producto::all();

        $historialUsuario = new HistorialCarrito;

        $productosHistorial = ProductoHistorial::all();

        $pedidos = Pedido::all();

        $productosComprados = array();
        $totalPrecioProducto = array();
        $totalPedidos = array();

        $cantidad = 0;
        $resumenPrecio = 0;
        $descuento = 0;
        $total  = 0;
        $ingresar = true;

        foreach ($productosHistorial as $index => $productoHistorial) :
            foreach ($productos as $producto) :

                if ($producto['idProducto'] == $productoHistorial['idProducto']) :

                    $producto['cantidad'] = $productoHistorial['cantidadCarrito'];
                    $cantidad +=  $producto['cantidad'];
                    $resumenPrecio +=  ($producto['cantidad'] * $producto['precio']);
                    $descuento +=  ($producto['cantidad'] * ($productoHistorial['descuento'] / 100 * $producto['precio']));
                    $total = $resumenPrecio -  $descuento;

                    $totalProducto =  ($producto['cantidad'] * $producto['precio']) - ($producto['cantidad'] * ($productoHistorial['descuento'] / 100 * $producto['precio']));

                    if (count($productosComprados) < 1) :

                        array_push($productosComprados, $producto);
                        array_push($totalPrecioProducto,  $totalProducto);
                    else :

                        foreach ($productosComprados as $index => $productoComprado) :

                            if ($producto['idProducto'] == $productoComprado['idProducto']) :
                                $productoComprado['cantidad'] += $producto['cantidad'];
                                $totalPrecioProducto[$index] +=  $totalProducto;
                                $ingresar = false;
                            endif;

                        endforeach;

                        if ($ingresar) :
                            array_push($productosComprados, $producto);
                            array_push($totalPrecioProducto,  $totalProducto);
                        else :
                            $ingresar = true;
                        endif;
                    endif;
                endif;
            endforeach;
        endforeach;

        $historialUsuario->cantidad =  $cantidad;
        $historialUsuario->resumenPrecio =  $resumenPrecio;
        $historialUsuario->descuento =    $descuento;
        $historialUsuario->total =  $total;

        $pedidosRealizados = count($pedidos);
        $pedidosPendientes = 0;
        $pedidosEnEnvio = 0;
        $pedidosCompletados = 0;

        array_push($totalPedidos, $pedidosRealizados, $pedidosPendientes, $pedidosEnEnvio, $pedidosCompletados);

        foreach ($pedidos as $pedido) :
            if ($pedido->estado == 1) {
                $totalPedidos[1] += 1;
            } else if ($pedido->estado == 2) {
                $totalPedidos[2] += 1;
            } else if ($pedido->estado == 3) {
                $totalPedidos[3] += 1;
            }

        endforeach;

        return view('admin/accounting', array('productos' => $productosComprados, 'historial' => $historialUsuario, 'totalproducto' => $totalPrecioProducto, 'totalPedidos' => $totalPedidos));
    }

    public function getChangeHistoryOrderStatus($idPedido, $idStatus)
    {
        $pedido = Pedido::where('idPedido', $idPedido)->get()->first();
        $pedido->estado = $idStatus;
        $pedido->save();

        return redirect('admin/history');
    }

    public function getAdminMakerPage($idUsuario)
    {
        $usuarios = User::all();
        $usuariosAdmin = User::where('rolUsuario', 2)->get();
        $usuarioElegido = new User();
        if ($idUsuario != 0) :
            $usuarioElegido = User::where('idUsuario', $idUsuario)->get()->first();
        endif;

        return view('admin/adminMaker', array('usuarios' => $usuarios,  'usuariosAdmin' => $usuariosAdmin, 'usuarioElegido' => $usuarioElegido));
    }

    public function postAddElectAdminMakerPage(Request $request)
    {

        $reglas =  $this->rules_AddElectAdmin();
        $mensaje = $this->messages_AddElectAdmin();

        $validacion = Validator::make($request->all(), $reglas, $mensaje);
        $request->all();

        if ($validacion->fails()) :
            return back()->withErrors($validacion)->withInput();

        else :
            $usuarioElegido = User::where('nombreUsuario', $request->nombreUsuario)->get()->first();
            if (is_null($usuarioElegido)) :
                return redirect('admin/adminMaker/0');
            else :
                if ($usuarioElegido->rolUsuario == 2) :
                    return redirect('admin/adminMaker/0');
                else :
                    return redirect('admin/adminMaker/' . $usuarioElegido->idUsuario);
                endif;
            endif;
        endif;

        return redirect('admin/adminMaker/0')->withErrors([
            'nombreUsuario' => 'El usuario no existe',
        ])->onlyInput('nombreUsuario');
    }
    public function getAddAdminMakerPage($idUsuario)
    {

        $usuarioElegido = User::where('idUsuario', $idUsuario)->get()->first();
        $usuarioElegido->rolUsuario = 2;
        $usuarioElegido->save();

        return redirect('admin/adminMaker/0');
    }
    public function getDelAdminMakerPage($idUsuario)
    {

        $usuarioElegido = User::where('idUsuario', $idUsuario)->get()->first();
        $usuarioElegido->rolUsuario = 1;
        $usuarioElegido->save();

        return redirect('admin/adminMaker/0');
    }
    
}
