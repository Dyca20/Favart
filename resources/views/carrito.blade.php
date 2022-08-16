<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FavArt - Carrito</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://css.gg/shopping-bag.css' rel='stylesheet'>
    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="bg-slate-50 h-screen w-screen overflow-x-hidden">
    @include('layouts.Customer')
    <main class="flex pl-20 pr-20 pt-10 flex-col h-screen">
        <div class="flex pl-10 justify-between bg-gradient-to-r from-red-300 to-red-50 h-24 rounded-md">
            <h1 class="flex gap-2 items-center text-4xl font-semibold text-white">
                Carrito de Compras
            </h1>
            <img class="object-cover w-96" src="{{ URL::asset('images/hmoon.png') }}" alt="">
        </div>
        <section class="grid-rows-2 pt-12 font-light w-full">
            <div class="flex space-x-2 lg:grid-cols-1 md:grid-cols-1 p-2">
                <a href="{{ url('/catalog') }}"><button type="button"
                        class="flex gap-2 text-white space-x-2 bg-red-400 hover:bg-red-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center mr-2 ">
                        <i class="gg-shopping-bag"></i>
                        Seguir comprando
                    </button></a>
            </div>
            <div class="col-span-2 flex flex-auto items-center justify-between  pb-5  bg-white rounded shadow-sm">
                <table class="w-full divide-y divide-gray-200 table-auto" id="tablaProductos" name="tablaProductos">
                    <thead class="bg-gray-50">

                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Imagen
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Producto
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Cantidad
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Precio
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Descuento
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Total
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Opciones
                            </th>

                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="tbodyProductos" name="tbodyProductos">
                        @foreach ($productos as $producto)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-20 w-20">
                                            <img class="h-20 w-20 rounded-full"
                                                src="{{ URL::asset('/images/productos/' . $producto->imagen) }}"
                                                alt="">
                                        </div>

                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $producto->nombreProducto }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $producto->cantidad }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    ₡ {{ $producto->precio }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    ₡ {{ $producto->precio * ($producto->descuento / 100) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    ₡
                                    {{ ($producto->precio - $producto->precio * ($producto->descuento / 100)) * $producto->cantidad }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ url('/sumProductCarrito/' . $producto->idProducto) }}"
                                        class="text-indigo-600 hover:text-indigo-900">👆 /</a>
                                    <a href="{{ url('/subProductCarrito/' . $producto->idProducto) }}"
                                        class="text-indigo-600 hover:text-indigo-900">👇 /</a>
                                    <a href="{{ url('/delProductCarrito/' . $producto->idProducto) }}"
                                        class="text-indigo-600 hover:text-indigo-900">❌ </a>
                                </td>
                            </tr>
                        @endforeach()
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Totales

                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                {{ $carrito->cantidad }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                {{ '₡' . $carrito->resumenPrecio }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Desc. total: {{ ' ₡' . $carrito->descuento }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Precio Total: {{ ' ₡' . $carrito->total }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                <a href="{{ url('/finishCarrito') }}"><button type="button"
                                        class="text-white bg-red-400 hover:bg-red-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 ">
                                        <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                            </path>
                                        </svg>
                                        Finalizar Pedido
                                    </button></a>

                        </tr>

                    </tbody>
                </table>

            </div>
            </div>
        </section>
    </main>
    @include('layouts.footer')
</body>
