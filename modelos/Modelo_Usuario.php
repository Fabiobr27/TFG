<?php

// Modelo Modelo_Usuario
//Fabio Benitez Ramirez
require_once 'modelos/Modelo.php';
require_once 'modelos/Usuario.php';
require_once 'modelos/Marca.php';
require_once "libs/Sesion.php";

class Modelo_Usuario {

    private $CodigoMod;
    private $idUsu;
    private $favorito;
    private $Comentario;

    public function __construct() {
        
    }

    public function getidUsu() {
        return $this->idUsu;
    }

    public function setidUsu($idUsu) {
        $this->idUsu = $idUsu;

        return $this;
    }

    public function getfavorito() {
        return $this->favorito;
    }

    public function setfavorito($favorito) {
        $this->favorito = $favorito;

        return $this;
    }

    function getComentario() {
        return $this->Comentario;
    }

    function setComentario($Comentario) {
        $this->Comentario = $Comentario;
    }

    public function getcodigoMod() {
        return $this->CodigoMod;
    }

    public function setcodigoMod($codMod) {
        $this->CodigoMod = $codMod;

        return $this;
    }

    public static function MostrarComentarios() {


        $db = Database::getInstance();
        $db->query("SELECT * FROM usuario us , modelo_usuario mu where comentario is not null and mu.codigoMod = 7 and mu.idUsu = us.idUsu Order by Comentario");

        $data = [];
        while ($obj = $db->getObject("Modelo_Usuario"))
            array_push($data, $obj);

        //
        return $data;
    }

    public static function findComentarios($codigoModelo): array {
        $db = Database::getInstance();
        $db->query("SELECT * FROM usuario us , modelo_usuario mu where comentario is not null and mu.codigoMod = $codigoModelo and mu.idUsu = us.idUsu Order by comentario;");

        $data = [];
        while ($obj = $db->getObject("Modelo_Usuario"))
            array_push($data, $obj);


        return $data;
    }

    public static function findAll() {
        $db = Database::getInstance();
        $db->query("SELECT * FROM modelo_usuario;");

        $data = [];
        while ($obj = $db->getObject("Modelo_Usuario"))
            array_push($data, $obj);

        //
        return $data;
    }

    public static function find($codigoModelo): Modelo_Usuario {
        $db = Database::getInstance();
        $db->query("SELECT * FROM usuario us , modelo_usuario mu where  mu.codigoMod = $codigoModelo and mu.idUsu = us.idUsu;");
        //echo "SELECT * FROM Usuario us , Modelo_Usuario mu where  mu.codigoMod = $codigoModelo and mu.idUsu = us.idUsu;";


        //var_dump($db->getObject("Modelo_Usuario"));
        return $db->getObject("Modelo_Usuario");
    }

    public static function MostrarFavoritos($idUsu): array {
        $db = Database::getInstance();
        $db->query("SELECT DISTINCT * FROM modelo mo , modelo_usuario mu , marcas ma "
                . "where mu.favorito = 1 and mu.idUsu= $idUsu and mo.CodigoMod = mu.codigoMod and mo.CodigoMarca=ma.CodigoMarca"
                . "  Order by NombreMarca");

        $data = [];
        while ($obj = $db->getObject("Modelo_Usuario"))
            array_push($data, $obj);


        return $data;
    }

    public function anadirFav() {
        $db = Database::getInstance();

        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $sql = "UPDATE modelo_usuario SET favorito= 1 WHERE idUsu= $id and codigoMod={$this->codigoMod};";

        echo $sql;
        $db->query($sql);


        header("Location:index.php?con=especificaciones&ope=listar&id=$this->codigoMod");
    }

    public function eliminarFav() {
        $db = Database::getInstance();


        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();

        $sql = "UPDATE modelo_usuario SET favorito= 0 WHERE idUsu= $id and codigoMod={$this->codigoMod};";

        echo $sql;
        $db->query($sql);



        header("Location:index.php?con=especificaciones&ope=listar&id=$this->codigoMod");
    }

    public function save() {
        $db = Database::getInstance();
        $sql = "INSERT INTO modelo_usuario (idUsu, codigoMod ,favorito, comentario) "
                . "VALUES ({$this->idUsu}, {$this->CodigoMod},  {$this->favorito}, '{$this->Comentario}') ;";


        $db->query($sql);
        $this->idUsu = $db->lastId();
    }

}
