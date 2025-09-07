<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Modificar Perfil</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="navbar navbar-expand bg-primary lg-4 shadow">
        <a href="landinpage.html">
            <img src="../Images/Logo.png" alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px;">
        </a>
        <p class="navbar-brand text-light fs-2 shadow">F.A.S</p>
        <div class="collapse navbar-collapse" id="navNavbarDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="{{ route('jugador.principal') }}" class="nav-link text-light shadow">Regresar</a>
                </li>
        </div>
    </div>

    <div class="container flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <h3 class="mt-5 shadow-sm p-2">Datos</h2>
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('jugador.perfil.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="text" name="nombres" placeholder="Nombre completo"
                            value="{{ old('nombres', $user->nombres) }}" class="form-control mb-3">
                        @error('nombres')<p class="text-danger">{{ $message }}</p>@enderror

                        <input type="text" name="apellidos" placeholder="Apellidos completos"
                            value="{{ old('apellidos', $user->apellidos) }}" class="form-control mb-3">
                        @error('apellidos')<p class="text-danger">{{ $message }}</p>@enderror

                        <input type="number" name="documento" placeholder="Número de documento"
                            value="{{ old('documento', $user->documento) }}" class="form-control mb-3">
                        @error('documento')<p class="text-danger">{{ $message }}</p>@enderror

                        <input type="email" name="email" placeholder="Correo electrónico"
                            value="{{ old('email', $user->email) }}" class="form-control mb-3">
                        @error('email')<p class="text-danger">{{ $message }}</p>@enderror

                        <label for="fecha_nacimiento">Fecha de nacimiento</label>
                        <input type="date" name="fecha_nacimiento"
                            value="{{ old('fecha_nacimiento', $user->fecha_nacimiento) }}" class="form-control mb-3">
                        @error('fecha_nacimiento')<p class="text-danger">{{ $message }}</p>@enderror

                        <input type="number" name="telefono" placeholder="Teléfono"
                            value="{{ old('telefono', $user->telefono) }}" class="form-control mb-3">
                        @error('telefono')<p class="text-danger">{{ $message }}</p>@enderror

                        <input type="password" name="password_actual" placeholder="Contraseña actual"
                            class="form-control mb-3">
                        @error('password_actual')<p class="text-danger">{{ $message }}</p>@enderror

                        <input type="password" name="password_nueva" placeholder="Contraseña nueva"
                            class="form-control mb-3">
                        @error('password_nueva')<p class="text-danger">{{ $message }}</p>@enderror

                        <div class="text-center mt-3 mb-3">
                            <button type="submit" class="btn btn-primary">Actualizar perfil</button>
                        </div>
                    </form>
            </div>
        </div>

    </div>

    <footer class="bg-warning py-3 shadow mt-auto">
        <div class="container text-start d-flex align-items-center shadow">
            <img src="../Images/Logo.png" alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px;">
            <p class="text-dark m-0">© Football Association System. Todos los derechos reservados</p>
        </div>
    </footer>

    <script src="validacionModificarPerfil.js"></script>
</body>

</html>