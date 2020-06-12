<?php

// Modelo Marca
//Fabio Benitez Ramirez
require_once "libs/Database.php";

/**
 * Class Marca
 * @author Fabio Benitez Ramirez 
 */
class Marca {
    
    /**
     * NombreMarca
     *
     * @var mixed
     */
    prublic $NombreMarca;    
    /**
     * CodigoMarca
     *
     * @var mixed
     */
    public $CodigoMarca;    
    /**
     * anioFundacion
     *
     * @var mixed
     */
    public $anioFundacion;    
    /**
     * logo
     *
     * @var mixed
     */
     public $logo;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct() {
        
    }
    
    /**
     * getCodigoMarca
     *
     * @return void
     */
    public function getCodigoMarca() {
        return $this->CodigoMarca;
    }
    
    /**
     * setCodigoMarca
     *
     * @param  mixed $CodigoMarca
     * @return void
     */
    public function setCodigoMarca($CodigoMarca) {
        $this->CodigoMarca = $CodigoMarca;

        return $this;
    }
    
    /**
     * getNombreMarca
     *
     * @return void
     */
    public function getNombreMarca() {
        return $this->NombreMarca;
    }
    
    /**
     * setNombreMarca
     *
     * @param  mixed $NombreMarca
     * @return void
     */
    public function setNombreMarca($NombreMarca) {
        $this->NombreMarca = $NombreMarca;

        return $this;
    }
    
    /**
     * getlogo
     *
     * @return void
     */
    public function getlogo() {
        return $this->logo;
    }
    
    /**
     * setlogo
     *
     * @param  mixed $logo
     * @return void
     */
    public function setlogo($logo) {
        $this->logo = $logo;

        return $this;
    }
    
    /**
     * getanioFundacion
     *
     * @return void
     */
    public function getanioFundacion() {
        return $this->anioFundacion;
    }
    
    /**
     * setanioFundacion
     *
     * @param  mixed $anioFundacion
     * @return void
     */
    public function setanioFundacion($anioFundacion) {
        $this->anioFundacion = $anioFundacion;

        return $this;
    }

    /**
     * get all the Car Brands
     *
     * @return void
     */
    public static function findAll() {
        $db =  Database::getInstance();
        $db->query("SELECT * FROM marcas ;");

        $data = [];
        while ($obj = $db->getObject("Marca"))
            array_push($data, $obj);

        
        return $data;
    }

  /**
     * get the Car Brand when your id equals $id
     *
     * @param integer $id
     * @return Marca
     */
    public static function find(int $id): Marca {
       $db =  Database::getInstance();
        $db->query("SELECT * FROM marcas WHERE codigoMarca = $id ;");

        
        return $db->getObject("Marca");
    }

    
}
