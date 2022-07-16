<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FavArt - Gestionar Inventario</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="">
    {{-- Muestra el Navbar, está en la carpeta layouts con el nombre admin. --}}
    @include('layouts.Admin')
    <main>
        <section class="grid-rows-2 px-36 pt-12 font-light w-full">
            <div class="flex items-center pb-8">
                <div class="h-auto w-36">
                    <img src="{{ URL::asset('/images/LogoFavart.png') }}" alt="logo" class="w-auto object-cover ">
                </div>
                <div class="ml-6">
                    <h1 class="text-4xl font-semibold text-gray-800"><b> Gestionar Inventario </b></h1>
                </div>
            </div>
            <div class="grid  lg:grid-cols-1 md:grid-cols-1 p-4">
                <div class="flex justify-between py-y px-6 whitespace-nowrap text-sm font-medium">
                    <div> <a href="#" class="text-indigo-600 hover:text-indigo-900">Agregar</a></div>

                    <div class="flex">

                        <label class="text-gray-700  font-bold px-2" for="usuario">Buscar</label>

                        <input type="text" id="buscar_producto_por_id" name="buscar_producto_por_id" class="bg-gray-50 rounded w-full h-6 text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-rose-300 transition duration-500 px-3 pb-3">
                    </div>


                </div>
            </div>


            <div class="col-span-2 flex flex-auto items-center justify-between  pb-5 px-5 bg-white rounded shadow-sm">
                <table class="min-w-full divide-y divide-gray-200 table-auto" id="tablaProductos" name="tablaProductos">
                    <thead class="bg-gray-50">

                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Código
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Cantidad
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Precio
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Categoria
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Opciones
                            </th>

                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="tbodyProductos" name="tbodyProductos">
                        @foreach($productos as $producto)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        <img class="h-12 w-12 rounded-full" src="{{ URL::asset('/images/carousel/post_3.jpg') }}" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-700">
                                          {{ $producto -> id_producto }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $producto -> nombre }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $producto -> cantidad }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $producto -> precio }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $producto -> categoria }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Editar /</a>
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Detalles /</a>
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Eliminar </a>
                            </td>
                        </tr>
                        @endforeach()

                        <!-- More people... -->
                    </tbody>
                </table>
            </div>
            </div>


        </section>
    </main>
    <script src="./js/Admin.js"></script>
</body>