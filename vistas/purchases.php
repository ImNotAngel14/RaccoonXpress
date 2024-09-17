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
        <title>Resultados</title>
        <link rel="icon" href="images/Isotipo.png">
        <link rel="stylesheet" type="text/css" href="css/profile.css">
        <link rel="stylesheet" type="text/css" href="css/general.css">
        <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    </head>
    <body style="display: flex; flex-direction: column; min-height: 100vh; margin: 0;" class="container-fluid">
        <?php
            printNavbar($user_id,$user_role);
        ?>
        <div class=" container mt-5 justify-content-center text-center">
            <h3>Consulta de pedidos</h3>
            <hr>
        </div>
        <div class="container mt-5" >
            <form id="form" onsubmit="showTableD(event)">
                <h4>Pedidos realizados </h4>
                <label for="fechaInicioP">Fecha de Inicio:</label>
                <input type="date" id="fechaInicioP" name="fechaInicioP">
                <label for="fechaFinalP">Fecha Final:</label>
                <input type="date" id="fechaFinalP" name="fechaFinalP">
                <button type="submit">Aplicar filtros</button>
            </form>

            <table id="tablaVentasP" class="table hidden">
                <thead>
                  <tr>
                    <th scope="row">#</th>
                    <th scope="col">Fecha y Hora</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Calificacion</th>
                    <th scope="col">Precio</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>2024-01-01</th>
                    <td>nombre cat</th>
                    <td>nombre prod</th>
                    <td>100 likes</th>
                    <td>$100</th>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>2024-01-01</th>
                    <td>nombre cat</th>
                    <td>nombre prod</th>
                    <td>100 likes</th>
                    <td>$100</th>
                  </tr>
                </tbody>
              </table>
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
<script>

    function showTableD(event) {
        event.preventDefault(); // Evita que el formulario se envíe

        // Obtiene las fechas del formulario
        var fechaInicio = document.getElementById('fechaInicioP').value;
        var fechaFinal = document.getElementById('fechaFinalP').value;

        // Aquí podrías hacer una petición AJAX para obtener los datos basados en las fechas

        // Muestra la tabla
        document.getElementById('tablaVentasP').classList.remove('hidden');
    }
</script>
</html>