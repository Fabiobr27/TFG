<?php

require_once "libs/Database.php";
require_once "modelos/Usuario.php";
require_once "modelos/Hilo.php";

class Respuesta {

    private $idRes;
    private $idHilo;
    private $idUsu;
    private $texto;
    private $fecha;
    private $positivos;
    private $negativos;

    function __construct() {
        
    }

    function getIdRes() {
        return $this->idRes;
    }

    function getIdHilo() {
        return $this->idHilo;
    }

    function getIdUsu() {
        return $this->idUsu;
    }

    function getTexto() {
        return $this->texto;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getPositivos() {
        return $this->positivos;
    }

    function getNegativos() {
        return $this->negativos;
    }

    function setIdRes($idRes) {
        $this->idRes = $idRes;
    }

    function setIdHilo($idHilo) {
        $this->idHilo = $idHilo;
    }

    function setIdUsu($idUsu) {
        $this->idUsu = $idUsu;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setPositivos($positivos) {
        $this->positivos = $positivos;
    }

    function setNegativos($negativos) {
        $this->negativos = $negativos;
    }

    public static function findAll($idHilo) {
        $db = Database::getInstance();
        $db->query("SELECT c.idUsu, c.idRes, c.idHilo, u.foto, u.nombre, DATE_FORMAT(c.fecha, '%d/%m/%Y') as fecha, c.texto, c.positivos, c.negativos
            FROM usuario u, respuesta c WHERE u.idUsu = c.idUsu AND c.idHilo=$idHilo ORDER BY c.fecha;");
        $listado = [];
        while ($comentario = $db->getObject())
            array_push($listado, $comentario);

        return $listado;
    }

      public function insertar()
        {
            $db = Database::getInstance();
            $db->query("INSERT INTO respuesta (idHilo, idUsu, texto, fecha, positivos, negativos)
             VALUES ({$this->idHilo}, {$this->idUsu}, '{$this->texto}',
                        current_time(), 0, 0);");
        }
     public static function find($idRes)
        {
            $db = Database::getInstance();
            $db->query("SELECT *
            FROM  respuesta r  WHERE idRes=$idRes;");
            return $db->getObject();
        }
     public function guardar($idResp)
        {
            $db = Database::getInstance();
            $sql = "UPDATE respuesta SET texto='{$this->texto}' WHERE idRes=$idResp";
            $db->query($sql);
        }

        public static function sumar($idRes)
        {
            $db = Database::getInstance();
            $db->query("UPDATE respuesta SET positivos = positivos+1 WHERE idRes = $idRes;");
        }

        public static function restar($idRes)
        {
            $db = Database::getInstance();
            $db->query("UPDATE respuesta SET negativos = negativos+1 WHERE idRes= $idRes;");
        }
}
