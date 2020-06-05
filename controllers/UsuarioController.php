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
        $id = $sesion->getUsuario();
        $tip = Usuario::find($id);
        $dat = Usuario::find($id);
        $mod = Usuario::MostrarMod();
        //$men = Usuario::findMensajes($id);
        // $hilo = Usuario::findHilos($id);
        // $anuncio = Usuario::findAnuncios($id);
        echo $this->twig->render("showPerfil.php.twig", ['dat' => $dat, 'tip' => $tip, 'mod' => $mod]);
    }

    /**
     * Show another user's profile
     *
     * @return void
     */
    public function mostrarPerfilAjeno() {
        $sesion = Sesion::getInstance();
        $idUsu = $sesion->getUsuario();
        $id = $_GET['id'];
        $tip = Usuario::find($idUsu);
        $dat = Usuario::find($id);
        $hilo = Usuario::findHilos($id);
        $anuncio = Usuario::findAnuncios($id);
        echo $this->twig->render("showPerfilAjeno.php.twig", ['dat' => $dat, 'men' => $men, 'hilo' => $hilo, 'anuncio' => $anuncio, 'tip' => $tip]);
    }

    /**
     * Show accounts of all users
     *
     * @return void
     */
    public function mostrarCuentas() {
        $dat = Usuario::findAll();
        echo $this->twig->render("showCuentas.php.twig", ['dat' => $dat]);
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

        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $dat = Usuario::find($_GET["id"]);

        if (!isset($_GET["nom"])):


            echo $this->twig->render("editCuenta.php.twig", ['dat' => $dat]);
        else:

            $nom = $_GET["nom"];
            $fec = $_GET["fec"];
            $ape = $_GET["ape"];
            $ema = $_GET["ema"];


            $dat->setNombre($nom);
            $dat->setFecha($fec);
            $dat->setApellidos($ape);
            $dat->setEmail($ema);


            $dat->save();


            header("Location: index.php?con=Usuario&ope=mostrarPerfil&id=$id");

        endif;
    }

}
