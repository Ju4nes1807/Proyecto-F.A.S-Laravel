<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon" />
    <meta name="theme-color" content="#1d91f0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous" />
    <title>Football Association System</title>
    <style>
        /* CSS personalizado para asegurar que las imágenes ocupen el 100% de la altura de su contenedor */
        .image-container {
            height: 100%;
            /* Asegura que el contenedor tenga una altura definida si es necesario */
            overflow: hidden;
            /* Oculta cualquier parte de la imagen que se salga del contenedor */
        }

        .image-container img {
            width: 100%;
            /* La imagen ocupa el 100% del ancho del contenedor */
            height: 100%;
            /* La imagen ocupa el 100% de la altura del contenedor */
            object-fit: cover;
            /* Recorta la imagen para que cubra todo el espacio sin distorsionarse */
        }

        /* ESTILO ADICIONAL: Clase para el contenedor principal de la página, para que crezca y empuje el footer */
        .content-wrapper {
            flex-grow: 1;
            /* Permite que este div ocupe todo el espacio vertical disponible */
        }

        /* Estilo para el footer, similar a los otros archivos para asegurar el apilamiento */
        .footer-content {
            flex-direction: column;
            /* Apila los elementos verticalmente por defecto */
        }

        @media (min-width: 576px) {

            /* En pantallas pequeñas y superiores, conviértelo en una fila */
            .footer-content {
                flex-direction: row;
            }
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="navbar navbar-expand-md bg-primary shadow"> <a href="landinpage.html" class="d-flex align-items-center">
            <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="img-fluid me-2"
                style="width: 75px; height: 75px" />
            <p class="navbar-brand text-light fs-2 shadow m-0">F.A.S</p>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navNavbarDropdown"
            aria-controls="navNavbarDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navNavbarDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="{{ route('inicioSesion') }}" class="nav-link text-light shadow">Iniciar Sesion</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('registro') }}" class="nav-link text-light shadow">Registrarse</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="content-wrapper">
        <header class="header pt-7">
            <div class="container-xl">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h1 class="display-4 fw-bold">Football Association System</h1>
                        <p class="lead text-muted">
                            Un sistema para gestionar asociaciones de futbol, jugadores,
                            partidos y mucho más.
                        </p>
                    </div>
                </div>
            </div>
        </header>

        <div class="container shadow mt-5 mb-5 text-center">
            <h2>DESCUBRE EL MEJOR CAMINO DEL FUTBOL EN TUS PRIMEROS PASOS!</h2>
        </div>

        <div class="container mb-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-4 mb-4">
                    <div class="card text-center h-100 shadow-sm bg-warning">
                        <div class="card-body shadow">
                            <h5 class="card-title text-dark">ENTRENAMIENTOS</h5>
                            <p class="card-text">
                                Descubre los entrenamientos que se realizan.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-4">
                    <div class="card text-center h-100 shadow-sm" style="background-color: #478eff">
                        <div class="card-body shadow">
                            <h5 class="card-title text-light">TORNEOS</h5>
                            <p class="card-text text-light">
                                Descubre los emocionantes torneos y demuestra tu talento en la
                                cancha.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-4">
                    <div class="card text-center h-100 shadow-sm bg-warning">
                        <div class="card-body shadow">
                            <h5 class="card-title text-dark">ESCUELAS</h5>
                            <p class="card-text">
                                Descubre las diferentes escuelas que se encunetran presentes.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="vistas bg-light py-5">
            <div class="container-fluid">
                <div class="row g-0">
                    <div class="col-12 col-md-4">
                        <div class="image-container">
                            <img src="Images/Imagen vista 1.jpg" alt="Vista 1" class="img-fluid rounded-0" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="image-container">
                            <img src="Images/imagen vista 2.jpg" alt="Vista 2" class="img-fluid rounded-0" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="image-container">
                            <img src="Images/imagen vista 3.jpg" alt="Vista 3" class="img-fluid rounded-0" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <footer class="bg-warning py-3 shadow mt-auto">
        <div class="container text-start d-flex align-items-center footer-content shadow"> <img src="Images/Logo.png"
                alt="Logo" class="img-fluid me-2" style="width: 75px; height: 75px" />
            <p class="text-dark m-0">
                © Football Association System. Todos los derechos reservados
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</html>