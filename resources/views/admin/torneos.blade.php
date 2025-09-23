<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('Images/Logo.png') }}" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <title>Torneos</title>
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
            <div class="col-12 col-md-3 col-lg-2 sidebar mb-3">
                <h5 class="mb-3 text-primary">Torneos</h5>
                <div class="list-group">
                    <a href="{{ route('admin.dash_admin') }}" class="list-group-item list-group-item-action">Inicio</a>
                    <a href="{{ route('escuelas.index') }}" class="list-group-item list-group-item-action">Escuelas</a>
                    <a href="{{ route('admin.entrenamientos.index') }}" class="list-group-item list-group-item-action">Entrenamientos</a>
                    <a href="{{ route('torneos.index') }}"
                        class="list-group-item list-group-item-action active">Torneos</a>
                    <a href="{{ route('categorias.index') }}"
                        class="list-group-item list-group-item-action">Categorias</a>
                    <a href="{{ route('canchas.index') }}" class="list-group-item list-group-item-action">Canchas</a>
                    <a href="{{ route('usuarios.index') }}" class="list-group-item list-group-item-action">Usuarios</a>
                </div>
            </div>

            <div class="col-12 col-md-9 col-lg-10 p-4">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-3">
                    <form class="d-flex flex-grow-1 mb-2 mb-md-0 me-md-2" role="search" method="GET"
                        action="{{ route('torneos.index') }}">
                        <div class="input-group flex-grow-1 me-2">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input type="search" class="form-control" placeholder="Nombre..." name="nombre"
                                value="{{ request('nombre') }}">
                        </div>

                        <div class="input-group me-2">
                            <span class="input-group-text">Ubicación</span>
                            <select class="form-select" name="ubicacion_id">
                                <option value="">Todas</option>
                                @foreach($ubicaciones as $ubicacion)
                                    <option value="{{ $ubicacion->id }}" @if(request('ubicacion_id') == $ubicacion->id)
                                    selected @endif>
                                        {{ $ubicacion->localidad }} - {{ $ubicacion->barrio }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group">
                            <span class="input-group-text">Categoría</span>
                            <select class="form-select" name="categoria_id">
                                <option value="">Todas</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" @if(request('categoria_id') == $categoria->id)
                                    selected @endif>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-primary ms-2" type="submit"><i class="fas fa-filter"></i></button>
                        <a href="{{ route('torneos.index') }}" class="btn btn-outline-warning ms-1"><i
                                class="fas fa-sync-alt"></i></a>
                    </form>

                    @if(Auth::user()->fk_role_id == 1)
                        <a href="{{ route('torneos.create') }}" class="btn btn-warning">Registrar Torneo</a>
                    @endif
                </div>

                <h3 class="mt-3">Todos los Torneos</h3>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Fecha de Inicio</th>
                                <th>Fecha de Fin</th>
                                <th>Ubicación</th>
                                <th>Categoría</th>
                                <th>Estado</th>
                                <th>Registrado por</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($torneos as $torneo)
                                <tr>
                                    <td><a href="#" data-bs-toggle="modal" data-bs-target="#modalTorneo{{ $torneo->id }}">
                                            {{ $torneo->nombre }}
                                        </a></td>
                                    <td>{{ Str::limit($torneo->descripcion, 50) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($torneo->fecha_inicio)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($torneo->fecha_fin)->format('d/m/Y') }}</td>
                                    <td>{{ $torneo->ubicacion->localidad }} - {{ $torneo->ubicacion->barrio }}</td>
                                    <td>{{ $torneo->categoria->nombre ?? 'Sin asignar' }}</td>
                                    <td>
                                        @if ($torneo->estado == 'En curso')
                                            <span class="badge bg-success">En curso</span>
                                        @elseif ($torneo->estado == 'Finalizado')
                                            <span class="badge bg-secondary">Finalizado</span>
                                        @elseif ($torneo->estado == 'Cancelado')
                                            <span class="badge bg-danger">Cancelado</span>
                                        @endif
                                    </td>
                                    <td>{{ $torneo->admin->nombres }} {{ $torneo->admin->apellidos }}</td>
                                </tr>

                                <!-- Modal de detalle del torneo -->
                                <div class="modal fade" id="modalTorneo{{ $torneo->id }}" tabindex="-1"
                                    aria-labelledby="modalTorneo{{ $torneo->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title">Información del Torneo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="list-group mb-3">
                                                    <li class="list-group-item"><strong>Nombre:</strong>
                                                        {{ $torneo->nombre }}</li>
                                                    <li class="list-group-item"><strong>Descripción:</strong>
                                                        {{ $torneo->descripcion ?? 'Sin descripción' }}</li>
                                                    <li class="list-group-item"><strong>Fecha inicio:</strong>
                                                        {{ $torneo->fecha_inicio }}</li>
                                                    <li class="list-group-item"><strong>Fecha fin:</strong>
                                                        {{ $torneo->fecha_fin }}</li>
                                                    <li class="list-group-item"><strong>Estado:</strong>
                                                        {{ $torneo->estado }}</li>
                                                    <li class="list-group-item"><strong>Categoría:</strong>
                                                        {{ $torneo->categoria->nombre ?? 'Sin asignar' }}</li>
                                                    <li class="list-group-item"><strong>Ubicación:</strong>
                                                        {{ $torneo->ubicacion->localidad }} -
                                                        {{ $torneo->ubicacion->barrio }}
                                                    </li>
                                                    <li class="list-group-item"><strong>Admin:</strong>
                                                        {{ $torneo->admin->nombres }} {{ $torneo->admin->apellidos }}</li>
                                                    <li class="list-group-item"><strong>Escuelas participantes:</strong>
                                                        @if($torneo->escuelas->count())
                                                            <ul>
                                                                @foreach($torneo->escuelas as $escuela)
                                                                    <li>{{ $escuela->nombre }}</li>
                                                                @endforeach
                                                            </ul>
                                                        @else
                                                            Sin asignar
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No hay torneos registrados.</td>
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