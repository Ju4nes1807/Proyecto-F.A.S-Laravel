<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Datos de la Escuela</title>
    <script src="validaciones.js" defer></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="navbar navbar-expand bg-primary lg-4 shadow">
        <a href="landinpage.html">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid me-2"
                style="width: 75px; height: 75px;">
        </a>
        <p class="navbar-brand text-light fs-2 shadow">F.A.S</p>
        <div class="collapse navbar-collapse" id="navNavbarDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.dash_admin') }}" class="nav-link text-light shadow">Regresar</a>
                </li>
        </div>
    </div>

    <div class="container flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <h3 class="mt-5 shadow-sm p-2">Datos de la escuela</h2>
                    <!-- Mostrar errores de validación -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>
                        </div>
                    @endif
                    <form id="FormEscuela" action="{{ route('escuelas.update', $escuela->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="text" id="nombre" name="nombre" class="form-control mb-3"
                            placeholder="Nombre de la escuela" value="{{ old('nombre', $escuela->nombre) }}" required>
                        <input type="tel" id="contacto" name="contacto" class="form-control mb-3" pattern="[0-9]{10}"
                            placeholder="Numero de telefono" value="{{ old('contacto', $escuela->contacto) }}" required>
                        <input type="email" id="correo" name="correo" class="form-control mb-3"
                            placeholder="Correo electronico" value="{{ old('correo', $escuela->correo) }}" required>
                        <input type="text" id="direccion" name="direccion" class="form-control mb-3"
                            placeholder="Direccion" value="{{ old('direccion', $escuela->direccion) }}" required>
                        <select name="ubicacion_id" id="ubicacion_id" class="form-select" required>
                            <option value="">Seleccione localidad y barrio</option>
                            @foreach ($ubicaciones as $ubicacion)
                                <option value="{{ $ubicacion->id }}" {{ old('ubicacion_id', $escuela->ubicacion_id) == $ubicacion->id ? 'selected' : '' }}>
                                    {{ $ubicacion->localidad }} - {{ $ubicacion->barrio }}
                                </option>
                            @endforeach
                        </select>
                    </form>
            </div>
        </div>
        <div class="container justify-content-center d-flex align-items-center p-4">
            <div class="text-center">
                <input type="submit" class="btn btn-primary fs-6 me-2 shadow" value="Actualizar" form="FormEscuela">
            </div>
        </div>
    </div>

    <footer class="bg-warning py-3 shadow mt-auto">
        <div class="container text-start d-flex align-items-center shadow">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid me-2"
                style="width: 75px; height: 75px;">
            <p class="text-dark m-0">© Football Association System. Todos los derechos reservados</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>