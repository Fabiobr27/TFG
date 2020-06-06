<?php

require_once "BaseController.php";
require_once "models/Usuario.php";
require_once "models/Respuesta.php";
require_once "libs/Sesion.php";

//require_once "modelos/Respuesta.php";

class respuestaController extends BaseController {

    public function __construct() {
        parent::__construct();
    }
/**
     * shows a form to insert the data of the answer and once filled it inserts them
     *
     * @return void
     */
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
/**
     * shows a form to edit the data of the news and once filled it update them
     *
     * @return void
     */
    public function edit() {
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        $idRes = $_GET["idRes"];
        $idHilo = $_GET["idHilo"];

        if (isset($_GET["texto"])) {
            $texto = $_GET["texto"];

            $res = new Respuesta();
     
            $res->setTexto($texto);

          
            $res->guardar($idRes);

            header("location:index.php?con=Hilo&ope=ver&id=$idHilo");
        } else {
            $res = Respuesta::find($idRes);
            echo $this->twig->render("editRespuesta.php.twig", (['res' => $res, 'idUsu' => $idUsu , 'idHilo' => $idHilo]));
        }
    }
    /**
     * Show the details of a specific anwser
     *
     * @return void
     */
    public function ver() {
        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $idHilo = $_GET["id"];

            $id = $sesion->getUsuario();
            $idUsu = $id;
            $usuario = Usuario::find($idUsu);
            $hilo = Hilo::find($idHilo);
            $data = Respuesta::findAll($idHilo);
            echo $this->twig->render("showInfo.php.twig", (['pos' => $hilo, 'data' => $data, 'usuario' => $usuario]));
        } else {
            echo $this->twig->render("showLogin.php.twig");
        }
    }
        /**
     * Delete a answer 
     *
     * @return void
     */
  public function delete() {
           $idHilo = $_GET["idHilo"];
        $idRes = $_GET["idRes"];

        Respuesta::borrar($idRes);
         header("location:index.php?con=Hilo&ope=ver&id=$idHilo");
    }

    /**
     * increase the number of likes of the thread
     *
     * @return void
     */
    public function increase() {
        $idHilo = $_GET["idHilo"];
        $idRes = $_GET["idRes"];
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        Respuesta::sumar($idRes);
        header("location:index.php?con=Hilo&ope=ver&id=$idHilo");
    }

        /**
     * increase the number of dislikes of the thread
     *
     * @return void
     */
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
