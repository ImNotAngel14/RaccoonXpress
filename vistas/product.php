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
                        <img src='' class='rounded img-thumbnail' style='width: 100px; height: 100px; object-fit:cover;'>
                    </div>
                    <div class="col-sm-4 d-flex align-items-center">
                        <div class='image'>
                            <img src='data:image/png;base64, <?php echo base64_encode($product_data['image1']); ?>' class='rounded img-thumbnail' style='height: 18rem; object-fit: contain;''>
                        </div>
                    </div>
                    <div class="col-sm-4 ">
                        <div class="card rounded ">
                            <div class="card-body product-card">
                                <h4 class='card-title'><?php echo $product_data['name']; ?></h4>
                                <p class='card-text'>
                                    <small class='text-muted'><?php echo $product_data['description']; ?></small>
                                </p>
                                <p class='card-text'><small class='text-muted'> Categoría: </small></p>
                                <p class='card-text'>Valoración: </p>
                                <h5 class='card-title'>Precio: <?php echo $product_data['price']; ?>$</h5>
                                <p class='card-title'>Disponibles: <strong><?php echo $product_data['quantity']; ?> </strong> unidades. </p>
                                <div class='form-group'>
                                    <label for='cantidad'>Cantidad:</label>
                                    <input type='number' class='form-control' id='cantidad' name='cantidad' min='1' max='' value='1' style='border: 1px solid #333;'>
                                </div>
                                <div class="row justify-content-center">
                                    <button class="btn btn_confirm my-1" onclick="">Agregar al carrito</button>
                                </div>
                                <!--?php
                                    // Mostrar otros detalles del producto
                                    
                                    echo "<h4 class='card-title'>" . $producto['nombre'] . "</h4>";
                                    echo "<p class='card-text'><small class='text-muted'> SKU: " . $producto['id'] . "</small></p>";
                                    echo "<p class='card-text'><small class='text-muted'> Categoría: " . $producto['categoria'] . "</small></p>";
                                    echo "<p class='card-text'>" . $producto['descripcion'] . "</p>";
                                    echo "<p class='card-text'>Valoración: " . $producto['rate'] . "</p>";
                                    echo "<h5 class='card-title'>Precio: $" . $producto['precio'] . "</h5>";
                                    echo "<p class='card-title'>Disponibles: <strong>" . $producto['disponibles'] . "</strong> unidades. </p>";
    
                                    if ($producto['disponibles'] > 0) {
                                        echo "<div class='form-group'>";
                                        echo "<label for='cantidad'>Cantidad:</label>";
                                        echo "<input type='number' class='form-control' id='cantidad' name='cantidad' min='1' max='" . $producto['disponibles'] . "' value='1' style='border: 1px solid #333;'>";
                                        echo "</div>";
                                        if (isset($_SESSION['id_user'])) {
                                            // Si el usuario ha iniciado sesión, muestra los botones
                                            echo '<div class="row justify-content-center">';
                                            echo '<button class="btn btn_hp my-1" onclick="agregarAlCarrito(' . $id_user . ', ' . $productoID . ', ' . $producto['disponibles'] . ')">Agregar al carrito</button>';
                                            echo '</div>';
                                        } else {
                                            // Si el usuario no ha iniciado sesión, redirige a la página de inicio de sesión
                                            echo '<p><strong>Inicia sesión para comprar o agregar al carrito</strong></p>';
                                            echo '<a href="login.php"><button class="btn btn_hp my-1">Iniciar Sesión</button></a>';
                                        }
                                    
                                    } else {
                                        // Si la cantidad disponible es 0, mostrar un mensaje y deshabilitar el botón
                                        echo "<p><strong><em>¡Este producto volverá pronto!</em></strong></p>";
                                        echo '<button class="btn btn_hp my-1" disabled>Agregar al carrito</button>';
                                    }
    
    
                                  
                                ?-->
                          
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