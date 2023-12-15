@extends('layouts.menu')

@section('titulo')
    Costos Fijos
@endsection

@section('contenido')
    <div class="container mx-auto">
        <table class="min-w-full table-auto border shadow-lg bg-amber-400">
            <thead>
                <tr>
                    <th class="border border-black py-2 px-4 text-center">Pertene Estudio Financiero</th>
                    <th class="border border-black py-2 px-4 text-center">Nombre</th>
                    <th class="border border-black py-2 px-4 text-center">Mes</th>
                    <th class="border border-black py-2 px-4 text-center">Costo</th>
                    <th class="border border-black py-2 px-4 text-center"></th>
                </tr>
            </thead>
            <tbody>

                @php
                    // Variable para alternar el color de fondo por estudio financiero
                    $alternateColor = false;
                @endphp
                {{-- voy a recorrer todos los estudios financieros --}}
                @foreach ($estudiosFinancieros as $estudio)
                    @php
                    // Pero ordenados por el mes menor o sea el 1
                        $costos = $estudio
                            ->costos_fijos()
                            ->orderBy('month')
                            ->get()
                            ->groupBy('month');
                    @endphp
                    {{-- De ahi recorro basandome por los meses --}}
                    @foreach ($costos as $mes => $costosPorMes)
                        @foreach ($costosPorMes as $costo)

                            {{-- hago que vaya pintanto primero el gris y luego el otro en blanco --}}
                            <tr class="{{ $alternateColor ? 'bg-white' : 'bg-gray-200' }} ">

                                {{-- Agrego los valores en los campos correspondiente --}}
                                <td class="border border-black py-2 px-4 text-center">{{ $estudio->name }}</td>
                                <td class="border border-black py-2 px-4 text-center">{{ $costo->name }}</td>
                                <td class="border border-black py-2 px-4 text-center">{{ $costo->month }}</td>
                                <td class="border border-black py-2 px-4 text-center">{{ $costo->amount }}</td>
                                <td class="border border-black">

                                    <div class=" text-center flex justify-center gap-3 items-center">
                                        {{-- Formulario para eliminar un costo fijo que me envia al metodo destroy para eliminar --}}
                                        <form action="{{ route('costos_fijos.destroy', $costo->id) }}" method="POST"
                                            class="pt-1">
                                            {{-- directiva de seguridad. --}}
                                            @csrf
                                            {{-- directiva para eliminar ya que el formulario solo soporta post y get. --}}
                                            @method('DELETE')

                                            <button type="submit" class="text-red-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25
                                        2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12
                                        .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964
                                        51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>

                                        </form>

                                        {{-- Metodo que me envia al formulario editar --}}
                                        <a href="{{ route('costos_fijos.edit', $costo->id) }}" class="text-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0
                                            01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5
                                            7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25
                                            2.25 0 015.25 6H10" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach

                    @php
                        // Alternar el color para el próximo estudio financiero
                        $alternateColor = !$alternateColor;
                    @endphp
                @endforeach

            </tbody>
        </table>

        <div class="flex gap-2">
            <!-- Voy al controlador costos_fijos y llamo al metodo create
                    y me envia a una vista -->
            <a href="{{ route('costos_fijos.create') }}"
                class="hover:text-green-700 hover:border-green-700 flex items-center jus mt-3 w-auto border-gray-400 border py-2 px-4 rounded-md ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Agregar un nuevo costo fijo
            </a>

        </div>
    @endsection
