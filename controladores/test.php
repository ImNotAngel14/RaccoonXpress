<?php


$data = json_decode(file_get_contents('php://input'));
/*
 * En este ejemplo no se hace la consulta a la BD solo se retorna la info 
 * que llega desde el front, ustedes ajustenlo para que obtenga la info necesaria
 * Tambien acá no hay nada validado por lo que siempre va a regresar lo mismo.
 * OJO
 * Esto solo es para que se den una idea en que consiste una API, pueden organizar este 
 * codigo en alguna clase que procese sus consultas o algo similar
*/


/*
 * Es muy imporante que el header se aplique antes de hacer el echo para que el metodo que sea
 * que esten usando lo identifique como tal y lo puedan procesar con mayor facilidad
 * Tambien es importante que no exista nada despues de su echo para evitar introducir basura
 * a su respuesta
*/
$json_response = ["success" => true];
header("Content-type: application/json");
echo json_encode($json_response);
