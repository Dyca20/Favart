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
        <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded shadow-sm">
            <div class="container flex flex-wrap justify-between items-center mx-auto">
                <a href="{{ url('admin/welcome') }}" class="flex items-center">
                    <img src="{{ URL::asset('/images/iconfavart.png') }}" class="mr-3 h-6 sm:h-9" alt="Favart Logo" />
                    <span class="self-center text-xl font-semibold whitespace-nowrap ">Fav Art.</span>
                </a>
                <button data-collapse-toggle="navbar-default" type="button" class="z-auto inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Abre el main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white ">
                        <li>
                            <a href="/admin/welcome" class="block py-2 pr-4 pl-3  bg-red-400 rounded md:bg-transparent md:p-0 " aria-current="welcome">Principal</a>
                        </li>
                        <li>
                            <a href="/admin/manageInventory" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-400 md:p-0 " aria-current="inventario">Gestionar inventario</a>
                        </li>
                        <li>
                            <a href="/admin/accounting" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-400 md:p-0 " aria-current="contabilidad">Contabilidad</a>
                        </li>
                        <li>
                            <a href="/admin/history" class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-400 md:p-0 " aria-current="historial">Historial</a>
                        </li>


                        @if (Auth::check())
                        @if(Auth::User()->idUsuario == 1)
                        <div class="mr-4">
                            <a class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-400 md:p-0" aria-current="administradores" href="{{ url('admin/adminMaker/0') }}" class="px-2 mx-2">
                                Administradores
                            </a>
                        </div>
                        @endif
                        <li>
                            <a class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-400 md:p-0" href="{{ url('admin/' . Auth::User()->idUsuario) . '/perfil' }}" class="px-2 mx-2" aria-current="user">
                                {{ Auth::User()->nombreUsuario }}
                            </a>
                        </li>
                        <li>
                            <a class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-400 md:p-0" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                {{ __('Salir') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            @else
                            <a class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-red-400 md:p-0" href="login" class="px-2 mx-2">
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
    @yield('content')
    <script>
        if (window.location.href.indexOf("welcome") > -1) {
            document.querySelector('[aria-current="welcome"]').classList.add('text-red-400');
        }
        if (window.location.href.indexOf("manageInventory") > -1) {
            document.querySelector('[aria-current="inventario"]').classList.add('text-red-400');
        }
        if (window.location.href.indexOf("accounting") > -1) {
            document.querySelector('[aria-current="contabilidad"]').classList.add('text-red-400');
        }
        if (window.location.href.indexOf("history") > -1) {
            document.querySelector('[aria-current="historial"]').classList.add('text-red-400');
        }
        if (window.location.href.indexOf("adminMaker") > -1) {
            document.querySelector('[aria-current="administradores"]').classList.add('text-red-400');
        }
        if (window.location.href.indexOf("perfil") > -1) {
            document.querySelector('[aria-current="user"]').classList.add('text-red-400');
        }
        if (window.location.href.indexOf("editProduct") > -1) {
            document.querySelector('[aria-current="inventario"]').classList.add('text-red-400');
        }
        if (window.location.href.indexOf("addCategory") > -1) {
            document.querySelector('[aria-current="inventario"]').classList.add('text-red-400');
        }
        if (window.location.href.indexOf("carritoHistorial") > -1) {
            document.querySelector('[aria-current="historial"]').classList.add('text-red-400');
        }
    </script>
</body>


</html>