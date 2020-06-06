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
    /**
     * Obtain the necessary data to show the news
     *
     * @return void
     */
     public function listar() {
        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
        $id = $sesion->getUsuario();
        $idUsu = $id;
        $dat = Noticia::findAll();

        $tip = Usuario::find($id);
        echo $this->twig->render("showNoticia.php.twig", ['dat' => $dat, 'idUsu' => $idUsu, 'tip' => $tip]);
        }else{
           header("location: index.php");
        }
    }
 /**
     * shows a form to insert the data of the news and once filled it inserts them
     *
     * @return void
     */
 

    public function add() {
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
         $sesion = Sesion::getInstance();
     if ($sesion->checkActiveSession()) {

            $Desarrollo= $_GET["Desarrollo"];
            $titulo = $_GET["Titulo"];
            $post = new Noticia;

            $post->setDesarrollo($Desarrollo);
            $post->setTitulo($titulo);
            $post->setIdUsu($idUsu);

            $post->insertar();

            header("location: index.php?con=Noticia&ope=listar");
       
     }else{
            header("location: index.php");
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


 /**
     * delete a new
     *
     * @return void
     */
    public function delete() {
        $idNoticia = $_GET["idNoticia"];

        Noticia::borrar($idNoticia);
        header("location:index.php?con=Noticia&ope=listar");
    }



}
