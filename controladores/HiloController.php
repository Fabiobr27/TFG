<?php

require_once "BaseController.php";
require_once "modelos/Usuario.php";
require_once "modelos/Hilo.php";
require_once "modelos/Respuesta.php";
require_once "libs/Sesion.php";

//require_once "modelos/Respuesta.php";

class HiloController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function listar() {
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        $dat = Hilo::findAll();
        $men = Hilo::NumMen(1);
        echo $this->twig->render("showHilo.php.twig", ['dat' => $dat, 'idUsu' => $idUsu, 'men' => $men]);
    }
    
    public function listarCreados() {
          $id = $_GET['id'];
        $dat = Hilo::findHilos($id);
       $usu = Usuario::find($id);
        echo $this->twig->render("showHiloCreados.php.twig", ['dat' => $dat, 'idUsu' => $id  , 'usu' => $usu]);
    }

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
        } else {
            echo $this->twig->render("addHilo.php.twig", ['idUsu' => $idUsu]);
        }
    }

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
        $idHilo = $_GET["idHilo"];

        Hilo::borrar($idHilo);
        header("location:index.php?con=Hilo&ope=listar");
    }

    public function increase() {
        $idHilo = $_GET["idHilo"];
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        Hilo::sumar($idHilo);
        header("location:index.php?con=Hilo&ope=ver&id=$idHilo");
    }

    public function decrease() {
        $idHilo = $_GET["idHilo"];
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        Hilo::restar($idHilo);
        header("location:index.php?con=Hilo&ope=ver&id=$idHilo");
    }

}
