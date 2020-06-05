<?php

require_once "libs/Database.php";
require_once "models/Anuncio.php";

/**
 * Class Imagenes
 * @author Fabio Benitez Ramirez
 */
class Imagenes {
    
    /**
     * idAnuncio
     *
     * @var mixed
     */
    private $idAnuncio;    
    /**
     * idImagen
     *
     * @var mixed
     */
    private $idImagen;    
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
    function __construct() {
        
    }
    
    /**
     * getIdAnuncio
     *
     * @return void
     */
    function getIdAnuncio() {
        return $this->idAnuncio;
    }
    
    /**
     * getIdImagen
     *
     * @return void
     */
    function getIdImagen() {
        return $this->idImagen;
    }
    
    /**
     * getImagen
     *
     * @return void
     */
    function getImagen() {
        return $this->imagen;
    }
    
    /**
     * setIdAnuncio
     *
     * @param  mixed $idAnuncio
     * @return void
     */
    function setIdAnuncio($idAnuncio) {
        $this->idAnuncio = $idAnuncio;
    }
    
    /**
     * setIdImagen
     *
     * @param  mixed $idImagen
     * @return void
     */
    function setIdImagen($idImagen) {
        $this->idImagen = $idImagen;
    }
    
    /**
     * setImagen
     *
     * @param  mixed $imagen
     * @return void
     */
    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    /**
     * get all the photos of the same ad
     *
     * @return void
     */
    public static function findAll() {
        $db = Database::getInstance();
        $db->query("SELECT i.imagen
            FROM anuncio a , imagenes i WHERE  a.idAnuncio = i.idAnuncio;");
        $data = [];
        while ($obj = $db->getObject("Imagenes"))
            array_push($data, $obj);


        return $data;
    }

    /**
     * you get the photos of the same ad and teh id of the ad = $idAnuncio
     *
     * @param  mixed $idAnuncio
     * @return void
     */
    public static function find($idAnuncio) {
        $db = Database::getInstance();
        $db->query("SELECT *
            FROM anuncio a , imagenes i WHERE  i.idAnuncio=$idAnuncio;");
        return $db->getObject();
    }

}
