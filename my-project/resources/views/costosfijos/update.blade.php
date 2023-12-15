@extends('layouts.menu')

@section('titulo')
    Editar un costo fijo
@endsection


@section('contenido')
    <div class="flex items-center justify-center">
        <div class="bg-gray-200 p-8 rounded shadow-md">
            <h2 class="text-2xl font-bold mb-4">Formulario Financiero</h2>

            {{-- Formulario para actualizar costos fijos. --}}
            <form action="{{ route('costos_fijos.update',$costo_fijo->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="id_financiero" class="block text-sm font-medium text-black">ID Financiero:</label>
                    <select id="id_financiero" name="id_financiero" class="mt-1 p-2 w-full border rounded-md">
                        <option value="" disabled selected>Selecciona un estudio financiero</option>
                        {{-- Agrego el estudio financiero y cuando encuentra el estudio financiero que ya tiene el costo fijo
                        lo va a seleccionar. --}}
                        @foreach ($datosFinancieros as $datofinanciero)
                        <option value="{{ $datofinanciero->id }}" @if($datofinanciero->id == $costo_fijo->estudio_finaciero->id) selected @endif>
                            {{ $datofinanciero->name }}
                        </option>
                    @endforeach

                    </select>
                </div>

                {{-- Si hay un error con id financiero lo va a mostrar. --}}
                @error('id_financiero')
                    <p class="bg-red-500 text-white rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-black">Nombre:</label>
                    <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-md"
                        value="{{ $costo_fijo->name }}">
                </div>

                {{-- Si hay un error con name lo va a mostrar. --}}
                @error('name')
                    <p class="bg-red-500 text-white rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror

                <div class="mb-4">
                    <label for="month" class="block text-sm font-medium text-black">Mes:</label>
                    <select id="month" name="month" class="p-2 border rounded-md w-full">
                        <option value="" disabled selected>Selecciona un mes</option>

                        {{-- Agrego los meses y cuando encuentra el mes que ya tiene el costo fijo
                        lo va a seleccionar. --}}
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" @if ($i == $costo_fijo->month) selected @endif>
                                {{ $i }}</option>
                        @endfor

                    </select>
                </div>

                {{-- Si hay un error con month lo va a mostrar. --}}
                @error('month')
                    <p class="bg-red-500 text-white rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror

                <div class="mb-6">
                    <label for="amount" class="block text-sm font-medium text-black">Cantidad:</label>
                    <input type="text" id="amount" name="amount"
                        class="mt-1 p-2 w-full border rounded-md"value="{{$costo_fijo->amount}}">
                </div>
                
                {{-- Si hay un error con amount lo va a mostrar. --}}
                @error('amount')
                    <p class="bg-red-500 text-white rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror

                <div class="flex items-center justify-between">
                    <input type="submit" value="Modificar"
                        class="px-4 py-2 w-full bg-blue-500 text-white rounded-md cursor-pointer">
                </div>
            </form>
        </div>
    </div>
@endsection
