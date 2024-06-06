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
    // Obtenemos los datos de 
    try
    {
        $mysqli = db::connect();
        if(isset($_GET["profile"]))
        {
            $profile = $_GET["profile"];
            //`username`, `user_password`, `email`, `fullname`, `birthdate`, `entry_date`, `gender`, `is_active`, `visibility`, `user_role`, `profile_image`
            $sql = "SELECT `username`, `user_password`, `email`, `fullname`, `birthdate`, `visibility`, `profile_image`, `gender` FROM `users` WHERE `user_id`=?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("i",$profile);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
            }
            else{
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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="icon" href="images/Isotipo.png">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="stylesheet" type="text/css" href="css/profile_client.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

</head>
<body style="display: flex; flex-direction: column; min-height: 100vh; margin: 0;">
    <div class="container-fluid">
        <!-- NAVBAR -->
        <?php
            printNavbar($user_id,$user_role);
        ?>
        <div class="row justify-content-center sidebar_profile">
            <!-- Sidebar -->
            <div class="col-lg-4 col-md-6 col-sm-8 col-xs-12 user_card_container d-flex align-items-stretch h-100">
                <div class="mt-4 w-100 h-100">
                    <div class="card bg-light information_area h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="text-center">
                                <h3 class="mt-2"><?php echo $row['username']; ?></h3>
                                <?php 
                                    if($profile == $user_id)
                                    {
                                        echo "
                                        <div class='position-absolute top-0 end-0'>
                                            <button id='id_edit_user' class='btn btn-outline-secondary' type='submit' style='border: #ced4da;' data-bs-toggle='modal' data-bs-target='#Modalmodifie'>
                                                <i class='fa fa-edit' aria-hidden='true'></i>
                                            </button>
                                        </div>";
                                    }
                                ?>
                                
                                <label for="id_input_img">
                                    <img id="id_profile_img" src="<?php
                                    
                                    
                                    //echo "data:image/png;base64," . base64_encode($row['profile_image']);
                                    echo isset($row['profile_image']) ?
                                    "data:image/png;base64," . $row['profile_image'] : "images/Profile.bmp";?>" alt="" style="height: 200px; width: 200px; object-fit: cover;border-radius: 50%;">
                                    <input type="file" id="id_input_img" style="display:none;" onchange="previewImg()" accept="image/*">
                                    <p id="id_file_validation" style="color: red;" hidden>Ingrese una imagen para su perfil.</p>
                                </label>
                            </div>
                            <div>
                                <!-- <CUANDO UN USUARIO ENTRE A ESTE PERFIL PRIVADO> -->
                                <!-- <h5 class="mt-2">Informacion privada</h5> -->
                                <?php 

                                    if($row['visibility'])
                                    {
                                        echo "
                                        <div class='sidebar_email'>
                                            <h5 class='mt-2' >Correo : </h5><h5 class='mt-2'>". $row['email']."</h5>
                                        </div>
                                        <div class='sidebar_realname'>
                                            <h5 class='mt-2' >Nombre completo : </h5><h5 class='mt-2'>".$row['fullname']."</h5>
                                        </div>
                                        <div class='sidebar_BirthDate'>
                                            <h5 class='mt-2' >Fecha Nacimiento : </h5><h5 class='mt-2'>".$row['birthdate']."</h5>
                                        </div>
                                        ";
                                    }
                                ?>
                                
                            </div>
                            <?php
                                if($profile == $user_id)
                                {
                                    echo "
                                    <div class='position-absolute bottom-0 end-0 p-4'>
                                        <button id='id_sign_off' class='btn btn btn-secondary' style='border: #ced4da;'>
                                            Cerrar Sesión
                                        </button>
                                        <button id='id_delete_account' class='btn btn btn-danger' style='border: #ced4da;' data-bs-toggle='modal' data-bs-target='#ModalDeleteAccount'>
                                            Eliminar Perfil
                                        </button>
                                    </div>
                                    ";
                                }
                            ?>
                            
                            <div class="flex-grow-1"></div>
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
                            if(!$row['visibility'])
                            {
                                echo "Este perfil es privado.";
                            }
                        ?>
                        <!--div class="card d-flex my-2" style="flex-direction:row;">
                            <div class="card_img">
                                <img src="images/ImagenPrueba.jpg" alt="..." style="height: 200px; width: 200px;">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Nombre lista</h5>
                                <p class="card-text">Descripción</p>
                                <p class="card-text"><small class="text-muted">Publica</small></p>
                            </div>
                            <button id="id_delete_list" class="btn btn-outline-secondary" type="submit" style="border: #ced4da;" data-bs-toggle="modal" data-bs-target="#ModalDeleteList">
                                <i class="fa-solid fa-trash" style="color: rgb(255, 84, 84);"></i>                            
                            </button>
                        </div>
                        <div class="card d-flex my-2" style="flex-direction:row;">
                            <div class="card_img">
                                <img src="images/ImagenPrueba.jpg" alt="..." style="height: 200px; width: 200px;">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Nombre lista</h5>
                                <p class="card-text">Descripción</p>
                                <p class="card-text"><small class="text-muted">Publica</small></p>
                            </div>
                            <button id="id_delete_list" class="btn btn-outline-secondary" type="submit" style="border: #ced4da;" data-bs-toggle="modal" data-bs-target="#ModalDeleteList">
                                <i class="fa-solid fa-trash" style="color: rgb(255, 84, 84);"></i>                            
                            </button>
                        </div>
                        <div class="card d-flex my-2" style="flex-direction:row;">
                            <div class="card_img">
                                <img src="images/ImagenPrueba.jpg" alt="..." style="height: 200px; width: 200px;">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Nombre lista</h5>
                                <p class="card-text">Descripción</p>
                                <p class="card-text"><small class="text-muted">Publica</small></p>
                            </div>
                            <button id="id_delete_list" class="btn btn-outline-secondary" type="submit" style="border: #ced4da;" data-bs-toggle="modal" data-bs-target="#ModalDeleteList">
                                <i class="fa-solid fa-trash" style="color: rgb(255, 84, 84);"></i>                            
                            </button>
                        </div-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal MODIFICAR PERFIL-->
    <div class="modal fade" id="Modalmodifie" tabindex="-1" aria-labelledby="ModalmodifieLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="ModalmodifieLabel">Modificar Perfil</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <form id="profile_form" enctype="multipart/form-data" method="post" onsubmit="return validate()">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="username" class="form-label">Nombre de usuario</label>
                    <input type="text" class="form-control" id="id_username" name="username" placeholder="Nombre de usuario" value="<?php echo $row['username'];?>">
                    <p id="id_username_validation" class="error_msg" hidden>El nombre de usuario debe ser mayor a 3 letras.</p>
                </div>
                <div class="mb-3">
                    <label for="realname" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="id_name" name="name" placeholder="Nombre Completo" value="<?php echo $row['fullname'];?>">
                </div>
                <div class="form-group">
                    <label for="id_birthdate"></label>
                    <input type="date" class="dato" id="id_birthdate" name="name_birthdate" placeholder="Fecha de Nacimiento " value="<?php echo $row['birthdate'];?>"required>
                </div>
                <div class="form-group">
                    <label for="id_gender"></label>
                    <select class="dato" id="id_gender" name="name_genre" required>
                        <option disabled selected>Género</option>
                        <option value='0' class='opcion' <?php if(!$row['gender']) echo "selected";?>>Femenino</option>
                        <option value='1' class='opcion' <?php if($row['gender']) echo "selected";?>>Masculino</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="profile_image" class="form-label">Foto de perfil</label>
                    <input type="file" class="form-control" id="id_profileImage" name="profile_image">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="id_email" name="email" placeholder="Correo electrónico" value="<?php echo $row['email'];?>">
                    <p id="id_email_validation" class="error_msg" hidden>El correo electrónico ya está registrado.</p>
                    <p id="id_email_validation2" class="error_msg" hidden>Escriba un correo electronico válido.</p>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control" id="id_password" name="password" placeholder="Contraseña" value="<?php echo $row['user_password'];?>">
                </div>
                <div id="id_pass_validation" class="error_msg" hidden>
                    <p  >La contraseña debe contener lo siguiente:</p>
                    <ul >
                        <li id="id_req_length">8 caracteres</li>
                        <li id="id_req_upper">Una mayúscula</li>
                        <li id="id_req_lower">Una minúscula</li>
                        <li id="id_req_number">Un número</li>
                        <li id="id_req_special">Un carácter especial</li>
                    </ul>
                </div>
                <div>
                    <input type="checkbox" id="id_visibility" name="visibility" 
                    <?php 
                        if($row['visibility'])
                            echo " checked ";
                        else
                            echo "";
                    ?>
                    >
                    <label for="id_visibility">Perfil público</label>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <input type="submit" type="submit" class="btn btn-primary" value="Guardar">
            </div>
        </form>
        </div>
        </div>
    </div>
    <!-- Modal ELIMINAR LISTA-->
    <div class="modal fade" id="ModalDeleteList" tabindex="-1" aria-labelledby="ModalDeleteListLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="ModalDeleteListLabel">Eliminar Lista</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>¿Seguro que quieres eliminar esta lista?</h5>
                <br>
                <div class=" text-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Aceptar</button>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- Modal ELIMINAR PERFIL-->
    <div class="modal fade" id="ModalDeleteAccount" tabindex="-1" aria-labelledby="ModalDeleteAccountLbl" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="ModalDeleteAccountLbl">Eliminar Cuenta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>¿Seguro que quieres eliminar tu cuenta?</h5>
                <br>
                <div class=" text-end">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="id_btn_delete_user">Aceptar</button>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- Scripts de Bootstrap y jQuery si los necesitas -->

    <!-- Script PARA OCULTAR CONTRASEÑA -->
    <script>
        /*
        const togglePasswordButton = document.getElementById('togglePassword');
        const passwordText = document.querySelector('.password_show');
        const passwordHidden = document.querySelector('.password-hidden');
        togglePasswordButton.addEventListener('click', function() {
            if (passwordText.style.display === 'none') {
                passwordText.style.display = 'inline';
                passwordHidden.style.display = 'none';
                togglePasswordButton.textContent = 'Ver Contraseña';
            } else {
                passwordText.style.display = 'none';
                passwordHidden.style.display = 'inline';
                togglePasswordButton.textContent = 'Ocultar Contraseña';
            }
        });
        */
    </script>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/profile.js"></script>
</body>
</html>
