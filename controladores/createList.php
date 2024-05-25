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
    $sql = "INSERT INTO `lists`(
        `list_name`,
        `description`,
        `privacity`,
        `image`,
        `user_id`)
        VALUES(?,?,?,?,?);";
    $success = false;
    try
    {
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssisi",$json["name"],$json["description"],$json["privacity"],$json["image"], $user_id);
        $stmt->execute();
        $success = ($stmt->affected_rows > 0);
    }
    catch(Exception $e)
    {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
    finally
    {
        db::disconnect($mysqli);
    }
    $json_response = ["success" => $success];
    echo json_encode($json_response);
}
?>