<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FavArt - Catálogo</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://css.gg/shopping-bag.css' rel='stylesheet'>
    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="bg-slate-50 h-screen w-screen overflow-x-hidden">
    @include('layouts.Admin')
    <main class="flex pl-20 pr-20 pt-10 flex-col h-screen">
        <div class="pt-10 mt-6">
            <h1 class="text-4xl font-bold text-center ">Inventario Fav Art <span class="text-rose-400 text-6xl">.<span>
            </h1>
        </div>
        <div class="flex mb-8 justify-between p-36 pt-0 w-full">
            <div class="mt-10 w-full mr-10">
                <h3 class="font-bold text-2xl">Datos del producto</h3>
                <p class="text-gray-600 pt-2 pb-6">Editar datos</p>
                <form method="POST" action="{{ url('/admin/' . $producto->idProducto . '/editProduct') }}"
                    enctype="multipart/form-data">

                    @csrf

                    <div class="flex flex-wrap -mx-3 mb-0">

                        <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="nombreProducto">
                                Nombre del Producto
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                id="nombreProducto" name="nombreProducto" value="{{ $producto->nombreProducto }}"
                                type="text">
                            @error('nombreProducto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="categoria">
                                Categoría: {{ $producto->categoria }}
                            </label>
                            <a href="{{ url('admin/' . $producto->idProducto . '/addCategory') }}">
                                <button
                                    class="bg-rose-400 hover:bg-rose-300 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500  mb-3"
                                    type="button">
                                    Editar su categoría
                                </button>
                            </a>
                        </div>

                        <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="precio">
                                Precio
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="precio" name="precio" type="number" value="{{ $producto->precio }}"
                                min="0" max="100000">
                            @error('precio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="cantidad">
                                Cantidad
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="cantidad" name="cantidad" type="number" min="0" max="1000"
                                value="{{ $producto->cantidad }}">
                            @error('cantidad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="detalles">
                                Detalles
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                id="detalles" name="detalles" type="text" value="{{ $producto->detalles }}">
                            @error('detalles')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="descuento">
                                Descuento
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="descuento" name="descuento" type="number" min="0" max="100"
                                value="{{ $producto->descuento }}">
                            @error('descuento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="imagen">
                                Imagen
                            </label>
                            <div class="relative h-80 w-1/2 overflow-hidden content-center">

                                <img class="absolute crop object-cover"
                                    src="{{ URL::asset('images/productos/' . $producto->imagen) }}"
                                    alt="product image">

                            </div>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="imagen" name="imagen" type="file" placeholder="Imagen">

                        </div>
                    </div>


                    {{-- boton de enviar form y cancelar --}}

                    <div class="flex flex-wrap -mx-3 mb-2 ">
                        <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                            <button
                                class="bg-rose-400 hover:bg-rose-300 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500"
                                type="submit">
                                Guardar
                            </button>
                        </div>
                        <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                            <a href="{{ url()->previous() }}"> <button
                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500"
                                    type="button">
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
    </main>
</body>

</html>
