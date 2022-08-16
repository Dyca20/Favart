<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FavArt - Carrito</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="bg-slate-50 h-screen w-screen overflow-x-hidden">
    @include('layouts.Customer')
    <main class="flex pl-20 pr-20 pt-10 flex-col h-screen">
        <div class="flex pl-10 justify-between bg-gradient-to-r from-red-300 to-red-50 h-24 rounded-md">
            <h1 class="flex gap-2 items-center text-4xl font-semibold text-white">
                <i class="gg-shopping-bag"></i>Historial Carrito de Compras
            </h1>
            <img class="object-cover w-96" src="{{ URL::asset('images/hmoon.png') }}" alt="">
        </div>
        <section class="grid-rows-2 pt-12 font-light w-full">
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
                                {{ $historial->cantidad }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                {{ '₡' . $historial->resumenPrecio }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Desc. total: {{ ' ₡' . $historial->descuento }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Precio Total: {{ ' ₡' . $historial->total }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                <a href="{{ url('/history') }}"><button type="button"
                                        class="text-white bg-red-400 hover:bg-red-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 ">
                                        Volver
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
