<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../configuracion/bd_config.php';

    $json = json_decode(file_get_contents('php://input'),true);

    header('Content-Type: application/json');
    session_start();
    // Verificamos la sesion del usuario
    if(isset($_SESSION['AUTH']))
    {
        // Sesion iniciada
        $user_id = $_SESSION['AUTH'];
    }
    $mysqli = db::connect();
    /*
    $sql = "INSERT INTO `products`(
            `name`,
            `description`,
            `quotable`,
            `price`,
            `quantity`,
            `approved`,
            `image1`,
            `image2`,
            `image3`,
            `video`,
            `is_active`,
            `category_id`,
            `seller_id`
            )
    