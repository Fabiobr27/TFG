<?php
//Fabio Benitez Ramirez
require_once "libs/Data.php";

$con = $_GET["con"] ?? "Login";
$ope = $_GET["ope"] ?? "mostrar";


// creamos el nombre completo del controlador
$nom = "{$con}Controller";

// importar el controlador necesario
require_once "controladores/$nom.php";

// instanciamos el controlador
$controller = new $nom();

// invocamos la operación a realizar
$controller->$ope();

