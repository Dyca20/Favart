@extends('layouts.Auth')

@section('content')

    <body class="bg-rose-100 min-h-screen md:pt-0 pb-6 px-2 md:px-0" style="font-family:'Lato',sans-serif;">
        <div class="pt-16 mt-10">
            <a href="#">
                <h1 class="text-4xl font-bold text-center ">¡Hola! Bienvenido <span class="text-rose-400 text-6xl">.<span>
                </h1>
            </a>
        </div>
        <div class="flex mb-4 justify-around p-36 pt-20 ">
            <div class="mt-10 w-96">
                <h3 class="font-bold text-2xl">Por favor inicie sesión</h3>
                <p class="text-gray-600 pt-2">Ingrese sus detalles de inicio de sesión</p>
                
                <form class="flex flex-col" method="POST"
                    action="{{ route('login') }}">
                        @csrf
                        <div class="mb-6
                    pt-3 rounded bg-gray-200">
                    <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="usuario">Nombre de
                        usuario</label>
                    <input type="text" id="nombre_Usuario" name="nombre_Usuario"
                        class="form-input bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-rose-300 transition duration-500 px-3 pb-3">
            </div>
            <div class="mb-6 pt-3 rounded bg-gray-200">
                <label class="block text-gray-700 text-sm font-bold mb-2 ml-3" for="password">Contraseña</label>
                <input type="password" id="password"
                    class="bg-gray-200 rounded w-full text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-rose-300 transition duration-500 px-3 pb-3 form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row mb-3">
                <div class="col-md-6 offset-md-4">
                    <div class=" flex flex-row form-check space-x-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Recordar sesión.') }}
                        </label>
                        @if (Route::has('password.request'))
                            <a class="no-underline text-blue-500 text-sm hover:underline"
                                href="{{ route('password.request') }}">
                                {{ __('Olvidó su contraseña?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit"
                        class="bg-rose-400 hover:bg-zinc-500 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500">
                        {{ __('Ingresar') }}
                    </button>
                </div>
            </div>

            </form>
        </div>
        {{-- genera una div con una imagen --}}
        <div class="flex md:pl-24 pt-5">
            <img src="{{ URL::asset('/images/LogoFavart.png') }}" alt="logo" class="w-auto object-cover ">
        </div>
        </div>
        </div>
    </body>
@endsection
