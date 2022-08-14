@extends('layouts.Admin')

@section('content')
<main>
    <section class="grid-rows-2 px-12 pt-12 font-light w-full">
        <div class="flex items-center pb-8">
            <div class="h-auto w-36">
                <img src="{{ URL::asset('/images/LogoFavart.png') }}" alt="logo" class="w-auto object-cover ">
            </div>
            <div class="ml-6">
                <h1 class="text-4xl font-semibold text-gray-800"><b> Gestionar Categorias </b></h1>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-2">


            <div class="items-center justify-center  pb-5 px-5 bg-white rounded shadow-sm">

                <h2 class="text-xl font-semibold text-gray-800 mb-2">Categorías Disponibles</h2>

                <table class="divide-y divide-gray-200 table-auto" id="tablaCategorias" name="tablaCategorias">
                    <thead class="bg-gray-50">

                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Opciones
                            </th>

                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="tbodyCategorias" name="tbodyCategorias">
                        @foreach($categorias as $categoria)

                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $categoria['nombreCategoria'] }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                                <a href="{{ url('admin/'.$producto -> idProducto.'/'.$categoria['idCategoria'].'/addProductCategory')}}" class="text-indigo-600 hover:text-indigo-900">Agregar -></a><br>

                                @if( $categoria['idCategoria'] == 1)

                                @else
                                <a href="{{ url('admin/'.$producto -> idProducto.'/'.$categoria['idCategoria'].'/deleteCategory')}}" class="text-indigo-600 hover:text-indigo-900">Eliminar</a><br>
                                    @endif

                            </td>
                        </tr>
                        @endforeach
                        <form method="POST" action="{{ url('admin/'.$producto->idProducto.'/addCategory') }}" enctype="multipart/form-data">
                            @csrf

                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    <input class="appearance-none flex w-1/2 bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="nombreCategoria" name="nombreCategoria" type="text" placeholder="Categoría" value="{{ old('nombreCategoria') }}">
                                    @error('nombreCategoria')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button class="bg-rose-400 hover:bg-zinc-500 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500" type="submit">
                                        {{ __('Agregar') }}
                                    </button>
                                </td>

                            </tr>
                        </form>

                    </tbody>
                </table>
            </div>

            <div class=" items-center justify-between  pb-5 px-5 bg-white rounded shadow-sm">

                <h2 class="text-xl font-semibold text-gray-800 mb-2">Categorías de {{$producto->nombreProducto}}</h2>

                <table class=" divide-y divide-gray-200 table-auto" id="tablaProductos" name="tablaProductos">
                    <thead class="bg-gray-50">

                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-medium text-gray-600 uppercase tracking-wider">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="tbodyCategorias" name="tbodyCategorias">
                        @foreach($categoriasProducto as $categoriaProducto)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $categoriaProducto['nombreCategoria'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ url('admin/'.$producto -> idProducto.'/'.$categoriaProducto['idCategoria'].'/deleteProductCategory')}}" class="text-indigo-600 hover:text-indigo-900">
                                    <- Eliminar </a><br>

                            </td>

                        </tr>
                        @endforeach
                        <tr>
                            <td>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ url('admin/manageInventory')}}">
                                    <button class="bg-rose-400 hover:bg-zinc-500 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500">
                                        {{ __('Finalizar') }}
                                    </button></a>

                                </button>
                            </td>

                        </tr>
                    </tbody>
                </table>


            </div>
        </div>

    </section>
</main>
</body>
@endsection