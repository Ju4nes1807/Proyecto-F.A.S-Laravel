<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Categoría</title>
    <link rel="shortcut icon" href="../Images/Logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="navbar navbar-expand bg-primary shadow">
        <a href="">
            <img src="../Images/Logo.png" alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px;">
        </a>
        <p class="navbar-brand text-light fs-2 shadow">F.A.S</p>
        <div class="collapse navbar-collapse" id="navNavbarDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="{{ route('categorias.index') }}" class="nav-link text-light shadow">Regresar</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container flex-grow-1 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-12 col-md-6 col-lg-4">
            <h3 class="mb-4 text-center">Registrar Categoría</h3>

            <!-- Mensajes de éxito -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            <!-- Errores de validación -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Formulario -->
            <form action="{{ route('categorias.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" name="nombre" class="form-control" placeholder="Nombre de la categoría"
                        value="{{ old('nombre') }}" required>
                </div>

                <div class="mb-3">
                    <label for="escuelas" class="form-label">Asignar a Escuelas</label>
                    <select name="escuelas[]" id="escuelas" class="form-select" multiple required>
                        @foreach ($escuelas as $escuela)
                            <option value="{{ $escuela->id }}">
                                {{ $escuela->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Mantén presionada la tecla Ctrl (Cmd en Mac) para seleccionar varias
                        escuelas.</small>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-100">Registrar</button>
                </div>
            </form>
        </div>
    </div>

    <footer class="bg-warning py-3 mt-3 shadow mt-auto">
        <div class="container text-start d-flex align-items-center footer-content shadow"> <img src="../Images/Logo.png"
                alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px;">
            <p class="text-dark m-0">© Football Association System. Todos los derechos reservados</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>