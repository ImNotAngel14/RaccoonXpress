<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../modelos/user.php';
    require_once '../configuracion/bd_config.php';

    $json = json_decode(file_get_contents('php://input'),true);

    header('Content-Type: application/json');
    $mysqli = db::connect();

    $success = User::SaveUser(
        $mysqli, 
        $json["username"], 
        $json["password"],
        $json["email"],
        $json["name"] . " " . $json["lastname"],
        $json["birthdate"],
        $json["gender"],
        1,
        1,
        $json["role"],
        $json["profileImage"],
    );
    db::disconnect($mysqli);
    $json_response = ["success" => $success];
    echo json_encode($json_response);
    exit;
}
?>