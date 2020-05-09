<?php

require_once "libs/Database.php";
require_once "modelos/Anuncio.php";
class Imagenes {

    private $idAnuncio;
    private $idImagen;
    private $imagen;

    
    function __construct() {
        
    }
    
    function getIdAnuncio() {
        return $this->idAnuncio;
    }

    function getIdImagen() {
        return $this->idImagen;
    }

    function getImagen() {
        return $this->imagen;
    }

    function setIdAnuncio($idAnuncio) {
        $this->idAnuncio = $idAnuncio;
    }

    function setIdImagen($idImagen) {
        $this->idImagen = $idImagen;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }


    public static function findAll() {
        $db = Database::getInstance();
        $db->query("SELECT i.imagen
            FROM Anuncio a , Imagenes i WHERE  a.idAnuncio = i.idAnuncio;");
        $data = [];
        while ($obj = $db->getObject("Imagenes"))
            array_push($data, $obj);


        return $data;
    }
    
    public static function find($idAnuncio) {
        $db = Database::getInstance();
        $db->query("SELECT *
            FROM Anuncio a , Imagenes i WHERE   i.idAnuncio=$idAnuncio;");
        return $db->getObject();
    }
    
    

}
