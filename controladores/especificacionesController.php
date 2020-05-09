<?php

// Controlador Especificaciones
//Fabio Benitez Ramirez

require_once "BaseController.php";
require_once "libs/Routing.php";
require_once "modelos/Modelo.php";
require_once "modelos/Marca.php";
require_once "modelos/Especificaciones.php";
require_once "modelos/Modelo_Usuario.php";

class especificacionesController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function listar() {

        $tab = Modelo::find($_GET["id"]);


        $dat = Especificaciones::findAll($_GET["id"]);

        $com = Modelo_Usuario::findComentarios($_GET["id"]);

        $fav = Modelo_Usuario::findAll();

        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        
        $usu = Usuario::find($id);

        echo $this->twig->render("showEspecificacion.php.twig", ['tab' => $tab, 'dat' => $dat, 'com' => $com, 'fav' => $fav, 'id' => $id , 'usu'=> $usu]);
    }

    public function anadir() {
        $tab = Modelo::find($_GET["id"]);
        //obtenemos todos los generos para mostrarlos en el desplegable
        $dat = Especificaciones::findAll($_GET["id"]);
        //muestra con el formulario para añadir serie
        echo $this->twig->render("addEspecificacion.php.twig", ['dat' => $dat , 'tab' =>$tab]);
    }

    public function insertar(){
            //recogemos los datos del formulario para añadir una nueva serie
            $caballos = $_GET['cab'];
            $combustible = $_GET['comb'];
            $ano = $_GET['ano'];
            $cod =$_GET['cod'];

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

        
        public function borrar() {
        $id = $_GET['id'];
        $cod = $_GET['cod'];
        $espe = Especificaciones::find($id);

        $espe->eliminar();


        header("Location:index.php?con=especificaciones&ope=listar&id=$cod");
    }
        
    }
