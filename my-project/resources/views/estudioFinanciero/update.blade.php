{{-- Hablamos al yaout --}}
@extends('layouts.menu')

{{-- Agregamos en el contenedor titulo lo siguiente --}}
@section('titulo')
    Actualizar Estudio Financiero
@endsection

{{-- Agregamos en el contenedor contenido lo siguiente --}}
@section('contenido')
    <div class="container mx-auto p-8">
        {{-- Formulario que habla al metodo update para que se haga la actualizacion con el id que correspondiente --}}
        <form class="max-w-lg mx-auto" action="{{ route('estudio_financiero.update',$estudio_Finaciero->id) }}" method="POST">

            {{-- directiva de seguridad --}}
            @csrf

            {{-- Directiva que tenemos que poner para que soporte el PUT ya que no lo
            soporta el formulario solo acepta POST Y GET. --}}
            @method('PUT')

            {{-- Agregamos el nombre correspondiente del id  --}}
            <div class="mb-4">
                <label for="name" class="block text-sm font-bold text-gray-700">Nombre</label>
                <input type="text" id="name" name="name" class="w-full mt-1 p-2 border border-gray-300 shadow-lg  rounded-md
                @error('name') border-red-500 @enderror" value="{{$estudio_Finaciero->name}}">
            </div>

            {{-- Se mostrara el siguiente error si hay un problema con name  --}}
            @error('name')
                <p class="bg-red-500 text-white my-0.5 rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
            @enderror

            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-bold text-gray-700">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4" class="w-full border-gray-300 shadow-lg mt-1 p-2 border  rounded-md
                @error('descripcion') border-red-500 @enderror">{{$estudio_Finaciero->descripcion}}</textarea>
            </div>

            {{-- Se mostrara el siguiente error si hay un problema con descripcion.  --}}
            @error('descripcion')
                <p class="bg-red-500 text-white my-0.5 rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
            @enderror

            <div class="mt-3">
                <button type="submit" class="px-4 py-2 bg-blue-500 w-full text-white rounded-md hover:bg-blue-700">Modificar</button>
            </div>
        </form>
    </div>
@endsection

