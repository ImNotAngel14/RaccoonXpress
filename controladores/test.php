<?php
try
{
    $json_response["success"] = $success;
}
catch(Exception $e)
{
    $json_response = array(
        "success" => false,
        "error" => $e->getMessage()
    );
}
echo json_encode($json_response);
exit;