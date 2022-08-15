<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FavArt - Hitorial</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="bg-rose-50">

    @include('layouts.Admin')

    <main class="flex flex-col">
        <div class="flex flex-col ml-20 pt-20 pb-10">
            <h1 class="text-4xl font-semibold">Historial de ventas</h1>
            <p class="font-normal">A continuación se muestra su historial de compras:</p>
        </div>
        <div class="flex ml-20 space-x-3 w-auto m-0">
            <div class="w-3/4 m-auto overflow-x-auto relative">
                <div class="pb-4 p-2 bg-white rounded-t-lg">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative mt-1">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input type="text" id="table-search" class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Buscar facturacion">
                    </div>
                </div>
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
                                Usuario
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Precio Total
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Estado
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($historiales as $index => $historial)
                        <tr class="bg-white border-b  hover:bg-gray-5">

                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap max-w-xs">
                                <p class="text-justify h-10 overflow-hidden">
                                    @foreach($productosHistorial as $productoHistorial)
                                    @for($i=0; $i < 3; $i++) @if(count($productoHistorial) <=$i) @break @endif @if($productoHistorial[$i] -> idHistorial == $historial -> idHistorial)
                                        @foreach($productos as $producto)

                                        @if($producto -> idProducto == $productoHistorial[$i] -> idProducto)
                                        {{$producto -> nombreProducto. '. '}}
                                        @endif
                                        @endforeach
                                        @endif
                                        @endfor
                                        @endforeach
                                </p>
                            </th>
                            <td class="py-4 px-6">
                                {{$historial -> fecha}}
                            </td>
                            <td class="py-4 px-6">
                                @foreach($users as $usuario)
                                @if($usuario -> idUsuario == $historial -> idUsuario)
                                {{$usuario -> nombreUsuario}}
                                @endif
                                @endforeach

                            </td>

                            <td class="py-4 px-6">
                                {{$historial -> total}}
                            </td>
                            <td class="py-4 px-6">
                                @if($pedidos[$index] -> estado == 1)
                                Pendiente
                                @endif
                                @if($pedidos[$index]-> estado == 2)
                                En envío
                                @endif
                                @if($pedidos[$index] -> estado == 3)
                                Completado
                                @endif
                            </td>

                            <td class="py-4 px-6 space-x-2">
                                <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="text-white bg-slate-600 hover:bg-slate-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center " type="button">Estado <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg></button>
                                <div id="dropdown" class="z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow  hidden" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(319px, 70px);">
                                    <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownDefault">

                                        <li>
                                            <a href="{{ url('/admin/status/.$historial -> idUsuario)}}" class="block py-2 px-4 hover:bg-gray-100 ">Pendiente</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/' )}}" class="block py-2 px-4 hover:bg-gray-100 ">En envío</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/' )}}" class="block py-2 px-4 hover:bg-gray-100 ">Completado</a>
                                        </li>
                                    </ul>
                                </div>

                                <a href="{{url('/admin/carritoHistorial/'.$historial -> idHistorial.'/'.$historial -> idUsuario )}}" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-500 to-red-500 group-hover:from-red-500 group-hover:to-red-500 hover:text-white  focus:ring-4 focus:outline-none focus:ring-cyan-200">
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
    <script src="./js/app.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>

</body>

</html>