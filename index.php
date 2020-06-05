<?php

    $control = $_GET["con"]??$_POST["con"]??"login";
    $operacion = $_GET["ope"]??$_POST["ope"]??"show";

    $name = "{$control}Controller";

	require_once "controllers/$name.php";

	$controller = new $name();

	$controller->$operacion();

