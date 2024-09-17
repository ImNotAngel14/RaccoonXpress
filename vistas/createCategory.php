<?php
    include "navbar.php";
    include "../configuracion/bd_config.php";
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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Crear Categoria</title>
        <link rel="icon" href="images/Isotipo.png">
        <link rel="stylesheet" type="text/css" href="css/profile.css">
        <link rel="stylesheet" type="text/css" href="css/general.css">
        <link rel="stylesheet" type="text/css" href="css/crearCategoria.css">
        <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    </head>
<body style="display: flex; flex-direction: column; min-height: 100vh; margin: 0;" class="container-fluid">
    <?php
        printNavbar($user_id,$user_role);
    ?>
    <div class="container col-4">
        <h2>Crear Nueva Categoría</h2>
        <form id="categoriaForm" action="guardar_categoria.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre de la Categoría:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required></textarea>
            </div>
            <button type="submit">Guardar Categoría</button>
        </form>
    </div>
</body>
</html>
