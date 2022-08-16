@extends('layouts.Admin')

@section('content')
<main class="flex pl-20 pr-20 pt-10 flex-col h-screen">

    <section class="font-medium w-full">
        <div class="flex pl-10 justify-between bg-gradient-to-r from-red-300 to-red-50 h-24 rounded-md">
            <h1 class="flex gap-2 items-center text-4xl font-semibold text-white">
                <i class="gg-shopping-bag"></i>Gestionar Administradores
            </h1>
            <img class="object-cover w-96" src="{{ URL::asset('images/hmoon.png') }}" alt="">
        </div>
        <form class="max-w-md" method="POST" action="{{ url('/admin/adminMaker' ) }}" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-col mt-5">
                <input class="appearance-none flex placeholder-gray-300 bg-white text-gray-700  border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="nombreUsuario" name="nombreUsuario" type="text" placeholder="Ej: tinimurillo" value="{{ old('nombreUsuario') }}">
                @error('nombreUsuario')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

                <button class="bg-rose-400 hover:bg-rose-300 text-white font-bold px-4 py-4 rounded shadow-lg hover:transition duration-500" type="submit">
                    {{ __('Buscar') }}
                </button>
            </div>
        </form>

        <div class="grid grid-cols-2 gap-2 mt-10">
            <div class="flex flex-col items-center justify-center pb-5 px-5 bg-white rounded shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Usuario Elegido</h2>

                <table class="divide-y divide-gray-200 table-auto" id="tablaPedidos" name="tablaPedidos">
                    <thead class="bg-gray-50">

                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Usuario
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Teléfono
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Opciones
                            </th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="tbodyPedidos" name="tbodyPedidos">

                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $usuarioElegido[0] -> nombreUsuario }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $usuarioElegido[1] -> nombre }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $usuarioElegido[2] -> numeroTelefono }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if($usuarioElegido[0] -> idUsuario > 0)
                                <a href="{{ url('admin/addAdminMaker/'.$usuarioElegido[0] -> idUsuario)}}"> <button type="button" class="text-white bg-gradient-to-r from-red-400 via-rose-400 to-red-300 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300  font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Agregar</button></a><br>

                                <a href="{{ url('admin/adminMaker/0')}}" class="text-indigo-600 hover:text-indigo-900">Eliminar</a><br>
                                @endif
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>

            <div class="flex flex-col items-center justify-between pb-10 px-5 bg-white rounded shadow-md">

                <h2 class="text-xl font-semibold text-gray-800 mb-2">Administradores</h2>

                <table class=" divide-y divide-gray-200 table-auto" id="tablaAdministradores" name="tablaAdministradores">
                    <thead class="bg-gray-50">

                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="tbodyCategorias" name="tbodyCategorias">
                        @foreach($usuariosAdmin as $Admin)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $Admin -> nombreUsuario }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if($Admin -> idUsuario == 1)
                                @else
                                <a href="{{ url('admin/delAdminMaker/'.$Admin -> idUsuario)}}"  class="relative inline-flex items-center justify-center p-0.5 mb-2 mr-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-500 to-red-500 group-hover:from-red-500 group-hover:to-red-500 hover:text-white  focus:ring-4 focus:outline-none focus:ring-cyan-200">
                                    <span class="relative px-5 py-2 transition-all ease-in duration-75 bg-white  rounded-md group-hover:bg-opacity-0">Eliminar</a><br>
                                        @endif
                            </td>

                        </tr>
                        @endforeach
                        <tr>
                            <td>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ url('admin/welcome')}}">
                                <button class="bg-rose-400 hover:bg-rose-300 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500">
                                        {{ __('Volver') }}
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