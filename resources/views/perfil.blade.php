<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FavArt - Menu Principal</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="">
    @include('layouts.Customer')
    <div class="pt-10 mt-6">
        <a href="#">
            <h1 class="text-4xl font-bold text-center ">¡Hola! {{ Auth::User()->Persona->nombre }} <span
                    class="text-rose-400 text-6xl">.<span>
            </h1>
        </a>
    </div>


    <div class="flex mb-4 justify-start p-36 pt-0 max-w-6xl">
        <div class="mt-10 w-fit">
            <h3 class="font-bold text-2xl">Datos del perfil</h3>
            <p class="text-gray-600 pt-2 pb-6">Editar datos</p>

            <form method="POST" action="{{ url($usuario->idUsuario . '/perfil') }}" enctype="multipart/form-data">

                @csrf

                <div class="flex flex-wrap -mx-3 mb-0">
                    <div class="w-full md:w-2/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="nombreUsuario">
                            Nombre de usuario
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="nombreUsuario" name="nombreUsuario" value="{{ $usuario->nombreUsuario }}"
                            type="text">
                        @error('nombreUsuario')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="password">
                            Contraseña
                        </label>
                        <input
                            class="form-control block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id='password' name="password" type="password">
                        <p class="text-gray-600 text-xs italic">Ingrese una contraseña que pueda recordar.</p>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-8">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="apellidos">
                                Confirmar contraseña
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                type="text">
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name"
                            name="name" autofocus>
                            Nombre
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="name" name="name" value="{{ $usuario->Persona->nombre }}" type="text">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-0">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="apellidos">
                                Apellidos
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                id="apellidos" name="apellidos" value="{{ $usuario->Persona->apellidos }}"
                                type="text">
                            @error('apellidos')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-4">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="direccion">
                            Dirección
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="direccion" name="direccion" value="{{ $direccion->señasExactas }}" type="text">
                        @error('direccion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="edad">
                            Edad
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="edad" name="edad" value="{{ $usuario->Persona->edad }}" type="number"
                            min="0" max="99">
                        @error('edad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-6">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="email">
                            Correo electrónico
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border  rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="email" name="email" type="email" value="{{ $usuario->email }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="telefono">
                            Teléfono
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="telefono" name="telefono" value="{{ $telefono->numeroTelefono }}" type="tel">
                        @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                        <button
                            class="bg-rose-400 hover:bg-zinc-500 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500"
                            type="submit">
                            Guardar
                        </button>
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <a href="{{ url()->previous() }}">
                            <button
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500"
                                type="button">
                                Cancelar
                            </button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('layouts.footer')
</body>

</html>
