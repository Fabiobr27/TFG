<?php

// Modelo TABLERO
// Modelo Vista Controlador
// curso 2019/20

require_once "libs/Database.php";
require_once "modelos/Marca.php";
class Modelo {

    private $NombreMod;
    private $CodigoMod;
    private $CodigoMarca;
    private $imagen;
   

    public function __construct() {
        
    }

    public function getCodigoMarca() {
        return $this->CodigoMarca;
    }

    public function setCodigoMarca($CodigoMarca) {
        $this->CodigoMarca = $CodigoMarca;

        return $this;
    }

    public function getNombreMod() {
        return $this->NombreMod;
    }

    public function setNombreMod($NombreMod) {
        $this->NombreMod = $NombreMod;

        return $this;
    }


    public function getimagen() {
        return $this->imagen;
    }

    public function setimagen($imagen) {
        $this->imagen = $imagen;

        return $this;
    }

    public function getcodigoMod() {
        return $this->CodigoMod;
    }

    public function setcodigoMod($codMod) {
        $this->CodigoMod = $codMod;

        return $this;
    }

    /**
     * busque y devuelva las notas almacenadas
     * en la base de datos.
     *
     * @param $idTab
     * @param array
     */
    public static function findAll($codigoMarca): array {
        $db = new Database();
        $db->query("SELECT  * FROM modelo WHERE codigoMarca= $codigoMarca order by 1;");

        $data = [];
        while ($obj = $db->getObject("Modelo"))
            array_push($data, $obj);


        return $data;
    }

    /**
     * Busca y devuelve una nota en particular
     * 
     * @param $codigoModelo
     * @return Modelo
     */
    
      public static function find($codigoMod): Modelo {
        $db = new Database();
        $db->query("SELECT NombreMod, CodigoMod, CodigoMarca, imagen,favorito FROM modelo   WHERE codigoMod = $codigoMod order by 1;");

        return $db->getObject("Modelo");
    }

    public function delete() {
        $db = new Database();
        $db->query("DELETE FROM nota WHERE idNot={$this->idNot} ;");
    }

}
