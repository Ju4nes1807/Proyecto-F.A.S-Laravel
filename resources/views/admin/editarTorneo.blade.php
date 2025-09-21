<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('Images/Logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Torneo</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="navbar navbar-expand bg-primary shadow">
        <a href="{{ route('admin.dash_admin') }}">
            <img src="{{ asset('Images/Logo.png') }}" alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px;">
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
                <h3 class="mt-5 shadow-sm p-2 text-center">Editar torneo</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="FormTorneoEdit" action="{{ route('torneos.update', $torneo->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="text" name="nombre" class="form-control mb-3" placeholder="Nombre del torneo"
                        value="{{ old('nombre', $torneo->nombre) }}" required>

                    <textarea name="descripcion" class="form-control mb-3" placeholder="Descripción del torneo"
                        rows="3">{{ old('descripcion', $torneo->descripcion) }}</textarea>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                                value="{{ old('fecha_inicio', $torneo->fecha_inicio->format('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"
                                value="{{ old('fecha_fin', $torneo->fecha_fin->format('Y-m-d')) }}" required>
                        </div>
                    </div>

                    <label for="fk_ubicacion_id" class="form-label">Ubicación</label>
                    <select name="fk_ubicacion_id" id="fk_ubicacion_id" class="form-select mb-3" required>
                        <option value="">Seleccione una ubicación</option>
                        @foreach ($ubicaciones as $ubicacion)
                            <option value="{{ $ubicacion->id }}" {{ old('fk_ubicacion_id', $torneo->fk_ubicacion_id) == $ubicacion->id ? 'selected' : '' }}>
                                {{ $ubicacion->localidad }} - {{ $ubicacion->barrio }}
                            </option>
                        @endforeach
                    </select>

                    <label for="fk_categoria_id" class="form-label">Categoría</label>
                    <select name="fk_categoria_id" id="fk_categoria_id" class="form-select mb-3" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('fk_categoria_id', $torneo->fk_categoria_id) == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>

                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Seleccionar Escuelas Participantes</h5>
                            <p class="text-muted">Puedes seleccionar varias escuelas.</p>
                            <div class="form-check-group" style="max-height: 200px; overflow-y: auto;">
                                @foreach ($escuelas as $escuela)
                                    <div class="form-check escuela-item" data-categorias="{{ $escuela->categorias->pluck('nombre')->implode(',') }}">
                                        <input class="form-check-input" type="checkbox" name="escuelas[]"
                                               value="{{ $escuela->id }}" id="escuela{{ $escuela->id }}"
                                               {{ $torneo->escuelas->contains($escuela->id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="escuela{{ $escuela->id }}">
                                            {{ $escuela->nombre }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <label for="estado" class="form-label">Estado del torneo</label>
                    <select name="estado" id="estado" class="form-select mb-3" required>
                        <option value="En curso" {{ $torneo->estado == 'En curso' ? 'selected' : '' }}>En curso</option>
                        <option value="Finalizado" {{ $torneo->estado == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                        <option value="Cancelado" {{ $torneo->estado == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                    </select>

                    <div class="d-flex justify-content-center mb-3">
                        <input type="submit" class="btn btn-primary fs-6 shadow" value="Guardar cambios">
                    </div>
                </form>
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

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const selectCategoria = document.getElementById("fk_categoria_id");
        const escuelas = document.querySelectorAll(".escuela-item");

        selectCategoria.addEventListener("change", function () {
            const selectedText = selectCategoria.options[selectCategoria.selectedIndex]?.text || "";
            escuelas.forEach(escuela => {
                const categoriasEscuela = escuela.dataset.categorias.split(",");
                if (categoriasEscuela.includes(selectedText)) {
                    escuela.style.display = "block";
                } else {
                    escuela.style.display = "none";
                    escuela.querySelector("input").checked = false;
                }
            });
        });
    });
    </script>

</body>
</html>
