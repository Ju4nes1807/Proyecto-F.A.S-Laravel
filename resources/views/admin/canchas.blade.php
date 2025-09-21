<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('Images/Logo.png') }}" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <title>Canchas</title>
    <style>
        .footer-content {
            flex-direction: column;
        }

        @media (min-width: 576px) {
            .footer-content {
                flex-direction: row;
            }
        }

        @media (max-width: 767.98px) {
            .sidebar {
                border-right: none !important;
                border-bottom: 1px solid #dee2e6;
                padding-bottom: 1rem;
                margin-bottom: 1rem;
            }
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="navbar navbar-expand-md bg-primary shadow mb-4">
        <a href="{{ route('landinpage') }}" class="d-flex align-items-center">
            <img src="{{ asset('Images/Logo.png') }}" alt="Logo" class="img-fluid me-2"
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

    <main class="container-fluid flex-grow-1">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-12 col-md-3 col-lg-2 sidebar mb-3">
                <h5 class="mb-3 text-primary">Canchas</h5>
                <div class="list-group">
                    <a href="{{ route('admin.dash_admin') }}" class="list-group-item list-group-item-action">Inicio</a>
                    <a href="{{ route('escuelas.index') }}" class="list-group-item list-group-item-action">Escuelas</a>
                    <a href="#" class="list-group-item list-group-item-action">Entrenamientos</a>
                    <a href="{{ route('torneos.index') }}" class="list-group-item list-group-item-action">Torneos</a>
                    <a href="{{ route('categorias.index') }}" class="list-group-item list-group-item-action">
                        Categorias
                    </a>
                    <a href="{{ route('canchas.index') }}"
                        class="list-group-item list-group-item-action active">Canchas</a>
                    <a href="{{ route('usuarios.index') }}" class="list-group-item list-group-item-action">Usuarios</a>
                </div>
            </div>

            <!-- Contenido principal -->
            <div class="col-12 col-md-9 col-lg-10 p-4">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-3">
                    <form class="d-flex flex-grow-1 mb-2 mb-md-0 me-md-2" role="search" method="GET"
                        action="{{ route('canchas.index') }}">
                        <div class="input-group flex-grow-1">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="search" class="form-control" placeholder="Nombre..." name="nombre"
                                value="{{ request('nombre') }}">
                        </div>

                        <div class="input-group ms-2">
                            <span class="input-group-text">Ubicación</span>
                            <select class="form-select" name="ubicacion">
                                <option value="">Todas</option>
                                @foreach($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}" @if(request('ubicacion') == $ubicacion->id) selected
                                    @endif>
                                        {{ $ubicacion->localidad }} - {{ $ubicacion->barrio }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-primary ms-2" type="submit"><i class="fas fa-filter"></i></button>
                        <a href="{{ route('canchas.index') }}" class="btn btn-outline-warning ms-1"><i
                                class="fas fa-sync-alt"></i></a>
                    </form>

                    @if(Auth::user()->fk_role_id == 1)
                        <a href="{{ route('canchas.create') }}" class="btn btn-warning">Registrar cancha</a>
                    @endif
                </div>
                <h6>
                </h6>
                <h3 class="mt-3">Todas las Canchas</h3>

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Descripción</th>
                                <th>Direccion</th>
                                <th>Localidad</th>
                                <th>Barrio</th>
                                <th>Estado</th>
                                <th>Escuela</th>
                                <th>Registrada por</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($canchas as $cancha)
                                <tr>
                                    <td>{{ $cancha->nombre }}</td>
                                    <td>{{ $cancha->tipo }}</td>
                                    <td>{{ $cancha->descripcion }}</td>
                                    <td>{{ $cancha->direccion }}</td>
                                    <td>{{ $cancha->ubicacion->localidad }}</td>
                                    <td>{{ $cancha->ubicacion->barrio }}</td>
                                    <td>
                                        @if($cancha->disponible)
                                            <span class="badge bg-success">Disponible</span>
                                        @else
                                            <span class="badge bg-danger">No disponible</span>
                                        @endif
                                    </td>
                                    <td>{{ $cancha->escuela->nombre }}</td>
                                    <td>{{ $cancha->escuela->admin->nombres }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No hay canchas registradas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-warning py-3 shadow mt-auto">
        <div class="container text-start d-flex align-items-center footer-content shadow">
            <img src="{{ asset('Images/Logo.png') }}" alt="Logo" class="img-fluid me-2"
                style="width: 75px; height: 75px;">
            <p class="text-dark m-0">© Football Association System. Todos los derechos reservados</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>