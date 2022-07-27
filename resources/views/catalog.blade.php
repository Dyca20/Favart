<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FavArt - Catálogo</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="bg-slate-50">
    {{-- Muestra el Navbar, está en la carpeta layouts con el nombre customer. --}}
    @include('layouts.Customer')

    <main class="flex flex-col">
        <div class="flex flex-col ml-20 pt-20 pb-10">
            <h1 class="text-4xl font-semibold">Catálogo</h1>
        </div>
        <div class="flex ml-20 pb-10 space-x-3 w-auto">
            <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="text-white bg-slate-600 hover:bg-slate-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center " type="button">Categorías <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg></button>
            <!-- Dropdown menu -->
            <div id="dropdown" class="z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow  hidden" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(319px, 70px);">
                <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownDefault">
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 ">Collares</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 ">Grabados</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 ">Lentes</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 ">Tobilleras</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 ">Hombres</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 ">Bebés</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-100">Pulseras</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 ">Anillos</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 ">Juegos</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 ">Aretes</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 ">Exhibidores</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 ">Llaveros</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 ">Bucket
                            Hats</a>
                    </li>
                </ul>
            </div>
            <button id="dropdownDefault" data-dropdown-toggle="dropdown" class="text-white bg-slate-600 hover:bg-slate-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center " type="button">Filtrar <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg></button>
            <!-- Dropdown menu -->
            <div id="dropdown" class="z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow  hidden" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(319px, 70px);">
                <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownDefault">
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 ">Collares</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 ">Grabados</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 ">Lentes</a>
                    </li>
                </ul>
            </div>

        </div>

        <section class="flex pt-0 p-16 space-x-6">
            @foreach($productos as $producto)

            <div class="max-w-xs rounded-lg hover:shadow-md hover:-translate-y-1 bg-white border-gray-700">
                <a href="#" data-modal-toggle="{{ $producto -> nombre_Producto }}">
                    <img class="p-2 rounded-t-lg" src="{{ URL::asset('images/productos/'.$producto -> imagen) }}" alt="product image">



                    <hr class="pb-2">
                </a>
                <div class="px-5 pb-5">
                    <a href="#">
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900">{{ $producto -> nombre_Producto }}
                        </h5>
                    </a>
                    <a href="#">
                        <h5 class="text-sm font-semibold tracking-tight text-gray-600 pb-2">
                            {{ $producto -> detalles }}
                        </h5>
                    </a>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-gray-900 ">₡{{ $producto -> precio }}</span>
                        <a href="/#"><button type="button" class="text-white bg-red-400 hover:bg-red-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 ">
                                <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                    </path>
                                </svg>
                                Añadir al carrito
                            </button></a>
                    </div>
                </div>
            </div>
            <div id="{{ $producto -> nombre_Producto }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full" aria-modal="true" role="dialog">
                <div class="relative p-4 w-full max-w-3xl h-full md:h-auto">
                    <div class="relative bg-white rounded-lg shadow">
                        <div class="flex justify-between items-start p-4 rounded-t border-b ">
                            <h3 class="text-xl font-semibold text-gray-900 ">
                                {{ $producto -> nombre_Producto }}
                            </h3>
                            {{-- La X de cerrar el modal. --}}
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center " data-modal-toggle="{{ $producto -> nombre_Producto }}">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="flex flex-row">

                            {{-- imagen del producto --}}
                            <div class="relative h-80 w-1/2 overflow-hidden content-center">

                                <img class="absolute crop object-cover" src="{{ URL::asset('images/productos/'.$producto -> imagen) }}" alt="product image">

                            </div>
                            <div class="p-6 space-y-3">
                                <div class="flex flex-row justify-between">
                                    <h2 class="text-base leading-relaxed text-gray-500">
                                        <strong>Categorías:</strong> <a class="text-blue-600 hover:underline" href="/#"> {{ $producto -> categoria }}</a>
                                    </h2>
                                    {{-- precio --}}
                                    <h2 class="text-base leading-relaxed text-gray-500 mr-6">
                                        <strong>Precio:</strong> <span class="text-red-400">₡ {{ $producto -> precio }}</span>
                                </div>

                                <h2 class="text-base leading-relaxed text-gray-500">
                                    <strong>Descripción:</strong>
                                    <p class="text-gray-600 ">
                                        {{ $producto -> detalles }}
                                    </p>
                                </h2>
                                {{-- accecorios diosponibles --}}
                                <div class="flex flex-row space-x-6">

                                    @foreach($categorias as $categoriaProducto)
                                    @if($categoriaProducto -> id_producto == $producto -> id_producto)

                                    @foreach($accesorios as $accesorio)
                                    @foreach($categorias as $categoriaAccesorio)
                                    @if($categoriaAccesorio -> id_producto == $accesorio -> id_producto)

                                    @if($categoriaProducto -> id_categoria == $categoriaAccesorio -> id_categoria)

                                    <idv class="flex flex-col items-center ">
                                        <img class="w-24 h-24 shadow-lg hover:scale-[3] hover:transition" src="{{ URL::asset('images/productos/'.$accesorio -> imagen) }}">
                                        <p class="text-sm font-semibold text-gray-600 pt-3">
                                            {{ $accesorio -> nombre_Producto }}
                                        </p>
                                        <a href="/#"><span class=" bg-pink-100 text-red-400 text-sm font-medium mr-2 px-2.5 
                                                py-0.5 rounded">Añadir</span></a>
                                    </div>
                                    @endif
                                    @endif
                                    @endforeach
                                    @endforeach
                                    @endif
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                            <a href="/#"> <button type="button" class="text-white bg-red-400 hover:bg-red-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 ">
                                    <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                        </path>
                                    </svg>
                                    Añadir al carrito
                                </button></a>

                        </div>
                    </div>
                </div>
            </div>
            @endforeach()


            {{-- Con este modal se va a mostrar los detalles del producto y los accesorios. --}}

        </section>
    </main>
    <script src="./js/app.js"></script>
</body>

</html>