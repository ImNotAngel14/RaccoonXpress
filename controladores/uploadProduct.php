<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once '../configuracion/bd_config.php';

    $json = json_decode(file_get_contents('php://input'),true);

    header('Content-Type: application/json');
    $image1 = isset($json["image1"]) ? $json["image1"] : NULL;
    $image2 = isset($json["image2"]) ? $json["image2"] : NULL;
    $image3 = isset($json["image3"]) ? $json["image3"] : NULL;
    $video = isset($json["video"]) ? $json["video"] : NULL;
    $mysqli = db::connect();
    //Si el idProducto es 0 Creamos
    $success = false;
    $product_id = isset($json["product_id"]) ? $json["product_id"] : 0;
    if($product_id == 0)
    {
        $sql = "INSERT INTO `products`(`name`, `description`, `quotable`, `price`,`quantity`,`image1`, `image2`, `image3`, `video`, `category_id`, `seller_id`) VALUES(?,?,?,?,?,?,?,?,?,?,?);";
        try
        {    
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param(
                "ssidissssii",
                $json["name"],
                $json["description"],
                $json["quotable"],
                $json["price"],
                $json["quantity"],
                $image1,
                $image2,
                $image3,
                $video,
                $json["category_id"],
                $json["seller_id"],
            );
            $stmt->execute();
            $success = true;
        }
        catch(Exception $e)
        {
            $success = false;
            $json_response["error"] = $e->getMessage();
        }
        //$stmt->bind_param("ssidissssii",$json["name"],$json["description"],$json["quotable"],$json["price"],$json["quantity"],null,null,null,null,$json["category_id"],$json["seller_id"]);
    }
    //Si el idProducto es diferente de 0 actualizamos
    else
    {
        $sql= "UPDATE
            `products`
        SET
            `name` = ?,
            `description` = ?,
            `quotable` = ?,
            `price` = ?,
            `quantity` = ?,
            `image1` = ?,
            `image2` = ?,
            `image3` = ?,
            `video` = ?,
            `category_id` = ?,
            `seller_id` = ?
        WHERE
            `product_id` = ?
        ;";
        try
        {
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param(
                "ssidissssiii",
                $json["name"],
                $json["description"],
                $json["quotable"],
                $json["price"],
                $json["quantity"],
                $image1,
                $image2,
                $image3,
                $video,
                $json["category_id"],
                $json["seller_id"],
                $json["product_id"]
            );
            $stmt->execute();
            $success = true;
        }
        catch(Exception $e2)
        {
            $success = false;
            $json_response["error"] = $e2->getMessage();
        }
    }
    db::disconnect($mysqli);
    $json_response["success"] = $success;
    echo json_encode($json_response);
    exit;
}
    