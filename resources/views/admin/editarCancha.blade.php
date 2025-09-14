<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('Images/Logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Cancha</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="navbar navbar-expand bg-primary shadow">
        <a href="{{ route('canchas.index') }}">
            <img src="{{ asset('Images/Logo.png') }}" alt="Logo" class="img-fluid me-2"
                style="width: 75px; height: 75px;">
        </a>
        <p class="navbar-brand text-light fs-2 shadow">F.A.S</p>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.dash_admin') }}" class="nav-link text-light shadow">Regresar</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <h3 class="mt-5 shadow-sm p-2 text-center">Editar Cancha</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="FormCancha" action="{{ route('canchas.update', $cancha->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nombre -->
                    <input type="text" name="nombre" class="form-control mb-3"
                           placeholder="Nombre de la cancha"
                           value="{{ old('nombre', $cancha->nombre) }}" required>

                    <!-- Tipo -->
                    <input type="text" name="tipo" class="form-control mb-3"
                           placeholder="Tipo de cancha (Fútbol 5, Fútbol 11...)"
                           value="{{ old('tipo', $cancha->tipo) }}" required>

                    <!-- Descripción -->
                    <textarea name="descripcion" class="form-control mb-3"
                              placeholder="Descripción de la cancha" rows="3">{{ old('descripcion', $cancha->descripcion) }}</textarea>

                    <!-- Dirección -->
                    <input type="text" name="direccion" class="form-control mb-3"
                           placeholder="Dirección"
                           value="{{ old('direccion', $cancha->direccion) }}" required>

                    <!-- Ubicación -->
                    <select name="fk_ubicacion_id" id="fk_ubicacion_id" class="form-select mb-3" required>
                        <option value="">Seleccione localidad y barrio</option>
                        @foreach ($ubicaciones as $ubicacion)
                            <option value="{{ $ubicacion->id }}"
                                {{ old('fk_ubicacion_id', $cancha->fk_ubicacion_id) == $ubicacion->id ? 'selected' : '' }}>
                                {{ $ubicacion->localidad }} - {{ $ubicacion->barrio }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Estado Disponible -->
                    <div class="card mb-3 mt-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Disponibilidad</h5>

                            <input type="hidden" name="disponible" value="0">

                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input me-2"
                                       type="checkbox"
                                       name="disponible"
                                       id="disponible"
                                       value="1"
                                       {{ old('disponible', $cancha->disponible) == 1 ? 'checked' : '' }}>
                                
                                <label class="form-check-label fs-5" for="disponible">
                                    <i class="fa-solid fa-square-check text-success me-2"></i> Disponible
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Botón Guardar -->
        <div class="container justify-content-center d-flex align-items-center p-4 mt-auto">
            <div class="text-center">
                <input type="submit" class="btn btn-primary fs-6 me-2 shadow"
                       value="Guardar cambios" form="FormCancha">
            </div>
        </div>
    </div>

    <footer class="bg-warning py-3 shadow mt-auto">
        <div class="container text-start d-flex align-items-center shadow">
            <img src="{{ asset('Images/Logo.png') }}" alt="Logo" class="img-fluid me-2"
                style="width: 75px; height: 75px;">
            <p class="text-dark m-0">© Football Association System. Todos los derechos reservados</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
