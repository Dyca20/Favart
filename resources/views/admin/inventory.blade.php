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
    <main class="flex pl-20 pr-20 pt-10 flex-col h-screen">
        <div class="flex pl-10 justify-between bg-gradient-to-r from-red-300 to-red-50 h-24 rounded-md">
            <h1 class="flex gap-2 items-center text-4xl font-semibold text-white">
                <i class="gg-shopping-bag"></i>Gestionar inventario
            </h1>
            <img class="object-cover w-68" src="{{ URL::asset('images/gestor.png') }}" alt="">
        </div>
        <section class="grid-rows-2 mt-10 w-full">
            <div class="flex p-3 space-x-2">
                <a href="/admin/addProduct" class="text-indigo-600 hover:text-indigo-900">
                    <button type="button" class="text-white bg-rose-400 hover:bg-rose-300 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Agregar
                        nuevo producto</button>
                </a>
                <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="text-white bg-slate-600 hover:bg-slate-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 h-10 text-center inline-flex items-center " type="button">Categorías <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg></button>
                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow  hidden" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(319px, 70px);">
                    <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownDefault">
                        @foreach ($categoria as $categoriaProducto)
                        <li>
                            <a href="{{ url('/admin/manageInventory/searcher/' . $categoriaProducto->idCategoria) }}" class="block py-2 px-4 hover:bg-gray-100 ">{{ $categoriaProducto->nombreCategoria }}</a>
                        </li>
                        @endforeach

                    </ul>
                </div>
                <form class="flex space-x-2" method="POST" action="{{ url('admin/buscador') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="text" id="buscarProducto" name="buscarProducto" class="bg-gray-50 rounded h-10 text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-rose-300 transition duration-500 px-3 pb-3">
                    <button class="bg-slate-600 hover:bg-zinc-500 text-white font-bold px-4 h-10 rounded shadow-lg hover:transition duration-500 " type="submit">
                        Buscar
                    </button>
                </form>
                <a href="{{ url('admin/manageInventory') }}">
                    <button class="bg-slate-600 hover:bg-zinc-500 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500" type="button">
                        Mostrar Todo
                    </button>
                </a>
            </div>
            <div class="col-span-2 flex flex-auto items-center justify-between px-5 bg-white rounded shadow-sm overflow-y-auto max-h-screen">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Imagen
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Nombre
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Cantidad
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Precio
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Categorías
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Detalles
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tbodyProductos" name="tbodyProductos">
                        @foreach ($productos as $producto)
                        <tr class="bg-white border-b hover:bg-gray-5">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-20 w-20">
                                        <img class="h-20 w-20 rounded-full" src="{{ URL::asset('/images/productos/' . $producto->imagen) }}" alt="">
                                    </div>

                                </div>
                            </td>
                            <td class="py-4 px-6">
                                {{ $producto->nombreProducto }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $producto->cantidad }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $producto->precio }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $producto->categoria }}
                            </td>
                            <td class="py-4 px-6">
                                <div class="max-w-xs">
                                    <p class="text-justify h-10 text-ellipsis overflow-hidden">
                                        {{ $producto->detalles }}
                                    </p>
                                </div>
                            </td>

                            <td class="py-4 px-6 space-x-2">
                                <a href="{{ url('admin/' . $producto->idProducto . '/editProduct') }}" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-blue-500 group-hover:to-cyan-500 hover:text-white  focus:ring-4 focus:outline-none focus:ring-cyan-200">
                                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white  rounded-md group-hover:bg-opacity-0">
                                        Editar
                                    </span></a>
                                <a href="{{ url('admin/' . $producto->idProducto . '/deleteProduct') }}" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-500 to-red-400 group-hover:from-red-500 group-hover:to-red-400 hover:text-white  focus:ring-4 focus:outline-none focus:ring-red-200">
                                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white  rounded-md group-hover:bg-opacity-0">
                                        Eliminar
                                    </span></a>
                            </td>
                        </tr>
                        @endforeach()

                    </tbody>

                </table>

            </div>


        </section>

    </main>
 
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
</body>