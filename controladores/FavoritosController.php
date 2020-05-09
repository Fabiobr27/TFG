<?php

// Controlador Favoritos
//Fabio Benitez Ramirez
require_once "BaseController.php";
require_once "libs/Routing.php";
require_once "modelos/Modelo_Usuario.php";
require_once "libs/Sesion.php";

class FavoritosController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function listar() {

        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();

        $dat = Modelo_Usuario::MostrarFavoritos($id);
        echo $this->twig->render("showFavoritos.php.twig", ['dat' => $dat]);
    }

    public function anadirFav() {
        $id = $_GET['cod'];
        $usu = Modelo_Usuario::find($id);

        $usu->anadirFav();
        header("Location: index.php?con=especificaciones&ope=listar&id=$id");
    }

    public function eliminarFav() {
        $id = $_GET['cod'];
        $usu = Modelo_Usuario::find($id);




        $usu->eliminarFav();

        //mostramos la vista principal
        header("Location: index.php?con=especificaciones&ope=listar&id=$id");
    }

    public function anadirComentario() {

        $com = Modelo_Usuario::findComentarios($_GET["id"]);

        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();

        if (!isset($_GET["comentario"])):

            echo $this->twig->render("addComentario.php.twig", ['com' => $com, 'id' => $_GET["id"]]);
        else:

            $com = $_GET["comentario"];
            $fav = $_GET["desplegable"];
            $cod = $_GET["cod"];

            $mod_usu = new Modelo_Usuario();
            $mod_usu->setComentario($com);
            $mod_usu->setfavorito($fav);
            $mod_usu->setcodigoMod($cod);
            $mod_usu->setidUsu($id);



            $mod_usu->save();


            header("Location: index.php");
        endif;
    }

}
