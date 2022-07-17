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
            <div class="flex flex-row space-y-5 justify-between w-full h-20 px-2  bg-red-300">
                <div class="flex flex-row ml-6 m-auto">
                    <a href="{{ route('home') }}" class="text-white text-2xl font-bold">
                        <img src="{{ URL::asset('/images/iconfavart.png') }}" alt="logo" class="mt-1 h-10">
                    </a>
                    <div class="flex items-center justify-between text-white text-3xl px-5 font-medium"><b>Fav Art</b>
                    </div>
                    <div class="flex flex-row flex-auto m-auto pt-1">
                        <a href="/welcome" class="px-2 hover:bg-pink-100 ">
                            <div class="flex flex-row space-x-3 ">
                                <h4 class="font-normal text-white hover:text-pink-600">Principal</h4>
                            </div>
                        </a>
                        <a href="/#" class="px-2 hover:bg-pink-100">
                            <div class="flex flex-row space-x-3">

                                <h4 class="font-normal text-white hover:text-pink-600">Comprar</h4>
                            </div>
                        </a>
                        <a href="/#" class="px-2 hover:bg-pink-100">
                            <div class="flex flex-row space-x-3">

                                <h4 class="font-normal text-white hover:text-pink-600 ">Catálogo</h4>
                            </div>
                        </a>
                        <a href="/#" class="px-2 hover:bg-pink-100">
                            <div class="flex flex-row space-x-3">
                                <h4 class="font-normal text-white hover:text-pink-600 ">Historial</h4>
                            </div>
                        </a>
                        <a href="{{ url('/'.Auth::User()->id_Usuario).'/perfil'}}" class="px-2 hover:bg-pink-100">
                            <div class="flex flex-row space-x-3">
                                <h4 class="font-normal text-white hover:text-pink-600">{{Auth::User()->nombre_Usuario}}</h4>
                                {{-- Acá se tendría que hacer un {{User::user_id -> name o similar}} --}}
                                {{-- Además tiene que ir ubicado a la derecha del todo, aún no está puesto. --}}
                            </div>
                        </a>
                    </div>
                </div>
                {{-- nombre del perfil en la derecha del navbar --}}

        </nav>
    </header>

</body>

</html>
