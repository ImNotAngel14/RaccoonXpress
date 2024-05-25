<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../modelos/user.php';
    require_once '../configuracion/bd_config.php';

    $json = json_decode(file_get_contents('php://input'),true);

    header('Content-Type: application/json');
    $mysqli = db::connect();

    $user = User::AuthenticateUser($mysqli, $json["username"], $json["password"]);
    db::disconnect($mysqli);
    $json_response = ["success" => false];
    if($user)
    {
        $json_response["success"] = true;
        session_start();
        $_SESSION["AUTH"] = (string)$user->getIdUser();
        $_SESSION["ROLE"] = (string)$user->getUserRol();
        $json_response["user_id"] = $_SESSION['AUTH'];
        echo json_encode($json_response);
        exit;
    } 
    else
    {
        echo json_encode($json_response);
        exit;
    }
}
?>