{{-- Hablo el layout menu para luego poner en los
contenedores correspondientes su informacion
en este caso titulo y contenido --}}
@extends('layouts.menu')
<!-- Mando agregar en el contenedor titulo lo siguiente -->
@section('titulo')
    Crear un costo variable
@endsection
<!-- Mando agregar en el contenedor contenido lo siguiente -->
@section('contenido')
    <div class="max-w-md mx-auto bg-gray-200 p-8 border rounded-md shadow-md">
        {{-- Formulario que envia a guardar el nuevo costo variable --}}
        <form action="{{route('costos_variables.store')}}" method="POST">
            @csrf
            {{-- Combo box para su formulario --}}
            <div class="mb-4">
                <label for="id_financiero" class="block text-dark text-sm font-bold mb-2">ID Financiero:</label>
                <select name="id_financiero" id="id_financiero" class="w-full px-4 py-2 border rounded-md">
                    {{-- Solo sirve como mensaje para que selecione otro --}}
                    <option value=" ">Selecciona un estudio financiero</option>
                    {{-- Guardo el nombre y el id del estudio financiero para que pueda seleccionar
                    de los que ya estan en la base de datos --}}
                    @foreach ($estudiosFinancieros as $datofinanciero)
                        <option value="{{ $datofinanciero->id }}">{{ $datofinanciero->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Si hay un error mostrara lo siguiente --}}
            @error('id_financiero')
                <p class="bg-red-500 text-white rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
            @enderror

            {{-- Input para el nombre --}}
            <div class="mb-4">
                <label for="name" class="block text-dark text-sm font-bold mb-2">Nombre:</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-md">
            </div>
            {{-- Muestra esto si hay un error con el nombre --}}
            @error('name')
                <p class="bg-red-500 text-white rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
            @enderror

            {{-- Input para el mes --}}
            <div class="mb-4">
                <label for="month" class="block text-dark text-sm font-bold mb-2">Mes:</label>
                <select name="month" id="month" class="w-full px-4 py-2 border rounded-md">
                    <!-- Opciones del combo box (del 1 al 12) -->
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            {{-- Muestra un error si hay con meses --}}
            @error('month')
                <p class="bg-red-500 text-white rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
            @enderror

            {{-- Input para la cantidad --}}
            <div class="mb-4">
                <label for="amount" class="block text-dark text-sm font-bold mb-2">Cantidad:</label>
                <input type="text" name="amount" id="amount" class="w-full px-4 py-2 border rounded-md">
            </div>
            {{-- muestra erro si hay con amount --}}
            @error('amount')
                <p class="bg-red-500 text-white rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
            @enderror

            {{-- Boton para guardar el nuevo costo variable --}}
            <div class="flex items-center justify-between">
                <button type="submit" class="px-4 py-2 w-full bg-blue-500 text-white rounded-md cursor-pointer">Guardar</button>
            </div>
        </form>

    </div>
@endsection
