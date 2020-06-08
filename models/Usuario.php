<?php

/**
 * Class Usuario
 * @author Fabio Benitez Ramirez
 */
class Usuario {

    /**
     * idUsu
     *
     * @var mixed
     */
    private $idUsu;

    /**
     * email
     *
     * @var mixed
     */
    private $email;

    /**
     * pass
     *
     * @var mixed
     */
    private $pass;

    /**
     * nombre
     *
     * @var mixed
     */
    private $nombre;

    /**
     * apellidos
     *
     * @var mixed
     */
    private $apellidos;

    /**
     * fec_nac
     *
     * @var mixed
     */
    private $fec_nac;

    /**
     * foto
     *
     * @var mixed
     */
    private $foto;

    /**
     * SerMod
     *
     * @var mixed
     */
    private $SerMod;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        
    }

    /**
     * getIdUsu
     *
     * @return void
     */
    public function getIdUsu() {
        return $this->idUsu;
    }

    /**
     * setIdUsu
     *
     * @param  mixed $idUsu
     * @return void
     */
    public function setIdUsu($idUsu) {
        $this->idUsu = $idUsu;

        return $this;
    }

    /**
     * getPass
     *
     * @return void
     */
    public function getPass() {
        return $this->pass;
    }

    /**
     * setPass
     *
     * @param  mixed $pass
     * @return void
     */
    public function setPass($pass) {
        return $this->pass = $pass;
    }

    /**
     * getNombre
     *
     * @return void
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * setNombre
     *
     * @param  mixed $nom
     * @return void
     */
    public function setNombre($nom) {
        return $this->nombre = $nom;
    }

    /**
     * getApellidos
     *
     * @return void
     */
    public function getApellidos() {
        return $this->apellidos;
    }

    /**
     * setApellidos
     *
     * @param  mixed $ape
     * @return void
     */
    public function setApellidos($ape) {
        return $this->apellidos = $ape;
    }

    /**
     * getEmail
     *
     * @return void
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * setEmail
     *
     * @param  mixed $email
     * @return void
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * setFecha
     *
     * @param  mixed $fec_nacimiento
     * @return void
     */
    public function setFecha($fec_nacimiento) {
        $this->fec_nac = $fec_nacimiento;

        return $this;
    }

    /**
     * getFecha
     *
     * @return void
     */
    public function getFecha() {
        return $this->fec_nac;
    }

    /**
     * setFoto
     *
     * @param  mixed $foto
     * @return void
     */
    public function setFoto($foto) {
        $this->foto = $foto;

        return $this;
    }

    /**
     * getFoto
     *
     * @return void
     */
    public function getFoto() {
        return $this->foto;
    }

    /**
     * getSerMod
     *
     * @return void
     */
    function getSerMod() {
        return $this->SerMod;
    }

    /**
     * setSerMod
     *
     * @param  mixed $SerMod
     * @return void
     */
    function setSerMod($SerMod) {
        $this->SerMod = $SerMod;
    }

    /**
     * __toString
     *
     * @return void
     */
    public function __toString() {
        try {
            return(string) $this->nombre;
        } catch (Exception $exception) {
            return('');
        }
    }

    /**
     * get all the information of the all the users
     *
     * @return void
     */
    public static function findAll() {
        $db = Database::getInstance();
        $db->query("SELECT * FROM usuario ;");

        $data = [];
        while ($obj = $db->getObject("Usuario"))
            array_push($data, $obj);


        return $data;
    }

    /**
     * get all the information of the user that have the id = $idUsu
     *
     * @param [type] $idUsu
     * @return Usuario
     */
    public static function find($idUsu): Usuario {
        $db = Database::getInstance();
        $db->query("SELECT * FROM usuario  WHERE idUsu = $idUsu;");

        return $db->getObject("Usuario");
    }

    /**
     * Get data from users thah they want to change the password
     *
     * @return void
     */
    public static function findPass($email, $fecn): Usuario {
        $db = Database::getInstance();
        $db->query("SELECT * FROM usuario WHERE email='$email' and fec_nac ='$fecn' ;");

        return $db->getObject("Usuario");
    }

    /**
     * Get data from users who want to be moderators
     *
     * @return void
     */
    public static function MostrarMod() {


        $db = Database::getInstance();
        $db->query("SELECT * FROM usuario us where Sermod = 1  Order by nombre");

        $data = [];
        while ($obj = $db->getObject("Usuario"))
            array_push($data, $obj);

        //
        return $data;
    }

    /**
     * delete the user where the id = $this->idUsu
     *
     * @return void
     */
    public function eliminar() {
        $db = Database::getInstance();
        $db->query("delete from usuario where idUsu={$this->idUsu};");
    }

    /**
     * convert to admin to user
     *
     * @return void
     */
    public function hacerAdmin() {
        $db = Database::getInstance();
        $tipo = "Admin";
        $db->query("Update usuario set Tipo ='$tipo' where idUsu={$this->idUsu};");
    }
   /**
     * make the user a moderator
     *
     * @return void
     */
    public function hacerMod() {
        $db = Database::getInstance();
        $tipo = "Moderador";
        $db->query("Update usuario set Tipo ='$tipo' , SerMod = 0 where idUsu={$this->idUsu};");
    }
 /**
     * Dont make the user a moderator
     *
     * @return void
     */
    public function NoSerMod() {
        $db = Database::getInstance();
        $SerMod = "0";
        $db->query("Update usuario set SerMod ='$SerMod' where idUsu={$this->idUsu};");
    }
      /**
     * Submit a request to be a moderator
     *
     * @return void
     */

    public function SerMod() {
        $db = Database::getInstance();
        $SerMod = "1";
        $db->query("Update usuario set SerMod ='$SerMod'  where idUsu={$this->idUsu};");
    }
/**
     * Insert a new user in the database
     *
     * @return void
     */
    public function insertar() {
        $db = Database::getInstance();
        $consulta = "INSERT INTO usuario (email,pass,nombre,apellidos,fec_nac)  values ('{$this->email}',md5('{$this->pass}'),'{$this->nombre}','{$this->apellidos}','{$this->fec_nac}');";

        $db->query($consulta);

        $this->idUsu = $db->lastId();
    }

    /**
     * Updtate the data of user 
     *
     * @return void
     */
    public function save() {

        $db = Database::getInstance();
        $consulta = "update usuario set nombre='" . $this->nombre . "',email='" . $this->email . "',fec_nac='" . $this->fec_nac . "',apellidos='" . $this->apellidos . "' where idUsu=" . $this->idUsu;

        //echo $consulta;
        $db->query($consulta);
    }

    /**
     * Updtate the pass of user 
     *
     * @return void
     */
    public function changePass() {

        $db = Database::getInstance();
        $consulta = "update usuario set pass=md5('{$this->pass}')  where idUsu=" . $this->idUsu;

      
        $db->query($consulta);
    }

}
