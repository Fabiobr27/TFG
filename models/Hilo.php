<?php

// Modelo Hilo
//Fabio Benitez Ramirez
require_once "libs/Database.php";

/**
 * Class Hilo
 * @author Fabio Benitez Ramirez 
 */
class Hilo {

    /**
     * idHilo
     *
     * @var mixed
     */
    private $idHilo;

    /**
     * idUsu
     *
     * @var mixed
     */
    private $idUsu;

    /**
     * titulo
     *
     * @var mixed
     */
    private $titulo;

    /**
     * texto
     *
     * @var mixed
     */
    private $texto;

    /**
     * fecha
     *
     * @var mixed
     */
    private $fecha;

    /**
     * positivos
     *
     * @var mixed
     */
    private $positivos;

    /**
     * negativos
     *
     * @var mixed
     */
    private $negativos;

    /**
     * __construct
     *
     * @return void
     */
    function __construct() {
        
    }

    /**
     * getIdHilo
     *
     * @return void
     */
    function getIdHilo() {
        return $this->idHilo;
    }

    /**
     * getIdUsu
     *
     * @return void
     */
    function getIdUsu() {
        return $this->idUsu;
    }

    /**
     * getTitulo
     *
     * @return void
     */
    function getTitulo() {
        return $this->titulo;
    }

    /**
     * getTexto
     *
     * @return void
     */
    function getTexto() {
        return $this->texto;
    }

    /**
     * getFecha
     *
     * @return void
     */
    function getFecha() {
        return $this->fecha;
    }

    /**
     * getPositivos
     *
     * @return void
     */
    function getPositivos() {
        return $this->positivos;
    }

    /**
     * getNegativos
     *
     * @return void
     */
    function getNegativos() {
        return $this->negativos;
    }

    /**
     * setIdHilo
     *
     * @param  mixed $idHilo
     * @return void
     */
    function setIdHilo($idHilo) {
        $this->idHilo = $idHilo;
    }

    /**
     * setIdUsu
     *
     * @param  mixed $idUsu
     * @return void
     */
    function setIdUsu($idUsu) {
        $this->idUsu = $idUsu;
    }

    /**
     * setTitulo
     *
     * @param  mixed $titulo
     * @return void
     */
    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    /**
     * setTexto
     *
     * @param  mixed $texto
     * @return void
     */
    function setTexto($texto) {
        $this->texto = $texto;
    }

    /**
     * setFecha
     *
     * @param  mixed $fecha
     * @return void
     */
    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    /**
     * setPositivos
     *
     * @param  mixed $positivos
     * @return void
     */
    function setPositivos($positivos) {
        $this->positivos = $positivos;
    }

    /**
     * setNegativos
     *
     * @param  mixed $negativos
     * @return void
     */
    function setNegativos($negativos) {
        $this->negativos = $negativos;
    }

    /**
     * get all the forum thread
     *
     * @return void
     */
    public static function findAll() {
        $sql = "SELECT * FROM   usuario u, hilo h WHERE u.idUsu = h.idUsu ORDER BY h.fecha";

        $db = Database::getInstance();
        $db->query($sql);
        $listado = [];
        while ($partido = $db->getObject("Hilo"))
            array_push($listado, $partido);

        return $listado;
    }

    /**
     * get all the forum thread using a search engine
     *
     * @param  mixed $idHilo
     * @return void
     */
    public static function filter($tit) {
        $sql = "SELECT * FROM   usuario u, hilo h WHERE u.idUsu = h.idUsu and titulo like   '%" . $tit . "%'  ORDER BY h.fecha";

        $db = Database::getInstance();
        $db->query($sql);
        $listado = [];
        while ($filtro = $db->getObject("Hilo"))
            array_push($listado, $filtro);

        return $listado;
    }

    /**
     * get all the forum thread where the id equals $idHilo
     *
     * @param  mixed $idHilo
     * @return void
     */
    public static function find($idHilo) {
        $db = Database::getInstance();
        $db->query("SELECT h.idHilo, u.idUsu, u.foto, u.nombre , u.apellidos, DATE_FORMAT(h.fecha, '%d/%m/%Y') as fecha ,count(texto)as mensaje, h.titulo, h.texto, h.positivos, h.negativos
            FROM usuario u, hilo h  WHERE u.idUsu = h.idUsu AND h.idHilo=$idHilo;");
        return $db->getObject();
    }
/**
     * get all the forum thread data where the id equals $idHilo
     *
     * @param  mixed $idHilo
     * @return void
     */
    public static function findHilos($idUsu) {
        $db = Database::getInstance();
        $db->query("SELECT * from usuario u , hilo h WHERE h.idUsu =u.idUsu and u.idUsu = $idUsu;");
        $data = [];
        while ($obj = $db->getObject("Hilo"))
            array_push($data, $obj);


        return $data;
    }

    /**
     * insert in to the database the news forum thread 
     *
     * @return void
     */
    public function insertar() {
        $db = Database::getInstance();
        $db->query("INSERT INTO hilo (idUsu, titulo, texto, fecha, positivos, negativos) VALUES ({$this->idUsu},'{$this->titulo}', '{$this->texto}',
                        current_time(), 0, 0);");
    }

    /**
     * delete the forum thread where your id is the same as $idHilo
     *
     * @param  mixed $idHilo
     * @return void
     */
    public static function borrar($idHilo) {
        $db = Database::getInstance();
        $db->query("DELETE FROM hilo WHERE idHilo=$idHilo;");
    }

    /**
     * Update the forum thread in the database when your id is the same as $idHilo
     *
     * @param [type] $idHilo
     * @return void
     */
    public function guardar($idHilo) {
        $db = Database::getInstance();
        $sql = "UPDATE hilo SET texto='{$this->texto}' , titulo='{$this->titulo}' WHERE idHilo=$idHilo";
        $db->query($sql);

        //echo $sql;
    }

    /**
     * Increment the number of like in the database
     *
     * @param [type] $idHilo
     * @return void
     */
    public static function sumar($idHilo) {
        $db = Database::getInstance();
        $db->query("UPDATE Hilo SET positivos = positivos+1 WHERE idHilo = $idHilo;");
    }

    /**
     * Increment the number of dislike in the database
     *
     * @param [type] $idHilo
     * @return void
     */
    public static function restar($idHilo) {
        $db = Database::getInstance();
        $db->query("UPDATE hilo SET negativos = negativos+1 WHERE idHilo = $idHilo;");
    }

}
