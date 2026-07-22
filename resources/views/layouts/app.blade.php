<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'TechSolutions - Proyectos')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/proyectos.css') }}">
</head>
<body>
    <header class="cabecera">
        <h1>TechSolutions - Gestion de Proyectos</h1>
        <nav>
            <a href="{{ route('proyectos.index') }}">Listar Proyectos</a>
            <a href="{{ route('proyectos.create') }}">Agregar Proyecto</a>
        </nav>
        <x-uf-hoy />
    </header>

    <main class="contenido">
        @if(session('mensaje'))
            <div class="mensaje-exito">{{ session('mensaje') }}</div>
        @endif

        @yield('contenido')
    </main>

    <footer class="pie">
        <p>TechSolutions &copy; {{ date('Y') }} - Desarrollado por Johhan Urrutia y Kevin Escobar</p>
    </footer>
</body>
</html>
