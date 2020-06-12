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
   
    
    
    /**
     * create api of the Car Brands
     *
     * @return void
     */
    public function api() {
        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {

            $dat = Marca::findAll();




            foreach ($dat as $item):
                $marca = new Marca();
                $show = json_decode(json_encode($dat), true);




                $marca = $item->NombreMarca ?? "";
                $aniofundacion = $item->AñoFundacuion ?? "";
                $logo = $item->logo ?? "";
                $codigoMarca = $item->CodigoMarca ?? "";



                $sql = "INSERT INTO marcas (NombreMarca,  AñoFundacion , logo , codigoMarca)";
                $sql .= "VALUES ($marca,  $aniofundacion  $logo ,$codigoMarca ) ;";

                echo $sql;

                echo "Insertando $marca.... <br/>";
            
   
    
        



            endforeach;
        } else {
            header('Location: index.php');
        }
    }
}
