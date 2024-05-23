<?php
    include "../configuracion/bd_config.php";
    include "productTemplate.php";
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
        <div class="row align-items-center general_navbar py-1">
            <div class="col-0 col-md-2  d-none d-md-block d-lg-block d-xl-block">
                <a class="navbar-brand d-flex justify-content-center" href="#">
                    <img src="images/Imagotipo.png" alt="" height="30 rem">
                </a>
            </div>
            <div class="col-md-8 col-8">
                <form class="" method="get" action="buscador.php">
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