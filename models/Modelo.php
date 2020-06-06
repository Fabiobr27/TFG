<?php

// Modelo TABLERO
// Modelo Vista Controlador
// curso 2019/20

require_once "libs/Database.php";
require_once "models/Marca.php";
/**
 * Class Modelo
 * @autor Fabio Benitez Ramirez
 */
class Modelo {
    
    /**
     * NombreMod
     *
     * @var mixed
     */
    private $NombreMod;    
    /**
     * CodigoMod
     *
     * @var mixed
     */
    private $CodigoMod;    
    /**
     * CodigoMarca
     *
     * @var mixed
     */
    private $CodigoMarca;    
    /**
     * imagen
     *
     * @var mixed
     */
    private $imagen;
    
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
     * getNombreMod
     *
     * @return void
     */
    public function getNombreMod() {
        return $this->NombreMod;
    }
    
    /**
     * setNombreMod
     *
     * @param  mixed $NombreMod
     * @return void
     */
    public function setNombreMod($NombreMod) {
        $this->NombreMod = $NombreMod;

        return $this;
    }
    
    /**
     * getimagen
     *
     * @return void
     */
    public function getimagen() {
        return $this->imagen;
    }
    
    /**
     * setimagen
     *
     * @param  mixed $imagen
     * @return void
     */
    public function setimagen($imagen) {
        $this->imagen = $imagen;

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
     * get all the models when the id of the cars Brands = $codigoMarca
     * 
     *
     * @param $codigoMarca
     * @param array
     */
    public static function findAll($codigoMarca): array {
        $db = Database::getInstance();
        $db->query("SELECT  * FROM modelo WHERE codigoMarca= $codigoMarca order by 1;");

        $data = [];
        while ($obj = $db->getObject("Modelo"))
            array_push($data, $obj);


        return $data;
    }

   /**
     * get the data of the model when the id of the model = $codigoModelo
     * 
     * @param $codigoModelo
     * @return Modelo
     */
      public static function find($codigoMod): Modelo {
        $db = Database::getInstance();
        $db->query("SELECT NombreMod, CodigoMod, CodigoMarca, imagen,favorito FROM modelo   WHERE codigoMod = $codigoMod order by 1;");

        return $db->getObject("Modelo");
    }

    

}
