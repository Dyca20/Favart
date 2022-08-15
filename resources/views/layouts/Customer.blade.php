<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FavArt</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/app.css">

</head>

<body class="">
    <header>
        {{-- <nav>
            <div class="flex flex-row space-y-5 w-full h-20 px-2 shadow-sm bg-white">
                <div class="flex flex-row ml-6 m-auto w-full sm:m-auto sm:w-auto">
                    <a href="{{ route('welcome') }}" class="leading-none m-auto">
                        <img src="{{ URL::asset('/images/iconfavart.png') }}" alt="logo" class="h-10">
                    </a>
                    <div class="flex items-center text-slate-800 text-3xl px-5 mr-2 font-medium">
                        <a href="{{ route('welcome') }}"><b>Fav Art</b></a>
                    </div>
                    <div class="flex flex-row justify-between flex-auto m-auto pt-1 sm:flex-1 ">
                        <div class="flex items-center space-x-6">
                            <a href="/welcome" class="px-2 hover:bg-pink-100 ">
                                <div class="flex flex-row space-x-3 ">
                                    <h4 class="font-normal text-slate-800 hover:text-pink-600">Principal</h4>
                                </div>
                            </a>
                            <a href="{{ url('/catalog') }}" class="px-2 hover:bg-pink-100">
                                <div class="flex flex-row space-x-3">
                                    <h4 class="font-normal text-slate-800 hover:text-pink-600 ">Catálogo</h4>
                                </div>
                            </a>
                            <a href="{{ url('/history') }}" class="px-2 hover:bg-pink-100">
                                <div class="flex flex-row space-x-3">
                                    <h4 class="font-normal text-slate-800 hover:text-pink-600 ">Historial de compra</h4>
                                </div>
                            </a>
                            <a href="{{ url('/carrito') }}" class="px-2 hover:bg-pink-100">
                                <div class="flex flex-row space-x-3">
                                    <h4 class="font-normal text-slate-800 hover:text-pink-600 ">Carrito</h4>
                                </div>
                            </a>
                        </div>
                        <div class="flex mr-4 items-center">
                            @if (Auth::check())
                                <div class="mr-4">
                                <a href="{{ url('/' . Auth::User()->idUsuario) . '/perfil' }}" class="px-2 mx-2">
                                    <div class="flex flex-row space-x-3">
                                        <h4 class="font-normal text-red hover:text-pink-600">
                                            {{ Auth::User()->nombreUsuario }}

                                        </h4>

                                    </a>
                                </div>
                                <!-- <div class="mx-2">
                                    @if (Auth::User()->rolUsuario == 2)
                                        <a href="admin/welcome" class="px-2 mx-2">
                                            <div class="flex flex-row space-x-3">
                                                <h4 class="font-normal text-slate-800 hover:text-pink-600">
                                                    {{ __('Admin') }}
                                                </h4>
                                            </div>
                                        </a>
                                    @endif
                                </div> -->

                                <div class="dropdown-menu dropdown-menu-end ml-4 mr-4 "
                                    aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <h4 class="font-normal text-slate-800 hover:text-pink-600">
                                            {{ __('Salir') }}
                        

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            @else
                                <div class="mr-4">
                                    <a href="login" class="px-2 mx-2">
                                        <div class="flex flex-row space-x-3">
                                            <h4 class="font-normal text-slate-800 hover:text-pink-600">
                                                Login </h4>
                                        </div>
                                    </a>
                                </div>

                                <div class="mx-2">

                                    <a href="register" class="px-2 mx-2">
                                        <div class="flex flex-row space-x-3">
                                            <h4 class="font-normal text-slate-800 hover:text-pink-600">
                                                Registrarse
                                            </h4>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
        </nav> --}}
        <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded shadow-sm">
            <div class="container flex flex-wrap justify-between items-center mx-auto">
                <a href="{{ route('welcome') }}" class="flex items-center">
                    <img src="{{ URL::asset('/images/iconfavart.png') }}" class="mr-3 h-6 sm:h-9" alt="Favart Logo" />
                    <span class="self-center text-xl font-semibold whitespace-nowrap ">Fav Art.</span>
                </a>
                <button data-collapse-toggle="navbar-default" type="button"
                    class="z-auto inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Abre el main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul
                        class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white ">
                        <li>
                            <a href="/welcome"
                                class="block py-2 pr-4 pl-3 text-white bg-red-400 rounded md:bg-transparent md:text-red-400 md:p-0 "
                                aria-current="page">Principal</a>
                        </li>
                        <li>
                            <a href="/catalog"
                                class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-400 md:p-0 ">Catálogo</a>
                        </li>
                        <li>
                            <a href="/history"
                                class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-400 md:p-0 ">Compras</a>
                        </li>
                        <li>
                            <a href="/carrito"
                                class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-400 md:p-0 ">Carrito</a>
                        </li>
                        <li>

                            @if (Auth::check())
                                <a class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-400 md:p-0"
                                    href="{{ url('/' . Auth::User()->idUsuario) . '/perfil' }}" class="px-2 mx-2">
                                    {{ Auth::User()->nombreUsuario }}
                                </a>
                        </li>
                        <li>
                            <a class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-400 md:p-0"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                {{ __('Salir') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <a class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-400 md:p-0"
                                href="login" class="px-2 mx-2">
                                Ingresar
                            </a>
                        </li>
                        <li>
                            <a href="register" class="px-2 mx-2">
                                Registrarse
                            </a>
                            @endif
                        </li>

                    </ul>
                </div>
        </nav>
    </header>

</body>

</html>
