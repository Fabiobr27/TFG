<?php

require_once "BaseController.php";
require_once "models/Usuario.php";
require_once "models/Anuncio.php";
require_once "models/Imagenes.php";
require_once "libs/Sesion.php";

/**
 * Class Anuncio Controller
 * @author Fabio Benitez Ramirez
 */
class AnuncioController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get the necessary data for the view and displays it
     *
     * @return void
     */
    public function listar() {
        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $id = $sesion->getUsuario();
            $idUsu = $id;
            $dat = Anuncio::findAll();

            echo $this->twig->render("showAnuncio.php.twig", ['dat' => $dat, 'idUsu' => $idUsu]);
        } else {
            header('Location: index.php');
        }
    }

    /**
     * shows  the multimedia section
     *
     * @return void
     */
    public function verMultimedia() {
        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $idUsu = $sesion->getUsuario();

            echo $this->twig->render("showMultimedia.php.twig", ['idUsu' => $idUsu]);
        } else {
            header('Location: index.php');
        }
    }

    /**
     * Show user-created ads
     *
     * @return void
     */
    public function listarCreados() {
        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $id = $_GET['id'];
            $dat = Anuncio::findAnuncio($id);
            $usu = Usuario::find($id);
            echo $this->twig->render("showAnuncioCreados.php.twig", ['dat' => $dat, 'idUsu' => $id, 'usu' => $usu]);
        } else {
            header('Location: index.php');
        }
    }

/**
     * shows a form to insert the data of the ad and once filled it inserts them
     *
     * @return void
     */

    public function add() {
        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
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
        } else {
            header("location: index.php");
        }
    }
 /**
     * shows a form to edit the ad data and once filled it updates it
     *
     * @return void
     */
    public function edit() {
        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
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
        } else {
            header("location: index.php");
        }
    }
    /**
     * Show the details of a specific ad
     *
     * @return void
     */
    public function ver() {

        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $idAnuncio = $_GET["idAnuncio"];

            $id = $sesion->getUsuario();
            $idUsu = $id;
            $usuario = Usuario::find($idUsu);
            $Anuncio = Anuncio::find($idAnuncio);
            $imagen = Imagenes::find($idAnuncio);
            echo $this->twig->render("verAnuncio.php.twig", (['anuncio' => $Anuncio, 'img' => $imagen, 'usuario' => $usuario]));
        } else {
            header('Location: index.php');
        }
    }
    /**
     * Delete a ad
     *
     * @return void
     */

    public function delete() {
        $idAnuncio = $_GET["idAnuncio"];

        Anuncio::borrar($idAnuncio);
        header("location:index.php?con=Anuncio&ope=listar");
    }

  
}
