<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla Principal</title>
    @vite(['resources/css/app.css','resources/css/app.scss', 'resources/js/app.js'])
    <!-- Aplica bootstrap css,cscs y js -->
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        <img src="../resources/img/icon.png" alt="logo" height="75px" weight="75px">
    </a>

    <!-- Boton menu dispositivos pequeños -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            @if (Auth::check() && Auth::user()->tipus_usuaris_id == '1')
            <!-- Menú Dades mestres -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dades mestres
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                    <a class="dropdown-item" href="#">Tipus usuaris</a>
                    <a class="dropdown-item" href="{{ route('usuarios.index') }}">Usuaris</a>
                    <a class="dropdown-item" href="#">Cicles</a>
                    <a class="dropdown-item" href="#">Mòduls</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Assignar Professors</a>
                    <a class="dropdown-item" href="#">Assignar alumnes</a>
                    <a class="dropdown-item" href="#">Resultats aprenentatge</a>
                    <a class="dropdown-item" href="#">Criteris avaluació</a>
                </div>
            </li>
            @endif

            @if (Auth::check() && Auth::user()->tipus_usuaris_id == '2')
            <!-- Menú Professors -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Professors
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                    <a class="dropdown-item" href="#">Assignar alumnes</a>
                    <a class="dropdown-item" href="#">Resultats aprenentatge</a>
                    <a class="dropdown-item" href="#">Criteris avaluació</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('moduls.index')}}">Autoavaluació alumnes</a>
                </div>
            </li>
            @endif

            @if (Auth::check() && Auth::user()->tipus_usuaris_id == '3')
            <!-- Menú Alumnes -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Alumnes
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                    {{-- Usar un controller normal para rredirigir a la vista, i ya luego en moduls.vue con el ftech ya llamaaras a la api con la info --}}
                    <a class="dropdown-item" href="{{ route('moduls.index')}}">Autoavaluació</a>
                </div>
            </li>
            @endif
        </ul>

        <!-- Botón de inicio de sesión -->
        @if (Auth::check())
        <li class="nav-item dropdown">
            <a style="color: white;">
                {{Auth::user()->nom_usuari}} {{Auth::user()->cognom}} 
            </a>
            <a href="{{ url('/logout')}}">
                <i>LOGOUT</i>
            </a>
        @else
        <a href="{{ route('login') }}" class="btn btn-outline-light">Iniciar Sesión</a>
        @endif
    </div>
</nav>

<div class="container mt-4">
    <!-- Contenido principal de las páginas -->
    @yield('contenido_principal')
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
