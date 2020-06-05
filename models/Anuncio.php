<?php

// Modelo Anuncio
//Fabio Benitez Ramirez
require_once "libs/Database.php";

/**
 * Class Anuncio
 * @author Fabio Benitez Ramirez 
 */
class Anuncio {
    
    /**
     * idUsu
     *
     * @var mixed
     */
    private $idUsu;    
    /**
     * Modelo
     *
     * @var mixed
     */
    private $Modelo;    
    /**
     * Anio
     *
     * @var mixed
     */
    private $Anio;    
    /**
     * Combustible
     *
     * @var mixed
     */
    private $Combustible;    
    /**
     * Imagen
     *
     * @var mixed
     */
    private $Imagen;    
    /**
     * Precio
     *
     * @var mixed
     */    
 
    private $Precio;    
    /**
     * color
     *
     * @var mixed
     */
    private $color;    
    /**
     * Kilometros
     *
     * @var mixed
     */
    private $Kilometros;    
    /**
     * Telefono
     *
     * @var mixed
     */
    private $Telefono;    
    /**
     * Descripcion
     *
     * @var mixed
     */
    private $Descripcion;    
    /**
     * Cabecera
     *
     * @var mixed
     */
    private $Cabecera;    
    /**
     * Marca
     *
     * @var mixed
     */
    private $Marca;
    
    /**
     * __construct
     *
     * @return void
     */
    function __construct() {
        
    }

    /**
     * get the ad id
     *
     * @return void
     */
    function getIdAnuncio() {
        return $this->idAnuncio;
    }

    /**
     * get the Id Usu 
     *
     * @return void
     */
    function getIdUsu() {
        return $this->idUsu;
    }

    /**
     * get the model
     *
     * @return void
     */
    function getModelo() {
        return $this->Modelo;
    }

    /**
     * get the year
     *
     * @return void
     */
    function getAnio() {
        return $this->Anio;
    }

    /**
     * get the fuel
     *
     * @return void
     */
    function getCombustible() {
        return $this->Combustible;
    }

    /**
     * get the photo
     *
     * @return void
     */
    function getImagen() {
        return $this->Imagen;
    }
    
    /**
     * getPrecio
     *
     * @return void
     */
    function getPrecio() {
        return $this->Precio;
    }
    
    /**
     * getColor
     *
     * @return void
     */
    function getColor() {
        return $this->color;
    }
    
    /**
     * getKilometros
     *
     * @return void
     */
    function getKilometros() {
        return $this->Kilometros;
    }
    
    /**
     * getTelefono
     *
     * @return void
     */
    function getTelefono() {
        return $this->Telefono;
    }
    
    /**
     * getDescripcion
     *
     * @return void
     */
    function getDescripcion() {
        return $this->Descripcion;
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
     * setIdUsu
     *
     * @param  mixed $idUsu
     * @return void
     */
    function setIdUsu($idUsu) {
        $this->idUsu = $idUsu;
    }
    
    /**
     * setModelo
     *
     * @param  mixed $Modelo
     * @return void
     */
    function setModelo($Modelo) {
        $this->Modelo = $Modelo;
    }
    
    /**
     * setAnio
     *
     * @param  mixed $Anio
     * @return void
     */
    function setAnio($Anio) {
        $this->Anio = $Anio;
    }
    
    /**
     * setCombustible
     *
     * @param  mixed $Combustible
     * @return void
     */
    function setCombustible($Combustible) {
        $this->Combustible = $Combustible;
    }
    
    /**
     * setImagen
     *
     * @param  mixed $Imagen
     * @return void
     */
    function setImagen($Imagen) {
        $this->Imagen = $Imagen;
    }
    
    /**
     * setPrecio
     *
     * @param  mixed $Precio
     * @return void
     */
    function setPrecio($Precio) {
        $this->Precio = $Precio;
    }
    
    /**
     * setColor
     *
     * @param  mixed $color
     * @return void
     */
    function setColor($color) {
        $this->color = $color;
    }
    
    /**
     * setKilometros
     *
     * @param  mixed $Kilometros
     * @return void
     */
    function setKilometros($Kilometros) {
        $this->Kilometros = $Kilometros;
    }
    
    /**
     * setTelefono
     *
     * @param  mixed $Telefono
     * @return void
     */
    function setTelefono($Telefono) {
        $this->Telefono = $Telefono;
    }
    
    /**
     * setDescripcion
     *
     * @param  mixed $Descripcion
     * @return void
     */
    function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }
    
    /**
     * getCabecera
     *
     * @return void
     */
    function getCabecera() {
        return $this->Cabecera;
    }
    
    /**
     * setCabecera
     *
     * @param  mixed $cabecera
     * @return void
     */
    function setCabecera($cabecera) {
        $this->Cabecera = $cabecera;
    }
    
    /**
     * getMarca
     *
     * @return void
     */
    function getMarca() {
        return $this->Marca;
    }
    
    /**
     * setMarca
     *
     * @param  mixed $Marca
     * @return void
     */
    function setMarca($Marca) {
        $this->Marca = $Marca;
    }

    /**
     * this fuction get all the ad in the database
     *
     * @return void
     */
    public static function findAll() {
        $db = Database::getInstance();
        $db->query("SELECT *
            FROM usuario u,anuncio a 
           WHERE u.idUsu = a.idUsu ;");
        $data = [];
        while ($obj = $db->getObject("Anuncio"))
            array_push($data, $obj);


        return $data;
    }

    /**
     * this fuction get the ad with the id = to variable $idAnuncio
     *
     * @param  mixed $idAnuncio
     * @return void
     */
    public static function find($idAnuncio) {
        $db = Database::getInstance();
        $db->query("SELECT *
            FROM usuario u,anuncio a  WHERE u.idUsu = a.idUsu and  a.idAnuncio=$idAnuncio;");
        return $db->getObject();
    }

    /**
     * this fuction get all the ad  that el user has created
     *
     * @param  mixed $idUsu
     * @return void
     */
    public static function findAnuncio($idUsu) {
        $db = Database::getInstance();
        $db->query("SELECT * from usuario u , anuncio a WHERE a.idUsu =u.idUsu and u.idUsu = $idUsu;");
        $data = [];
        while ($obj = $db->getObject("Anuncio"))
            array_push($data, $obj);


        return $data;
    }

    /**
     * this function insert the ad in the database
     *
     * @return void
     */
    public function insertar() {
        $db = Database::getInstance();

        $sql = "INSERT INTO anuncio ( IdUsu, Descripcion, color , Precio, Kilometros, Anio , Combustible ,Modelo ,Telefono, Imagen , Marca , Cabecera ) VALUES ({$this->idUsu},'{$this->Descripcion}', '{$this->color}',
                        {$this->Precio} , {$this->Kilometros} , {$this->Anio}, '{$this->Combustible}','{$this->Modelo}','{$this->Telefono}','{$this->Imagen}' ,'{$this->Marca}','{$this->Cabecera}');";

        $db->query($sql);
    }

    /**
     * Delete the add whis a id = $idAnuncio
     *
     * @param  $idAnuncio
     * @return void
     */
    public static function borrar($idAnuncio) {
        $db = Database::getInstance();
        $db->query("DELETE FROM anuncio WHERE idAnuncio=$idAnuncio;");
    }

    /**
     * Updte the ad in the database where the idAd = $idAnuncio
     *
     * @param [type] $idAnuncio
     * @return void
     */
    public function guardar($idAnuncio) {
        $db = Database::getInstance();
        $sql = "UPDATE anuncio SET Descripcion='{$this->Descripcion}', Anio = '{$this->Anio}', precio='{$this->Precio}', Modelo='{$this->Modelo}', Marca='{$this->Marca}' , Cabecera='{$this->Cabecera}'"
                . ", Telefono='{$this->Telefono}', Kilometros='{$this->Kilometros}', color='{$this->color}' , combustible='{$this->Combustible}' , imagen='{$this->Imagen}' WHERE idAnuncio=$idAnuncio";
        $db->query($sql);
    }

}
