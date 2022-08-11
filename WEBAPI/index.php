
<?php
//Requerimos el Controlador que nos proporcionara las rutas
require_once "controllers/ruta.controller.php";
require_once "controllers/alumnos.controller.php";
require_once "models/alumnos.model.php";
require_once "models/authorization.model.php";
$objRuta = new  RutaController();
$objRuta->inicio(); //Nos redirijira al archivo page.php


?>

