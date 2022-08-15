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

<body class="bg-slate-50 h-screen w-screen overflow-x-hidden">
    {{-- Muestra el Navbar, está en la carpeta layouts con el nombre customer. --}}
    @include('layouts.Customer')

    <main class="flex flex-col h-screen">

        <div class="flex flex-col ml-20 pt-20 pb-10">
            <h1 class="text-4xl font-semibold">Catálogo</h1>
        </div>
        <div class="flex ml-20 pb-10 space-x-3 w-auto bg-white">

            <button id="dropdownDefault" data-dropdown-toggle="dropdown"
                class="text-white bg-slate-600 hover:bg-slate-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center "
                type="button">Categorías <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg></button>
            <!-- Dropdown menu -->
            <div id="dropdown" class="z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow  hidden"
                data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"
                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(319px, 70px);">
                <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownDefault">
                    @foreach ($categoria as $categoriaProducto)
                        <li>
                            <a href="{{ url('/catalog/searcher/' . $categoriaProducto->idCategoria) }}"
                                class="block py-2 px-4 hover:bg-gray-100 ">{{ $categoriaProducto->nombreCategoria }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="flex justify-between py-y px-6 whitespace-nowrap text-base font-medium">
                <div class="flex items-center w-2/3 max-w-xs">
                    <form method="POST" action="{{ url('/catalog/searcher') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" id="buscarProducto" name="buscarProducto"
                            class="bg-gray-50 rounded w-3/4 h-10 text-gray-700 focus:outline-none border-b-4 border-gray-300 focus:border-rose-300 transition duration-500 px-3 pb-3">
                        <button
                            class="bg-rose-400 hover:bg-zinc-500 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500 "
                            type="submit">
                            Buscar
                        </button>
                    </form>
                </div>
                <div class="flex items-center ml-2">
                    <a href="{{ url('/catalog') }}">
                        <button
                            class="bg-rose-400 hover:bg-zinc-500 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500"
                            type="button">
                            Mostrar Todo
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <section class="flex flex-wrap justify-items-start gap-y-3 gap-x-3 pt-0 p-16 content-start">
            @foreach ($productos as $producto)
                <div
                    class="w-64 max-h-[395px] min-w-[288px] rounded-lg shadow-sm hover:shadow-md hover:-translate-y-1 bg-white border-gray-700">
                    <a href="#" data-modal-toggle="{{ $producto->nombreProducto }}">
                        <div class="flex w-[288px] h-64 justify-center">
                            <img class="p-2 rounded-t-lg object-cover"
                                src="{{ URL::asset('images/productos/' . $producto->imagen) }}" alt="product image">
                        </div>
                        <hr class="pb-2">
                    </a>
                    <div class="px-5 pb-5">
                        <a href="#">
                            <h5 class="text-lg font-semibold tracking-tighttext-gray-900 line-clamp-1">
                                {{ $producto->nombreProducto }}
                            </h5>
                        </a>
                        <a href="#">
                            <p class="text-sm font-semibold tracking-tight text-gray-600 pb-0 mb-1 line-clamp-1">
                                {{ $producto->detalles }}
                            </p>
                        </a>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-gray-900 ">₡{{ $producto->precio }}</span>
                            <a href="{{ url('/addProductCarrito/' . $producto->idProducto) }}"><button type="button"
                                    class="text-white bg-red-400 hover:bg-red-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1.5 text-center inline-flex items-center mr-0 ">
                                    <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                        </path>
                                    </svg>
                                    Añadir
                                </button></a>
                        </div>
                    </div>
                </div>

                <div id="{{ $producto->nombreProducto }}" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full"
                    aria-modal="true" role="dialog">
                    <div class="relative p-4 w-full max-w-3xl h-full md:h-auto">
                        <div class="relative bg-white rounded-t-lg shadow">
                            <div class="flex justify-between items-start p-4 rounded-t border-b ">
                                <h3 class="text-xl font-semibold text-gray-900 ">
                                    {{ $producto->nombreProducto }}
                                </h3>
                                {{-- La X de cerrar el modal. --}}
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center "
                                    data-modal-toggle="{{ $producto->nombreProducto }}">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>

                            <!-- Modal body -->
                            <div class="flex flex-row h-72 w-full">
                                {{-- imagen del producto --}}
                                <div
                                    class="flex flex-grow h-72 w-72 max-w-[288px] min-w-[288px] justify-center border-r-2 border-gray-100">
                                    <img class="p-2 rounded-t-lg object-contain"
                                        src="{{ URL::asset('images/productos/' . $producto->imagen) }}"
                                        alt="product image">
                                </div>
                                <div class="p-6 space-y-3 flex flex-col overflow-y-auto" style="width: inherit">
                                    <div class="flex justify-between">
                                        <div class="flex">
                                            <h3 class="font-bold text-gray-500">Categorías:&nbsp;</h3>
                                            <p class="text-base leading-relaxed text-gray-500">
                                                <a class="text-blue-600 hover:underline" href="/#">
                                                    {{ $producto->categoria }}</a>
                                            </p>
                                        </div>
                                        {{-- precio --}}
                                        <div class="flex">
                                            <h2 class="text-base text-gray-500">Precio: <span
                                                    class="text-red-400">₡{{ $producto->precio }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <h3 class="font-bold text-gray-500">Descripción:&nbsp;</h3>
                                        <p class="leading-relaxed text-gray-500 w-auto text-sm">
                                            {{ $producto->detalles }}
                                        </p>
                                    </div>
                                    {{-- accecorios diosponibles --}}
                                    <div class="flex flex-row space-x-6 pt-2">
                                        @foreach ($categorias as $categoriaProducto)
                                            @if ($categoriaProducto->idProducto == $producto->idProducto)
                                                @foreach ($accesorios as $accesorio)
                                                    @foreach ($categorias as $categoriaAccesorio)
                                                        @if ($categoriaAccesorio->idProducto == $accesorio->idProducto)
                                                            @if ($categoriaProducto->idCategoria == $categoriaAccesorio->idCategoria)
                                                                <div class="flex flex-col items-center">
                                                                    <img class="w-24 h-24 shadow-lg hover:scale-[3] hover:shadow-2xl hover:transition hover:z-10 rounded-md overflow-visible"
                                                                        src="{{ URL::asset('images/productos/' . $accesorio->imagen) }}">
                                                                    <div class="flex flex-col items-center">
                                                                        <p
                                                                            class="flex text-sm font-semibold text-gray-600 pt-3">
                                                                            {{ $accesorio->nombreProducto }}
                                                                        </p>
                                                                        <a class="flex" href="/#">
                                                                            <span
                                                                                class=" bg-pink-100 text-red-400 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">Añadir
                                                                            </span>
                                                                        </a>
                                                                    </div>
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
                            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 bg-white">
                                <a href="{{ url('/addProductCarrito/' . $producto->idProducto) }}"> <button
                                        type="button"
                                        class="text-white bg-red-400 hover:bg-red-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 ">
                                        <svg aria-hidden="true" class="mr-2 -ml-1 w-5 h-5" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                            </path>
                                        </svg>
                                        Añadir al carrito
                                    </button></a>

                                {{-- cantidad --}}
                                <div class="flex flex-row items-center space-x-2">
                                    <svg aria-hidden="true" class="w-5 h-5 text-slate-400" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <input type="number"
                                        class="text-gray-600 text-sm p-1.5 ml-auto inline-flex items-center rounded-sm border-gray-300"
                                        value="1" min="1" max="10">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach()


            {{-- Con este modal se va a mostrar los detalles del producto y los accesorios. --}}

        </section>
        @include('layouts.footer')
    </main>

    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
</body>

</html>
