<?php

// Fabio Benitez Ramirez
require_once "libs/Database.php";

/**
 * Especificaciones
 * @author  Fabio Benitez Ramirez
 */
class Especificaciones {

    /**
     * CodEspe
     *
     * @var mixed
     */
    private $CodEspe;

    /**
     * CodigoMod
     *
     * @var mixed
     */
    private $CodigoMod;

    /**
     * Caballos
     *
     * @var mixed
     */
    private $Caballos;

    /**
     * Año
     *
     * @var mixed
     */
    private $Año;

    /**
     * Combustible
     *
     * @var mixed
     */
    private $Combustible;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        
    }
    
    /**
     * getCaballos
     *
     * @return void
     */
    public function getCaballos() {
        return $this->Caballos;
    }
    
    /**
     * setCaballos
     *
     * @param  mixed $Caballos
     * @return void
     */
    public function setCaballos($Caballos) {
        $this->Caballos = $Caballos;

        return $this;
    }
    
    /**
     * getA
     *
     * @return void
     */
    public function getAño() {
        return $this->Año;
    }
    
    /**
     * setA
     *
     * @param  mixed $A
     * @return void
     */
    public function setAño($Año) {
        $this->Año = $Año;

        return $this;
    }
    
    /**
     * getCombustible
     *
     * @return void
     */
    public function getCombustible() {
        return $this->Combustible;
    }
    
    /**
     * setCombustible
     *
     * @param  mixed $Combustible
     * @return void
     */
    public function setCombustible($Combustible) {
        $this->Combustible = $Combustible;

        return $this;
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
     * getCodEspe
     *
     * @return void
     */
    function getCodEspe() {
        return $this->CodEspe;
    }
    
    /**
     * setCodEspe
     *
     * @param  mixed $CodEspe
     * @return void
     */
    function setCodEspe($CodEspe) {
        $this->CodEspe = $CodEspe;
    }

    /**
     * get all the specifications that belong to the model with id  = $CodigoMod
     *
     * @param $codigoMod
     * @return array
     */
    public static function findAll($codigoMod): array {
         $db =  Database::getInstance();;
        $db->query("SELECT * FROM especificaciones WHERE codigoMod = $codigoMod;");

        $data = [];
        while ($obj = $db->getObject("Especificaciones"))
            array_push($data, $obj);


        return $data;
    }
     /**
     * get the specifications where the id of them are equals $codigoEspe
     *
     * @param  $codigoEspe
     * @return Especificaciones
     */
    public static function find($codigoEspe): Especificaciones {
        $db =  Database::getInstance();
        $db->query("SELECT CodEspe, CodigoMod, Caballos, Año, Combustible FROM especificaciones  WHERE codEspe= $codigoEspe;");

        return $db->getObject("Especificaciones");
    }

    /**
     * delete the specifiations 
     *
     * @return void
     */
    public function eliminar() {
        $db =  Database::getInstance();
        $db->query("DELETE FROM especificaciones WHERE codEspe={$this->CodEspe} ;");
    
       // echo"DELETE FROM especificaciones WHERE codEspe= {$this->CodEspe} ;";
    }

      /**
     * insert into the database the news specifications
     *
     * @return void
     */
      public function save(){
              $db =  Database::getInstance();
            $consulta = "insert into especificaciones (caballos,combustible , codigoMod, año) values ({$this->Caballos},'{$this->Combustible}',{$this->CodigoMod},{$this->Año});";

            //echo $consulta;
           $db->query($consulta);
         $this->CodEspe = $db->lastId();
        }
}
