<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="{{ asset('Images/Logo.png') }}" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <title>Mis Torneos - Jugador</title>
</head>

<body class="d-flex flex-column min-vh-100">

  <!-- NAVBAR -->
  <div class="navbar navbar-expand-md bg-primary shadow mb-4">
    <a href="{{ route('jugador.principal') }}" class="d-flex align-items-center">
      <img src="{{ asset('Images/Logo.png') }}" alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px;">
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
          <a href="{{ route('jugador.perfil.edit') }}" class="nav-link text-light shadow">Modificar Perfil</a>
        </li>
      </ul>
    </div>
  </div>

  <!-- CONTENIDO -->
  <div class="container-fluid flex-grow-1">
    <div class="row">
      <!-- SIDEBAR -->
      <div class="col-12 col-md-3 col-lg-2 sidebar mb-3">
        <h5 class="mb-3 text-primary">Menú Jugador</h5>
        <div class="list-group">
          <a href="{{ route('jugador.principal') }}" class="list-group-item list-group-item-action">Inicio</a>
          <a href="{{ route('jugador.perfil') }}" class="list-group-item list-group-item-action">Perfil</a>
          <a href="{{ route('jugador.entrenamientos.index') }}" class="list-group-item list-group-item-action">Entrenamientos</a>
          <a href="{{ route('jugador.torneos') }}" class="list-group-item list-group-item-action active">Torneos</a>
          <a href="{{ route('escuelas.index') }}" class="list-group-item list-group-item-action">Escuela</a>
        </div>
      </div>

      <!-- PANEL PRINCIPAL -->
      <div class="col-12 col-md-9 col-lg-10 p-4">
        <h3 class="mt-3">Torneos Disponibles</h3>

        @if($torneos->isEmpty())
          <div class="alert alert-info">No hay torneos disponibles para ti en este momento.</div>
        @else
          <div class="row">
            @foreach($torneos as $torneo)
              <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-warning">
                  <div class="card-body bg-light">
                    <h5 class="card-title mb-3">{{ $torneo->nombre }}</h5>
                    <p><strong>Organizador:</strong> {{ $torneo->admin->nombres }} {{ $torneo->admin->apellidos }}</p>
                    <p><strong>Ubicación:</strong> {{ $torneo->ubicacion->localidad }} - {{ $torneo->ubicacion->barrio }}
                    </p>
                    <p><strong>Estado:</strong> {{ $torneo->estado }}</p>
                    <p><strong>Categoría:</strong> {{ $torneo->categoria->nombre ?? 'Sin asignar' }}</p>
                    <button class="btn btn-warning btn-sm d-block mx-auto" data-bs-toggle="modal"
                      data-bs-target="#modalTorneo{{ $torneo->id }}">Ver detalles</button>
                  </div>
                </div>
              </div>

              <!-- Modal de detalle del torneo -->
              <div class="modal fade" id="modalTorneo{{ $torneo->id }}" tabindex="-1"
                aria-labelledby="modalTorneo{{ $torneo->id }}Label" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header bg-warning">
                      <h5 class="modal-title">Información del Torneo</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                      <ul class="list-group mb-3">
                        <li class="list-group-item"><strong>Nombre:</strong> {{ $torneo->nombre }}</li>
                        <li class="list-group-item"><strong>Descripción:</strong>
                          {{ $torneo->descripcion ?? 'Sin descripción' }}</li>
                        <li class="list-group-item"><strong>Fecha inicio:</strong> {{ $torneo->fecha_inicio }}</li>
                        <li class="list-group-item"><strong>Fecha fin:</strong> {{ $torneo->fecha_fin }}</li>
                        <li class="list-group-item"><strong>Estado:</strong> {{ $torneo->estado }}</li>
                        <li class="list-group-item"><strong>Categoría:</strong>
                          {{ $torneo->categoria->nombre ?? 'Sin asignar' }}</li>
                        <li class="list-group-item"><strong>Ubicación:</strong> {{ $torneo->ubicacion->localidad }} -
                          {{ $torneo->ubicacion->barrio }}
                        </li>
                        <li class="list-group-item"><strong>Admin:</strong> {{ $torneo->admin->nombres }}
                          {{ $torneo->admin->apellidos }}
                        </li>
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

            @endforeach
          </div>
        @endif
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="bg-warning py-3 shadow mt-auto">
    <div class="container text-start d-flex align-items-center footer-content shadow">
      <img src="{{ asset('Images/Logo.png') }}" alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px;">
      <p class="text-dark m-0">© Football Association System. Todos los derechos reservados</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>