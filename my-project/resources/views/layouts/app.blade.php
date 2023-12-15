<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('titulo')</title>
</head>

{{-- Layout que me sirve para el login y crear cuenta. --}}

<body class="bg-slate-900 ">
    <main class="flex items-center justify-center h-screen">
        <div class=" px-10 rounded-lg shadow-2xl">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                {{-- Agrego la imagen que esta en la carpeta public en imagenes. --}}
                <img class="mx-auto h-auto w-auto" src="{{ asset('img/IconoMapache.ico') }}" alt="Imagen tec">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900 dark:text-white">
                    {{-- Creo el contenedor titulo. --}}
                    @yield('titulo')</h2>
            </div>
            {{-- Creo el contenedor contenido. --}}
            @yield('contenido')
        </div>
    </main>
    <h2 class="text-white">Prueba</h2>
</body>

</html>
