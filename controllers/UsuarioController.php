<?php

// Controlador Usuario
//Fabio Benitez Ramirez
require_once "BaseController.php";
require_once "libs/Sesion.php";
require_once "models/Usuario.php";

/**
 * Class UsuarioController
 * @author Fabio Benitez Ramirez 
 */
class UsuarioController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Check if there is a session started, 
     * if there is, it takes you to the main,
     *  if it does not, it sends you to the login
     *
     * @return void
     */
    public function mostrar() {
        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $this->inicio();
        } else {
            echo $this->twig->render("login.php.twig");
        }
    }

    /**
     * Show your personal profile
     *
     * @return void
     */
    public function mostrarPerfil() {

        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $id = $sesion->getUsuario();
            $tip = Usuario::find($id);
            $dat = Usuario::find($id);
            $mod = Usuario::MostrarMod();

            echo $this->twig->render("showPerfil.php.twig", ['dat' => $dat, 'tip' => $tip, 'mod' => $mod]);
        } else {
            header('Location: index.php');
        }
    }

    /**
     * Show another user's profile
     *
     * @return void
     */
    public function mostrarPerfilAjeno() {
        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $idUsu = $sesion->getUsuario();
            $id = $_GET['id'];
            $tip = Usuario::find($idUsu);
            $dat = Usuario::find($id);
            $hilo = Usuario::findHilos($id);
            $anuncio = Usuario::findAnuncios($id);
            echo $this->twig->render("showPerfilAjeno.php.twig", ['dat' => $dat, 'men' => $men, 'hilo' => $hilo, 'anuncio' => $anuncio, 'tip' => $tip]);
        } else {
            header('Location: index.php');
        }
    }

    /**
     * Show accounts of all users
     *
     * @return void
     */
    public function mostrarCuentas() {
        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $dat = Usuario::findAll();
            echo $this->twig->render("showCuentas.php.twig", ['dat' => $dat]);
        } else {
            header('Location: index.php');
        }
    }

    /**
     * Login with email and password
     *
     * @return void
     */
    public function IniciarSesion() {

        if (isset($_GET['email'])) {
            $ses = Sesion::getInstance();

            $email = $_GET['email'];
            $pass = $_GET['pass'];

            $existe = $ses->login($email, $pass);

            if ($existe) {
                $this->inicio();
            } else {

                echo $this->twig->render("login.php.twig");
            }
        }
    }

    /**
     * Shows you the main page
     * @return void
     */
    public function inicio() {
        $dat = Marca::findAll();
        echo $this->twig->render("showMarcas.php.twig", ['dat' => $dat]);
    }

    /**
     * delete a user
     *
     * @return void
     */
    public function borrar() {
        $id = $_GET['id'];
        $usu = Usuario::find($id);

        $usu->eliminar();


        header("Location: index.php?con=Usuario&ope=mostrarCuentas");
    }

    /**
     * turns an administrator into a user
     *
     * @return void
     */
    public function hacerAdmin() {
        $id = $_GET['id'];
        $usu = Usuario::find($id);

        $usu->hacerAdmin();

        header("Location: index.php?con=Usuario&ope=mostrarCuentas");
    }

    /**
     * Apply to be a moderator
     *
     * @return void
     */
    public function SolicitarMod() {
        $sesion = Sesion::getInstance();
        $idU = $sesion->getUsuario();
        $id = $_GET['id'];
        $usu = Usuario::find($id);

        $usu->SerMod();

        header("Location: index.php?con=Usuario&ope=mostrarPerfil&id=$idU");
    }

    /**
     * Make the user a moderator
     *
     * @return void
     */
    public function HacerMod() {
        $sesion = Sesion::getInstance();
        $idU = $sesion->getUsuario();
        $id = $_GET['id'];
        $usu = Usuario::find($id);

        $usu->hacerMod();

        header("Location: index.php?con=Usuario&ope=mostrarPerfil&id=$idU");
    }
  /**
     * Dont make the user a moderator
     *
     * @return void
     */
    public function NoHacerMod() {
        $sesion = Sesion::getInstance();
        $idU = $sesion->getUsuario();
        $id = $_GET['id'];
        $usu = Usuario::find($id);

        $usu->NoSerMod();

        header("Location: index.php?con=Usuario&ope=mostrarPerfil&id=$idU");
    }
 /**
     * shows a form to edit the user data and once filled it updates it
     *
     * @return void
     */
    public function editar() {
        // buscamos el tablero
        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $dat = Usuario::find($_GET["id"]);

        if (!isset($_GET["nom"])):

            // mostramos el formulario de edición
            //require_once "vistas/editBoard.php" ;
            echo $this->twig->render("editCuenta.php.twig", ['dat' => $dat]);
        else:

            // actualizar la información en la 
            // base de datos.
            $nom = $_GET["nom"];
            $fec = $_GET["fec"];
            $ape = $_GET["ape"];
            $ema = $_GET["ema"];
            // actualizar los datos

            $dat->setNombre($nom);
            $dat->setFecha($fec);
            $dat->setApellidos($ape);
            $dat->setEmail($ema);

            // refrescar el objeto en la base de datos
            $dat->save();

            // redirigimos a la página principal
            header("Location: index.php?con=Usuario&ope=mostrarPerfil&id=$id");

        endif;
    }

}
