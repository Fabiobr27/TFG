<?php

// Controlador MARCA
//Fabio Benitez Ramirez

require_once "BaseController.php";
require_once "libs/Sesion.php";
require_once "models/Marca.php";

class MarcaController extends BaseController {

    public function __construct() {
        parent::__construct();
       
    }

    
    public function listar() {
             $ses = Sesion::getInstance();
          $idUsu = $ses->getUsuario();
        $dat = Marca::findAll();
        echo $this->twig->render("showMarcas.php.twig", ['dat' => $dat , 'idUsu' => $idUsu]);
      
    }

   
}
