<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="{{ asset('images/Logo.png') }}" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <title>Mi Perfil - F.A.S Jugador</title>
</head>

<body class="d-flex flex-column min-vh-100">

  <!-- NAVBAR -->

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
            <a href="{{ route('jugador.perfil.edit') }}" class="nav-link text-light shadow">Modificar Perfil</a>
          </li>
        </ul>
      </div>
    </div>

    <!-- CONTENIDO -->
    <div class="container-fluid flex-grow-1">
      <div class="row">
        <!-- SIDEBAR -->
        <div class="col-md-3 col-lg-2 sidebar">
          <h5 class="mb-3 text-primary">Menú Jugador</h5>
          <div class="list-group">
            <a href="{{ route('jugador.principal') }}" class="list-group-item list-group-item-action">Inicio</a>
            <a href="{{ route('jugador.perfil') }}" class="list-group-item list-group-item-action active">Perfil</a>
            <a href="{{ route('jugador.entrenamientos.index') }}" class="list-group-item list-group-item-action">Entrenamientos</a>
            <a href="torneos.html" class="list-group-item list-group-item-action">Torneos</a>
            <a href="{{ route('escuelas.index') }}" class="list-group-item list-group-item-action">Escuela</a>
          </div>
        </div>

        <!-- PERFIL -->
        <div class="col-md-9 col-lg-10 p-4">
          <h2 class="mb-4">Mi Perfil</h2>
          <div class="col-md-8">
            <p><strong>Nombres:</strong> {{ $user->nombres }}</p>
            <p><strong>Apellidos:</strong> {{ $user->apellidos }}</p>
            <p><strong>Documento:</strong> {{ $user->documento }}</p>
            <p><strong>Correo electrónico:</strong> {{ $user->email }}</p>
            <p><strong>Teléfono:</strong> {{ $user->telefono }}</p>
            <p><strong>Fecha de nacimiento:</strong> {{ $user->fecha_nacimiento }}</p>
            <p><strong>Categoría:</strong>
              @if($user->fk_role_id == 3)
                          {{ $user->asignaciones->first() && $user->asignaciones->first()->categoria
                ? $user->asignaciones->first()->categoria->nombre
                : 'Sin asignar' }}
              @else
                No aplica
              @endif
            </p>
          </div>
        </div>
      </div>
    </div>

    </div>
    </div>
    </div>

    <!-- FOOTER -->
    <footer class="bg-warning py-3 shadow mt-auto">
      <div class="container text-start d-flex align-items-center footer-content shadow"> <img src="../Images/Logo.png"
          alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px;">
        <p class="text-dark m-0">© Football Association System. Todos los derechos reservados</p>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  </body>
  <script>
    function cerrarSesion() {
      localStorage.removeItem("logueado");
      window.location.href = "login.html";
    }
  </script>

</html>