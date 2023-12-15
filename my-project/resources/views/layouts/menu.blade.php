<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-gray-100 h-screen flex flex-col">

    <header class="bg-gray-800 p-4 text-white border-b">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex justify-center items-center text-white">
                {{-- Agrego la imagen que esta en la carpeta public y despues imagenes. --}}
                <img src="{{ asset('img/laravel-img.png') }}" class="sm:w-10" alt="Imagen laravel">
                {{-- Muestro el usuario que esta autenticado. --}}
                <h2 class="px-3">{{ auth()->user()->name }}</h2>
            </div>
            <div class="flex justify-center items-center">

                {{-- Formulario para deslogearse o cerrar sesion. --}}
                <form action="{{ route('logout') }}" method="post" class="text-white">
                    @csrf
                    <button type="submit" class="hover:text-orange-500 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        Cerrar Sesion
                    </button>
                </form>

            </div>
    </header>

    <!-- Barra lateral y Contenido principal -->
    <div class="flex flex-grow">

        <!-- Barra lateral -->
        <aside class="w-1/6 bg-gray-800 text-white p-4 h-full">
            <!-- Aquí puedes agregar enlaces o íconos para navegar a diferentes secciones -->
            <ul>
                <li class="mb-3 ">
                    {{-- Lo envio a menu --}}
                    <a href="{{ route('menu') }}" class="hover:text-orange-500 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Inicio
                    </a>
                </li>

                <li class="mb-3">
                    {{-- Lo envio a la ruta para mostrar los estudios financieros. --}}
                    <a href="{{ route('estudio_financiero.index') }}"
                        class="hover:text-orange-500 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                        </svg>
                        Estudio Finaciero
                    </a>
                </li>

                <li class="mb-3">
                    {{-- Lo envio a la ruta para mostrar los costos fijos. --}}
                    <a href="{{route('costos_fijos.index')}}" class="hover:text-orange-500 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
                        </svg>
                        Costos Fijos
                    </a>
                </li>

                <li class="mb-3">
                    {{-- Lo envio a la ruta para mostrar los costos variables. --}}
                    <a href="{{route('costos_variables.index')}}" class="hover:text-orange-500 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                        </svg>
                        Costos Variables
                    </a>
                </li>
            </ul>
        </aside>


        <main class="flex-grow p-4 h-full">
            <div class="bg-white rounded-lg shadow p-4 h-full">
                <h1 class="flex justify-center text-4xl font-bold mb-5 mt-1">
                    {{-- Creo el contenedor titulo --}}
                    @yield('titulo')
                </h1>
                {{-- Apartado donde mostrara un mensaje de las operaciones que se han echo --}}
                @if (Session::get('success'))
                    <div class="bg-blue-100 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md"
                        role="alert">
                        <div class="flex items-center gap-2">
                            <div class="py-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                </svg>
                            </div>
                            <div>
                                {{-- Agrego el texto que me enviaran --}}
                                <p class="font-bold">{{ Session::get('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Creo el contenedor contenido --}}
                @yield('contenido')
            </div>
        </main>
    </div>
</body>
</html>
