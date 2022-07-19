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
    {{-- Muestra el Navbar, está en la carpeta layouts con el nombre customer. --}}
    @include('layouts.Customer')
    <main>
        <section class="flex justify-around pt-36 font-light">
            <div>
                <h1 class="text-4xl font-semibold mb-2">Bienvenido a accesorios <span
                        class="text-red-400 font-semibold">Fav Art.</span></h1>
                <p class="text-3xl">Diseños hechos con amor 💕</p>
                <hr><br>
                <p class="font-normal"> Entregas en Cañas y Los Ángeles Tilarán de 1 a 2 días. </p>
                <p class="font-normal"> Se realizan envíos a todo el país. 🇨🇷</p><br>
                {{-- boton rosado de ver catálogo --}}
                <div class="flex flex-row mt-5 space-x-8">
                    <a href="/catalog"
                        class="z-40 bg-red-400 shadow-2xl shadow-red-400 hover:bg-red-500 text-white font-bold py-2 px-4 rounded-full">Ver
                        Catálogo</a>
                    {{-- botón de contacto --}}
                    <a href="/contacto"
                        class="bg-red-400 shadow-md hover:bg-red-500 text-white font-bold py-2 px-4 rounded-full">Contacto</a>
                </div>

                <img class="w-24 origin-center rotate-0 absolute z-30 left-1/6 -ml-16 top-96 pt-8"
                    src="{{ URL::asset('/images/arrow.png') }}">
                <div id="default-carousel" class="relative mt-8 z-20" data-carousel="static">
                    <!-- Carousel wrapper -->
                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                        <!-- Item 1 -->
                        <div class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-0 z-20"
                            data-carousel-item="">
                            <span
                                class="absolute text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 sm:text-3xl dark:text-gray-800">First
                                Slide</span>
                            <img src="{{ URL::asset('/images/carousel/post_1.jpg') }}"
                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                alt="...">
                        </div>
                        <!-- Item 2 -->
                        <div class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-full z-10"
                            data-carousel-item="">
                            <img src="{{ URL::asset('/images/carousel/post_2.jpg') }}"
                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                alt="...">
                        </div>
                        <!-- Item 3 -->
                        <div class="duration-700 ease-in-out absolute inset-0 transition-all transform -translate-x-full z-10"
                            data-carousel-item="">
                            <img src="{{ URL::asset('/images/carousel/post_3.jpg') }}"
                                class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                alt="...">
                        </div>
                    </div>
                    <!-- Slider indicators -->
                    <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                        <button type="button" class="w-3 h-3 rounded-full bg-white dark:bg-gray-800"
                            aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                        <button type="button"
                            class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800"
                            aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                        <button type="button"
                            class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800"
                            aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                    </div>
                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev="">
                        <span
                            class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <span class="hidden">Previous</span>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-next="">
                        <span
                            class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                            <span class="hidden">Next</span>
                        </span>
                    </button>
                </div>

            </div>
            <div class="mt-20">
                <img src="{{ URL::asset('/images/LogoFavart.png') }}" alt="logo" class="w-auto object-cover ">
            </div>
        </section>
    </main>
    <script src="./js/app.js"></script>
</body>
