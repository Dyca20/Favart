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
            <div class="grid  lg:grid-cols-1 md:grid-cols-1 p-2">
                <div class="flex justify-between py-y px-6 whitespace-nowrap text-base font-medium">
                    <div> <a href="/admin/addProduct" class="text-indigo-600 hover:text-indigo-900">Agregar</a></div>

                    <div class="flex items-center w-2/3 max-w-xs">

                        <form method="POST" action="{{ url('admin/buscador') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="text" id="buscarProducto" name="buscarProducto" class="bg-gray-50 rounded w-3/4 h-10 text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-rose-300 transition duration-500 px-3 pb-3">
                            <button class="bg-rose-400 hover:bg-zinc-500 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500  mb-3" type="submit">
                                Buscar
                            </button>
                        </form>

                    </div>
                    <div class="flex items-center max-w-xs">
                        <a href="{{url('admin/manageInventory')}}">
                            <button class="bg-rose-400 hover:bg-zinc-500 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500" type="button">
                                Mostrar Todo
                            </button>
                        </a>
                    </div>


                </div>
            </div>


            <div class="col-span-2 flex flex-auto items-center justify-between  pb-5 px-5 bg-white rounded shadow-sm">
                <table class="min-w-full divide-y divide-gray-200 table-auto" id="tablaProductos" name="tablaProductos">
                    <thead class="bg-gray-50">

                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Imagen
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
                                Categorias
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Detalles
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
                                    <div class="flex-shrink-0 h-20 w-20">
                                        <img class="h-20 w-20 rounded-full" src="{{ URL::asset('/images/productos/'.$producto -> imagen) }}" alt="">
                                    </div>

                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $producto -> nombreProducto }}
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <div class="max-w-xs">
                                    <p class="text-justify h-10 text-ellipsis overflow-hidden"> {{ $producto -> detalles }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ url('admin/'.$producto -> idProducto.'/editProduct')}}" class="text-indigo-600 hover:text-indigo-900">Editar /</a>
                                <a href="{{ url('admin/'.$producto -> idProducto.'/deleteProduct')}}" class="text-indigo-600 hover:text-indigo-900">Eliminar </a>
                            </td>
                        </tr>
                        @endforeach()
                    </tbody>
                </table>

            </div>
            </div>


        </section>
    </main>
</body>