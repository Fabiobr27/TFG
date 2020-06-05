<?php

require_once "BaseController.php";
require_once "models/Usuario.php";
require_once "models/Hilo.php";
require_once "models/Respuesta.php";
require_once "libs/Sesion.php";

//require_once "modelos/Respuesta.php";

/**
 * Class HiloController
 * @author Fabio Benitez Ramirez
 */
class HiloController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * Obtain the necessary data to show the thread
     *
     * @return void
     */
    public function listar() {
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        $dat = Hilo::findAll();

        echo $this->twig->render("showHilo.php.twig", ['dat' => $dat, 'idUsu' => $idUsu]);
    }

    /**
     * 
     * Obtain the necessary data to show the filtered thread
     *
     * @return void
     */
    public function filtro() {
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        $tit = $_GET["tit"];
        $dat = Hilo::filter($tit);

        echo $this->twig->render("showfiltro.php.twig", ['dat' => $dat]);
    }

    /**
     * 
     * Obtain the necessary data to show the thread created by a user
     *
     * @return void
     */
    public function listarCreados() {
        $id = $_GET['id'];
        $dat = Hilo::findHilos($id);
        $usu = Usuario::find($id);
        echo $this->twig->render("showHiloCreados.php.twig", ['dat' => $dat, 'idUsu' => $id, 'usu' => $usu]);
    }

    /**
     * collect the form data and insert it
     *
     * @return void
     */
    public function add() {
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        if (isset($_GET["texto"])) {
            $texto = $_GET["texto"];
            $titulo = $_GET["titulo"];
            $post = new Hilo();

            $post->setTexto($texto);
            $post->setTitulo($titulo);
            $post->setIdUsu($idUsu);

            $post->insertar();

            header("location: index.php?con=Hilo&ope=listar");
        }
    }

    /**
     * shows a form to edit the thread data and once filled it updates it
     *
     * @return void
     */
    public function edit() {
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        $idHilo = $_GET["idHilo"];

        if (isset($_GET["texto"])) {
            $texto = $_GET["texto"];
            $titulo = $_GET["titulo"];
            $hilo = new Hilo();

            $hilo->setTexto($texto);
            $hilo->setTitulo($titulo);


            $hilo->guardar($idHilo);

            header("location: index.php?con=Hilo&ope=listar");
        } else {
            $Hilo = Hilo::find($idHilo);
            echo $this->twig->render("editHilo.php.twig", (['hilo' => $Hilo, 'idUsu' => $idUsu]));
        }
    }

    /**
     * Show the details of a specific thread
     *
     * @return void
     */
    public function ver() {
        $idHilo = $_GET["id"];
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        $usuario = Usuario::find($idUsu);
        $hilo = Hilo::find($idHilo);
        $data = Respuesta::findAll($idHilo);
        echo $this->twig->render("showInfo.php.twig", (['pos' => $hilo, 'data' => $data, 'usuario' => $usuario, 'idUsu' => $idUsu, 'idHilo' => $idHilo]));
    }

    /**
     * Delete a a thread
     *
     * @return void
     */
    public function delete() {
        $idHilo = $_GET["idHilo"];

        Hilo::borrar($idHilo);
        header("location:index.php?con=Hilo&ope=listar");
    }

    /**
     * increase the number of likes of the thread
     *
     * @return void
     */
    public function increase() {
        $idHilo = $_GET["idHilo"];
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        Hilo::sumar($idHilo);
        header("location:index.php?con=Hilo&ope=ver&id=$idHilo");
    }

    /**
     * increase the number of dislikes of the thread
     *
     * @return void
     */
    public function decrease() {
        $idHilo = $_GET["idHilo"];
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        Hilo::restar($idHilo);
        header("location:index.php?con=Hilo&ope=ver&id=$idHilo");
    }

}
