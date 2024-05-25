<?php

if($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    require_once '../configuracion/bd_config.php';
    require_once '../modelos/user.php';

    $json = json_decode(file_get_contents('php://input'),true);
    try{
        header('Content-Type: application/json');
        $mysqli = db::connect();
        session_start();
        $user_id = $_SESSION['AUTH'];
        $success = User::DeleteUser($mysqli, $user_id);
        db::disconnect($mysqli);
        $json_response = ["success" => false];
        if($success)
        {
            $json_response["success"] = true;
            // Destruir todas las variables de sesión
            session_unset();
            // Destruir la sesión
            session_destroy();
            echo json_encode($json_response);
            exit;
        } 
        else
        {
            echo json_encode($json_response);
            exit;
        }
    }
    catch(Exception $e)
    {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
        exit;
    }
}
?>