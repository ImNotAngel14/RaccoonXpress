<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Agregar la referencia a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/general.css">
</head>
<body>
    <div class="container mt-5 Contenedor">
        <form class="col-md-10 offset-md-1" method="post" id="form_login" name="form_login" onsubmit="return authLogin()">
            <h1 class="mb-4">Iniciar Sesión</h1>
            <span id="id_login_msg" class="error_msg" hidden>Credenciales incorrectas.</span>
            <div class="form-group">
                <label for="username"></label>
                <input type="text" id="username" name="username" class="dato"  placeholder="Usuario" required>
            </div>
            <div class="form-group">
                <label for="password"></label>
                <input type="password" id="password" name="password" class="dato" placeholder="Contraseña" required>
            </div>
            <br>
            <button type="submit" class="btn btn_login">Ingresar</button>
            <br><br>
            <span>¿Aún no tienes una cuenta? &nbsp;</span>
            <a href="register.php">Registrate Aquí</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
