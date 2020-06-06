<?php

require_once "models/Marca.php";
require_once "BaseController.php";
require_once "libs/Sesion.php";
require_once("libs/Database.php");

/**
 * Class loginController
 * @author Fabio Benitez Ramirez
 */
class loginController extends BaseController {

    private $error = false;

    public function __construct() {
        parent::__construct();
    }

    /**
     * If the session exists: we send the main
     * If not: we show the login
     *
     * @return void
     */
    public function show() {
        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $usuario = Usuario::find($sesion->getUsuario());

            $this->goMain($sesion->getUsuario());
        } else {
            echo $this->twig->render("showLogin.php.twig", ['error' => $this->error]);
        }
    }

    /**
     * We check if the data sent by the user exist,
     * if the user exists we will redirect to the main
     * and if it does not exist, continue in the login
     *
     * @return void
     */
    public function signin() {
        if (isset($_POST['email'])) {
            $ses = Sesion::getInstance();

            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $pass = isset($_POST['pass']) ? $_POST['pass'] : null;

            //we check if it exists
            $existe = $ses->login($email, $pass);
            if ($existe) {
                $idUsu = $ses->getUsuario();
                $usuario = Usuario::find($idUsu);
            }
            // if the user exists we will redirect to the main

            if ($existe) {
                $this->goMain($ses->getUsuario());
            } else {
                $this->error = true;
                echo $this->twig->render("showLogin.php.twig", ['error' => $this->error]);
            }
        }
    }

    /**
     * shows a form to insert the data of the new user and once filled it inserts them
     *
     * @return void
     */
    public function registro() {
        $db = Database::getInstance();
        if (!isset($_GET["nombre"])):

            echo $this->twig->render("registro.php.twig");
        else:

            $email = $_GET["email"];



            $sql = "SELECT * FROM usuario WHERE email='$email' ;";
            $db->query($sql);


//We check that the email does not already exist
            if ($user = $db->getObject("Usuario")) {
                $this->error = true;
                echo $this->twig->render("registro.php.twig", ['error' => $this->error]);
            } else {
                $nom = $_GET["nombre"];
                $fec = $_GET["fnac"];
                $ape = $_GET["apellidos"];
                $pass = $_GET["pass"];
                $ema = $_GET["email"];

                $usu = new Usuario();
                $usu->setNombre($nom);
                $usu->setFecha($fec);
                $usu->setApellidos($ape);
                $usu->setPass($pass);
                $usu->setEmail($ema);


                $usu->insertar();

                $sesion = Sesion::getInstance();
                if ($sesion->login($ema, $pass)) {
                    $id = $sesion->getUsuario();
                    header("location:?con=login&ope=goMain&id=$id");
                }
            }
        endif;
    }

    /**
     * 
     * If the user has logged in, we will send him to the main
     * @param  mixed $id
     * @return void
     */
    public function goMain($id = null) {
        $idUsu = $_GET["id"] ?? $id;
        $data = Marca::findAll();

        echo $this->twig->render("showMarcas.php.twig", (['dat' => $data, 'idUsu' => $idUsu]));
    }
 /**
     * We close the user session
     *
     * @return void
     */
    public function logout() {
        $ses = Sesion::getInstance();
        $ses->close();
        $ses->redirect("index.php");
    }

    public function recuperarPass() {

        if (!isset($_GET["email"])):

            echo $this->twig->render("recuperarPass.php.twig");
        else:



            $nom = $_GET["nombre"];
            $fec = $_GET["fnac"];
            $ape = $_GET["apellidos"];
            $pass = $_GET["pass"];
            $ema = $_GET["email"];

            $usu = new Usuario();
            $usu->setNombre($nom);
            $usu->setFecha($fec);
            $usu->setApellidos($ape);
            $usu->setPass($pass);
            $usu->setEmail($ema);


            $usu->insertar();

            $sesion = Sesion::getInstance();
            if ($sesion->login($ema, $pass)) {
                $id = $sesion->getUsuario();
                header("location:?con=login&ope=goMain&id=$id");
            }



        endif;
    }
     /**
     * We check if the user knows their email and 
      * their date of birth to send them a form to change their password
     *
     * @return void
     */

    public function recordarPass() {
        $db = Database::getInstance();
        if (!isset($_GET["email"])):

            echo $this->twig->render("recordarPass.php.twig");
        else:

            $email = $_GET["email"];
            $fecha = $_GET["fnac"];


            $sql = "SELECT * FROM usuario WHERE email='$email' and 	fec_nac  = '$fecha';";

            $db->query($sql);


//We check that the email does not already exist
            if ($user = $db->getObject("Usuario")) {
                $this->error = true;
                echo $this->twig->render("recordarPass.php.twig", ['error' => $this->error, 'user' => $user]);
            } else {

                header("location: index.php?con=login&ope=recordarPass");
            }

        endif;
    }

    /**
     * Change the pass when the user forgets it
     *
     * @return void
     */
    public function cambiarPass() {
        $sesion = Sesion::getInstance();

        if (isset($_GET["pass"])) {
            $Pass = $_GET["pass"];
            $idUsu = $_GET["idUsu"];
            $post = new Usuario;

            $post->setPass($Pass);
            $post->setIdUsu($idUsu);

            $post->changePass();

            header('Location: index.php');
        }
    }

}
