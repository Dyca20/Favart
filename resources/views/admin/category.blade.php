@extends('layouts.Admin')

@section('content')
    <main class="flex pl-20 pr-20 pt-10 flex-col h-screen">
        <section class="font-medium w-full">
            <div class="flex pl-10 justify-between bg-gradient-to-r from-red-300 to-red-50 h-24 rounded-md">
                <h1 class="flex gap-2 items-center text-4xl font-semibold text-white">
                    <i class="gg-shopping-bag"></i>Gestionar categorías
                </h1>
                <img class="object-cover w-96" src="{{ URL::asset('images/hmoon.png') }}" alt="">
            </div>
            <form class="max-w-md" method="POST" action="{{ url('admin/' . $producto->idProducto . '/addCategory') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col mt-5">
                    <input
                        class="appearance-none flex placeholder-gray-300 bg-white text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="nombreCategoria" name="nombreCategoria" type="text" placeholder="Ej: Anillos"
                        value="{{ old('nombreCategoria') }}">
                    @error('nombreCategoria')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button
                        class="bg-rose-400 hover:bg-rose-300 text-white font-bold px-4 py-4 rounded shadow-lg hover:transition duration-500"
                        type="submit">
                        {{ __('Añadir categoría') }}
                    </button>


                </div>
            </form>
            <div class="grid grid-cols-2 gap-2 mt-10">
                <div class="flex flex-col items-center justify-center pb-5 px-5 bg-white rounded shadow-md">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Categorías Disponibles</h2>
                    <table class="divide-y divide-gray-200 table-auto" id="tablaCategorias" name="tablaCategorias">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                    Nombre
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="tbodyCategorias" name="tbodyCategorias">
                            @foreach ($categorias as $categoria)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $categoria['nombreCategoria'] }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                                        <a
                                            href="{{ url('admin/' . $producto->idProducto . '/' . $categoria['idCategoria'] . '/addProductCategory') }}"><button
                                                type="button"
                                                class="text-white bg-gradient-to-r from-red-400 via-rose-400 to-red-300 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300  font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Agregar</a><br>

                                        @if ($categoria['idCategoria'] == 1)
                                        @else
                                            <a href="{{ url('admin/' . $producto->idProducto . '/' . $categoria['idCategoria'] . '/deleteCategory') }}"
                                                class="text-indigo-600 hover:text-indigo-900">Eliminar</a><br>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-col items-center justify-between pb-10 px-5 bg-white rounded shadow-md">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">Categorías del producto:
                        {{ $producto->nombreProducto }}</h2>
                    <table class=" divide-y divide-gray-200 table-auto" id="tablaProductos" name="tablaProductos">
                        <thead class="bg-gray-50">

                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                    Nombre
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="tbodyCategorias" name="tbodyCategorias">
                            @foreach ($categoriasProducto as $categoriaProducto)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $categoriaProducto['nombreCategoria'] }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ url('admin/' . $producto->idProducto . '/' . $categoriaProducto['idCategoria'] . '/deleteProductCategory') }}"
                                            class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-500 to-red-500 group-hover:from-red-500 group-hover:to-red-500 hover:text-white  focus:ring-4 focus:outline-none focus:ring-cyan-200">
                                            <span
                                                class="relative px-5 py-2 transition-all ease-in duration-75 bg-white  rounded-md group-hover:bg-opacity-0">Eliminar</a><br>

                                    </td>

                                </tr>
                            @endforeach
                            <tr>
                                <td>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ url('admin/manageInventory') }}">
                                        <button
                                            class="bg-rose-400 hover:bg-rose-300 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500">
                                            {{ __('Finalizar') }}
                                        </button></a>

                                    </button>
                                </td>

                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>

        </section>
    </main>
    </body>
@endsection
