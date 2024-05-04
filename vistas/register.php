<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <!-- Agregar referencia a Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <link rel="stylesheet" type="text/css" href="css/general.css">
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
</head>
<body style="background-color: rgb(223, 223, 223)">
    <div class="container mt-5">

        <div class="row">
        <div class="col-md-3">
        </div>
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-md-12 col-sm-12 registro" style="background-color: #ffffff">
                        <form  method="POST" enctype="multipart/form-data"  class="registro_form" onsubmit="return validate()">
                            <h1 class="mb-4 text-center" style="color:#494949;">Crea una cuenta nueva</h1>
                            <h3 class="mb-4 text-center" style="color:lightblue;">Ingresa tus datos</h3>
                            <div class="form-group">
                                <label for="id_email"></label>
                                <input type="email" class="dato" id="id_email" name="name_email" placeholder="Correo" required>
                                <p id="id_email_validation" class="error_msg" hidden>El correo electrónico ya está registrado.</p>
                                <p id="id_email_validation2" class="error_msg" hidden>Escriba un correo electronico válido.</p>
                            </div>
                            <div class="form-group">
                                <label for="id_username"></label>
                                <input type="text" class="dato" id="id_username" name="name_username" placeholder="Usuario" required>
                                <p id="id_username_validation" class="error_msg" hidden>El nombre de usuario debe ser mayor a 3 letras.</p>
                            </div>
                            <div class="form-group">
                                <label for="id_password"></label>
                                <input type="password" class="dato" id="id_password" placeholder="Contraseña" name="name_password" required>
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
                            <div class="form-group">
                                <label for="id_name"></label>
                                <input type="text" class="dato" id="id_name" name="name_name" placeholder="Nombre(s)"required>
                            </div>
                            <div>
                                <label for="id_lastname"></label>
                                <input type="text" class="dato" id="id_lastname" name="name_lastname" placeholder = "Apellido(s)" required>
                            </div>                                            
                            <div class="form-group">
                                <label for="id_birthdate"></label>
                                <input type="date" class="dato" id="id_birthdate" name="name_birthdate" placeholder="Fecha de Nacimiento " required>
                            </div>
                            <div class="form-group">
                                <label for="id_genre"></label>
                                <select class="dato" id="id_genre" name="name_genre" required>
                                    <option disabled selected>Género</option>
                                    <option value="0" class="opcion">Femenino</option>
                                    <option value="1" class="opcion">Masculino</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_role"></label>
                                <select class="dato" id="id_role" name="name_role" required>
                                    <option disabled selected>Tipo de cuenta</option>
                                    <option value="0" class="opcion">Comprador</option>
                                    <option value="1" class="opcion">Vendedor</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <br>
                                <h5 class="dato_noinput">
                                    Imagen de perfil
                                </h5>
                                <label for="id_input_img">
                                    <img id="id_profile_img" src="images/Profile.bmp" alt="" style="height: 200px; width: 200px; object-fit: cover;border-radius: 50%;">
                                    <input type="file" id="id_input_img" style="display:none;" onchange="previewImg()" accept="image/*">
                                    <p id="id_file_validation" style="color: red;" hidden>Ingrese una imagen para su perfil.</p>
                                </label>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center" style="flex-direction:column; text-align:center;">
                                <button type="submit" class="btn" id="id_registerSubmit">Confirmar</button>
                                <br>
                                <p style="color: #494949;">¿Ya tienes una cuenta? &nbsp;</p>
                                <span class="link"><a href="login.php" style="color: lightskyblue;">Inicia Sesión</a><span>
                            </div>
                            


                        </form>
                    </div>
                </div>
                <br>
            </div>
        <div class="col-md-3">
        </div>
        </div>

    </div>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/register.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
</body>
</html>