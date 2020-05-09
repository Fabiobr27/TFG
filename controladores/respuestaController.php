<?php

require_once "BaseController.php";
require_once "modelos/Usuario.php";
require_once "modelos/Respuesta.php";
require_once "libs/Sesion.php";

//require_once "modelos/Respuesta.php";

class respuestaController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function add() {
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $_GET["idUsu"];
        $codigoHilo = $_GET["idHilo"];
        if (isset($_GET["texto"])) {
            $texto = $_GET["texto"];
            $comentario = new Respuesta();

            $comentario->setTexto($texto);
            $comentario->setIdUsu($idUsu);
            $comentario->setIdHilo($codigoHilo);

            $comentario->insertar();

            header("location: index.php?con=Hilo&ope=ver&id=$codigoHilo");
        } else {
            echo $this->twig->render("addComentario1.php.twig", (['idUsu' => $id, 'codigoHilo' => $codigoHilo]));
        }
    }

    public function edit() {
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        $idRes = $_GET["idRes"];
        $idHilo = $_GET["idHilo"];

        if (isset($_GET["texto"])) {
            $texto = $_GET["texto"];

            $res = new Respuesta();
            // $comentario->setIdPos($idPos);
            $res->setTexto($texto);

            // $comentario->setIdUsu($idUsu);

            $res->guardar($idRes);

            header("location:index.php?con=Hilo&ope=ver&id=$idHilo");
        } else {
            $res = Respuesta::find($idRes);
            echo $this->twig->render("editRespuesta.php.twig", (['res' => $res, 'idUsu' => $idUsu , 'idHilo' => $idHilo]));
        }
    }

    public function ver() {
        $idHilo = $_GET["id"];
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        $usuario = Usuario::find($idUsu);
        $hilo = Hilo::find($idHilo);
        $data = Respuesta::findAll($idHilo);
        echo $this->twig->render("showInfo.php.twig", (['pos' => $hilo, 'data' => $data, 'usuario' => $usuario]));
    }

    public function delete() {
        $idHilo = $_GET["id"];

        Hilo::borrar($idHilo);
        header("location:index.php?con=Hilo&ope=listar");
    }

    public function increase() {
        $idHilo = $_GET["idHilo"];
        $idRes = $_GET["idRes"];
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        Respuesta::sumar($idRes);
        header("location:index.php?con=Hilo&ope=ver&id=$idHilo");
    }

    public function decrease() {
        $idHilo = $_GET["idHilo"];
        $idRes = $_GET["idRes"];
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        Respuesta::restar($idRes);
        header("location:index.php?con=Hilo&ope=ver&id=$idHilo");
    }

}
