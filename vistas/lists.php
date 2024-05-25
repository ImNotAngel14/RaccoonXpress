<?php
include "../configuracion/bd_config.php";
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

try
    {
        $mysqli = db::connect();
        $sql = "SELECT `list_id`, `list_name`, `description`, `privacity`, `image` FROM `lists` WHERE `user_id` = $user_id";
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
        <title>Listas</title>
        <link rel="icon" href="images/Isotipo.png">
        <link rel="stylesheet" type="text/css" href="css/profile.css">
        <link rel="stylesheet" type="text/css" href="css/general.css">
        <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    </head>
    <body style="display: flex; flex-direction: column; min-height: 100vh; margin: 0;">
        <?php
                printNavbar($user_id);
        ?>
        <div class="container mt-5">
        <div class="row justify-content-center sidebar_profile">
            <!-- Sidebar -->
            <div class="col-lg-4 col-md-6 col-sm-8 col-xs-12 user_card_container d-flex align-items-stretch h-100">
                <div class="mt-4 w-100 h-100">
                    <div class="card bg-light information_area h-100">
                        <div class="card-body d-flex flex-column">
                            <h5>Crear lista</h5>
                            <form action="lists.php" enctype="multipart/form-data" method="post" onsubmit="return createList()">
                                <div class="form-group m-4">
                                    <br>
                                    <h5 class="dato_noinput">
                                        Imagen de lista
                                    </h5>
                                    <label for="id_list_image_input">
                                        <img id="id_list_image" src="images/Profile.bmp" alt="" style="height: 200px; width: 200px; object-fit: cover;border-radius: 50%;">
                                        <input type="file" id="id_list_image_input" style="display:none;" onchange="loadImg()" accept="image/*">
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="id_list_name"></label>
                                    <input type="text" class="dato" id="id_list_name" name="list_name" placeholder="Nombre lista" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_list_description"></label>
                                    <input type="text" class="dato" id="id_list_description" name="list_description" placeholder="Descripción" required>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="id_privacity" name="privacity">
                                    <label for="id_privacity">Lista pública</label>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Ingresar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenido del perfil -->
            <div class="col-lg-8 col-md-6 col-sm-12 content_profile">
                <div class="row mt-4">
                    <div class="col">
                        <h3>Listas guardadas</h3>
                        <hr>
                        <?php
                        if ($result->num_rows > 0) 
                        {
                            while ($row = $result->fetch_assoc())
                            {
                                //`list_id`, `list_name`, `description`, `privacity`, `image`
                                $privacity = ($row["privacity"]) ? "Pública" : "Privada";
                                echo "
                                    <div class='card d-flex my-2' style='flex-direction:row;'>
                                        <div class='card_img'>
                                            <img src='data:image/png;base64,". $row["image"] ."' alt='...' style='height: 200px; width: 200px;'>
                                        </div>
                                        <div class='card-body'>
                                            <h5 class='card-title'>".$row["list_name"]."</h5>
                                            <p class='card-text'>".$row["description"]."</p>
                                            <p class='card-text'><small class='text-muted'>".$privacity."</small></p>
                                        </div>
                                        <button id='id_delete_list' class='btn btn-outline-secondary' type='submit' style='border: #ced4da;' data-bs-toggle='modal' data-bs-target='#ModalDeleteList'>
                                            <i class='fa-solid fa-trash' style='color: rgb(255, 84, 84);'></i>                            
                                        </button>
                                    </div>
                                ";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <br><br>
        <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/intro.min.js"></script>
        <script src="js/lists.js"></script>
    </body>
    <footer>

    </footer>
</html>