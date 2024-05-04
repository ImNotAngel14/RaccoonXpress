<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" type="text/css" href="css/landing_page.css">
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body style="background-color: rgb(194, 235, 233);">
    <div class="row align-items-center general_navbar py-1">
        <div class="col-0 col-md-2  d-none d-md-block d-lg-block d-xl-block">
            <a class="navbar-brand d-flex justify-content-center" href="#">
                <img src="images/Imagotipo.png" alt="" height="30 rem">
            </a>
        </div>
        <div class="col-md-8 col-8">
            <form class="" method="get" action="resultado.php">
                <div class="input-group">
                    <input class="form-control" type="search" placeholder="Buscar..." aria-label="Search" id="id_search" name="search">
                    <div class="input-group-append">
                        <button id="id_navbar_search" class="btn" type="submit" style="background-color: white; border-left: white; border-color: #ced4da;">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <nav class="navbar navbar-expand-md navbar-light ">
                <div class="container-fluid justify-content-center">
                    <div class="flex-row">
                        <button class="navbar-toggler col" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="#">Perfil</a>
                                </li>
    
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="#">Mis compras</a>
                                </li>
    
                                <li class="nav-item" id="chatbotfacil">
                                    <a class="nav-link" aria-current="page" href="#">Mis listas</a>
                                </li>
    
                                <li class="nav-item" id="chatbotfacil">
                                    <a class="nav-link" aria-current="page" href="#">Carrito de compras</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <header>
        <h1>¡Bienvenido!</h1>
        <p>Explora nuestro contenido increíble y descubre más.</p>
    </header>
    


    <div class="container">

        <section class="cta">
            <h2><a href="register.php" class="btn-cta">Registrate ahora</a></h2>
            <p>Vive la experiencia completa</p>
        </section>

        <!-- <h1 id="watchme">Watch me move</h1> -->

        <div class="beneficio d-flex fadeIn">
            <div class="beneficio_img">
                <img src="images/Imagen2.jpg" alt="Beneficio 1">
            </div>
            <div class="beneficio_texto" style="padding-left: 1.5rem;">
                <h2>Calidad Garantizada</h2>
                <p>Nuestros productos son de la más alta calidad para satisfacer tus necesidades.</p>
            </div>
        </div>       

        <div class="frase_atractiva watchme-styling" id="watchme">
            <p>"Descubre la calidad que mereces."</p>
        </div>

        <div class="beneficio d-flex">
            <div class="beneficio_img">
                <img src="images/envio.jpg" alt="Beneficio 2">
                </div>
            <div class="beneficio_texto" style="padding-left: 1.5rem;">
                <h2>Envío Rápido</h2>
                <p>Entregamos tus productos de manera rápida y segura a tu puerta.</p>
            </div>

        </div>

        <div class="frase_atractiva" id="watchme">
            <p>"Comprar con nosotros es una experiencia única."</p>
        </div>

        <div class="beneficio d-flex">
            <div class="beneficio_img">
            <img src="images/servcliente.jpg" alt="Beneficio 3">
            </div>
            <div class="beneficio_texto" style="padding-left: 1.5rem;">
            <h2>Atención al Cliente</h2>
            <p>Nuestro equipo de soporte está disponible para ayudarte en cualquier momento.</p>
            </div>
        </div>
    </div>

    <section class="cta">
        <h2>¡Explora Nuestra Colección!</h2>
        <p>Encuentra los productos que se adaptan a tus necesidades y disfruta de la mejor calidad.</p>
        <a href="index.html" class="btn-cta">Ver Productos</a> <!-- Enlaza esta URL a tu página de productos -->
    </section>
    <br>
    <footer>
        <p>Derechos de Autor &copy; 2023. PWCI. Todos los derechos reservados.</p>
    </footer>


    <script src="https://kit.fontawesome.com/c3ad86cf20.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>