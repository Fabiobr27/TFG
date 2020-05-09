<?php

require_once "BaseController.php";
require_once "modelos/Usuario.php";
require_once "modelos/Modelo.php";
require_once "modelos/Comentario.php";

class comentarioController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function edit() {
        $idUsu = $_GET["idUsu"];
        $idCom = $_GET["idCom"];
        $codigoMod = $_GET["codigoMod"];

        if (isset($_GET["texto"])) {
            $texto = $_GET["texto"];

            $comentario = new Comentario();
            // $comentario->setIdPos($idPos);
            $comentario->setTexto($texto);
            // $comentario->setIdUsu($idUsu);

            $comentario->guardar($idCom);

            header("location: ?con=post&ope=ver&idUsu=$idUsu&codigoMod=$codigoMod");
        } else {
            $comentario = Comentario::find($idCom);
            echo $this->render("editComentario.php.twig", (['comentario' => $comentario, 'idUsu' => $idUsu, 'idPos' => $idPos]));
        }
    }

    public function add() {
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $_GET["idUsu"];
        $codigoMod = $_GET["codigoMod"];
        if (isset($_GET["texto"])) {
            $texto = $_GET["texto"];
            $comentario = new Comentario();

            $comentario->setTexto($texto);
            $comentario->setIdUsu($idUsu);
            $comentario->setIdPos($codigoMod);

            $comentario->insertar();

            header("location: ?con=post&ope=ver&idUsu=$idUsu&codigoMod=$codigoMod");
        } else {
            echo $this->render("addComentario.php.twig", (['idUsu' => $id, 'codigoMod' => $codigoMod]));
        }
    }

}
