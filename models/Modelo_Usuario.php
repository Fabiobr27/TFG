<?php

// Modelo Modelo_Usuario
//Fabio Benitez Ramirez
require_once 'models/Modelo.php';
require_once 'models/Usuario.php';
require_once 'models/Marca.php';
require_once "libs/Sesion.php";

/**
 * class Modelo_Usuario
 * @author Fabio Benitez Ramirez
 */
class Modelo_Usuario {

    /**
     * CodigoMod
     *
     * @var mixed
     */
    private $CodigoMod;

    /**
     * idUsu
     *
     * @var mixed
     */
    private $idUsu;

    /**
     * favorito
     *
     * @var mixed
     */
    private $favorito;

    /**
     * Comentario
     *
     * @var mixed
     */
    private $Comentario;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        
    }

    /**
     * getidUsu
     *
     * @return void
     */
    public function getidUsu() {
        return $this->idUsu;
    }

    /**
     * setidUsu
     *
     * @param  mixed $idUsu
     * @return void
     */
    public function setidUsu($idUsu) {
        $this->idUsu = $idUsu;

        return $this;
    }

    /**
     * getfavorito
     *
     * @return void
     */
    public function getfavorito() {
        return $this->favorito;
    }

    /**
     * setfavorito
     *
     * @param  mixed $favorito
     * @return void
     */
    public function setfavorito($favorito) {
        $this->favorito = $favorito;

        return $this;
    }

    /**
     * getComentario
     *
     * @return void
     */
    function getComentario() {
        return $this->Comentario;
    }

    /**
     * setComentario
     *
     * @param  mixed $Comentario
     * @return void
     */
    function setComentario($Comentario) {
        $this->Comentario = $Comentario;
    }

    /**
     * getcodigoMod
     *
     * @return void
     */
    public function getcodigoMod() {
        return $this->CodigoMod;
    }

    /**
     * setcodigoMod
     *
     * @param  mixed $codMod
     * @return void
     */
    public function setcodigoMod($codMod) {
        $this->CodigoMod = $codMod;

        return $this;
    }

    /**
     * get all where the id of the model = $codigoModelo and the id of the table user = id table model_user
     *
     * @param [type] $codigoModelo
     * @return Modelo_Usuario
     */
    public static function find($codigoModelo): Modelo_Usuario {
        $db = Database::getInstance();
        $db->query("SELECT * FROM usuario us , modelo_usuario mu where  mu.codigoMod = $codigoModelo and mu.idUsu = us.idUsu;");
        ;
        return $db->getObject("Modelo_Usuario");
    }

    /**
     * get the favorites model where the id of the model= $CodigoMod and the id of the user = $id
     * 
     *
     * @param  $codigoModelo
     * @param $id
     * @return array
     */
    public static function findFavo($codigoModelo, $id): array {
        $db = Database::getInstance();
        ;

        $db->query("SELECT * FROM usuario us , modelo_usuario mu where  mu.codigoMod = $codigoModelo and mu.idUsu = us.idUsu and mu.idUsu = $id ");
        $data = [];
        while ($obj = $db->getObject("Modelo_Usuario"))
            array_push($data, $obj);


        return $data;
    }

    /**
     * get the favorites model of the user with id = $idUu
     *
     * @param  mixed $idUsu
     * @return array
     */
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

    /**
     * Add to favorites the model that have the idModel = $this->codigoMod and teh id user = $id
     *
     * @return void
     */
    public function anadirFav() {
        $db = Database::getInstance();

        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();
        $sql = "UPDATE modelo_usuario SET favorito= 1 WHERE idUsu= $id and codigoMod={$this->codigoMod};";

        echo $sql;
        $db->query($sql);


        header("Location:index.php?con=especificaciones&ope=listar&id=$this->codigoMod");
    }

    /**
     * remove to favorites the model that have the idModel = $this->codigoMod and teh id user = $id
     *
     * @return void
     */
    public function eliminarFav() {
        $db = Database::getInstance();


        $sesion = Sesion::getInstance();
        $id = $sesion->getUsuario();

        $sql = "UPDATE modelo_usuario SET favorito= 0 WHERE idUsu= $id and codigoMod={$this->codigoMod};";

        // echo $sql;
        $db->query($sql);



        header("Location:index.php?con=especificaciones&ope=listar&id=$this->codigoMod");
    }

    /**
     * Insert into the database news datas about the models and the users
     *
     * @return void
     */
    public function save() {
        $db = Database::getInstance();
        $sql = "INSERT INTO modelo_usuario (idUsu, codigoMod ,favorito) "
                . "VALUES ({$this->idUsu}, {$this->CodigoMod},  1);";

//echo $sql;
        $db->query($sql);
        $this->idUsu = $db->lastId();
    }

}
