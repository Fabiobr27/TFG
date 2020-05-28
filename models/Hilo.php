<?php

// Modelo Hilo
//Fabio Benitez Ramirez
require_once "libs/Database.php";

class Hilo {

    private $idHilo;
    private $idUsu;
    private $titulo;
    private $texto;
    private $fecha;
    private $positivos;
    private $negativos;

    function __construct() {
        
    }

    function getIdHilo() {
        return $this->idHilo;
    }

    function getIdUsu() {
        return $this->idUsu;
    }

    function getTitulo() {
        return $this->titulo;
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

    function setIdHilo($idHilo) {
        $this->idHilo = $idHilo;
    }

    function setIdUsu($idUsu) {
        $this->idUsu = $idUsu;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
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

 	public static function findAll()
	{
		$sql = "SELECT * FROM   usuario u, hilo h WHERE u.idUsu = h.idUsu ORDER BY h.fecha";

		$db = Database::getInstance();
		$db->query($sql);
		$listado = [];
		while ($partido = $db->getObject("Hilo"))
			array_push($listado, $partido);

		return $listado;

	}

    
     public static function find($idHilo)
        {
            $db = Database::getInstance();
            $db->query("SELECT h.idHilo, u.idUsu, u.foto, u.nombre , u.apellidos, DATE_FORMAT(h.fecha, '%d/%m/%Y') as fecha ,count(texto)as mensaje, h.titulo, h.texto, h.positivos, h.negativos
            FROM usuario u, hilo h  WHERE u.idUsu = h.idUsu AND h.idHilo=$idHilo;");
            return $db->getObject();
        }
        
         public static function findHilos($idUsu) {
        $db = Database::getInstance();
        $db->query("SELECT * from usuario u , hilo h WHERE h.idUsu =u.idUsu and u.idUsu = $idUsu;");
        $data = [];
        while ($obj = $db->getObject("Hilo"))
            array_push($data, $obj);


        return $data;
    }

         public function insertar()
        {
            $db = Database::getInstance();
            $db->query("INSERT INTO Hilo (idUsu, titulo, texto, fecha, positivos, negativos) VALUES ({$this->idUsu},'{$this->titulo}', '{$this->texto}',
                        current_time(), 0, 0);");
        }

        public static function borrar($idHilo)
        {
            $db = Database::getInstance();
            $db->query("DELETE FROM hilo WHERE idHilo=$idHilo;");
        }
  
          public function guardar($idHilo)
        {
            $db = Database::getInstance();
            $sql = "UPDATE hilo SET texto='{$this->texto}' , titulo='{$this->titulo}' WHERE idHilo=$idHilo";
            $db->query($sql);
            
            //echo $sql;
        }
        
        public static function sumar($idHilo)
        {
            $db = Database::getInstance();
            $db->query("UPDATE Hilo SET positivos = positivos+1 WHERE idHilo = $idHilo;");
        }

        public static function restar($idHilo)
        {
            $db = Database::getInstance();
            $db->query("UPDATE hilo SET negativos = negativos+1 WHERE idHilo = $idHilo;");
        }

         public static function NumMen($idHilo)
        {
            $db = Database::getInstance();
            $db->query("Select count(texto)as mensaje from  hilo WHERE idHilo = $idHilo;");
            
        }

}
