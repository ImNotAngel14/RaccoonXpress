<!--?php
    include "conexion.php";
    session_start(); // Inicia la sesión si no está iniciada
    $main_color = "#729740";
    #           = "#8eb35a";
    if(isset($_GET["search"]))
    {
        $busqueda = $_GET["search"];
        $sql = "SELECT id, nombre, imagen, precio, rate FROM producto WHERE nombre LIKE '%$busqueda%';";
        $result = $conexion->query($sql);
    }
    else
    {
        $busqueda = "";
        $sql = "SELECT id, nombre, imagen, precio, rate FROM producto WHERE nombre LIKE '%$busqueda%';";
        $result = $conexion->query($sql); 
    }
    // Realizar la consulta a la base de datos
    

    if (isset($_SESSION['id_user'])) {
        $id_user = $_SESSION['id_user'];

        // Obtener el nombre del usuario desde la base de datos (asumiendo que tienes una tabla de usuarios relacionada con productos)
        $query = "SELECT firstname FROM users WHERE id_user = '$id_user'";
        $user_result = $conexion->query($query);

        if ($user_result) {
            $user_data = $user_result->fetch_assoc();
            $nombre_usuario = $user_data['firstname'];
        } else {
            // Manejo de errores, puedes personalizar según tus necesidades
            echo "Error en la consulta de usuario: " . $conexion->error;
        }
    }
    

    // Cerrar la conexión
    $conexion->close();
?-->
<?php
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link rel="icon" href="images/Isotipo.png">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="css/general.css">
        <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    </head>
    <body style="display: flex; flex-direction: column; min-height: 100vh; margin: 0;">
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
                                        <a class="nav-link" aria-current="page" href="profile_client.html">Perfil</a>
                                    </li>
        
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="compras.html">Mis compras</a>
                                    </li>
        
                                    <li class="nav-item" id="chatbotfacil">
                                        <a class="nav-link" aria-current="page" href="listas.html">Mis listas</a>
                                    </li>
        
                                    <li class="nav-item" id="chatbotfacil">
                                        <a class="nav-link" aria-current="page" href="shopping_cart.html">Carrito de compras</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="container-fluid justify-content-center mt-4">
            <!--Rated-->
            <div class="container" id="Rated">
                <h3 style="text-align: center;">Mejor votados</h3>
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <br>
                    <div class='col d-inline-flex justify-content-center'>
                        <div class='card' style='width: 18rem;'>
                            <a href='' style='color: black; text-decoration: none;'>
                                <img src='images/ImagenPrueba.jpg' class='card-img-top' alt='' style='height: 18rem; object-fit: contain;'>
                                <div class='card-body'>
                                    <p class='card-text'>Nombre</p>
                                    <h5 class='card-title'>$00.00</h5>
                                    <div class='rate-container' style='color: #8eb35a'>
                                        <i class='fa-solid fa-star'></i>
                                        <i class='fa-solid fa-star'></i>
                                        <i class='fa-solid fa-star'></i>
                                        <i class='fa-solid fa-star'></i>
                                        <i class='fa-solid fa-star'></i>
                                    </div>
                                    <br>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--Recomendados-->
            <div class="container" id="Rated">
                <h3 style="text-align: center;">Recomendados</h3>
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <br>
                    <div class='col d-inline-flex justify-content-center'>
                        <div class='card' style='width: 18rem;'>
                            <a href='' style='color: black; text-decoration: none;'>
                                <img src='images/ImagenPrueba.jpg' class='card-img-top' alt='' style='height: 18rem; object-fit: contain;'>
                                <div class='card-body'>
                                    <p class='card-text'>Nombre</p>
                                    <h5 class='card-title'>$00.00</h5>
                                    <div class='rate-container' style='color: #8eb35a'>
                                        <i class='fa-solid fa-star'></i>
                                        <i class='fa-solid fa-star'></i>
                                        <i class='fa-solid fa-star'></i>
                                        <i class='fa-solid fa-star'></i>
                                        <i class='fa-solid fa-star'></i>
                                    </div>
                                    <br>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--Populares-->
            <div class="container" id="Rated">
                <h3 style="text-align: center;">Populares</h3>
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <br>
                    <div class='col d-inline-flex justify-content-center'>
                        <div class='card' style='width: 18rem;'>
                            <a href='' style='color: black; text-decoration: none;'>
                                <img src='images/ImagenPrueba.jpg' class='card-img-top' alt='' style='height: 18rem; object-fit: contain;'>
                                <div class='card-body'>
                                    <p class='card-text'>Nombre</p>
                                    <h5 class='card-title'>$00.00</h5>
                                    <div class='rate-container' style='color: #8eb35a'>
                                        <i class='fa-solid fa-star'></i>
                                        <i class='fa-solid fa-star'></i>
                                        <i class='fa-solid fa-star'></i>
                                        <i class='fa-solid fa-star'></i>
                                        <i class='fa-solid fa-star'></i>
                                    </div>
                                    <br>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <br><br>
        <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/intro.min.js"></script>
    </body>
    <footer>
        <!--div class="container py-5">
            <div class="row">
                <div class="footer-content col-6 text-center">
                    <div class="footer-our-store">
                        <div class="our-store-info">
                            <h5>Atención a clientes</h5>
                            <p>
                                L-V 10-7pm Sábado 10- 2pm: (33) - 2736 4752
                                <br>ventas@highpro.com.mx
                            </p>
                        </div>
                    </div>
                    <div class="footer-address col-6 text-center">
                        <h5>Dirección</h5>
                        <p>Highpro, Av. conchita 3124 C.P. 45086 Col. Loma bonita Residencial Zapopan, Jalisco. México.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="footer-copyright col">
                        <br>
                        <p> © Copyright 2023 Angel Barbosa, Karla Martínez </p>
                    </div>
                </div>
            </div>
        </div-->
    </footer>
    <!--style>
        footer {
            background-color: <?php echo $main_color ?>;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            width: 80%;
            /* ajusta el ancho según sea necesario */
            margin: 0 auto;
            /* centra el contenido horizontalmente */
        }

        .footer-our-store,
        .footer-address {
            width: 48%;
            /* ajusta el ancho según sea necesario */
        }

        .footer-copyright {
            width: 100%;
            text-align: center;

        }
    </style-->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Obtener todas las imágenes con la clase img-hover
            var imgHoverElements = document.querySelectorAll('.img-hover');

            // Agregar un listener para cada imagen
            imgHoverElements.forEach(function(img) {
                img.addEventListener('mouseout', function() {
                    // Restablecer el tamaño original y quitar la sombra y el borde al quitar el mouse
                    img.style.transform = 'scale(1)';
                    img.style.width = '200px'; // O el tamaño deseado
                    img.style.height = '200px'; // O el tamaño deseado
                    img.style.boxShadow = 'none';
                    img.style.borderColor = 'transparent'; // Restablecer el color del borde
                });
            });
        });
    </script>
</html>