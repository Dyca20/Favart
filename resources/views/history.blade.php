<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FavArt - Catálogo</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="bg-slate-50 h-screen w-screen overflow-x-hidden">
    {{-- Muestra el Navbar, está en la carpeta layouts con el nombre customer. --}}
    @include('layouts.Customer')

    <main class="flex pl-20 pr-20 pt-10 flex-col h-screen">
        <div class="flex pl-10 justify-between bg-red-300 h-24 rounded-md">
            <h1 class="flex gap-2 items-center text-4xl font-semibold text-white">
                <i class="gg-shopping-bag"></i>Historial de compras
            </h1>
            <img class="object-cover w-66" src="{{ URL::asset('images/anillo.png') }}" alt="">
        </div>
        <div class="flex mt-10 space-x-3 w-auto m-0">
            <div class="w-full m-auto overflow-x-auto relative shadow-sm overflow-y-auto max-h-screen">

                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3 px-6">
                                Factura
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Fecha
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Precio
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Descuento
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Precio Total
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Cantidad
                            </th>
                            <th class="py-4 px-6">
                                Estado
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($historiales as $index => $historial)
                        <tr class="bg-white border-b  hover:bg-gray-5">

                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap max-w-xxs">
                                <p class="text-justify overflow-hidden">
                                    @foreach ($productosHistorial as $productoHistorial)
                                    @for ($i = 0; $i < 3; $i++) @if (count($productoHistorial) <=$i) @break @endif @if ($productoHistorial[$i]->idHistorial == $historial->idHistorial)
                                        @foreach ($productos as $producto)
                                        @if ($producto->idProducto == $productoHistorial[$i]->idProducto)
                                        {{ $producto->nombreProducto . '. ' }}
                                        @endif
                                        @endforeach
                                        @endif
                                        @endfor
                                        @endforeach
                                </p>
                            </th>
                            <td class="py-4 px-6">
                                {{ $historial->fecha }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $historial->resumenPrecio }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $historial->descuento }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $historial->total }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $historial->cantidad }}
                            </td>
                            <td class="py-4 px-6">
                                @if ($pedidos[$index]->estado == 1)
                                Pendiente
                                @endif
                                @if ($pedidos[$index]->estado == 2)
                                En envío
                                @endif
                                @if ($pedidos[$index]->estado == 3)
                                Completado
                                @endif
                            </td>
                            <td class="py-4 px-6 space-x-2">
                                <a href="{{ url('/carritoHistorial/' . $historial->idHistorial) }}" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-500 to-red-500 group-hover:from-red-500 group-hover:to-red-500 hover:text-white  focus:ring-4 focus:outline-none focus:ring-cyan-200">
                                    <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white  rounded-md group-hover:bg-opacity-0">
                                        Productos
                                    </span></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>


        </div>
    </main>
    @include('layouts.footer')
    <script src="./js/app.js"></script>
</body>

</html>