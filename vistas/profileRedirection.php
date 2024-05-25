<?php
session_start();
// Verificamos la sesion del usuario
if(isset($_SESSION['AUTH']))
{
    // Sesion iniciada
    $user_id = $_SESSION['AUTH'];
    header("Location: profile_client.php?profile=$user_id");
}
else
{
    // No hay sesion iniciada.
    header("Location: ./vistas/landing_page.php");
}
