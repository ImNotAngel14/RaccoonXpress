<?php

$server='localhost';
$user='root';
$pass='';
$db='interface';

 $conexion= new mysqli($server, $user, $pass, $db);

 if($conexion->connect_errno){
    echo "<label style='color: red;'>Sin conexión</label>";
     die("Conexion fallida". $conexion->connect_errno);
 }else{
    #echo "<label style='color: white;'>Conectado</label>";

 }
?>