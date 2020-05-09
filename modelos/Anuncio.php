<?php

// Modelo Hilo
//Fabio Benitez Ramirez
require_once "libs/Database.php";

class Anuncio {

    private $idAnuncio;
    private $idUsu;
    private $Modelo;
    private $Anio;
    private $Combustible;
    private $Imagen;
    private $Precio;
    private $color;
    private $Kilometros;
    private $Telefono;
    private $Descripcion;
    private $Cabecera;
    private $Marca;

    function __construct() {
        
    }

    function getIdAnuncio() {
        return $this->idAnuncio;
    }

    function getIdUsu() {
        return $this->idUsu;
    }

    function getModelo() {
        return $this->Modelo;
    }

    function getAnio() {
        return $this->Anio;
    }

    function getCombustible() {
        return $this->Combustible;
    }

    function getImagen() {
        return $this->Imagen;
    }

    function getPrecio() {
        return $this->Precio;
    }

    function getColor() {
        return $this->color;
    }

    function getKilometros() {
        return $this->Kilometros;
    }

    function getTelefono() {
        return $this->Telefono;
    }

    function getDescripcion() {
        return $this->Descripcion;
    }

    function setIdAnuncio($idAnuncio) {
        $this->idAnuncio = $idAnuncio;
    }

    function setIdUsu($idUsu) {
        $this->idUsu = $idUsu;
    }

    function setModelo($Modelo) {
        $this->Modelo = $Modelo;
    }

    function setAnio($Anio) {
        $this->Anio = $Anio;
    }

    function setCombustible($Combustible) {
        $this->Combustible = $Combustible;
    }

    function setImagen($Imagen) {
        $this->Imagen = $Imagen;
    }

    function setPrecio($Precio) {
        $this->Precio = $Precio;
    }

    function setColor($color) {
        $this->color = $color;
    }

    function setKilometros($Kilometros) {
        $this->Kilometros = $Kilometros;
    }

    function setTelefono($Telefono) {
        $this->Telefono = $Telefono;
    }

    function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }
     function getCabecera() {
        return $this->Cabecera;
    }

    function setCabecera($cabecera) {
        $this->Cabecera = $cabecera;
    }


    function getMarca() {
        return $this->Marca;
    }

    function setMarca($Marca) {
        $this->Marca = $Marca;
    }

    public static function findAll() {
        $db = Database::getInstance();
        $db->query("SELECT *
            FROM usuario u,Anuncio a 
           WHERE u.idUsu = a.idUsu ;");
        $data = [];
        while ($obj = $db->getObject("Anuncio"))
            array_push($data, $obj);


        return $data;
    }

    public static function find($idAnuncio) {
        $db = Database::getInstance();
        $db->query("SELECT *
            FROM usuario u,Anuncio a  WHERE u.idUsu = a.idUsu and  a.idAnuncio=$idAnuncio;");
        return $db->getObject();
    }
 public static function findAnuncio($idUsu) {
        $db = Database::getInstance();
        $db->query("SELECT * from usuario u , anuncio a WHERE a.idUsu =u.idUsu and u.idUsu = $idUsu;");
        $data = [];
        while ($obj = $db->getObject("Anuncio"))
            array_push($data, $obj);


        return $data;
    }
    public function insertar() {
        $db = Database::getInstance();
        
        $sql ="INSERT INTO Anuncio ( idUsu, Descripcion, color , Precio, Kilometros, Anio , Combustible ,Modelo ,Telefono, Imagen , Marca , Cabecera ) VALUES ({$this->idUsu},'{$this->Descripcion}', '{$this->color}',
                        {$this->Precio} , {$this->Kilometros} , {$this->Anio}, '{$this->Combustible}','{$this->Modelo}','{$this->Telefono}','{$this->Imagen}' ,'{$this->Marca}','{$this->Cabecera}');";
   
        $db->query($sql);

        // echo $sql;  
           }

    public static function borrar($idAnuncio) {
        $db = Database::getInstance();
        $db->query("DELETE FROM Anuncio WHERE idAnuncio=$idAnuncio;");
    }

    public function guardar($idAnuncio) {
        $db = Database::getInstance();
        $sql = "UPDATE Anuncio SET Descripcion='{$this->Descripcion}', Anio = '{$this->Anio}', precio='{$this->Precio}', Modelo='{$this->Modelo}', Marca='{$this->Marca}' , Cabecera='{$this->Cabecera}'"
        . ", Telefono='{$this->Telefono}', Kilometros='{$this->Kilometros}', color='{$this->color}' , combustible='{$this->Combustible}' , imagen='{$this->Imagen}' WHERE idAnuncio=$idAnuncio";
        $db->query($sql);

       //echo $sql;
    }

}
