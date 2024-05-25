<?php

if($_SERVER['REQUEST_METHOD'] == 'PUT') {
    require_once '../modelos/user.php';
    require_once '../configuracion/bd_config.php';

    $json = json_decode(file_get_contents('php://input'),true);

    header('Content-Type: application/json');
    $mysqli = db::connect();
    session_start();
    $user_id = $_SESSION['AUTH'];
    $success = User::UpdateUser(
        $mysqli,
        $user_id,
        $json["username"], 
        $json["password"],
        $json["email"],
        $json["name"],
        $json["birthdate"],
        $json["gender"],
        $json["visibility"],
        $json["profileImage"]
    );
    db::disconnect($mysqli);
    $json_response = ["success" => $success, "user_id" => $user_id, "imagen" => $json["profileImage"]];
    echo json_encode($json_response);
    exit;
}
?>