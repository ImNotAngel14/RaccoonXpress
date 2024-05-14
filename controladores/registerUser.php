<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../modelos/user.php';
    require_once '../configuracion/bd_config.php';

    $json = json_decode(file_get_contents('php://input'),true);

    header('Content-Type: application/json');
    $mysqli = db::connect();

    User::SaveUser(
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
        NULL,
    );
    /*
    username,
    user_password,
    email,
    fullname,
    birthdate,
    gender,
    is_active,
    visibility,
    user_role,
    profile_image
    */
    $json_response = ["success" => true];
    echo json_encode($json_response);
    exit;
}
?>