@extends('layouts.Auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="mt-10 p-10">
                <div class="text-2xl font-medium">{{ __('Ya has iniciado sesión') }}</div>
                <p>Vuelve a la pantalla Principal con el siguiente botón.</p>
                <a href="{{ url('/welcome') }}">
                    <button
                        class="mt-4 bg-rose-400 hover:bg-rose-300 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500  mb-3"
                        type="button">
                        Volver a la Pantalla Principal
                    </button>
                </a>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
