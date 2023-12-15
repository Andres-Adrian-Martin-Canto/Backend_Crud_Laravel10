<!-- LLamo al layout como herencia -->
@extends('layouts.menu')

<!-- Mando agregar en el contenedor titulo lo siguiente -->
@section('titulo')
    Agregar un nuevo Costo Fijo
@endsection
<!-- Mando agregar en el contenedor contenido lo siguiente -->
@section('contenido')

        <div class="max-w-md mx-auto bg-gray-200 p-8 rounded shadow-md">
            {{-- Formulario para crear un costo fijo --}}
            <form action="{{ route('costos_fijos.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="id_financiero" class="block text-sm font-medium text-black">ID Financiero:</label>
                    <select id="id_financiero" name="id_financiero" class="mt-1 p-2 w-full border rounded-md">
                        <option value="" disabled selected>Selecciona un estudio financiero</option>

                        {{-- Agrego los valores del estudio financiero el combo box. --}}
                        @foreach ($datosFinancieros as $datofinanciero)
                            <option value="{{ $datofinanciero->id }}">{{ $datofinanciero->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Si hay un error con el id financiero lo mostrara. --}}
                @error('id_financiero')
                    <p class="bg-red-500 text-white rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-black">Nombre:</label>
                    <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-md" value="{{old('name')}}">
                </div>

                {{-- Si hay un error con el name lo mostrara. --}}
                @error('name')
                    <p class="bg-red-500 text-white rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror

                <div class="mb-4">
                    <label for="month" class="block text-sm font-medium text-black">Mes:</label>
                    <select id="month" name="month" class="p-2 border rounded-md w-full">
                        <option value="" disabled selected>Selecciona un mes</option>
                        {{-- Agrego del 1 al 12 meses como seleccion del combobox. --}}
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}"> {{ $i }}</option>
                        @endfor
                    </select>
                </div>

                {{-- Si hay un error con el month lo mostrara. --}}
                @error('month')
                    <p class="bg-red-500 text-white rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror

                <div class="mb-6">
                    <label for="amount" class="block text-sm font-medium text-black">Cantidad:</label>
                    <input type="text" id="amount" name="amount" class="mt-1 p-2 w-full border rounded-md"value="{{old('amount')}}">
                </div>

                {{-- Si hay un error con el amount lo mostrara. --}}
                @error('amount')
                    <p class="bg-red-500 text-white rounded-lg text-sm p-2 text-center" >
                        {{ $message }}
                    </p>
                @enderror

                <div class="flex items-center justify-between">
                    <input type="submit" value="Guardar"
                        class="px-4 py-2 w-full bg-blue-500 text-white rounded-md cursor-pointer">
                </div>
            </form>
        </div>
@endsection
