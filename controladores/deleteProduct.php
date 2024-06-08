<?php

if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    require_once '../configuracion/bd_config.php';

    $json = json_decode(file_get_contents('php://input'),true);

    header('Content-Type: application/json');
    session_start();
    $mysqli = db::connect();
    $sql = "DELETE FROM `products` WHERE `product_id` = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $json["product_id"]);
    $stmt->execute();
    $json_response = ["success" => false];
    if($stmt->affected_rows > 0)
    {
        $json_response["success"] = true;
        echo json_encode($json_response);
        exit;
    } 
    else
    {
        echo json_encode($json_response);
        exit;
    }
    db::disconnect($mysqli);
    echo json_encode($json_response);
    exit;
}
    