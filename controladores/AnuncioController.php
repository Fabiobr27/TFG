<?php

require_once "BaseController.php";
require_once "modelos/Usuario.php";
require_once "modelos/Anuncio.php";
require_once "modelos/Imagenes.php";
require_once "libs/Sesion.php";

class AnuncioController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function listar() {
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        $dat = Anuncio::findAll();

        echo $this->twig->render("showAnuncio.php.twig", ['dat' => $dat, 'idUsu' => $idUsu]);
    }

    public function listarCreados() {
        $id = $_GET['id'];
        $dat = Anuncio::findAnuncio($id);
        $usu = Usuario::find($id);
        echo $this->twig->render("showAnuncioCreados.php.twig", ['dat' => $dat, 'idUsu' => $id , 'usu' => $usu]);
    }

    public function add() {
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        if (isset($_GET["Descripcion"])) {
            $Anio = $_GET["Anio"];
            $Color = $_GET["Color"];
            $Modelo = $_GET["Modelo"];
            $Kilometro = $_GET["Kilometro"];
            $Precio = $_GET["Precio"];
            $Imagen = $_GET["Imagen"];
            $Telefono = $_GET["Telefono"];
            $Descripcion = $_GET["Descripcion"];
            $Combustible = $_GET["Combustible"];
            $Cabecera = $_GET["Cabecera"];
            $Marca = $_GET["Marca"];
            $Anuncio = new Anuncio();

            $Anuncio->setAnio($Anio);
            $Anuncio->setColor($Color);
            $Anuncio->setCombustible($Combustible);
            $Anuncio->setModelo($Modelo);
            $Anuncio->setKilometros($Kilometro);
            $Anuncio->setDescripcion($Descripcion);
            $Anuncio->setTelefono($Telefono);
            $Anuncio->setImagen($Imagen);
            $Anuncio->setPrecio($Precio);
            $Anuncio->setMarca($Marca);
            $Anuncio->setCabecera($Cabecera);




            $Anuncio->setIdUsu($idUsu);

            $Anuncio->insertar();

            header("location: index.php?con=Anuncio&ope=listar");
        } else {
            echo $this->twig->render("addAnuncio.php.twig", ['idUsu' => $idUsu]);
        }
    }

    public function edit() {
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        $idAnuncio = $_GET["idAnuncio"];

        if (isset($_GET["Descripcion"])) {
            $Anio = $_GET["Anio"];
            $Color = $_GET["Color"];
            $Modelo = $_GET["Modelo"];
            $Kilometro = $_GET["Kilometro"];
            $Precio = $_GET["Precio"];
            $Imagen = $_GET["Imagen"];
            $Telefono = $_GET["Telefono"];
            $Descripcion = $_GET["Descripcion"];
            $Combustible = $_GET["Combustible"];
            $Cabecera = $_GET["Cabecera"];
            $Marca = $_GET["Marca"];
            $Anuncio = new Anuncio();

            $Anuncio->setAnio($Anio);
            $Anuncio->setColor($Color);
            $Anuncio->setCombustible($Combustible);
            $Anuncio->setModelo($Modelo);
            $Anuncio->setKilometros($Kilometro);
            $Anuncio->setDescripcion($Descripcion);
            $Anuncio->setTelefono($Telefono);
            $Anuncio->setImagen($Imagen);
            $Anuncio->setPrecio($Precio);
            $Anuncio->setMarca($Marca);
            $Anuncio->setCabecera($Cabecera);






            $Anuncio->guardar($idAnuncio);

            header("location: index.php?con=Anuncio&ope=Listar");
        } else {
            $Anuncio = Anuncio::find($idAnuncio);
            echo $this->twig->render("editAnuncio.php.twig", (['anuncio' => $Anuncio, 'idUsu' => $idUsu]));
        }
    }

    public function ver() {
        $idAnuncio = $_GET["idAnuncio"];
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $idUsu = $id;
        $usuario = Usuario::find($idUsu);
        $Anuncio = Anuncio::find($idAnuncio);
        $imagen = Imagenes::findAll($idAnuncio);
        echo $this->twig->render("verAnuncio.php.twig", (['anuncio' => $Anuncio, 'img' => $imagen, 'usuario' => $usuario]));
    }

    public function delete() {
        $idHilo = $_GET["id"];

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
