<?php

require_once "libs/Database.php";
require_once "models/Usuario.php";
require_once "models/Hilo.php";

/**
 * class Respuesta
 * @author Fabio Benitez Ramirez 
 */
class Respuesta {

    /**
     * idAnswer
     *
     * @var mixed
     */
    private $idRes;

    /**
     * idthread
     *
     * @var mixed
     */
    private $idHilo;

    /**
     * idUser
     *
     * @var mixed
     */
    private $idUsu;

    /**
     * text
     *
     * @var mixed
     */
    private $texto;

    /**
     * date
     *
     * @var mixed
     */
    private $fecha;

    /**
     * positives
     *
     * @var mixed
     */
    private $positivos;

    /**
     * negatives
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
     * getIdRes
     *
     * @return void
     */
    function getIdRes() {
        return $this->idRes;
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
     * setIdRes
     *
     * @param  mixed $idRes
     * @return void
     */
    function setIdRes($idRes) {
        $this->idRes = $idRes;
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
     * get all the datas of the forum thread where the id = $idHilo
     *
     * @param [type] $idHilo
     * @return void
     */
    public static function findAll($idHilo) {
        $db = Database::getInstance();
        $db->query("SELECT c.idUsu, c.idRes, c.idHilo, u.foto, u.nombre, DATE_FORMAT(c.fecha, '%d/%m/%Y') as fecha, c.texto, c.positivos, c.negativos
            FROM usuario u, respuesta c WHERE u.idUsu = c.idUsu AND c.idHilo=$idHilo ORDER BY c.fecha;");
        $listado = [];
        while ($comentario = $db->getObject())
            array_push($listado, $comentario);

        return $listado;
    }

    /**
     * Inserts a new thread reply into the database
     *
     * @return void
     */
    public function insertar() {
        $db = Database::getInstance();
        $db->query("INSERT INTO respuesta (idHilo, idUsu, texto, fecha, positivos, negativos)
             VALUES ({$this->idHilo}, {$this->idUsu}, '{$this->texto}',
                        current_time(), 0, 0);");
    }

    /**
     * get all the datas of the answer where the id = $idRes
     *
     * @param [type] $idres
     * @return void
     */
    public static function find($idRes) {
        $db = Database::getInstance();
        $db->query("SELECT *
            FROM  respuesta r  WHERE idRes=$idRes;");
        return $db->getObject();
    }

    /**
     * Update the answer where the id of the answer = $idRes
     *
     * @param [type] $idResp
     * @return void
     */
    public function guardar($idResp) {
        $db = Database::getInstance();
        $sql = "UPDATE respuesta SET texto='{$this->texto}' WHERE idRes=$idResp";
        $db->query($sql);
    }

    /**
     * Increment the number of like in the database
     *
     * @param [type] $idRes
     * @return void
     */
    public static function sumar($idRes) {
        $db = Database::getInstance();
        $db->query("UPDATE respuesta SET positivos = positivos+1 WHERE idRes = $idRes;");
    }

    /**
     * Increment the number of dislike in the database
     *
     * @param [type] $idRes
     * @return void
     */
    public static function restar($idRes) {
        $db = Database::getInstance();
        $db->query("UPDATE respuesta SET negativos = negativos+1 WHERE idRes= $idRes;");
    }

    /**
     * delete the answer where the id of the answer = $idRes
     *
     * @param [type] $idRes
     * @return void
     */
    public static function borrar($idRes) {
        $db = Database::getInstance();
        $db->query("DELETE FROM respuesta WHERE idRes=$idRes;");
    }

}
