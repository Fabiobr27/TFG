<?php

// Fabio Benitez Ramirez
require_once "libs/Database.php";

class Especificaciones {

    private $CodEspe;
    private $CodigoMod;
    private $Caballos;
    private $Año;
    private $Combustible;

    public function __construct() {
        
    }

    public function getCaballos() {
        return $this->Caballos;
    }

    public function setCaballos($Caballos) {
        $this->Caballos = $Caballos;

        return $this;
    }

    public function getAño() {
        return $this->Año;
    }

    public function setAño($Año) {
        $this->Año = $Año;

        return $this;
    }

    public function getCombustible() {
        return $this->Combustible;
    }

    public function setCombustible($Combustible) {
        $this->Combustible = $Combustible;

        return $this;
    }

    public function getcodigoMod() {
        return $this->CodigoMod;
    }

    public function setcodigoMod($codMod) {
        $this->CodigoMod = $codMod;

        return $this;
    }

    function getCodEspe() {
        return $this->CodEspe;
    }

    function setCodEspe($CodEspe) {
        $this->CodEspe = $CodEspe;
    }

    
   
    public static function findAll($codigoMod): array {
         $db =  Database::getInstance();;
        $db->query("SELECT * FROM especificaciones WHERE codigoMod = $codigoMod;");

        $data = [];
        while ($obj = $db->getObject("Especificaciones"))
            array_push($data, $obj);


        return $data;
    }
    
    public static function find($codigoEspe): Especificaciones {
        $db =  Database::getInstance();
        $db->query("SELECT CodEspe, CodigoMod, Caballos, Año, Combustible FROM especificaciones  WHERE codEspe= $codigoEspe;");

        return $db->getObject("Especificaciones");
    }

    public function eliminar() {
        $db =  Database::getInstance();
        $db->query("DELETE FROM especificaciones WHERE codEspe={$this->CodEspe} ;");
    
       // echo"DELETE FROM especificaciones WHERE codEspe= {$this->CodEspe} ;";
    }

      public function save(){
              $db =  Database::getInstance();
            $consulta = "insert into especificaciones (caballos,combustible , codigoMod, año) values ({$this->Caballos},'{$this->Combustible}',{$this->CodigoMod},{$this->Año});";

            echo $consulta;
           $db->query($consulta);
         $this->CodEspe = $db->lastId();
        }
}
