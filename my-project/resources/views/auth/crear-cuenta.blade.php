@extends('layouts.app')

@section('titulo')
    Crear cuenta
@endsection


@section('contenido')
    <form action="{{ route('crear-cuenta') }}" method="POST" novalidate>
        @csrf
        <label for="name" class="block my-2 text-sm font-medium
            text-gray-900 dark:text-white">
            Nombre
        </label>
        <input id="name" name="name" type="name" placeholder="Ingresa tu nombre" autocomplete="name" required
            class="border block w-full rounded-md  p-3 py-1.5 text-gray-900
                shadow-sm ring-1 ring-inset ring-gray-300
                placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name')
                border-red-500
                @enderror"
            value="{{ old('name') }}">
        @error('name')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm
                p-2 text-center">
                {{ $message }}
            </p>
        @enderror

        <label for="email" class="block my-2 text-sm font-medium leading-6
            text-gray-900 dark:text-white">
            Correo Electronico
        </label>
        <input id="email" name="email" type="email" placeholder="Ingresa tu Correo Electronico" autocomplete="email" required
            class="border block w-full rounded-md  p-3 py-1.5 text-gray-900
                shadow-sm ring-1 ring-inset ring-gray-300
                placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('email')
                border-red-500
                @enderror"
            value="{{ old('email') }}">
        <!-- Muestra error -->
        @error('email')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm
                p-2 text-center">
                {{ $message }}
            </p>
        @enderror
        <label for="password"
            class="block text-sm my-2 font-medium leading-6
            text-gray-900 dark:text-white">Password</label>
        <input id="password" name="password" type="password" placeholder="Ingresa tu password" autocomplete="current-password" required
            class="border block w-full rounded-md p-3  py-1.5 text-gray-900
                shadow-sm ring-1 ring-inset ring-gray-300
                placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                focus:ring-indigo-600 sm:text-sm sm:leading-6
                @error('password')
                    border-red-500
                @enderror">
        @error('password')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm
                p-2 text-center">
                {{ $message }}
            </p>
        @enderror
        <!-- Parametros de confirmacion  password-->
        <label for="password_confirmation"
            class="block my-2 text-sm font-medium
            leading-6 text-gray-900 dark:text-white">
            Password Confirmacion
        </label>
        <input id="password_confirmation" name="password_confirmation" placeholder="Confirma tu contrasenia" type="password" autocomplete="current-password"
            required
            class="block w-full rounded-md p-3  py-1.5 text-gray-900
                shadow-sm ring-1 ring-inset ring-gray-300
                placeholder:text-gray-400 focus:ring-2 focus:ring-inset
                focus:ring-indigo-600 sm:text-sm sm:leading-6
                ">

            <button type="submit"
                class="flex w-full my-3 justify-center rounded-md
                    bg-indigo-600 px-3 py-1.5 text-sm font-semibold
                    leading-6 text-white shadow-sm hover:bg-indigo-500
                    focus-visible:outline focus-visible:outline-2
                    focus-visible:outline-offset-2
                    focus-visible:outline-indigo-600">
                Crear cuenta
            </button>
    </form>
    <p class="mt-4 mb-2 my-2 text-center text-sm">
        <a href="{{ route('login') }}" class="font-semibold leading-6  text-indigo-600 hover:text-indigo-500">Log in</a>
    </p>
@endsection
