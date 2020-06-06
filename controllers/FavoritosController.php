<?php

// Controlador Favoritos
//Fabio Benitez Ramirez
require_once "BaseController.php";

require_once "models/Modelo_Usuario.php";
require_once "libs/Sesion.php";
/**
 * Class FavoritosController
 * @author Fabio Benitez Ramirez
 */
class FavoritosController extends BaseController {

    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Get the necessary data for the view and displays it
     *
     * @return void
     */
  public function listar() {

        $sesion = Sesion::getInstance();
      
        if ($sesion->checkActiveSession()) {
         $id = $sesion->getUsuario();

        $dat = Modelo_Usuario::MostrarFavoritos($id);
        echo $this->twig->render("showFavoritos.php.twig", ['dat' => $dat]);
        } else {
            header('Location: index.php');
        }
    }
      /**
     * Insert to favorites the indicated model
     *
     * @return void
     */
    public function anadirFav() {
        $id = $_GET['cod'];
        $usu = Modelo_Usuario::find($id);

        $usu->anadirFav();
        header("Location: index.php?con=especificaciones&ope=listar&id=$id");
    }
/**
     * Insert to favorites the indicated model if not added before
     *
     * @return void
     */
    public function anadirFavo () {
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        
       
            $cod = $_GET["cod"];
        $mod_usu = new Modelo_Usuario();
     
            $mod_usu->setcodigoMod($cod);
            $mod_usu->setidUsu($id);



            $mod_usu->save();

   
        header("Location: index.php?con=especificaciones&ope=listar&id=$cod");
    }
        /**
     * remove to favorites the indicated model 
     *
     * @return void
     */
    public function eliminarFav() {
        $id = $_GET['cod'];
        $usu = Modelo_Usuario::find($id);




        $usu->eliminarFav();

   
        header("Location: index.php?con=especificaciones&ope=listar&id=$id");
    }

    

}
