<?php
    include "../configuracion/bd_config.php";
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
        <title>Cotizacion</title>
        <link rel="icon" href="images/Isotipo.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link rel="stylesheet" href="css/chat.css">
        <link rel="stylesheet" type="text/css" href="css/general.css">
    </head>
    <body>
    <!-- NAVBAR -->
        <!-- <div style="flex: 1;"> -->
        <?php
            printNavbar($user_id,$user_role);
        ?>
    <!-- NAVBAR -->
    <!-- CONTENIDO PAGINA -->
    <div class="container-fluid cuerpo_pagina">
        <div class="row">
    <!-- IZQUIERDA -->
            <div class="col-lg-3 col-md-4 col-sm-2 col-xs-2 cuerpo_chat_izquierda">
                <div class="row">
                    <h3>Chats</h3>
                </div>
                <div class="row">
                    <input class="form-control barra_busqueda_chat mx-auto" type="search" placeholder="Buscar">
                </div>   
                <hr/>
                <div class="row barra_izquierda_chats px-2">
                    <div class="row recuadro_chat_barraizquierda">
                        <div class="col-2 recuadro_chat_img px-2">
                            <img src="images/Profile.bmp" class="imagen_usuario_barraizquierda" alt=""/>
                        </div>
                        <div class="col-10 recuadro_chat_info d-none d-md-block">
                            <div class="row usuario_barraizquierda">
                                <h5>Usuario 1</h5>
                            </div>
                            <div class="d-flex flex-row ultimo_mensaje">
                                    <p class="ultimo_mensaje_texto">waos</p>
                                    <p class="ultimo_mensaje_fechahora">2 d</p>
                            </div>
                        </div> 
                    </div>  


                </div>             
            </div>
    <!-- DERECHA -->
            <div class="col-lg-9 col-md-8 col-sm-10 col-xs-10 cuerpo_chat_derecha">
                <div class="row header_chat_derecha">
                    <div class="col-1 d-flex justify-content-center">
                        <img src="images/Profile.bmp" class="img_usuario_top_barraderecha" alt=""/>
                    </div>
                    <div class="col-lg-10 col-md-9 col-sm-7 usuario_info_derecha px-2">
                        <div class="row">
                            <h5>Usuario</h5>
                        </div>
                        <div class="row">
                            <p>Activo ahora</p>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class='dropdown'>
                            <a class='btn dropdown-toggle intro-target' href='#' role='button' id='dropdownChatMenu' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class="fa-solid fa-ellipsis-vertical"></i></a>
                            <div class='dropdown-menu' aria-labelledby='dropdownChatMenu'>
                                <a class='dropdown-item'>Reportar</a>
                                <div class='dropdown-divider'></div>
                                    <a class='dropdown-item'>Eliminar Chat</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row chats_container">
                    <div class="mensaje_del_destinatario d-flex justify-content-start">
                        <div class="cuerpo_mensaje_destinatario">
                            <p class="mensaje_texto">Hola</p>
                        </div>
                        <p class="mensaje_hora">17:05 pm</p>
                    </div>
                    <div class="mensaje_del_remitente d-flex justify-content-end">
                        <div class="cuerpo_mensaje_remitente">
                            <p class="mensaje_texto">Hola</p>
                        </div>
                        <div class="info_mensaje_remitente">
                            <p class="mensaje_hora">17:15 pm</p>
                            <p class="mensaje_visto">Visto</p>
                        </div>
                    </div>
                </div>
                <div class="row input_chat_container">
                    <form class="input_chat_wrapper">
                        <div class="col-11">
                            <textarea class="form-control" rows="1" placeholder="Escribe tu mensaje..."></textarea>
                        </div>
                        <div class="col-1">
                            <label for="btn_enviar_mensaje"><button><i class="fa-solid fa-paper-plane"></i></button></label>
                            <input type="submit" class="btn btn_mandar_mensaje" id="btn_enviar_mensaje"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENIDO PAGINA -->
    <!-- SCRIPTS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/intro.min.js"></script>
    </body>
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
</html>