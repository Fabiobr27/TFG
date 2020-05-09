
<?php

//Fabio Benitez Ramirez
require_once("Database.php");
require_once("modelos/Usuario.php");

class Sesion {

    public $usuario;
    private $time_expire = 1800;    // segundos
    private static $instancia = null;

    /**
     */
    private function __construct() {
        
    }

    /**
     */
    private function __clone() {
        
    }

    /**
     */
    public function getUsuario() {
        return $this->usuario;
    }

    /**
     */
    public function close() {

        session_unset();

        session_destroy();
    }

    public static function getInstance() {
        session_start();

        if (isset($_SESSION["_sesion"])):
            self::$instancia = unserialize($_SESSION["_sesion"]);
        else:
            if (self::$instancia === null)
                self::$instancia = new Sesion();
        endif;


        return self::$instancia;
    }
public function redirect(string $url)
		{
			header("Location: $url") ;
			die() ;
		}
    public function login(string $ema, string $pas): bool {

        $db = Database::getInstance();


        $sql = "SELECT * FROM usuario WHERE email='$ema' AND pass=MD5($pas) ;";
        $db->query($sql);

        if ($user = $db->getObject("Usuario")):


            $this->usuario = $user->getIdUsu();

            $_SESSION["time"] = time();
            $_SESSION["_sesion"] = serialize(self::$instancia);


            return true;

        endif;


        return false;
    }

    public function isExpired(): bool {
        return (time() - $_SESSION["time"] > $this->time_expire);
    }

    public function isLogged(): bool {
        return !empty($_SESSION);
    }

    public function checkActiveSession(): bool {
        if ($this->isLogged())
            if (!$this->isExpired())
                return true;

        return false;
    }

}
