<?php

// Modelo Hilo
//Fabio Benitez Ramirez
require_once "libs/Database.php";

class Noticia {

    private $idNoticia;
    private $idUsu;
    private $Titulo;
    private $Desarrollo;
    private $Fecha;
   

    function __construct() {
        
    }
    function getIdNoticia() {
        return $this->idNoticia;
    }

    function getIdUsu() {
        return $this->idUsu;
    }

    function getTitulo() {
        return $this->Titulo;
    }

    function getDesarrollo() {
        return $this->Desarrollo;
    }

    function getFecha() {
        return $this->Fecha;
    }

    function setIdNoticia($idNoticia) {
        $this->idNoticia = $idNoticia;
    }

    function setIdUsu($idUsu) {
        $this->idUsu = $idUsu;
    }

    function setTitulo($Titulo) {
        $this->Titulo = $Titulo;
    }

    function setDesarrollo($Desarrollo) {
        $this->Desarrollo = $Desarrollo;
    }

    function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    
 	public static function findAll()
	{
		$sql = "SELECT * FROM   usuario u, noticia n WHERE u.idUsu = n.idUsu ORDER BY n.fecha";

		$db = Database::getInstance();
		$db->query($sql);
		$listado = [];
		while ($noticia = $db->getObject("Noticia"))
			array_push($listado, $noticia);

		return $listado;

	}

    
     public static function find($idNoticia)
        {
            $db = Database::getInstance();
            $db->query("SELECT n.idNoticia, u.idUsu, u.foto, u.nombre , u.apellidos, DATE_FORMAT(n.fecha, '%d/%m/%Y') as fecha , n.titulo, n.Desarrollo
            FROM usuario u, noticia n  WHERE u.idUsu = n.idUsu AND n.idNoticia=$idNoticia;");
            return $db->getObject();
        }
        
         

         public function insertar()
        {
            $db = Database::getInstance();
            $db->query("INSERT INTO noticia (idUsu, Titulo, Desarrollo, Fecha) VALUES ({$this->idUsu},'{$this->Titulo}', '{$this->Desarrollo}',
                        current_time());");
        
        }

        public static function borrar($idNoticia)
        {
            $db = Database::getInstance();
            $db->query("DELETE FROM noticia WHERE idNoticia=$idNoticia;");
        }
  
          public function guardar($idNoticia)
        {
            $db = Database::getInstance();
            $sql = "UPDATE noticia SET Desarrollo='{$this->Desarrollo}' , Titulo='{$this->Titulo}' WHERE idNoticia=$idNoticia;";
            $db->query($sql);
            
            //echo $sql;
        }
        
   
        

}
