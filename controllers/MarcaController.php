<?php

// Controlador MARCA
//Fabio Benitez Ramirez

require_once "BaseController.php";
require_once "libs/Sesion.php";
require_once "models/Marca.php";
/**
 * Class MarcaController
 * @author Fabio Benitez Ramirez 
 */
class MarcaController extends BaseController {

    public function __construct() {
        parent::__construct();
       
    }
    
    /**
     * 
     * Obtain the necessary data to show the Car Brands
     *
     * @return void
     */
 public function listar() {
        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $ses = Sesion::getInstance();
            $idUsu = $ses->getUsuario();
            $dat = Marca::findAll();
            echo $this->twig->render("showMarcas.php.twig", ['dat' => $dat, 'idUsu' => $idUsu]);
        } else {
            header('Location: index.php');
        }
    }
   
}
