<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('Images/Logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registrar Torneo</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="navbar navbar-expand bg-primary shadow">
        <a href="{{ route('torneos.index') }}">
            <img src="{{ asset('Images/Logo.png') }}" alt="Logo" class="img-fluid me-2"
                style="width: 75px; height: 75px;">
        </a>
        <p class="navbar-brand text-light fs-2 shadow">F.A.S</p>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="{{ route('torneos.index') }}" class="nav-link text-light shadow">Regresar</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container flex-grow-1">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <h3 class="mt-5 shadow-sm p-2 text-center">Registrar un torneo</h3>

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

                <form id="FormTorneo" action="{{ route('torneos.store') }}" method="POST">
                    @csrf
                    <input type="text" name="nombre" class="form-control mb-3" placeholder="Nombre del torneo"
                        value="{{ old('nombre') }}" required>

                    <textarea name="descripcion" class="form-control mb-3" placeholder="Descripción del torneo"
                        rows="3">{{ old('descripcion') }}</textarea>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                                value="{{ old('fecha_inicio') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control"
                                value="{{ old('fecha_fin') }}" required>
                        </div>
                    </div>

                    <label for="fk_ubicacion_id" class="form-label">Ubicación</label>
                    <select name="fk_ubicacion_id" id="fk_ubicacion_id" class="form-select mb-3" required>
                        <option value="">Seleccione una ubicación</option>
                        @foreach ($ubicaciones as $ubicacion)
                            <option value="{{ $ubicacion->id }}" {{ old('ubicacion_id') == $ubicacion->id ? 'selected' : ''
                                            }}>
                                {{ $ubicacion->localidad }} - {{ $ubicacion->barrio }}
                            </option>
                        @endforeach
                    </select>

                    <label for="fk_categoria_id" class="form-label">Categoría</label>
                    <select name="fk_categoria_id" id="fk_categoria_id" class="form-select mb-3" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : ''
                                            }}>
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
        <div class="form-check escuela-item"
             data-categorias="{{ $escuela->categorias->pluck('nombre')->implode(',') }}">
            <input class="form-check-input" type="checkbox" name="escuelas[]"
                   value="{{ $escuela->id }}" id="escuela{{ $escuela->id }}"
                   {{ in_array($escuela->id, old('escuelas', [])) ? 'checked' : '' }}>
            <label class="form-check-label" for="escuela{{ $escuela->id }}">
                {{ $escuela->nombre }}
            </label>
        </div>
    @endforeach
</div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="container justify-content-center d-flex align-items-center p-4 mt-auto">
            <div class="text-center">
                <input type="submit" class="btn btn-primary fs-6 me-2 shadow" value="Finalizar" form="FormTorneo">
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
                escuela.querySelector("input").checked = false; // desmarca si ya estaba
            }
        });
    });
});
</script>

</body>

</html>