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
        $sql = "CALL sp_getCategorys();";
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
    if($_GET["product_id"] > 0)
    {
        try
        {
            $mysqli = db::connect();
            $sql2 = "SELECT * FROM `products` WHERE product_id = ?;";
            $stmt2 = $mysqli->prepare($sql2);
            $stmt2->bind_param("i", $_GET["product_id"]);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            $product_data = $result2->fetch_assoc();
        }
        catch(error)
        {
            echo "Error en la conexion a la base de datos: " . error;
        }
        finally
        {
            db::disconnect($mysqli);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear Producto</title>
        <link rel="icon" href="images/Isotipo.png">
        <link rel="stylesheet" type="text/css" href="css/profile.css">
        <link rel="stylesheet" type="text/css" href="css/general.css">
        <link rel="stylesheet" type="text/css" href="css/crearCategoria.css">
        <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <style>
            .hidden {
                display: none;
            }
        </style>
    </head>

<body style="display: flex; flex-direction: column; min-height: 100vh; margin: 0;" class="container-fluid">
    <?php
        printNavbar($user_id, $user_role);
    ?>
    <div class="container col-4">
        <h2>Crear Nuevo Producto</h2>
        <form id="productoForm" enctype="multipart/form-data" method="POST" onsubmit="return newProduct()">
            <div class="form-group">
                <label for="id_nombre">Nombre del Producto:</label>
                <input type="text" id="id_nombre" name="nombre" 
                    <?php
                        if($_GET["product_id"] > 0)
                        {
                            echo "value = '" . $product_data["name"] ."'";
                        }
                    ?> 
                required>
            </div>
            <div class="form-group">
                <label for="id_descripcion">Descripción:</label>
                <textarea id="id_descripcion" name="descripcion"required><?php if($_GET["product_id"] > 0){echo $product_data["description"];}?></textarea>
            </div>
            <div class="form-group">
                <label for="id_cotizable">¿Es cotizable?</label>
                <select id="id_cotizable" name="cotizable" required>
                    <option value="1">Cotizable</option>
                    <option <?php if($_GET["product_id"] > 0) { if($product_data["quotable"] == 0) { echo "selected"; }}?> value="0">No cotizable</option>
                </select>
            </div>
            <div class="form-group">
                <label for="id_precio">Precio:</label>
                <input type="number" id="id_precio" name="precio"
                    <?php
                        if($_GET["product_id"] > 0)
                        {
                            echo "value = '" . $product_data["price"] ."'";
                        }
                    ?>
                required step="0.01" min="0">
            </div>
            <div class="form-group">
                <label for="id_cantidad">Cantidad:</label>
                <input type="number" id="id_cantidad" name="cantidad" 
                    <?php
                        if($_GET["product_id"] > 0)
                        {
                            echo "value = '" . $product_data["quantity"] ."'";
                        }
                    ?>
                required min="0">
            </div>
            <div class="form-group">
                <label for="id_imagen1">Imagen 1:</label>
                <input type="file" id="id_imagen1" name="imagen1" accept="image/*">
            </div>
            <div class="form-group">
                <label for="id_imagen2">Imagen 2:</label>
                <input type="file" id="id_imagen2" name="imagen2" accept="image/*">
            </div>
            <div class="form-group">
                <label for="id_imagen4">Imagen 3:</label>
                <input type="file" id="id_imagen3" name="imagen3" accept="image/*">
            </div>
            <div class="form-group">
                <label for="id_video">Video:</label>
                <input type="file" id="id_video" name="video" accept="video/*">
            </div>
            <div class="form-group">
                <label for="id_categoria">Categoria</label>
                <select id="id_categoria" name="categoria" required>
                    <?php
                    // Cargar categorias
                    if ($result->num_rows > 0) 
                    {
                        while ($row = $result->fetch_assoc())
                        {
                            if($_GET["product_id"] > 0)
                            {
                                if($product_data["category_id"] == $row['category_id'])
                                {
                                    echo "<option selected value=".$row['category_id'].">".$row['name']."</option>";
                                }
                                else
                                {
                                    echo "<option value=".$row['category_id'].">".$row['name']."</option>";
                                }
                            }
                            else
                            {
                                echo "<option value=".$row['category_id'].">".$row['name']."</option>";
                            }
                            
                        }
                    }
                    ?>
                </select>
            </div>
            <br/>
            <button type="submit">
                <?php
                    if($_GET["product_id"] > 0)
                    {
                        echo "Actualizar producto";
                    }
                    else
                    {
                        echo "Guardar producto";
                    }
                ?>
            </button>
            <?php
                if($_GET["product_id"] > 0)
                {
                    echo "<button id='id_delete_product' class='btn btn-danger' onclick='delete_product(" . $_GET["product_id"] .")'>Eliminar producto</button>";
                }
            ?>
            
        </form>
    </div>
<script src="js/createProduct.js"></script>
</body>
</html>
