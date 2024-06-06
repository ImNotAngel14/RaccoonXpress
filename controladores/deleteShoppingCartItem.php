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
        $sql="DELETE FROM `shopping_cart` WHERE shoppingCart_id=?;";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $json["cart_item"]);
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
    }
    catch(Exception $e)
    {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
        exit;
    }
}
?>