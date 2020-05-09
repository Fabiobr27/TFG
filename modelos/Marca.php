<?php

// Modelo Marca
//Fabio Benitez Ramirez
require_once "libs/Database.php";

class Marca {

    private $NombreMarca;
    private $CodigoMarca;
    private $anioFundacion;
    private $logo;

 
    public function __construct() {
        
    }

    public function getCodigoMarca() {
        return $this->CodigoMarca;
    }

    public function setCodigoMarca($CodigoMarca) {
        $this->CodigoMarca = $CodigoMarca;

        return $this;
    }

    public function getNombreMarca() {
        return $this->NombreMarca;
    }

    public function setNombreMarca($NombreMarca) {
        $this->NombreMarca = $NombreMarca;

        return $this;
    }

    public function getlogo() {
        return $this->logo;
    }

  
    public function setlogo($logo) {
        $this->logo = $logo;

        return $this;
    }

    public function getanioFundacion() {
        return $this->anioFundacion;
    }

    public function setanioFundacion($anioFundacion) {
        $this->anioFundacion = $anioFundacion;

        return $this;
    }


  
    public static function findAll() {
        $db =  Database::getInstance();
        $db->query("SELECT * FROM marcas ;");

        $data = [];
        while ($obj = $db->getObject("Marca"))
            array_push($data, $obj);

        
        return $data;
    }

  
    public static function find(int $id): Marca {
       $db =  Database::getInstance();
        $db->query("SELECT * FROM marcas WHERE codigoMarca = $id ;");

        
        return $db->getObject("Marca");
    }

    
    public function save() {
         $db =  Database::getInstance();

        if (is_null($this->idTab)):

          
            $db->query("INSERT INTO tablero (nombre, fecha) VALUES ('{$this->nombre}', '{$this->fecha}') ;");

            
            $this->idTab = $db->lastId();
        else:

          
            $db->query("UPDATE tablero SET nombre='{$this->nombre}', fecha='{$this->fecha}' WHERE idTab={$this->idTab} ;");
        endif;

        return $this;
    }

}
