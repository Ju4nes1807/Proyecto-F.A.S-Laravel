<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="{{ asset('images/Logo.png') }}" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <title>Mi Escuela - F.A.S Jugador</title>
</head>

<body class="d-flex flex-column min-vh-100">

  <!-- NAVBAR -->
  <div class="navbar navbar-expand bg-primary shadow mb-4">
    <a href="{{ url('principal') }}">
      <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px" />
    </a>
    <p class="navbar-brand text-light fs-2">F.A.S</p>
    <div class="collapse navbar-collapse" id="navNavbarDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a href="{{ route('entrenador.perfil.edit') }}" class="nav-link text-light shadow">Mi Perfil</a>
        </li>
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link text-light shadow btn btn-link">Cerrar Sesión</button>
          </form>
        </li>
      </ul>
    </div>
  </div>

  <!-- CONTENIDO PRINCIPAL -->
  <div class="container-fluid flex-grow-1">
    <div class="row">
      <!-- SIDEBAR -->
      <div class="col-md-3 col-lg-2 sidebar mb-3">
        <h5 class="mb-3 text-primary">Menú Entrenador</h5>
        <div class="list-group">
          <a href="{{ route('entrenador.principalEntrenador') }}"class="list-group-item list-group-item-action">Inicio</a>
          <a href="{{ route('entrenador.entrenamientos.index') }}" class="list-group-item list-group-item-action">Entrenamientos</a>
          <a href="{{ url('torneos') }}" class="list-group-item list-group-item-action">Torneos</a>
          <a href="{{ route('escuelas.index') }}" class="list-group-item list-group-item-action active">Escuela</a>
        </div>
      </div>

      <!-- INFORMACIÓN DE LA ESCUELA -->
      <div class="col-md-9 col-lg-10 p-4">
        <h2 class="mb-3">Mi Escuela</h2>

        @if($escuela)
          <div class="card border-warning shadow-sm">
            <div class="card-body bg-light">
              <h4 class="card-title text-primary mb-3">{{ $escuela->nombre }}</h4>
              <p><strong>Teléfono:</strong> {{ $escuela->contacto }}</p>
              <p><strong>Correo:</strong> {{ $escuela->correo }}</p>
              <p><strong>Dirección:</strong> {{ $escuela->direccion }}</p>
              <p><strong>Localidad:</strong> {{ $escuela->ubicacion->localidad ?? 'No definida' }}</p>
              <p><strong>Barrio:</strong> {{ $escuela->ubicacion->barrio ?? 'No definida' }}</p>
            </div>
          </div>
        @else
          <div class="alert alert-warning">
            No estás asignado a ninguna escuela actualmente.
          </div>
        @endif
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="bg-warning py-3 shadow mt-auto">
    <div class="container text-start d-flex align-items-center shadow">
      <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px" />
      <p class="text-dark m-0">© Football Association System. Todos los derechos reservados</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>