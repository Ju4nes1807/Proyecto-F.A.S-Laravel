<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Sesion principal</title>
    <style>
        /* Estilo para el footer para asegurar el apilamiento */
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

    <div class="container-fluid flex-grow-1">
        <div class="row">
            <div class="col-12 col-md-3 col-lg-2 sidebar">
                <h5 class="mb-3 text-primary">Inicio</h5>
                <div class="list-group">
                    <a href="{{ route('admin.dash_admin') }}" class="list-group-item list-group-item-action active"
                        aria-current="true">
                        Inicio
                    </a>
                    <a href="{{ route('escuelas.index') }}" class="list-group-item list-group-item-action">
                        Escuelas
                    </a>
                    <a href="Entrenamientos.html" class="list-group-item list-group-item-action">
                        Entrenamientos
                    </a>
                    <a href="{{ route('torneos.index') }}" class="list-group-item list-group-item-action">
                        Torneos
                    </a>
                    <a href="{{ route('categorias.index') }}" class="list-group-item list-group-item-action">
                        Categorias
                    </a>
                    <a href="{{ route('canchas.index') }}" class="list-group-item list-group-item-action">Canchas</a>
                    <a href="{{ route('usuarios.index') }}" class="list-group-item list-group-item-action">Usuarios</a>
                </div>
            </div>

            <div class="col-12 col-md-9 col-lg-10 p-4">
                <h2>Bienvenido, {{ auth()->user()->nombres }}</h2>
                <h6>{{ auth()->user()->rol->tipo ?? 'Sin rol asignado' }}</h6>
                <p>Aquí podrás ver un resumen de su escuela, torneos y entrenamientos.</p>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                @endif

                <div class="row mt-4">
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card border-warning">
                            <div class="card-body text-center">
                                <h5 class="card-title">Escuela</h5>
                                <p>Consulte informacion sobre su escuela</p>
                                <button type="button" class="btn btn-warning btn-sm shadow-sm" data-bs-toggle="modal"
                                    data-bs-target="#consultarEscuela">Consultar Escuela</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card border-warning">
                            <div class="card-body text-center">
                                <h5 class="card-title">Entrenamientos</h5>
                                <p>Consulte informacion sobre sus los entrenamientos de su escuela</p>
                                <button class="btn btn-warning btn-sm shadow-sm" data-bs-toggle="modal"
                                    data-bs-target="#buscarEntrenamientos">Consultar Entrenamientos</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card border-warning">
                            <div class="card-body text-center">
                                <h5 class="card-title">Torneos</h5>
                                <p>Consulte informacion de sus torneos realizados</p>
                                <button class="btn btn-warning btn-sm shadow-sm" data-bs-toggle="modal"
                                    data-bs-target="#consultarTorneos">Consultar Torneo</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card border-warning">
                            <div class="card-body text-center">
                                <h5 class="card-title">Canchas</h5>
                                <p>Consulte informacion de sus canchas</p>
                                <button class="btn btn-warning btn-sm shadow-sm" data-bs-toggle="modal"
                                    data-bs-target="#consultarCanchas">Consultar Canchas</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="consultarEscuela" tabindex="-1" aria-labelledby="consultarEscuelaTitulo"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="consultarEscuelaTitulo">
                        {{ auth()->user()->escuelas->first()->nombre ?? 'Sin escuela registrada' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    @if(auth()->user()->escuelas->isNotEmpty())
                        @php
                            $escuela = auth()->user()->escuelas->first();
                        @endphp

                        <h3>Información General</h3>
                        <ul class="list-unstyled">
                            <li><strong>Localidad: </strong>{{ $escuela->ubicacion->localidad }}</li>
                            <li><strong>Barrio: </strong>{{ $escuela->ubicacion->barrio }}</li>
                            <li><strong>Dirección: </strong>{{ $escuela->direccion }}</li>
                            <li><strong>Administrador: </strong>{{ auth()->user()->nombres }}</li>
                            <li><strong>Max. Usuarios: </strong>{{ $escuela->max_usuarios ?? 'No definido' }}</li>
                        </ul>

                        <h3>Contacto</h3>
                        <ul class="list-unstyled">
                            <li><strong>Teléfono: </strong>{{ $escuela->contacto }}</li>
                            <li><strong>Correo Electrónico: </strong>{{ $escuela->correo }}</li>
                        </ul>
                    @else
                        <p class="text-muted">No tienes ninguna escuela registrada todavía.</p>
                    @endif
                </div>
                <div class="modal-footer">
                    @if(auth()->user()->escuelas->isNotEmpty())
                        <form action="{{ route('escuelas.destroy', $escuela->id) }}" method="POST"
                            onsubmit="return confirm('¿Seguro que deseas eliminar esta escuela?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    @endif
                    @if(isset($escuela))
                        <a href="{{ route('escuelas.edit', $escuela->id) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="buscarEntrenamientos" tabindex="-1" aria-labelledby="buscarEntrenamientosLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="buscarEntrenamientosLabel">Buscar Entrenamientos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="buscadorEntrenamiento" class="form-control mb-3"
                        placeholder="Buscar por categoría, día o entrenador...">
                    <ul id="listaEntrenamientos" class="list-group">
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="consultarTorneos" tabindex="-1" aria-labelledby="consultarTorneosLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="consultarTorneosLabel">Mis Torneos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <h3>Información General</h3>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Categoría</th>
                                    <th>Ubicación</th>
                                    <th>Estado</th>
                                    @if(Auth::user()->fk_role_id == 1)
                                        <th>Acciones</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($torneos as $torneo)
                                    @if($torneo->fk_admin_id == Auth::id())
                                        <tr>
                                            <td>{{ $torneo->nombre }}</td>
                                            <td>{{ $torneo->descripcion }}</td>
                                            <td>{{ \Carbon\Carbon::parse($torneo->fecha_inicio)->format('d/m/Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($torneo->fecha_fin)->format('d/m/Y') }}</td>
                                            <td>{{ $torneo->categoria->nombre ?? 'Sin categoría' }}</td>
                                            <td>{{ $torneo->ubicacion->localidad ?? 'Sin ubicación' }}
                                                - {{ $torneo->ubicacion->barrio ?? 'Sin ubicacion' }}
                                            </td>
                                            <td>
                                                @if($torneo->estado == 'En curso')
                                                    <span class="badge bg-success">En curso</span>
                                                @elseif($torneo->estado == 'Finalizado')
                                                    <span class="badge bg-secondary">Finalizado</span>
                                                @elseif($torneo->estado == 'Cancelado')
                                                    <span class="badge bg-danger">Cancelado</span>
                                                @endif
                                            </td>

                                            @if(Auth::user()->fk_role_id == 1)
                                                <td>
                                                    <!-- Botón Editar -->
                                                    <a href="{{ route('torneos.edit', $torneo->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <!-- Botón Eliminar -->
                                                    <form action="{{ route('torneos.destroy', $torneo->id) }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('¿Seguro que deseas eliminar este torneo?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No tienes torneos registrados.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="consultarCanchas" tabindex="-1" aria-labelledby="consultarCanchasLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="consultarCanchasLabel">Mis Canchas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <h3>Información General</h3>

                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Direccion</th>
                                    <th scope="col">Localidad</th>
                                    <th scope="col">Barrio</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Escuela</th>
                                    @if(Auth::user()->fk_role_id == 1)
                                        <th scope="col">Acciones</th>
                                    @endif
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

                                        @if(Auth::user()->fk_role_id == 1 && $cancha->fk_admin_id == Auth::id())
                                            <td>
                                                <!-- Botón Editar -->
                                                <a href="{{ route('canchas.edit', $cancha->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <!-- Botón Eliminar -->
                                                <form action="{{ route('canchas.destroy', $cancha->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('¿Seguro que deseas eliminar esta cancha?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No tienes canchas registradas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="adminTorneo" tabindex="-1" aria-labelledby="adminTorneoLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="adminTorneoLabel">Administrar Torneo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs mb-3" id="adminTabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" id="fases-tab" data-bs-toggle="tab" data-bs-target="#fases"
                                type="button">Fases</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="partidos-tab" data-bs-toggle="tab" data-bs-target="#partidos"
                                type="button">Partidos</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="escuelas-tab" data-bs-toggle="tab" data-bs-target="#escuelas"
                                type="button">Escuelas</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="adminTabsContent">
                        <div class="tab-pane fade show active" id="fases">
                            <h6>Fases del torneo</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Fase de Grupos</td>
                                            <td>10/07/2025</td>
                                            <td>20/07/2025</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary">Editar</button>

</html> <button class="btn btn-sm btn-warning">Eliminar</button>
</td>
</tr>
</tbody>
</table>
</div>
<button class="btn btn-warning btn-sm">Agregar Fase</button>
</div>

<div class="tab-pane fade" id="partidos">
    <h6>Partidos y resultados</h6>
    <div class="table-responsive">
        <table class="table table-bordered table-sm text-center">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Equipo 1</th>
                    <th>Resultado</th>
                    <th>Equipo 2</th>
                    <th>Fase</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="date" class="form-control form-control-sm" value="2025-07-10" /></td>
                    <td>San Pablo FC</td>
                    <td><input type="text" class="form-control form-control-sm text-center" value="2 - 1" /></td>
                    <td>Guerreros Dorados FC</td>
                    <td>Grupos</td>
                    <td>
                        <button class="btn btn-sm btn-primary">Guardar</button>
                        <button class="btn btn-sm btn-warning">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <button class="btn btn-warning btn-sm">Agregar Partido</button>
</div>

<div class="tab-pane fade" id="escuelas">
    <h6>Escuelas Participantes</h6>
    <ul class="list-group mb-3">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            San Pablo FC
            <button class="btn btn-sm btn-warning">Eliminar</button>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Guerreros Dorados FC
            <button class="btn btn-sm btn-warning">Eliminar</button>
        </li>
    </ul>
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Nombre de la escuela" />
        <button class="btn btn-warning">Agregar Escuela</button>
    </div>
</div>
</div>
</div>
<div class="modal-footer">
    <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
</div>
</div>
</div>
</div>


<footer class="bg-warning py-3 mt-3 shadow mt-auto">
    <div class="container text-start d-flex align-items-center footer-content shadow"> <img src="../Images/Logo.png"
            alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px;">
        <p class="text-dark m-0">© Football Association System. Todos los derechos reservados</p>
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>
<script src="validaciones.js"></script>
</body>