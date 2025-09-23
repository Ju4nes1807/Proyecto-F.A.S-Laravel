<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>F.A.S - Editar Entrenamiento</title>
  <link rel="shortcut icon" href="{{ asset('images/Logo.png') }}" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/estilo.css') }}" />
</head>

<body class="d-flex flex-column min-vh-100">
  <!-- NAVBAR -->
  <div class="navbar navbar-expand-md bg-primary shadow mb-4">
    <a href="#" class="d-flex align-items-center">
      <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px;">
      <p class="navbar-brand text-dark fs-2 shadow m-0">F.A.S</p>
    </a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link text-dark shadow">Cerrar sesión</button>
          </form>
        </li>
      </ul>
    </div>
  </div>

  <!-- CONTENIDO -->
  <div class="container-fluid flex-grow-1">
    <div class="row">
      <!-- SIDEBAR ADMIN -->
      <aside class="col-md-3 col-lg-2 sidebar p-3">
        <h5 class="text-warning mb-3">Menú Administrador</h5>
        <div class="list-group">
          <a href="{{ route('admin.dash_admin') }}" class="list-group-item list-group-item-action">Inicio</a>
          <a href="{{ route('escuelas.index') }}" class="list-group-item list-group-item-action">Escuelas</a>
          <a href="{{ route('admin.entrenamientos.index') }}" class="list-group-item list-group-item-action active">Entrenamientos</a>
          <a href="{{ route('torneos.index') }}" class="list-group-item list-group-item-action">Torneos</a>
          <a href="{{ route('categorias.index') }}" class="list-group-item list-group-item-action">Categorías</a>
          <a href="{{ route('canchas.index') }}" class="list-group-item list-group-item-action">Canchas</a>
          <a href="{{ route('usuarios.index') }}" class="list-group-item list-group-item-action">Usuarios</a>
        </div>
      </aside>

      <!-- FORMULARIO EDIT -->
      <main class="col-md-9 col-lg-10 p-4">
        <h2 class="mb-3">✏️ Editar Entrenamiento</h2>

        <div class="card shadow-sm border-warning">
          <div class="card-body">
            <form method="POST" action="{{ route('admin.entrenamientos.update', $entrenamiento) }}">
              @csrf
              @method('PUT')

              <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" value="{{ $entrenamiento->titulo }}" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3">{{ $entrenamiento->descripcion }}</textarea>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Fecha</label>
                  <input type="date" name="fecha" class="form-control" value="{{ $entrenamiento->fecha }}" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Hora</label>
                  <input type="time" name="hora" class="form-control" value="{{ $entrenamiento->hora }}" required>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Cancha</label>
                <input type="text" name="cancha" class="form-control" value="{{ $entrenamiento->cancha }}">
              </div>

    

              <button type="submit" class="btn btn-warning">💾 Actualizar</button>
              <a href="{{ route('admin.entrenamientos.index') }}" class="btn btn-secondary">⬅ Volver</a>
            </form>
          </div>
        </div>
      </main>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="bg-warning py-3 shadow mt-auto">
    <div class="container text-start d-flex align-items-center footer-content shadow">
      <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px;">
      <p class="text-light m-0">© Football Association System. Todos los derechos reservados</p>
    </div>
  </footer>
</body>
</html>
