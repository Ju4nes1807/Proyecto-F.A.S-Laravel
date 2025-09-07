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
                <h5 class="mb-3 text-primary">Categorías</h5>
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
                    <a href="Torneos.html" class="list-group-item list-group-item-action">
                        Torneos
                    </a>
                    <a href="Canchas.html" class="list-group-item list-group-item-action">Canchas</a>
                    <a href="Usuarios.html" class="list-group-item list-group-item-action">Usuarios</a>
                    <a href="Solicitudes.html" class="list-group-item list-group-item-action">
                        Solicitudes
                    </a>
                    <a href="Estadisticas.html" class="list-group-item list-group-item-action">Estadisiticas</a>
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
                                    data-bs-target="#buscarTorneos">Consultar Torneo</button>
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
                            <button type="submit" class="btn btn-danger">Eliminar escuela</button>
                        </form>
                    @endif
                    @if(isset($escuela))
                        <a href="{{ route('escuelas.edit', $escuela->id) }}" class="btn btn-primary">Editar</a>
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

    <div class="modal fade" id="buscarTorneos" tabindex="-1" aria-labelledby="buscarTorneosLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="buscarTorneosLabel">Buscar Torneos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="buscadorTorneo" class="form-control mb-3"
                        placeholder="Buscar por categoría, día o escuela...">
                    <ul id="listaTorneos" class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Football Stellar
                            <button class="btn btn-sm btn-outline-primary abrir-admin"
                                data-torneo="Football Stellar">Administrar</button>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Copa Estelar
                            <button class="btn btn-sm btn-outline-primary abrir-admin"
                                data-torneo="Copa Estelar">Administrar</button>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="consultarCanchas" tabindex="-1" aria-labelledby="consultarCachasLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="consultarCanchasLabel">Canchas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <h3>Informacion General</h3>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Direccion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Cancha 1</td>
                                    <td>Futbol 11</td>
                                    <td>Disponible</td>
                                    <td>Cancha de futbol 11 con grama natural</td>
                                    <td>Calle 123 #45-67</td>
                                </tr>
                                <tr>
                                    <td>Cancha 2</td>
                                    <td>Futbol 5</td>
                                    <td>No Disponible</td>
                                    <td>Cancha de futbol 5 con grama sintética</td>
                                    <td>Avenida 89 #12-34</td>
                                </tr>
                                <tr>
                                    <td>Cancha 3</td>
                                    <td>Futbol Sala</td>
                                    <td>Disponible</td>
                                    <td>Cancha de futbol sala techada</td>
                                    <td>Carrera 56 #78-90</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Eliminar cancha</button>
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
                                                <button class="btn btn-sm btn-warning">Eliminar</button>
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
                                            <td><input type="date" class="form-control form-control-sm"
                                                    value="2025-07-10" /></td>
                                            <td>San Pablo FC</td>
                                            <td><input type="text" class="form-control form-control-sm text-center"
                                                    value="2 - 1" /></td>
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


    <footer class="bg-warning py-3 shadow mt-auto">
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

</html>