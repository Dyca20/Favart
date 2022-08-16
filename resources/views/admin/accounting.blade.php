<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FavArt - Contabilidad</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="bg-slate-50 h-screen w-screen overflow-x-hidden">
    @include('layouts.Admin')
    <main class="flex pl-20 pr-20 pt-10 flex-col h-screen">
        <div class="flex pl-10 justify-between bg-gradient-to-r from-red-300 to-red-50 h-24 rounded-md">
            <h1 class="flex gap-2 items-center text-4xl font-semibold text-white">
                <i class="gg-shopping-bag"></i>Gestionar categorías
            </h1>
            <img class="object-cover w-96" src="{{ URL::asset('images/hmoon.png') }}" alt="">
        </div>
        <div class="pb-20">
            <section class="grid-rows-2 px-36 pt-12 font-light w-full">
                <div class="flex items-center pb-8">
                    <h2 class="text-2xl font-medium text-gray-800 my-6"><b> Productos </b></h2>
                </div>
                <div class="col-span-2 flex flex-auto items-center justify-between  pb-5  bg-white rounded shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200 table-auto" id="tablaProductos"
                        name="tablaProductos">
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
                                    Vendidos
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
                            @foreach ($productos as $index => $producto)
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
                                        ₡ {{ $totalproducto[$index] }}
                                    </td>
                                </tr>
                            @endforeach()
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-bold text-gray-600 uppercase tracking-wider">
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
                                    Total: {{ ' ₡' . $historial->total }}
                                </th>

                            </tr>

                        </tbody>
                    </table>

                </div>

            </section>
            <section class="px-36 pt-12 font-light w-full">
                <div class="flex items-center pb-8">
                    <h2 class="text-2xl font-medium text-gray-800 my-6"><b> Pedidos </b></h2>
                </div>
                <table class="min-w-full divide-y divide-gray-200 table-auto" id="tablaTotales" name="tablaTotales">
                    <thead class="bg-gray-50">

                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Ingresos Totales
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Ganancias
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Pago a Proveedores
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="tbodyProductos" name="tbodyProductos">

                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ ' ₡' . $historial->total }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ ' ₡' . $historial->total * 0.25 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ ' ₡' . $historial->total * 0.75 }}
                            </td>
                        </tr>

                    </tbody>
                </table>

            </section>
            <section class="px-36 pt-12 font-light w-full">
                <div class="flex items-center pb-8">
                    <h2 class="text-2xl font-medium text-gray-800 my-6"><b> Ganancias y deducciones </b></h2>
                </div>
                <table class="min-w-full divide-y divide-gray-200 table-auto" id="tablaTotales" name="tablaTotales">
                    <thead class="bg-gray-50">

                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Ingresos Totales
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Ganancias
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Pago a Proveedores
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="tbodyProductos" name="tbodyProductos">

                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ ' ₡' . $historial->total }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ ' ₡' . $historial->total * 0.25 }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ ' ₡' . $historial->total * 0.75 }}
                            </td>
                        </tr>

                    </tbody>
                </table>
            </section>
            <div>
    </main>
</body>
