<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Images/Logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <title>Categorias</title>
    <style>
        /* Estilo para el footer, similar a los otros archivos para asegurar el apilamiento */
        .footer-content {
            flex-direction: column;
            /* Apila los elementos verticalmente por defecto */
        }

        @media (min-width: 576px) {

            /* En pantallas pequeñas y superiores, conviértelo en una fila */
            .footer-content {
                flex-direction: row;
            }
        }

        /* Ajuste para el sidebar para que ocupe todo el ancho en pantallas pequeñas */
        @media (max-width: 767.98px) {
            .sidebar {
                border-right: none !important;
                /* Elimina el borde si lo hubiera en móviles */
                border-bottom: 1px solid #dee2e6;
                /* Añade un borde inferior para separación */
                padding-bottom: 1rem;
                margin-bottom: 1rem;
            }
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="navbar navbar-expand-md bg-primary shadow mb-4"> <a href="landinpage.html"
            class="d-flex align-items-center"> <img src="../Images/Logo.png" alt="Logo" class="img-fluid me-2"
                style="width: 75px; height: 75px;">
            <p class="navbar-brand text-light fs-2 shadow m-0">F.A.S</p>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navNavbarDropdown"
            aria-controls="navNavbarDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navNavbarDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link text-light shadow">Cerrar sesión</button>
                    </form>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.perfil.edit') }}" class="nav-link text-light shadow">Modificar Perfil</a>
                </li>
            </ul>
        </div>
    </div>


    <main class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-3 col-lg-2 sidebar mb-3">
                <h5 class="mb-3 text-primary">Categorias</h5>
                <div class="list-group">
                    <a href="{{ route('admin.dash_admin') }}" class="list-group-item list-group-item-action"
                        aria-current="true">
                        Inicio
                    </a>
                    <a href="{{ route('escuelas.index') }}" class="list-group-item list-group-item-action">
                        Escuelas
                    </a>
                    <a href="Entrenamientos.html" class="list-group-item list-group-item-action">
                        Entrenamientos
                    </a>
                    <a href="Torneos.html" class="list-group-item list-group-item-action">
                        Torneos
                    </a>
                    <a href="{{ route('categorias.index') }}" class="list-group-item list-group-item-action active">
                        Categorias
                    </a>
                    <a href="{{ route('canchas.index') }}" class="list-group-item list-group-item-action">Canchas</a>
                    <a href="{{ route('usuarios.index') }}" class="list-group-item list-group-item-action">Usuarios</a>
                    <a href="Solicitudes.html" class="list-group-item list-group-item-action">
                        Solicitudes
                    </a>
                    <a href="Estadisticas.html" class="list-group-item list-group-item-action">Estadisiticas</a>
                </div>
            </div>


            <div class="col-12 col-md-9 col-lg-10 p-4">
                <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap">
                    <h2></h2>
                    <form class="d-flex flex-grow-1 flex-shrink-1 me-2 ms-auto" role="search" style="max-width: 400px;">
                        <div class="input-group flex-grow-1">
                            <button class="input-group-text"><i class="fas fa-search"></i></button>
                            <input type="search" class="form-control" placeholder="Buscar cancha..."
                                aria-label="Search">
                        </div>
                        <a href="{{ route('categorias.create') }}"
                            class="btn btn-warning d-flex align-items-center justify-content-center flex-shrink-0 ms-2">Registar
                            categoria</a>
                    </form>
                </div>
                <h6></h6>
                <h3 class="mt-3">Categorias</h3>

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Escuelas</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categorias as $categoria)
                                <tr>
                                    <td>{{ $categoria->id }}</td>
                                    <td>{{ $categoria->nombre }}</td>
                                    <td>{{ $categoria->escuelas->pluck('nombre')->join(', ') ?: 'No asignada' }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('categorias.edit', $categoria->id) }}"
                                                class="btn btn-sm btn-primary me-2" data-bs-toggle="modal"
                                                data-bs-target="#editCategoriaModal{{ $categoria->id }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('¿Seguro que desea eliminar esta categoría?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No hay categorías registradas por usted.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    @foreach ($categorias as $categoria)
        <div class="modal fade" id="editCategoriaModal{{ $categoria->id }}" tabindex="-1"
            aria-labelledby="editCategoriaLabel{{ $categoria->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title" id="editCategoriaLabel{{ $categoria->id }}">
                                Editar Categoría
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nombre{{ $categoria->id }}" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="nombre{{ $categoria->id }}" class="form-control"
                                    value="{{ $categoria->nombre }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="escuelas{{ $categoria->id }}" class="form-label">Escuelas</label>
                                <select name="escuelas[]" id="escuelas{{ $categoria->id }}" class="form-select" multiple
                                    required>
                                    @foreach ($escuelas as $escuela)
                                        <option value="{{ $escuela->id }}" {{ $categoria->escuelas->contains($escuela->id) ? 'selected' : '' }}>
                                            {{ $escuela->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">
                                    Mantén presionada la tecla Ctrl (Cmd en Mac) para seleccionar varias escuelas.
                                </small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <footer class="bg-warning py-3 shadow mt-auto">
        <div class="container text-start d-flex align-items-center footer-content shadow"> <img src="../Images/Logo.png"
                alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px;">
            <p class="text-dark m-0">© Football Association System. Todos los derechos reservados</p>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>