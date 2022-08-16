<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FavArt - Menu Principal</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/app.css">
    <link href='https://css.gg/phone.css' rel='stylesheet'>
</head>

<body class="bg-slate-50 h-screen w-screen overflow-x-hidden">
    {{-- Muestra el Navbar, está en la carpeta layouts con el nombre customer. --}}
    @include('layouts.Admin')
    <main class="h-screen">
        <section
            class="flex flex-col sm:flex-row justify-around space-x-50 mt-4 mb-20 sm:mt-16 items-center font-light">
            <div class="py-0">
                <div class="flex align-middle w-full z-0">
                    <div class="">
                        <div class="">
                            <div>
                                <span class="text-red-400 sm:text-6xl text-3xl font-bold font-sans">Admin. </span>
                                <span class="text-slate-700 sm:text-6xl text-3xl font-semibold font-sans">Fav
                                    Art.</span>
                            </div>
                        </div>
                        <div>
                            <hr class="h-2">
                            <div class="text-slate-700 sm:text-4xl text-2xl font-thin">Diseños hechos a mano con amor.
                                💕</div>
                        </div>
                    </div>
                </div>
                {{-- boton rosado de ver catálogo --}}
                <div class="flex flex-col mt-10 p-4 text-slate-700 bg-red-100 rounded-md">
                    <p class="sm:text-lg text-sm font-normal">Entregas en Cañas y Los Ángeles de Tilarán de <strong>1 a
                            2
                            días.</strong>
                    </p>
                    <p class="text-lg font-normal">Se hacen entregas a todo el país. 🚚
                    </p>
                    {{-- botón de contacto --}}
                </div>
                <div id="default-carousel" class="relative mt-10" data-carousel="static">
                    <!-- Carousel wrapper -->
                    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                        <!-- Item 1 -->
                        <div class="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-0 z-20"
                            data-carousel-item="">
                            <span
                                class="absolute text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 sm:text-3xl "></span>
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
                        <button type="button" class="w-3 h-3 rounded-full bg-white " aria-current="true"
                            aria-label="Slide 1" data-carousel-slide-to="0"></button>
                        <button type="button" class="w-3 h-3 rounded-full bg-white/50  hover:bg-white "
                            aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                        <button type="button" class="w-3 h-3 rounded-full bg-white/50  hover:bg-white "
                            aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                    </div>
                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev="">
                        <span
                            class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30  group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white  group-focus:outline-none">
                            <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 " fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                            class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30  group-hover:bg-white/50  group-focus:ring-4 group-focus:ring-white  group-focus:outline-none">
                            <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 " fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                            <span class="hidden">Next</span>
                        </span>
                    </button>
                </div>
                <div class="flex justify-center sm:justify-start space-x-6 mt-8 ">
                    <a href="/catalog" data-tooltip-target="tooltip-default"
                        class="z-40 bg-rose-400 shadow-md hover:bg-rose-300 text-white font-bold py-2 px-4 rounded-lg">
                        <button type="button">Ver
                            Catálogo</button>
                        <div id="tooltip-default" role="tooltip"
                            class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
                            Mostrar todos los productos
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </a>

                    <a href="/contacto"
                        class="flex gap-3 ring-1 ring-slate-500 shadow-md hover:bg-slate-600 hover:text-white text-slate-700 font-bold py-2 px-4 rounded-lg">
                        <i class="gg-phone"></i>
                        Contacto</a>
                </div>
            </div>
            <div class="hidden sm:flex w-96 -mt-32 ">
                <img src="{{ URL::asset('/images/hmoon.png') }}" alt="logo"
                    class="w-full shadow-red-400 drop-shadow-2xl-red">
            </div>
        </section>
    </main>
    <div class="mt-36 sm:mt-44 md:mt-80 xl:mt-72 lg:mt-80 2xl:mt-0">
        @include('layouts.footer')
    </div>
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
</body>
