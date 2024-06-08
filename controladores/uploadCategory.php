<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../configuracion/bd_config.php';

    $json = json_decode(file_get_contents('php://input'),true);

    header('Content-Type: application/json');
    $mysqli = db::connect();
    $success = false;
    $sql = "INSERT INTO `categorys`(
                `name`,
                `description`,
                `user_id`
            ) VALUES(?,?,?);";
    try
    {
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssi", $json["name"], $json["description"], $json["user_id"]);
        $stmt->execute();
        $success = true;
    }
    catch(Exception $e)
    {
        $success = false;
        $json_response["error"] = $e->getMessage();
    }
    db::disconnect($mysqli);
    $json_response["success"] = $success;
    echo json_encode($json_response);
    exit;
}    

if($_SERVER['REQUEST_METHOD'] == 'PUT') {
    require_once '../configuracion/bd_config.php';

    $json = json_decode(file_get_contents('php://input'),true);

    header('Content-Type: application/json');
    $mysqli = db::connect();
    $success = false;
    $sql = "UPDATE `categorys` SET `name` = ?, `description`=? WHERE `category_id` =?";
    try
    {
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssi", $json["name"], $json["description"], $json["category_id"]);
        $stmt->execute();
        $success = true;
    }
    catch(Exception $e)
    {
        $success = false;
        $json_response["error"] = $e->getMessage();
    }
    db::disconnect($mysqli);
    $json_response["success"] = $success;
    echo json_encode($json_response);
    exit;
}    
