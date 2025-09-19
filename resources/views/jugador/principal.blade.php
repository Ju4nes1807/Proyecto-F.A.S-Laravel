<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title> F.A.S</title>
  <link rel="shortcut icon" href="{{ asset('images/Logo.png') }}" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="estilo.css" />
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
        <aside class="col-md-3 col-lg-2 sidebar p-3">
          <h5 class="text-primary mb-3">Menú Jugador</h5>
          <div class="list-group">
            <a href="{{ route('jugador.principal') }}" class="list-group-item list-group-item-action active">Inicio</a>
            <a href="{{ route('jugador.perfil') }}" class="list-group-item list-group-item-action">Perfil</a>
            <a href="{{ route('jugador.entrenamientos.index') }}" class="list-group-item list-group-item-action">Entrenamientos</a>
            <a href="torneos.html" class="list-group-item list-group-item-action">Torneos</a>
            <a href="{{ route('escuelas.index') }}" class="list-group-item list-group-item-action action">Escuela</a>
          </div>
        </aside>

        <!-- CONTENIDO PRINCIPAL -->
        <main class="col-md-9 col-lg-10 p-4">
          <h2 class="mb-1">Bienvenido, {{ auth()->user()->nombres }}</h2>
          <h6 class="text-muted">{{ auth()->user()->rol->tipo ?? 'Sin rol asignado' }}</h6>

          <div class="row g-4 mt-3">
            <!--Escuela -->
            <div class="col-md-6 col-lg-4">
              <div class="card border-warning shadow-sm">
                <div class="card-body text-center">
                  <h5 class="card-title">Mi Escuela</h5>
                  <p>Información sobre tu escuela.</p>
                  <a href="{{ route('escuelas.index') }}" class="btn btn-warning btn-sm">Ver Escuela</a>
                </div>
              </div>
            </div>

            <!--Entrenamientos -->
            <div class="col-md-6 col-lg-4">
              <div class="card border-warning shadow-sm">
                <div class="card-body text-center">
                  <h5 class="card-title">Entrenamientos</h5>
                  <p>Revisa tus entrenamientos.</p>
                  <a href="{{ route('jugador.entrenamientos.index') }}" class="btn btn-warning btn-sm">Ver Entrenamientos</a>
                </div>
              </div>
            </div>

            <!-- Torneos -->
            <div class="col-md-6 col-lg-4">
              <div class="card border-warning shadow-sm">
                <div class="card-body text-center">
                  <h5 class="card-title">Torneos</h5>
                  <p>Torneos en los que participas.</p>
                  <a href="torneos.html" class="btn btn-warning btn-sm">Ver Torneos</a>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    </div>
    </main>
    </div>
    </div>

    <!-- FOOTER -->
    <footer class="bg-warning py-3 shadow mt-auto">
      <div class="container text-start d-flex align-items-center footer-content shadow"> <img src="../Images/Logo.png"
          alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px;">
        <p class="text-dark m-0">© Football Association System. Todos los derechos reservados</p>
      </div>
    </footer>
  </body>

</html>