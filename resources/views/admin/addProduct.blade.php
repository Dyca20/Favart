@extends('layouts.Admin')

@section('content')

    <body class="bg-rose-100 min-h-screen pt-0 md:pt-0pb-6 px-2 md:px-0" style="font-family:'Lato',sans-serif;">
        <div class="pt-10 mt-6">
            <h1 class="text-4xl font-bold text-center ">Inventario Fav Art <span class="text-rose-400 text-6xl">.<span></h1>
        </div>

        <div class="flex mb-8 justify-between p-36 pt-0 w-full">
            <div class="mt-10 w-full mr-10">
                <h3 class="font-bold text-2xl">Agregue un producto</h3>
                <p class="text-gray-600 pt-2 pb-6">Ingrese los datos</p>
                <form method="POST" action="{{ route('postAddProduct') }}" class="w-full mr-4"
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
                                id="nombreProducto" name="nombreProducto" type="text" placeholder="Producto"
                                value="{{ old('nombreProducto') }}">
                            @error('nombreProducto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="precio">
                                Precio
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="precio" name="precio" type="number" min="0" max="100000"
                                placeholder="Precio" value="{{ old('precio') }}">
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
                                placeholder="Cantidad" value="{{ old('cantidad') }}">
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
                                id="detalles" name="detalles" type="text" placeholder="Detalles"
                                value="{{ old('detalles') }}">
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
                                placeholder="Descuento" value="{{ old('descuento') }}">
                            @error('descuento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">

                            <label class="block uppercase mb-2 text-sm font-bold text-gray-700" for="imagen">Subir
                                imagen</label>
                            <input
                                class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none "
                                aria-describedby="file_input_help" id="imagen" name="imagen" type="file"
                                value="{{ old('imagen') }}">
                            @error('imagen')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <p class="mt-1 mb-3 text-sm text-gray-500" id="imagen">PNG, JPG
                                o
                                GIF (MAX. 800x400px).</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                            <button
                                class="bg-rose-400 hover:bg-rose-300 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500"
                                type="submit">
                                {{ __('Siguiente') }}
                            </button>
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
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
    </body>
@endsection
