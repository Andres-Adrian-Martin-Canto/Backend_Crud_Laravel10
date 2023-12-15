{{-- Hablamos al yaout --}}
@extends('layouts.menu')

{{-- Agregamos en el contenedor titulo lo siguiente --}}
@section('titulo')
    Crear un nuevo Estudio Financiero
@endsection

{{-- Agregamos en el contenedor contenido lo siguiente --}}
@section('contenido')
    <div class="max-w-md mx-auto bg-gray-200 p-8 border rounded-md shadow-md">
        {{-- Formulario para agregar y te envia al metodo store para insertar los datos en la base de datos. --}}
        <form class="max-w-lg mx-auto" action="{{ route('estudio_financiero.store') }}" method="POST">
            {{-- directiva de seguridad --}}
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-bold text-dark">Nombre</label>
                <input type="text" id="name" name="name" class="w-full mt-1 p-2 border border-gray-300 shadow-lg  rounded-md
                @error('name') border-red-500 @enderror">
            </div>

            {{-- Mostrara lo siguiente si hay un error de name --}}
            @error('name')
                <p class="bg-red-500 text-white my-0.5 rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
            @enderror

            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-bold text-dark">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4" class="w-full border-gray-300 shadow-lg mt-1 p-2 border  rounded-md
                @error('name') border-red-500 @enderror""></textarea>
            </div>

            {{-- Mostrara lo siguiente si hay un error de descripcion --}}
            @error('descripcion')
                <p class="bg-red-500 text-white my-0.5 rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
            @enderror

            <div class="mt-3">
                <button type="submit" class="px-4 py-2 bg-blue-500 w-full text-white rounded-md hover:bg-blue-700">Crear</button>
            </div>
        </form>
    </div>
@endsection
