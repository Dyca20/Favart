@extends('layouts.Auth')

@section('content')
    <div class="container mt-10">
        <div class="row justify-content-center">
            <div class="col-md-8 p-10">
                <div class="card">
                    <div class="card-header font-medium">{{ __('Restablecer contraseña') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-6 mt-4">
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Correo
                                    electrónico</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    autocomplete="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder="john.doe@company.com"
                                    required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit"
                                        class="bg-rose-400 hover:bg-rose-300 text-white font-bold px-4 py-2 rounded shadow-lg hover:transition duration-500">
                                        {{ __('Enviar link de verificación') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
