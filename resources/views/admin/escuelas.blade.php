{{-- resources/views/escuelas/index.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../Images/Logo.png" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <title>Escuelas</title>
</head>

<body class="d-flex flex-column min-vh-100">

  {{-- ---------- Parche: evita "Undefined variable $entrenamientos" ---------- --}}
  @php
    $entrenamientos = $entrenamientos ?? collect();
  @endphp
  {{-- ----------------------------------------------------------------------- --}}

  <!-- Navbar -->
  <div class="navbar navbar-expand bg-primary shadow mb-4">
    <a href="{{ route('landinpage') }}">
      <img src="../Images/Logo.png" alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px" />
    </a>
    <p class="navbar-brand text-light fs-2 shadow">F.A.S</p>
    <div class="collapse navbar-collapse" id="navNavbarDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link text-light shadow">Cerrar sesión</button>
          </form>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.perfil.update') }}" class="nav-link text-light shadow">Modificar Perfil</a>
        </li>
      </ul>
    </div>
  </div>

  <!-- Contenedor principal -->
  <div class="container-fluid flex-grow-1">
    <div class="row">
      
      <!-- Sidebar -->
      <div class="col-12 col-md-3 col-lg-2 sidebar mb-3">
        <h5 class="mb-3 text-primary">Menú Administrador</h5>
        <div class="list-group">
          <a href="{{ route('admin.dash_admin') }}" class="list-group-item list-group-item-action">Inicio</a>
          <a href="{{ route('escuelas.index') }}" class="list-group-item list-group-item-action active">Escuelas</a>
          <a href="{{ route('admin.entrenamientos.index') }}" class="list-group-item list-group-item-action">Entrenamientos</a>
          <a href="{{ route('torneos.index') }}" class="list-group-item list-group-item-action">Torneos</a>
          <a href="{{ route('categorias.index') }}" class="list-group-item list-group-item-action">Categorias</a>
          <a href="{{ route('canchas.index') }}" class="list-group-item list-group-item-action">Canchas</a>
          <a href="{{ route('usuarios.index') }}" class="list-group-item list-group-item-action">Usuarios</a>
        </div>
      </div>

      <!-- Contenido principal -->
      <div class="col-12 col-md-9 col-lg-10 p-4">
        
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-md-end mb-3">
          <form class="d-flex flex-column flex-sm-row me-md-3 mt-3 mt-md-0"
                action="{{ route('escuelas.index') }}" method="GET" role="search">
            <div class="input-group me-sm-2 mb-2 mb-sm-0" style="width: auto;">
              <button class="input-group-text" type="submit"><i class="fas fa-search"></i></button>
              <input class="form-control" type="search" name="q" placeholder="Buscar escuela..."
                     aria-label="Search" value="{{ request('q') }}" />
            </div>

            @if(request()->filled('q'))
              <a href="{{ route('escuelas.index') }}" class="btn btn-primary ms-2">Limpiar</a>
            @endif
            <a href="{{ route('escuelas.create') }}"
               class="btn btn-warning flex-shrink-0 d-flex align-items-left justify-content-center ms-2">
              Registrar Escuela
            </a>
          </form>
        </div>

        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif

        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
          </div>
        @endif

        <h3 class="mt-3">Escuelas</h3>

        <div class="row">
          @foreach($escuelas as $escuela)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
              <div class="card border-warning h-100 shadow-sm">
                <div class="card-body text-start">
                  <h5 class="card-title mb-3">{{ $escuela->nombre }}</h5>
                  <p><strong>Teléfono:</strong> {{ $escuela->contacto }}</p>
                  <p><strong>Localidad:</strong> {{ $escuela->ubicacion->localidad }}</p>
                  <p><strong>Barrio:</strong> {{ $escuela->ubicacion->barrio }}</p>
                  <p><strong>Dirección:</strong> {{ $escuela->direccion }}</p>
                </div>
              </div>
            </div>
          @endforeach
        </div>

      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-warning py-3 shadow mt-auto">
    <div class="container text-start d-flex align-items-center shadow">
      <img src="../Images/Logo.png" alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px" />
      <p class="text-dark m-0">© Football Association System. Todos los derechos reservados</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
