<?php

require_once "BaseController.php";
require_once "models/Usuario.php";
require_once "models/Noticia.php";
require_once "models/Respuesta.php";
require_once "libs/Sesion.php";

//require_once "modelos/Respuesta.php";

class NoticiaController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function listar() {
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        $dat = Noticia::findAll();

        $tip = Usuario::find($id);
        echo $this->twig->render("showNoticia.php.twig", ['dat' => $dat, 'idUsu' => $idUsu, 'tip' => $tip ]);
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
        if (isset($_GET["Desarrollo"])) {
            $Desarrollo= $_GET["Desarrollo"];
            $titulo = $_GET["Titulo"];
            $post = new Noticia;

            $post->setDesarrollo($Desarrollo);
            $post->setTitulo($titulo);
            $post->setIdUsu($idUsu);

            $post->insertar();

            header("location: index.php?con=Noticia&ope=listar");
        } else {
            echo $this->twig->render("addNoticia.php.twig", ['idUsu' => $idUsu]);
        }
    }

    public function edit() {
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        $idNoticia = $_GET["idNoticia"];

        if (isset($_GET["Desarrollo"])) {
            $Desarrollo= $_GET["Desarrollo"];
            $Titulo = $_GET["titulo"];
            $not= new Noticia();
          
            $not->setDesarrollo($Desarrollo);
            $not->setTitulo($Titulo);
            

            $not->guardar($idNoticia);

          header("location: index.php?con=Noticia&ope=listar");
        } else {
            $Noticia =Noticia::find($idNoticia);
            echo $this->twig->render("editNoticia.php.twig", (['Noticia' => $Noticia, 'idUsu' => $idUsu]));
        }
    }



    public function delete() {
        $idNoticia = $_GET["idNoticia"];

        Noticia::borrar($idNoticia);
        header("location:index.php?con=Noticia&ope=listar");
    }



}
