<?php
    include "../configuracion/bd_config.php";
    include "productTemplate.php";
    include "navbar.php";
    session_start();
    // Verificamos la sesion del usuario
    if(isset($_SESSION['AUTH']))
    {
        // Sesion iniciada
        $user_id = $_SESSION['AUTH'];
    }
    else
    {
        // No hay sesion iniciada.
        header("Location: ./vistas/landing_page.php");
    }
    // Obtenemos los datos de los productos
    try
    {
        $mysqli = db::connect();
        $sql = "SELECT * FROM products;";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result(); 
    }
    catch(error)
    {
        echo "Error en la conexion a la base de datos: " . error;
    }
    finally
    {
        db::disconnect($mysqli);
    }
    
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
        <div class="container-fluid">
            <?php
                printNavbar($user_id);
            ?>
            <div class="container-fluid justify-content-center mt-5">
                <!--Rated-->
                <div class="container" id="Rated">
                    <h3 style="text-align: center;">Mejor votados</h3>
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        <br>
                        <?php
                            if ($result->num_rows > 0) 
                            {
                                while ($row = $result->fetch_assoc())
                                {
                                    //$product_name, $price, $image, $rating
                                    printProduct($row['product_id'] ,$row['name'], $row['price'],base64_encode($row['image1']),5);
                                }
                            }
                            else
                            {
                                echo "No parece haber productos disponibles...";
                            }
                        ?>
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