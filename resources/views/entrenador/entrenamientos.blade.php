<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Entrenamientos - F.A.S</title>
  <link rel="shortcut icon" href="imagenes/Logo.png" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="estilo.css" />
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container-fluid">
<<<<<<< HEAD
      <a href="principal.html" class="d-flex align-items-center text-white text-decoration-none">
        <img src="imagenes/Logo.png" alt="Logo" width="60" class="me-2" />
        <span class="fs-3">F.A.S - Jugador</span>
      </a>
      <div class="ms-auto d-flex align-items-center">
        <a href="perfil.html" class="nav-link text-white me-3">Mi Perfil</a>
=======
      <a href="{{ route('entrenador.principalEntrenador') }}" class="d-flex align-items-center text-white text-decoration-none">
        <img src="imagenes/Logo.png" alt="Logo" width="60" class="me-2" />
        <span class="fs-3">F.A.S - Entrenador</span>
      </a>
      <div class="ms-auto d-flex align-items-center">
        <a href="perfil.html" class="nav-link text-white me-3">Modificar Perfil</a>
>>>>>>> c5d8cbf (Entrenamientos)
        <a href="login.html" class="btn btn-outline-light btn-sm" id="logoutBtn">Cerrar Sesión</a>

<script>
  document.getElementById("logoutBtn").addEventListener("click", () => {
    localStorage.clear();
    window.location.href = "login.html";
  });
</script>
      </div>
    </div>
  </nav>

  <div class="container-fluid flex-grow-1">
    <div class="row">
      <!-- SIDEBAR -->
      <aside class="col-md-3 col-lg-2 sidebar bg-light p-3 shadow-sm">
        <h5 class="text-primary mb-3">Menú Jugador</h5>
        <div class="list-group">
<<<<<<< HEAD
          <a href="principal.html" class="list-group-item list-group-item-action">Inicio</a>
          <a href="entrenamientos.html" class="list-group-item list-group-item-action active">Entrenamientos</a>
=======
          <a href="{{ route('entrenador.principalEntrenador') }}" class="list-group-item list-group-item-action">Inicio</a>
          <a href="{{ route('entrenador.entrenamientos.create') }}">Entrenamiento</a>
>>>>>>> c5d8cbf (Entrenamientos)
          <a href="torneos.html" class="list-group-item list-group-item-action">Torneos</a>
          <a href="escuela.html" class="list-group-item list-group-item-action">Escuela</a>
        </div>
      </aside>

      <!-- CONTENIDO -->
      <main class="col-md-9 col-lg-10 p-4">
        <h2 class="mb-3">Entrenamientos</h2>
        <p class="text-muted">Registra y consulta tus entrenamientos.</p>

        <!-- Formulario registro entrenamiento -->
        <div class="card mb-4 shadow-sm">
          <div class="card-header bg-warning fw-bold">Registrar entrenamiento</div>
          <div class="card-body">
            <form>
              <div class="mb-3">
                <label class="form-label">Fecha</label>
                <input type="date" class="form-control" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Descripción</label>
                <input type="text" class="form-control" placeholder="Ej: Técnica de pases">
              </div>
              <div class="mb-3">
                <label class="form-label">Duración (minutos)</label>
                <input type="number" class="form-control" min="10">
              </div>
              <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
          </div>
        </div>

        <!-- Tabla entrenamientos -->
        <div class="card shadow-sm">
          <div class="card-header bg-warning fw-bold">Entrenamientos Registrados</div>
          <div class="card-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Descripción</th>
                  <th>Duración</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>30/08/2025</td>
                  <td>Ejercicios de resistencia</td>
                  <td>60 min</td>
                </tr>
                <tr>
                  <td>29/08/2025</td>
                  <td>Práctica de tiros libres</td>
                  <td>45 min</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </main>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="bg-warning py-3 mt-auto">
    <div class="container text-center">
      <img src="imagenes/Logo.png" alt="Logo" class="me-2" width="60" />
      <span class="text-dark">© Football Association System. Todos los derechos reservados.</span>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
