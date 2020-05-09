<?php

// Modelo Usuario
//Fabio Benitez Ramirez
class Usuario {

    private $idUsu;
    private $email;
    private $pass;
    private $nombre;
    private $apellidos;
    private $fec_nac;
    private $foto;

    public function __construct() {
        
    }

    public function getIdUsu() {
        return $this->idUsu;
    }

    public function setIdUsu($idUsu) {
        $this->idUsu = $idUsu;

        return $this;
    }

    public function getPass() {
        return $this->pass;
    }

    public function setPass($pass) {
        return $this->pass = $pass;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nom) {
        return $this->nombre = $nom;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function setApellidos($ape) {
        return $this->apellidos = $ape;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    public function setFecha($fec_nacimiento) {
        $this->fec_nac = $fec_nacimiento;

        return $this;
    }

    public function getFecha() {
        return $this->fec_nac;
    }

    public function setFoto($foto) {
        $this->foto = $foto;

        return $this;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function __toString() {
        try {
            return(string) $this->nombre;
        } catch (Exception $exception) {
            return('');
        }
    }

    public static function findAll() {
        $db = Database::getInstance();
        $db->query("SELECT * FROM usuario ;");

        $data = [];
        while ($obj = $db->getObject("Usuario"))
            array_push($data, $obj);


        return $data;
    }

    public static function find($idUsu): Usuario {
        $db = Database::getInstance();
        $db->query("SELECT * FROM usuario  WHERE idUsu = $idUsu;");

        return $db->getObject("Usuario");
    }

     public static function findMensajes($idUsu): Usuario {
        $db = Database::getInstance();
        $db->query("SELECT count(*)as mensajes FROM  usuario u, respuesta r WHERE u.idUsu=r.idUsu and u.idUsu = $idUsu;");

        return $db->getObject("Usuario");
    }
    
     public static function findHilos($idUsu): Usuario {
        $db = Database::getInstance();
        $db->query("SELECT count(*)as Hilo FROM  usuario u, Hilo h WHERE u.idUsu=h.idUsu and u.idUsu = $idUsu;");

        return $db->getObject("Usuario");
    }
    
    
      public static function findAnuncios($idUsu): Usuario {
        $db = Database::getInstance();
        $db->query("SELECT count(*)as Anuncios FROM  usuario u, Anuncio a WHERE u.idUsu=a.idUsu and u.idUsu = $idUsu;");

        return $db->getObject("Usuario");
    }
    
    
    
    public function eliminar() {
        $db = Database::getInstance();
        $db->query("delete from usuario where idUsu={$this->idUsu};");
    }

    public function hacerAdmin() {
        $db = Database::getInstance();
        $tipo = "Admin";
        $db->query("Update usuario set Tipo ='$tipo' where idUsu={$this->idUsu};");
    }

    public function insertar() {
        $db = Database::getInstance();
        $consulta = "INSERT INTO usuario (email,pass,nombre,apellidos,fec_nac)  values ('{$this->email}',md5('{$this->pass}'),'{$this->nombre}','{$this->apellidos}','{$this->fec_nac}');";


        $db->query($consulta);
        $this->idUsu = $db->lastId();
    }

    public function save() {

        $db = Database::getInstance();
        $consulta = "update usuario set nombre='" . $this->nombre . "',email='" . $this->email . "',fec_nac='" . $this->fec_nac . "',apellidos='" . $this->apellidos . "' where idUsu=" . $this->idUsu;

        //echo $consulta;
        $db->query($consulta);
    }

}
