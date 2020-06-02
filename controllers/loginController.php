<?php

require_once "models/Marca.php";
require_once "BaseController.php";
require_once "libs/Sesion.php";
require_once("libs/Database.php");

class loginController extends BaseController {

    private $error = false;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Si la sesion existe: mandamos al main
     * Si no: mostramos el login
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

    public function signin() {
        if (isset($_POST['email'])) {
            $ses = Sesion::getInstance();
            // $idUsu = $ses->getUsuario()??0;
            // if ($ses->checkActiveSession()) $this->goMain($ses);
            //login con email y contraseña
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $pass = isset($_POST['pass']) ? $_POST['pass'] : null;

            //comprobamos si es admin
            $existe = $ses->login($email, $pass);
            if ($existe) {
                $idUsu = $ses->getUsuario();
                $usuario = Usuario::find($idUsu);
            }
            // si el usuario existe redigirimos al main

            if ($existe) {
                $this->goMain($ses->getUsuario());
            } else {
                $this->error = true;
                echo $this->twig->render("showLogin.php.twig", ['error' => $this->error]);
            }
        }
    }

    public function registro() {
        $db = Database::getInstance();
        if (!isset($_GET["nombre"])):

            echo $this->twig->render("registro.php.twig");
        else:

            $email = $_GET["email"];



            $sql = "SELECT * FROM usuario WHERE email='$email' ;";
            $db->query($sql);



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

    public function goMain($id = null) {
        $idUsu = $_GET["id"] ?? $id;
        $data = Marca::findAll();

        echo $this->twig->render("showMarcas.php.twig", (['dat' => $data, 'idUsu' => $idUsu]));
    }

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

}
