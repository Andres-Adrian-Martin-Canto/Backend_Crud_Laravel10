
@extends('layouts.app')


@section('titulo')
    Iniciar sesión en su cuenta
@endsection

@section('contenido')
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{ route('login') }}" method="POST">

            @csrf
            <!-- Muestra error de credenciales -->
            @if (session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ session('mensaje') }}
                </p>
            @endif

            <label for="email" class=" text-sm font-medium leading-6 text-gray-900 dark:text-white">Dirección de
                correo
                electrónico</label>
            <input id="email" name="email" type="text" placeholder="Tu Email de Registro"
                class="border rounded-lg w-full p-3 py-1.5 text-gray-900
                        ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6
                        @error('email') border-red-500 @enderror"
                value="{{ old('email') }}">

            @error('email')
                <p class="bg-red-500 text-white my-0.5 rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
            @enderror


            <label for="password" class=" text-sm font-medium leading-6 text-gray-900 dark:text-white">Password</label>
            <input id="password" name="password" type="password" placeholder="Password de Registro"
                class="w-full rounded-lg p-3 py-1.5 text-gray-900 border
                        ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6
                        @error('password')
                            border-red-500
                        @enderror">

            @error('password')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
            @enderror

            <input type="submit" value="Iniciar Sesion"
                class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6
                text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        </form>

        <p class="mt-4 mb-2 text-center text-sm">
            <a href="{{ route('crear-cuenta') }}" class="font-semibold leading-6  text-indigo-600 hover:text-indigo-500">
                Crear cuenta
            </a>
        </p>
    </div>

@endsection
