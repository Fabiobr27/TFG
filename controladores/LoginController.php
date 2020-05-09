<?php
// Controlador Login
//Fabio Benitez Ramirez
require_once "BaseController.php";
require_once "libs/Sesion.php";
require_once "modelos/Marca.php";
require_once "modelos/Usuario.php";

class LoginController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function mostrar() {
        $sesion = Sesion::getInstance();
        if ($sesion->checkActiveSession()) {
            $this->inicio();
        } else {
            echo $this->twig->render("login.php.twig");
        }
    }

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

    public function inicio() {
        $dat = Marca::findAll();
        echo $this->twig->render("showMarcas.php.twig", ['dat' => $dat]);
    }

    public function logout() {


        $ses = Sesion::getInstance();
        $ses->close();
        $ses->redirect("index.php");
   
    }

    public function registro() {

        if (!isset($_GET["nombre"])):

            echo $this->twig->render("registro.php.twig");
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

            
           header("Location: index.php");

        endif;
    }

}
