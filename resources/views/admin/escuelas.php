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
    <div class="navbar navbar-expand bg-primary shadow mb-4">
        <a href="landinpage.html">
            <img src="../Images/Logo.png" alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px" />
        </a>
        <p class="navbar-brand text-light fs-2 shadow">F.A.S</p>
        <div class="collapse navbar-collapse" id="navNavbarDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="../landinpage.php" class="nav-link text-light shadow">Cerrar Sesion</a>
                </li>
                <li class="nav-item">
                    <a href="ModificarPerfil.html" class="nav-link text-light shadow">Modificar Perfil</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container-fluid flex-grow-1">
        <div class="row">
            <div class="col-12 col-md-3 col-lg-2 sidebar mb-3">
                <h5 class="mb-3 text-primary">Categorías</h5>
                <div class="list-group">
                    <a href="dash_admin.php" class="list-group-item list-group-item-action">Inicio</a>
                    <a href="Escuelas.html" class="list-group-item list-group-item-action active">Escuelas</a>
                    <a href="Entrenamientos.html" class="list-group-item list-group-item-action">Entrenamientos</a>
                    <a href="Torneos.html" class="list-group-item list-group-item-action">Torneos</a>
                    <a href="Canchas.html" class="list-group-item list-group-item-action">Canchas</a>
                    <a href="Usuarios.html" class="list-group-item list-group-item-action">Usuarios</a>
                    <a href="Solicitudes.html" class="list-group-item list-group-item-action">Solicitudes</a>
                    <a href="Estadisticas.html" class="list-group-item list-group-item-action">Estadisiticas</a>
                </div>
            </div>

            <div class="col-12 col-md-9 col-lg-10 p-4">
                <div
                    class="d-flex flex-column flex-md-row align-items-md-center justify-content-between text-center mb-3">
                    <h2>Juan</h2>
                    <form class="d-flex flex-column flex-sm-row ms-md-3 mt-3 mt-md-0" role="search">
                        <div class="input-group me-sm-2 mb-2 mb-sm-0" style="width: auto;">
                            <button class="input-group-text"><i class="fas fa-search"></i></button>
                            <input class="form-control" type="search" placeholder="Buscar escuela..."
                                aria-label="Search" />
                        </div>
                        <a href="Inscripcion_Escuela.html"
                            class="btn btn-warning flex-shrink-0 d-flex align-items-center justify-content-center">
                            Registar Escuela
                        </a>
                    </form>
                </div>
                <h6>Administrador</h6>
                <h3 class="mt-3">Escuelas</h3>

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card border-warning">
                            <div class="card-body text-start">
                                <h5 class="card-title mb-3">Guerreros Dorados FC</h5>
                                <p><strong>Telefono:</strong> 3123354854</p>
                                <p><strong>Localidad: </strong>San Cristobal Sur</p>
                                <p><strong>Barrio: </strong>Quiroga</p>
                                <p><strong>Dirección: </strong>Cra. 9 #19 -39 sur</p>
                                <button type="button"
                                    class="btn btn-warning px-3 px-5 shadow-sm align-center mx-auto d-block"
                                    data-bs-toggle="modal" data-bs-target="#consultarEscuela">
                                    Ver
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card border-warning">
                            <div class="card-body text-start">
                                <h5 class="card-title mb-3">Guerreros Dorados FC</h5>
                                <p><strong>Telefono:</strong> 3123623227</p>
                                <p><strong>Localidad: </strong>Kennedy</p>
                                <p><strong>Barrio: </strong>El Recreo</p>
                                <p><strong>Dirección: </strong>Calle 22B Sur No. 10 – 38 57</p>
                                <button type="button"
                                    class="btn btn-warning px-3 px-5 shadow-sm align-center mx-auto d-block">
                                    Ver
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card border-warning">
                            <div class="card-body text-start">
                                <h5 class="card-title mb-3">Real Madelena FC</h5>
                                <p><strong>Telefono:</strong> 3192403690</p>
                                <p><strong>Localidad: </strong>Ciudad Bolivar</p>
                                <p><strong>Barrio: </strong>La Madelena</p>
                                <p><strong>Dirección: </strong>Calle 59 Sur #60-19</p>
                                <button type="button"
                                    class="btn btn-warning px-3 px-5 shadow-sm align-center mx-auto d-block">
                                    Ver
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card border-warning">
                            <div class="card-body text-start">
                                <h5 class="card-title mb-3">San Pablo FC</h5>
                                <p><strong>Telefono:</strong> 3162954037</p>
                                <p><strong>Localidad: </strong>Usaquen</p>
                                <p><strong>Barrio: </strong>San Pablo</p>
                                <p><strong>Dirección: </strong>Calle 170 No. 8G-31</p>
                                <button type="button"
                                    class="btn btn-warning px-3 px-5 shadow-sm align-center mx-auto d-block">
                                    Ver
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card border-warning">
                            <div class="card-body text-start">
                                <h5 class="card-title mb-3">Alejandro Brand FC</h5>
                                <p><strong>Telefono:</strong> 031 6151652</p>
                                <p><strong>Localidad: </strong>Usaquen</p>
                                <p><strong>Barrio: </strong>Cedritos</p>
                                <p><strong>Dirección: </strong>Calle 140 #11-58, Local 46</p>
                                <button type="button"
                                    class="btn btn-warning px-3 px-5 shadow-sm align-center mx-auto d-block">
                                    Ver
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="consultarEscuela" tabindex="-1" aria-labelledby="consultarEscuelaInfo"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="consultarEscuelaInfo">Guerreros Dorados FC</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <h3>Informacion General</h3>
                    <ul class="list-unstyled">
                        <li><strong>Localidad: </strong>San Cristobal Sur</li>
                        <li><strong>Barrio: </strong>Quiroga</li>
                        <li><strong>Direccion: </strong>Cra. 9 #19 -39 sur</li>
                        <li><strong>Administrador: </strong>Juan</li>
                        <li><strong>Max. Usuarios: </strong>30</li>
                        <p><Strong>Categorias</Strong></p>
                        <li>Junior</li>
                        <li>Semi_Junior</li>
                        <li>Media</li>
                        <li>Semi-Avanzada</li>
                        <li>Avanzada</li>
                    </ul>

                    <h3>Infraestructura</h3>
                    <ul class="list-unstyled">
                        <p><strong>Canchas</strong></p>
                        <li>Cancha 1</li>
                        <li>Cancha 2</li>
                        <li><strong>Vestuario: </strong>Si</li>
                    </ul>

                    <h3>Entrenadores</h3>
                    <ul class="list-unstyled">
                        <li>Carlos Jaramillo</li>
                        <li>Luis Reyes</li>
                    </ul>

                    <h3>Horarios</h3>
                    <ul class="list-unstyled">
                        <li>Lunes a Viernes 7:00 am a 5:00pm</li>
                        <li>Sabados, Domingos y Festivos: Practicas y entrenamientos especiales</li>
                    </ul>

                    <h3>Logros</h3>
                    <ul class="list-unstyled">
                        <li>Campeones Football Stellar</li>
                        <li>Subcampeones Copa Estelar</li>
                    </ul>

                    <h3>Contacto</h3>
                    <ul class="list-unstyled">
                        <li><strong>Telefono: </strong>3192403690</li>
                        <li><strong>Correo Electrónico: </strong>DoradosFC@Gmail.com</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-warning py-3 shadow mt-auto">
        <div class="container text-start d-flex align-items-center shadow">
            <img src="../Images/Logo.png" alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px" />
            <p class="text-dark m-0">
                © Football Association System. Todos los derechos reservados
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>