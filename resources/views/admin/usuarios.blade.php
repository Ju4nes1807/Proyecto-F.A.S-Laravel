<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="../Images/Logo.png" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <title>Usuarios</title>
</head>

<body class="d-flex flex-column min-vh-100">
  <div class="navbar navbar-expand bg-primary lg-4 shadow mb-4">
    <a href="landinpage.html">
      <img src="../Images/Logo.png" alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px;" />
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

  <main class="container-fluid flex-grow-1">
    <div class="row">
      <div class="col-md-3 col-lg-2 sidebar mb-3">
        <h5 class="mb-3 text-primary">Usuarios</h5>
        <div class="list-group">
          <a href="{{ route('admin.dash_admin') }}" class="list-group-item list-group-item-action">Inicio</a>
          <a href="{{ route('escuelas.index') }}" class="list-group-item list-group-item-action">Escuelas</a>
          <a href="Entrenamientos.html" class="list-group-item list-group-item-action">Entrenamientos</a>
          <a href="Torneos.html" class="list-group-item list-group-item-action">Torneos</a>
          <a href="{{ route('categorias.index') }}" class="list-group-item list-group-item-action">
            Categorias
          </a>
          <a href="{{ route('canchas.index') }}" class="list-group-item list-group-item-action">Canchas</a>
          <a href="{{ route('usuarios.index') }}" class="list-group-item list-group-item-action active">Usuarios</a>
          <a href="Solicitudes.html" class="list-group-item list-group-item-action">Solicitudes</a>
          <a href="Estadisticas.html" class="list-group-item list-group-item-action">Estadisiticas</a>
        </div>
      </div>

      <div class="col-md-9 col-lg-10 p-4">
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-md-end mb-3">
          <form class="d-flex flex-column flex-sm-row me-md-3 mt-3 mt-md-0" action="{{ route('usuarios.index') }}"
            method="GET" role="search">
            <div class="input-group me-sm-2 mb-2 mb-sm-0" style="width: auto;">
              <button class="input-group-text" type="submit"><i class="fas fa-search"></i></button>
              <input class="form-control" type="search" name="q" placeholder="Buscar usuario..." aria-label="Search"
                value="{{ request('q') }}" />
            </div>
            @if(request()->filled('q'))
              <a href="{{ route('usuarios.index') }}" class="btn btn-primary ms-2">Limpiar</a>
            @endif
          </form>
        </div>

        <h3 class="mt-3">Usuarios</h3>

        {{-- Mensajes de error / éxito --}}
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

        <ul class="nav nav-tabs" id="userTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="jugadores-tab" data-bs-toggle="tab" data-bs-target="#jugadores"
              type="button" role="tab">Jugadores</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="entrenadores-tab" data-bs-toggle="tab" data-bs-target="#entrenadores"
              type="button" role="tab">Entrenadores</button>
          </li>
        </ul>

        <div class="tab-content mt-3" id="userTabsContent">
          @foreach(['3' => 'jugadores', '2' => 'entrenadores'] as $role_id => $tab)
            <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ $tab }}" role="tabpanel">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Rol</th>
                      <th>Escuela</th>
                      <th>Asignar / Quitar Escuela y Categoría</th>
                      <th>Mostrar Usuario</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($usuarios->where('fk_role_id', $role_id) as $user)
                      @php
                        $asignacion = $user->asignaciones->first() ?? null;
                        $modalId = $tab . '-' . $user->id;
                      @endphp

                      <tr>
                        <td>{{ $user->nombres }} {{ $user->apellidos }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->rol->tipo }}</td>
                        <td>{{ $asignacion ? $user->escuela->nombre : 'Sin asignar' }}</td>

                        <td>
                          <div class="d-flex flex-column gap-2 mb-2">

                            {{-- Botón para asignar escuela (si no tiene) --}}
                            <div class="d-flex flex-column gap-2 mb-2">

                              {{-- Botón para asignar escuela (si no tiene) --}}
                              @if(!$asignacion)
                                @if($admin->escuelas->isNotEmpty())
                                  <form action="{{ route('escuelas.asignarUsuario', $admin->escuelas->first()->id) }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" name="usuario_id" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-primary btn-sm">Asignar Escuela</button>
                                  </form>
                                @else
                                  <div class="card bg-light border-warning">
                                    <div class="card-body p-2 d-flex align-items-center">
                                      <i class="fas fa-exclamation-circle text-warning me-2"></i>
                                      <small class="text-secondary">Debes tener una escuela para asignar.</small>
                                    </div>
                                  </div>
                                @endif
                              @endif

                            </div>

                            {{-- Botón para quitar escuela (si ya tiene y fue asignado por este admin) --}}
                            @if($asignacion && $asignacion->assigned_by == auth()->id())
                              <form action="{{ route('usuarios.eliminarAsignacion', $asignacion->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning btn-sm"
                                  onclick="return confirm('¿Seguro que quieres quitar la asignación de este usuario?')">
                                  Quitar Escuela
                                </button>
                              </form>
                            @endif

                            {{-- Select para asignar categoría (SOLO jugadores con escuela asignada por este admin) --}}
                            {{-- Asignar o quitar categoría (SOLO jugadores con escuela asignada por este admin) --}}
                            @if($user->fk_role_id == 3 && $asignacion && $asignacion->assigned_by == auth()->id())

                              {{-- Si NO tiene categoría, mostrar el select para asignar --}}
                              @if(!$asignacion->categoria_id)
                                <form action="{{ route('categorias.asignarUsuario', $user->id) }}" method="POST"
                                  class="d-flex gap-2">
                                  @csrf
                                  <select name="categoria_id" class="form-select form-select-sm">
                                    <option value="">Selecciona categoría</option>
                                    @foreach($categorias as $categoria)
                                      <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                  </select>
                                  <button type="submit" class="btn btn-primary btn-sm">Asignar
                                    Categoría</button>
                                </form>
                              @endif

                              {{-- Si YA tiene categoría, mostrar el botón para quitar --}}
                              @if($asignacion->categoria_id)
                                <form action="{{ route('usuarios.eliminarCategoria', $asignacion->id) }}" method="POST"
                                  onsubmit="return confirm('¿Seguro que quieres quitar la categoría de este jugador?');">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-warning btn-sm">Quitar
                                    Categoría</button>
                                </form>
                              @endif

                            @endif
                          </div>
                        </td>


                        <td>
                          <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#{{ $modalId }}">Ver</button>
                        </td>
                      </tr>

                      <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header bg-warning">
                              <h5 class="modal-title">Información del Usuario</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                              <ul class="list-group mb-3">
                                <li class="list-group-item"><strong>Nombres:</strong> {{ $user->nombres }}</li>
                                <li class="list-group-item"><strong>Apellidos:</strong> {{ $user->apellidos }}</li>
                                <li class="list-group-item"><strong>Documento:</strong> {{ $user->documento }}</li>
                                <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                                <li class="list-group-item"><strong>Teléfono:</strong> {{ $user->telefono }}</li>
                                <li class="list-group-item"><strong>Edad:</strong>
                                  {{ \Carbon\Carbon::parse($user->fecha_nacimiento)->age }}</li>
                                <li class="list-group-item"><strong>Escuela:</strong>
                                  {{ $asignacion ? $user->escuela->nombre : 'Sin asignar' }}</li>
                                <li class="list-group-item"><strong>Categoría:</strong>
                                  @if($user->fk_role_id == 3)
                                    {{ $asignacion && $asignacion->categoria ? $asignacion->categoria->nombre : 'Sin asignar' }}
                                  @else
                                    No aplica
                                  @endif
                                </li>
                              </ul>
                            </div>
                            <div class="modal-footer">
                              @if($asignacion && $asignacion->assigned_by == auth()->id())
                                <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST"
                                  onsubmit="return confirm('¿Seguro que deseas eliminar este usuario del sistema?');">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>

                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </main>

  <footer class="bg-warning py-3 shadow mt-auto">
    <div class="container text-start d-flex align-items-center shadow">
      <img src="../Images/Logo.png" alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px;" />
      <p class="text-dark m-0">© Football Association System. Todos los derechos reservados</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
</body>

</html>