<?php

// Controlador Modelo
//Fabio Benitez Ramirez
require_once "BaseController.php";
require_once "libs/Routing.php";
require_once "modelos/Modelo.php";
require_once "modelos/Marca.php";
require_once "modelos/Usuario.php";
require_once "libs/Sesion.php";

class ModeloController extends BaseController {

    public function __construct() {
        parent::__construct();
        
    }


    public function listar() {
       
        $tab = Marca::find($_GET["id"]);

     
        $dat = Modelo::findAll($_GET["id"]);

     
        echo $this->twig->render("showModelos.php.twig", ['tab' => $tab, 'dat' => $dat]);
    }
}

  
 
