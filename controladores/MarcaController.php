<?php

// Controlador MARCA
//Fabio Benitez Ramirez

require_once "BaseController.php";
require_once "libs/Routing.php";
require_once "modelos/Marca.php";

class MarcaController extends BaseController {

    public function __construct() {
        parent::__construct();
       
    }

    
    public function listar() {
        
        $dat = Marca::findAll();
        echo $this->twig->render("showMarcas.php.twig", ['dat' => $dat]);
      
    }

   
}
