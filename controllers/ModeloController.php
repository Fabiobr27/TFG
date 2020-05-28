<?php

// Controlador Modelo
//Fabio Benitez Ramirez
require_once "BaseController.php";
require_once "models/Modelo.php";
require_once "models/Marca.php";
require_once "models/Usuario.php";
require_once "libs/Sesion.php";

class ModeloController extends BaseController {

    public function __construct() {
        parent::__construct();
        
    }


    public function listar() {
              $ses = Sesion::getInstance();
          $idUsu = $ses->getUsuario();
        $tab = Marca::find($_GET["id"]);

     
        $dat = Modelo::findAll($_GET["id"]);

     
        echo $this->twig->render("showModelos.php.twig", ['tab' => $tab, 'dat' => $dat , 'idUsu' => $idUsu]);
    }
}

  
 
