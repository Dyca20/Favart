<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FavArt - Historial</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="bg-slate-50 h-screen w-screen overflow-x-hidden">
    @include('layouts.Admin')
    <main class="flex pl-20 pr-20 pt-10 flex-col h-screen">
        <div class="flex pl-10 justify-between bg-gradient-to-r from-red-300 to-red-50 h-24 rounded-md">
            <h1 class="flex gap-2 items-center text-4xl font-semibold text-white">
                <i class="gg-shopping-bag"></i>Historial de ventas
            </h1>
            <img class="object-cover w-68" src="{{ URL::asset('images/hmoon.png') }}" alt="">
        </div>
        <div class="flex mt-10 space-x-3 w-auto m-0 ">
            <div class="w-full m-auto shadow-sm relative overflow-visible overflow-y-auto max-h-screen">
            
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
                        @foreach ($historiales as $index => $historial)
                        <tr class="bg-white border-b hover:bg-gray-5">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap max-w-xs">
                                <p class="text-justify h-10 overflow-hidden">
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
                                @foreach ($users[0] as $usuario)
                                @if ($usuario->idUsuario == $historial->idUsuario)

                                <a>
                                    <button type="button" data-modal-toggle="{{ $usuario->nombreUsuario }}" class="underline text-blue-600">
                                        {{ $usuario->nombreUsuario }}
                                    </button></a>

                                <div id="{{ $usuario->nombreUsuario }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full" aria-modal="true" role="dialog">
                                    <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
                                        <div class="relative bg-white rounded-t-lg rounded-b-lg shadow">
                                            <div class="flex justify-between items-start p-4 rounded-t border-b ">
                                                <h3 class="text-xl font-semibold text-gray-900 ">
                                                    {{ $usuario->nombreUsuario }}
                                                </h3>
                                                {{-- La X de cerrar el modal. --}}
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center " data-modal-toggle="{{ $usuario->nombreUsuario }}">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="flex flex-row h-56 w-full">
                                                {{-- imagen del producto --}}
                                                <div class="p-6 pl-10 pr-10 space-y-5 flex flex-col overflow-y-auto" style="width: inherit">
                                                    <div class="flex flex-col">
                                                        <h3 class="font-bold text-gray-500 text-base">Nombre
                                                            completo</h3>
                                                        <p class="text-base leading-relaxed text-gray-500">
                                                            @foreach ($users[1] as $persona)
                                                            @if($usuario->idPersona == $persona -> idPersona )
                                                            {{ $persona -> nombre }} {{ $persona -> apellidos }}
                                                            @php
                                                            $idDireccion = $persona -> idDireccion
                                                            @endphp
                                                            @endif
                                                            @endforeach
                                                        </p>
                                                    </div>
                                                    <div class="flex justify-between">
                                                        <div class="flex flex-col">
                                                            <h3 class="font-bold text-gray-500 text-base">
                                                                Teléfono:</h3>
                                                            <p class="text-base leading-relaxed text-gray-500">
                                                                <a class="text-blue-600" target="_blank" data-tooltip-target="tooltip-telefono" href="https://wa.me/{{ '85049932' }}">
                                                                    @foreach ($users[2] as $telefono)
                                                                    @if($usuario->idPersona == $telefono -> idPersona )
                                                                    {{ $telefono -> numeroTelefono }}
                                                                    @endif
                                                                    @endforeach
                                                                </a>
                                                            <div id="tooltip-telefono" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
                                                                Escribir por WhatsApp
                                                                <div class="tooltip-arrow" data-popper-arrow>
                                                                </div>
                                                            </div>
                                                            </p>
                                                        </div>
                                                        {{-- precio --}}
                                                        <div class="flex flex-col">
                                                            <h3 class="font-bold text-gray-500 text-base">
                                                                Correo electrónico:</h3>
                                                            <p class="text-base leading-relaxed text-gray-500">
                                                                <a class="text-blue-600 hover:underline" data-tooltip-target="tooltip-correo" target="blank" href="https://mail.google.com/mail/u/0/#inbox?compose=new">
                                                                    {{ $usuario->email }}
                                                                </a>
                                                            <div id="tooltip-correo" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
                                                                Redactar correo electrónico
                                                                <div class="tooltip-arrow" data-popper-arrow>
                                                                </div>
                                                            </div>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <h3 class="font-bold text-gray-500">Dirección exacta
                                                        </h3>
                                                        <p class="leading-relaxed text-gray-500 w-auto text-sm">
                                                            @foreach ($users[3] as $direccion)
                                                            @if($idDireccion == $direccion -> idDireccion )
                                                            {{ $direccion -> señasExactas }}
                                                            @endif
                                                            @endforeach
                                                        </p>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="flex items-center p-2 space-x-2 rounded-b border-t border-gray-200 bg-white" data-modal-toggle="{{ $usuario->nombreUsuario }}">
                                                <a><button type="button" class="text-white bg-red-400 hover:bg-red-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center inline-flex items-center mr-2 ">
                                                        Cerrar
                                                    </button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </td>

                            <td class="py-4 px-6">
                                {{ $historial->total }}
                            </td>
                            <td class="py-4 px-6 z-30">
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
                                <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="text-white bg-slate-600 hover:bg-slate-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center " type="button">Estado <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg></button>
                                <div id="dropdown" class="z-10 w-44 bg-white rounded divide-y divide-gray-100  hidden" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(319px, 70px);">
                                    <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownDefault">

                                        <li>
                                            <a href="{{ url('/admin/history/status/'.$historial->idHistorial .'/'. 1 )}}" class="block py-2 px-4 hover:bg-gray-100 ">Pendiente</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/admin/history/status/'.$historial->idHistorial .'/'. 2 )}}" class="block py-2 px-4 hover:bg-gray-100 ">En envío</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/admin/history/status/'.$historial->idHistorial  .'/'. 3 )}}" class="block py-2 px-4 hover:bg-gray-100 ">Completado</a>
                                        </li>

                                    </ul>
                                </div>

                                <a href="{{ url('/admin/carritoHistorial/' . $historial->idHistorial . '/' . $historial->idUsuario) }}" class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-500 to-red-500 group-hover:from-red-500 group-hover:to-red-500 hover:text-white  focus:ring-4 focus:outline-none focus:ring-cyan-200">
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


    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>

</body>

</html>