<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>F.A.S - Administrador</title>
  <link rel="shortcut icon" href="{{ asset('images/Logo.png') }}" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/estilo.css') }}" />
</head>

<body class="d-flex flex-column min-vh-100">
  <!-- NAVBAR -->
  <div class="navbar navbar-expand-md bg-primary shadow mb-4">
    <a href="#" class="d-flex align-items-center">
      <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px;">
      <p class="navbar-brand text-light fs-2 shadow m-0">F.A.S</p>
    </a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link text-light shadow">Cerrar sesión</button>
          </form>
        </li>
      </ul>
    </div>
  </div>

  <!-- CONTENIDO -->
  <div class="container-fluid flex-grow-1">
    <div class="row">
      <!-- SIDEBAR -->
      <aside class="col-md-3 col-lg-2 sidebar p-3">
        <h5 class="text-primary mb-3">Menú</h5>
        <div class="list-group">
          <a href="{{ route('admin.dash_admin') }}" class="list-group-item list-group-item-action">Inicio</a>
          <a href="{{ route('escuelas.index') }}" class="list-group-item list-group-item-action">Escuelas</a>
          <a href="{{ route('admin.entrenamientos.index') }}" class="list-group-item list-group-item-action active">Entrenamientos</a>
          <a href="#" class="list-group-item list-group-item-action">Torneos</a>
          <a href="{{ route('categorias.index') }}" class="list-group-item list-group-item-action">Categorías</a>
          <a href="{{ route('canchas.index') }}" class="list-group-item list-group-item-action">Canchas</a>
          <a href="{{ route('usuarios.index') }}" class="list-group-item list-group-item-action">Usuarios</a>
        </div>
      </aside>

      <!-- CONTENIDO PRINCIPAL -->
      <main class="col-md-9 col-lg-10 p-4">
        <h2 class="mb-3">Gestión de Entrenamientos (Administrador)</h2>

        <!-- Botón para crear nuevo entrenamiento -->
        <a href="{{ route('admin.entrenamientos.create') }}" class="btn btn-primary mb-3">➕ Nuevo Entrenamiento</a>

        <!-- Mensaje de éxito -->
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tabla de entrenamientos -->
        <div class="card shadow-sm">
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead class="table-warning">
                <tr>
                  <th>ID</th>
                  <th>Título</th>
                  <th>Descripción</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Cancha</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($entrenamientos as $entrenamiento)
                  <tr>
                    <td>{{ $entrenamiento->id }}</td>
                    <td>{{ $entrenamiento->titulo }}</td>
                    <td>{{ $entrenamiento->descripcion }}</td>
                    <td>{{ $entrenamiento->fecha }}</td>
                    <td>{{ $entrenamiento->hora }}</td>
                    <td>{{ $entrenamiento->cancha }}</td>
                    
                    <td>
                      <a href="{{ route('admin.entrenamientos.edit', $entrenamiento) }}" class="btn btn-sm btn-primary">✏️ Editar</a>
                      <form action="{{ route('admin.entrenamientos.destroy', $entrenamiento) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">🗑 Eliminar</button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="8" class="text-center">No hay entrenamientos registrados.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
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
