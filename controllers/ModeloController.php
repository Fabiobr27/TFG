<?php

// Controlador Modelo
//Fabio Benitez Ramirez
require_once "BaseController.php";
require_once "models/Modelo.php";
require_once "models/Marca.php";
require_once "models/Usuario.php";
require_once "libs/Sesion.php";
require_once "libs/Routing.php";

class ModeloController extends BaseController {

    public function __construct() {
        parent::__construct();
        
    }
  /**
     * Obtain the necessary data to show the Cars models
     *
     * @return void
     */
  public function listar() {
         $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
      
        $idUsu = $sesion->getUsuario();
        $tab = Marca::find($_GET["id"]);


        $dat = Modelo::findAll($_GET["id"]);


        echo $this->twig->render("showModelos.php.twig", ['tab' => $tab, 'dat' => $dat, 'idUsu' => $idUsu]); } else {
            header('Location: index.php');
        }
    }
}

  
 
