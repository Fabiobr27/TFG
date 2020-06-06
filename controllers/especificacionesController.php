<?php

// Controlador Especificaciones
//Fabio Benitez Ramirez

require_once "BaseController.php";
require_once "models/Modelo.php";
require_once "models/Marca.php";
require_once "models/Especificaciones.php";
require_once "models/Modelo_Usuario.php";
/**
 * Class especificacionesController
 * @author Fabio Benitez Ramirez 
 */
class especificacionesController extends BaseController {

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
            $tab = Modelo::find($_GET["id"]);


            $dat = Especificaciones::findAll($_GET["id"]);

            $fav = Modelo_Usuario::findFavo($_GET["id"], $id);



            $usu = Usuario::find($id);

            echo $this->twig->render("showEspecificacion.php.twig", ['tab' => $tab, 'dat' => $dat, 'fav' => $fav, 'id' => $id, 'usu' => $usu]);
        } else {
               header('Location: index.php');
        }
    }

 /**
     * shows a form to insert the data of the specification 
     *
     * @return void
     */
    public function anadir() {
       $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
        $tab = Modelo::find($_GET["id"]);
        //obtenemos todos los generos para mostrarlos en el desplegable
        $dat = Especificaciones::findAll($_GET["id"]);
        //muestra con el formulario para añadir serie
        echo $this->twig->render("addEspecificacion.php.twig", ['dat' => $dat, 'tab' => $tab]);
           } else {
           header('Location: index.php');
        }
    }
    /**
     * Insert the data of the specification in the database
     *
     * @return void
     */

    public function insertar() {
        //recogemos los datos del formulario para añadir una nueva serie
        $caballos = $_GET['cab'];
        $combustible = $_GET['comb'];
        $ano = $_GET['ano'];
        $cod = $_GET['cod'];

        //creamos una nueva serie y le introducimos sus datos
        $esp = new Especificaciones();

        $esp->setAño($ano);
        $esp->setCaballos($caballos);
        $esp->setCombustible($combustible);
        $esp->setcodigoMod($cod);

        //guardamos la serie
        $esp->save();




        header("location:index.php?con=especificaciones&ope=listar&id=$cod");
    }
    /**
     * Delete the specification of the database
     *
     * @return void
     */

    public function borrar() {
        $id = $_GET['id'];
        $cod = $_GET['cod'];
        $espe = Especificaciones::find($id);

        $espe->eliminar();


        header("Location:index.php?con=especificaciones&ope=listar&id=$cod");
    }

}
