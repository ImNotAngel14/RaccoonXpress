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
        $sql = "SELECT shoppingCart_id, product_name, quantity, product_price, product_image1 FROM shopping_cart_view WHERE `user_id` = $user_id;";
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
        <title>Carrito compras</title>
        <link rel="icon" href="images/Isotipo.png">
        <link rel="stylesheet" type="text/css" href="css/general.css">
        <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    </head>
    <body style="display: flex; flex-direction: column; min-height: 100vh; margin: 0;">
        <div class="container-fluid">
            <?php
                printNavbar($user_id,$user_role);
            ?>
            <div class="container-fluid mt-5">
                <div class="flex-row">
                    <h3>Carrito de compras</h3>
                    <?php
                    if ($result->num_rows > 0) 
                    {
                        while ($row = $result->fetch_assoc())
                        {
                            echo "
                                <div class='card d-flex my-2' style='flex-direction:row;'>
                                    <div class='card_img'>
                                        <img src='data:image/png;base64,". base64_encode($row['product_image1']) ."' alt='...' style='height: 200px; width: 200px;'>
                                    </div>
                                    <div class='card-body'>
                                        <h5 class='card-title'>". $row['product_name'] ."</h5>
                                        <input type='number' class='form-control' name='cantidad' min='1' max='' value='". $row['quantity']  ."' style='border: 1px solid #333;'>
                                        <h6 class='card-text'>$". $row['product_price'] ." MXN</h6>
                                        <button data-cart-item='". $row['shoppingCart_id'] ."' class='btn btn-danger btn-delete-item'>Eliminar producto</button>
                                    </div>
                                </div>
                            ";
                        }
                    }
                    else
                    {
                        echo "
                        <div>
                            <h3>¡Empieza un carrito de compras!</h3>
                            <ul>
                                <li>En este momento no cuentas con articulos agregados a tu carrito.</li>
                                <li><a href='home.php'>Descubrir</a> productos</li>
                            </ul>
                        </div>";
                    }
                    ?>
                </div> 
                <div class="flex-row">
                    <br>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary">Proceder a la compra</button>
                    </div>
                </div>   
            </div>
            <br><br>
        </div>
        <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/intro.min.js"></script>
        <script src="js/shoppingCart.js"></script>
    </body>
    <footer>
    </footer>
</html>