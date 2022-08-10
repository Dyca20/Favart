@extends('layouts.Admin')

@section('content')

<body class="bg-rose-100 min-h-screen pt-0 md:pt-0pb-6 px-2 md:px-0" style="font-family:'Lato',sans-serif;">
    <div class="pt-10 mt-6">
        <h1 class="text-4xl font-bold text-center ">Inventario Fav Art <span class="text-rose-400 text-6xl">.<span></h1>
    </div>


    <div class="flex mb-8 justify-between p-36 pt-0 w-full">
        <div class="mt-10 w-full mr-10">
            <h3 class="font-bold text-2xl">Datos del producto</h3>
            <p class="text-gray-600 pt-2 pb-6">Editar datos</p>

            <form method="POST" action="{{url('/admin/'.$producto -> id_producto.'/editProduct')}}" enctype="multipart/form-data">

                @csrf

                <div class="flex flex-wrap -mx-3 mb-0">

                    <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nombre_Producto">
                            Nombre del Producto
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="nombre_Producto" name="nombre_Producto" value="{{$producto->nombre_Producto}}" type="text">
                        @error('nombre_Producto')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="categoria">
                            Categoría
                        </label>
                        <a href="{{url('admin/' . $producto -> id_producto . '/addCategory')}}">
                            <button class="bg-rose-400 hover:bg-zinc-500 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500  mb-3" type="button">
                                Editar Categorias
                            </button>
                        </a>
                    </div>

                    <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="precio">
                            Precio
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="precio" name="precio" type="number" value="{{$producto->precio}}" min="0" max="100000">
                        @error('precio')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cantidad">
                            Cantidad
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="cantidad" name="cantidad" type="number" min="0" max="1000" value="{{$producto->cantidad}}">
                        @error('cantidad')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="detalles">
                            Detalles
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="detalles" name="detalles" type="text" value="{{$producto->detalles}}">
                        @error('detalles')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="descuento">
                            Descuento
                        </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="descuento" name="descuento" type="number" min="0" max="100" value="{{$producto->descuento}}">
                        @error('descuento')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="imagen">
                            Imagen
                        </label>
                        <div class="relative h-80 w-1/2 overflow-hidden content-center">

                            <img class="absolute crop object-cover" src="{{ URL::asset('images/productos/'.$producto -> imagen) }}" alt="product image">

                        </div>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="imagen" name="imagen" type="file" placeholder="Imagen">

                    </div>
                </div>


                {{-- boton de enviar form y cancelar --}}

                <div class="flex flex-wrap -mx-3 mb-2 ">
                    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                        <button class="bg-rose-400 hover:bg-zinc-500 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500" type="submit">
                            Guardar
                        </button>
                    </div>
                    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                        <a href="{{url()->previous()}}"> <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500" type="button">
                                Cancelar
                            </button>
                        </a>
                    </div>
                </div>

            </form>
        </div>
        <div class="mt-20">
            <img src="{{ URL::asset('/images/LogoFavart.png') }}" alt="logo" class="w-auto object-cover ">
        </div>
    </div>
</body>
@endsection