<?php
    include "productTemplate.php";
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
        <style>
            .hidden {
                display: none;
            }
        </style>
    </head>
<body style="display: flex; flex-direction: column; min-height: 100vh; margin: 0;" class="container-fluid">
<?php
            printNavbar($user_id, 1);
?>
<div class="container col-4">
    <h2>Crear Nueva Categoría</h2>
    <form id="categoriaForm" action="../index.php" method="POST" onsubmit="return newCategory()">
        <div class="form-group">
            <label for="id_name">Nombre de la Categoría:</label>
            <input type="text" id="id_name" name="name_name" required>
        </div>
        <div class="form-group">
            <label for="id_description">Descripción:</label>
            <textarea id="id_description" name="name_description" required></textarea>
        </div>
        <button type="submit">Guardar Categoría</button>
    </form>
</div>
<script>
    async function newCategory()
    {
        event.preventDefault();
        const name = document.getElementById("id_name").value;
        const description = document.getElementById("id_description").value;
        try {
            const response = await fetch('http://localhost/WebDeCapaIntermedia/controladores/uploadCategory.php', {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    name: name,
                    description: description,
                    user_id: localStorage.getItem("user_id")
                })
            });
            // const text = await response.text();
            // console.log(text);
            const data = await response.json();
            // Actuamos en base a la respuesta de la API
            if(data.success)
            {  
                window.location.replace("home.php");
                console.log("Insertado.");
                return true;
            }
            else
            {
                console.error("No se pudo registrar la categoria.: ", data.error);
                return false;
            }
        } catch (error) {
            console.error('Error al llamar a la API:', error);
            return false;
        }
    }
</script>
</body>
</html>
