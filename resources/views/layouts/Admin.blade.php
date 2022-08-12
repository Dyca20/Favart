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
        <nav>
            <div class="flex flex-row space-y-5 w-full h-20 px-2  bg-red-300">
                <div class="flex flex-row ml-6 m-auto  w-full">
                    <a href="{{ route('home') }}" class="text-white text-2xl font-bold">
                        <img src="{{ URL::asset('/images/iconfavart.png') }}" alt="logo" class="mt-1 h-10">
                    </a>
                    <div class="flex items-center text-white text-3xl px-5 font-medium"><b>Fav Art</b>
                    </div>
                    <div class="flex flex-row flex-auto m-auto pt-1 justify-between items-center">
                        <div class="flex">
                            <a href="/admin/welcome" class="px-2 hover:bg-pink-100">
                                <div class="flex flex-row space-x-3 ">
                                    <h4 class="font-normal text-white hover:text-pink-600">Principal</h4>
                                </div>
                            </a>
                            <a href="/admin/manageInventory" class="px-2 hover:bg-pink-100">
                                <div class="flex flex-row space-x-3">
                                    <h4 class="font-normal text-white hover:text-pink-600">Gestionar Inventario</h4>
                                </div>
                            </a>
                            <a href="/admin/accounting" class="px-2 hover:bg-pink-100">
                                <div class="flex flex-row space-x-3">

                                    <h4 class="font-normal text-white hover:text-pink-600 ">Contabilidad</h4>
                                </div>
                            </a>
                            <a href="/admin/history" class="px-2 hover:bg-pink-100">
                                <div class="flex flex-row space-x-3">
                                    <h4 class="font-normal text-white hover:text-pink-600 ">Historial</h4>
                                </div>
                            </a>
                        </div>
                        <div class="flex mr-4 items-center">
                            <div class="mr-4">
                                <a href="{{ url('admin/' . Auth::User()->idUsuario. '/perfil') }}" class="px-2 mx-2">
                                    <div class="flex flex-row space-x-3">
                                        <h4 class="font-normal text-white hover:text-pink-600">
                                            {{ Auth::User()->nombreUsuario }}
                                        </h4>
                                    </div>
                                </a>
                            </div>
                            <div class="mx-2">
                                <a href="/welcome" class="px-2 mx-2">
                                    <div class="flex flex-row space-x-3">
                                        <h4 class="font-normal text-white hover:text-pink-600">
                                            {{ __('Cliente') }}
                                        </h4>
             
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-menu dropdown-menu-end ml-4 mr-4 " aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <h4 class="font-normal text-white hover:text-pink-600">
                                        {{ __('Logout') }}
                                    </h4>

                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

        </nav>
    </header>
    @yield('content')
 
</body>


</html>