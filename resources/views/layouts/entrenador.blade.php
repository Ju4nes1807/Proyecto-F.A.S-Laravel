<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Entrenador')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4">
        <a href="{{ route('entrenador.principalEntrenador') }}" class="list-group-item list-group-item-action">Inicio</a>
        <a href="{{ route('entrenador.entrenamientos.index') }}" class="mr-4">Entrenamientos</a>
        <a href="{{ route('profile.edit') }}">Perfil</a>
    </nav>

    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>
