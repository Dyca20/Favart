<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Producto_Compra;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

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

    public function obtenerProducto($id)
    {
        $producto = Producto::findOrFail($id);
        return $producto;
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
            $product = $this->obtenerProducto($id);

            $product->cantidad = $data->cantidad;
            $product->nombre = $data->nombre_Producto;
            $product->precio = $data->precio;
            $product->imagen =  $product->imagen;
            $product->detalles = $data->detalles;
            $product->categoria = $data->categoria;
            $product->save();

            return  redirect()->route('manageInventory');

        /*             return  redirect()->route('admin/'.$product-> id_producto.'/editProduct');
 */
        endif;
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
