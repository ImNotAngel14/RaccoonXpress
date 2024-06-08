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
        $user_role = $_SESSION["ROLE"];
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
        if(isset($_GET["product"]))
        {
            $product = $_GET["product"];
            $sql = "SELECT * FROM products WHERE `product_id` = $product;";
            $stmt = $mysqli->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) 
            {
                $product_data = $result->fetch_assoc();
            }
        }
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
        <title>Producto</title>
        <link rel="icon" href="images/Isotipo.png">
        <link rel="stylesheet" type="text/css" href="css/general.css">
        <link rel="stylesheet" type="text/css" href="css/product.css">
        <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    </head>
    <body style="display: flex; flex-direction: column; min-height: 100vh; margin: 0;">
        <?php
            printNavbar($user_id,$user_role);
        ?>
        <div class="container mt-5">
            <div class="my-2">
                <div class="d-flex flex-row justify-content-center">
                    <div class="col-sm-2">
                        <img src='data:image/png;base64, <?php echo $product_data['image1']; ?>' class='rounded img-thumbnail' style='width: 100px; height: 100px; object-fit:cover;'>
                        <img src='data:image/png;base64, <?php echo $product_data['image2']; ?>' class='rounded img-thumbnail' style='width: 100px; height: 100px; object-fit:cover;'>
                        <img src='data:image/png;base64, <?php echo $product_data['image3']; ?>' class='rounded img-thumbnail' style='width: 100px; height: 100px; object-fit:cover;'>

                    </div>
                    <div class="col-sm-4 d-flex align-items-center">
                        <div class='image'>
                            <video controls loop autoplay src='data:video/webm;base64 <?php echo $product_data['video']; ?>' class='rounded img-thumbnail' style='height: 18rem; object-fit: contain;'>

                        </div>
                    </div>
                    <div class="col-sm-4 ">
                        <div class="card rounded ">
                            <div class="card-body product-card">
                                
                                <?php 
                                    if($product_data['seller_id'] == $user_id)
                                    {
                                        echo "
                                        <form method='GET' action='createProduct.php?product_id=<" . $product_data['product_id'] . "'>
                                            <div class='position-absolute top-0 end-0'>
                                                <input type='text' class='form-control' name='product_id' value='" . $product_data['product_id'] . "' hidden>
                                                <button id='id_edit_product' class='btn btn-outline-secondary' style='border: #ced4da;' type='submit'>
                                                    <i class='fa fa-edit' aria-hidden='true'></i>
                                                </button>
                                            </div>
                                        </form>";
                                    }
                                ?>
                                <h4 class='card-title'><?php echo $product_data['name']; ?></h4>
                                <p class='card-text'>
                                    <small class='text-muted'><?php echo $product_data['description']; ?></small>
                                </p>
                                <p class='card-text'><small class='text-muted'> Categoría: </small></p>
                                <p class='card-text'>Valoración: </p>
                                <h5 class='card-title'>Precio: $<?php echo $product_data['price']; ?></h5>
                                <p class='card-title'>Disponibles: <strong><?php echo $product_data['quantity']; ?> </strong> unidades. </p>
                                <div class='form-group'  <?php if($product_data['seller_id'] == $user_id) echo "hidden"; ?>>
                                    <label for='cantidad'>Cantidad:</label>
                                    <input type='number' class='form-control' id='cantidad' name='cantidad' min='1' max='' value='1' style='border: 1px solid #333;'>
                                </div>
                                <div class="row justify-content-center"  <?php if($product_data['seller_id'] == $user_id) echo "hidden"; ?>>
                                    <button class="btn btn_confirm my-1" onclick="">Agregar al carrito</button>
                                </div>
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