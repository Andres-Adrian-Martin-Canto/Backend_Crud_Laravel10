<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

{{-- Login --}}
<body class="bg-slate-900">
    <header class="p-5 border-b bg-red-500 shadow">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-black text-white">Finanzas</h1>
            <nav class="flex gap-2 items-center">
                {{-- Lo envio al controlador login para que valide. --}}
                <a href="{{route('login')}}" class="font-bold uppercase text-gray-200">
                    Login
                </a>
                {{-- Lo envio al controlador donde se mandara a crear cuenta. --}}
                <a href="{{route('crear-cuenta')}}" class="font-bold uppercase text-gray-200">
                    Crear cuenta
                </a>
            </nav>
        </div>
    </header>
</body>

</html>
