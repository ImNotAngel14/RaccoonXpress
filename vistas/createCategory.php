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
<div class="row align-items-center general_navbar py-1">
    <div class="col-0 col-md-2  d-none d-md-block d-lg-block d-xl-block">
        <a class="navbar-brand d-flex justify-content-center" href="#">
            <img src="images/Imagotipo.png" alt="" height="30 rem">
        </a>
    </div>
    <div class="col-md-8 col-8">
        <form class="" method="get" action="resultado.php">
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
