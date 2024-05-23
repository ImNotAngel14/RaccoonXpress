<?php
    include "../configuracion/bd_config.php";
    include "productTemplate.php";
    include "navbar.php";
    session_start();
    // Verificamos la sesion del usuario
    if(isset($_SESSION['AUTH']))
    {
        // Sesion iniciada
        $id_user = $_SESSION['AUTH'];
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
        if(isset($_GET["search"]))
        {
            $busqueda = $_GET["search"];
            $sql = "SELECT `name`, `price`, `image1` FROM products WHERE `name` LIKE '%$busqueda%';";
            $stmt = $mysqli->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result(); 
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
        <title>Resultados</title>
        <link rel="icon" href="images/Isotipo.png">
        <link rel="stylesheet" type="text/css" href="css/profile.css">
        <link rel="stylesheet" type="text/css" href="css/general.css">
        <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    </head>
    <body style="display: flex; flex-direction: column; min-height: 100vh; margin: 0;">
        <?php
            printNavbar();
        ?>
        <div class="container mt-5">
            <div class="row">
                <h4>Busqueda: "<?php
                        if(isset($_GET["search"]))
                        {
                            echo $busqueda;
                        }
                    ?>"
                </h4>
            </div>
            <!--div class="row row-cols-1 row-cols-md-4 g-4"-->
                <br>
                <?php
                    if ($result->num_rows > 0) 
                    {
                        echo "<div class='row row-cols-1 row-cols-md-4 g-4'>";
                        while ($row = $result->fetch_assoc())
                        {
                            //$product_name, $price, $image, $rating
                            printProduct($row['name'], $row['price'],base64_encode($row['image1']),5);
                        }
                    }
                    else
                    {
                        echo "
                        <div>
                            <h3>No hay publicaciones que coincidan con tu búsqueda</h3>
                            <ul>
                                <li><strong>Revisa la ortografía</strong> de la palabra.</li>
                                <li>Utiliza <strong>palabras más genéricas</strong> o menos palabras.</li>
                                <li><a href='#'> Navega por las categorías</a> para encontrar un producto similar</li>
                            </ul>
                        </div>
                        ";
                        
                    }
                ?>
            </div>
        </div>
        <br><br>
        <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/intro.min.js"></script>
    </body>
    <footer>
    </footer>
    <script>
    </script>
</html>