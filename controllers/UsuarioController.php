<?php

// Controlador Usuario
//Fabio Benitez Ramirez
require_once "BaseController.php";
require_once "libs/Sesion.php";
require_once "models/Usuario.php";

class UsuarioController extends BaseController {

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

    public function mostrarPerfil() {

        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $tip = Usuario::find($id);
        $dat = Usuario::find($id);
        $mod = Usuario::MostrarMod();
        //$men = Usuario::findMensajes($id);
         // $hilo = Usuario::findHilos($id);
         // $anuncio = Usuario::findAnuncios($id);
        echo $this->twig->render("showPerfil.php.twig", ['dat' => $dat, 'tip' => $tip , 'mod' =>$mod]);
    }

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

    public function mostrarCuentas() {
        $dat = Usuario::findAll();
        echo $this->twig->render("showCuentas.php.twig", ['dat' => $dat]);
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

    
    public function borrar() {
        $id = $_GET['id'];
        $usu = Usuario::find($id);

        $usu->eliminar();


        header("Location: index.php?con=Usuario&ope=mostrarCuentas");
    }

    public function hacerAdmin() {
        $id = $_GET['id'];
        $usu = Usuario::find($id);

        $usu->hacerAdmin();

        header("Location: index.php?con=Usuario&ope=mostrarCuentas");
    }
      public function SolicitarMod() {
          $sesion = Sesion::getInstance();
        $idU = $sesion->getUsuario();
        $id = $_GET['id'];
        $usu = Usuario::find($id);

        $usu->SerMod();

        header("Location: index.php?con=Usuario&ope=mostrarPerfil&id=$idU");
    }
 public function HacerMod() {
          $sesion = Sesion::getInstance();
        $idU = $sesion->getUsuario();
        $id = $_GET['id'];
        $usu = Usuario::find($id);

        $usu->hacerMod();

          header("Location: index.php?con=Usuario&ope=mostrarPerfil&id=$idU");
    }
    
     public function NoHacerMod() {
          $sesion = Sesion::getInstance();
        $idU = $sesion->getUsuario();
        $id = $_GET['id'];
        $usu = Usuario::find($id);

        $usu->NoSerMod();

          header("Location: index.php?con=Usuario&ope=mostrarPerfil&id=$idU");
    }
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
