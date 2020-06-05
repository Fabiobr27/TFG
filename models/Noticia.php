<?php

// Modelo Hilo
//Fabio Benitez Ramirez
require_once "libs/Database.php";

class Noticia {
    
    /**
     * idNoticia
     *
     * @var mixed
     */
    private $idNoticia;    
    /**
     * idUsu
     *
     * @var mixed
     */
    private $idUsu;    
    /**
     * Titulo
     *
     * @var mixed
     */
    private $Titulo;    
    /**
     * Desarrollo
     *
     * @var mixed
     */
    private $Desarrollo;    
    /**
     * Fecha
     *
     * @var mixed
     */
    private $Fecha;
    
    /**
     * __construct
     *
     * @return void
     */
    function __construct() {
        
    }
    
    /**
     * getIdNoticia
     *
     * @return void
     */
    function getIdNoticia() {
        return $this->idNoticia;
    }
    
    /**
     * getIdUsu
     *
     * @return void
     */
    function getIdUsu() {
        return $this->idUsu;
    }
    
    /**
     * getTitulo
     *
     * @return void
     */
    function getTitulo() {
        return $this->Titulo;
    }
    
    /**
     * getDesarrollo
     *
     * @return void
     */
    function getDesarrollo() {
        return $this->Desarrollo;
    }
    
    /**
     * getFecha
     *
     * @return void
     */
    function getFecha() {
        return $this->Fecha;
    }
    
    /**
     * setIdNoticia
     *
     * @param  mixed $idNoticia
     * @return void
     */
    function setIdNoticia($idNoticia) {
        $this->idNoticia = $idNoticia;
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
     * setTitulo
     *
     * @param  mixed $Titulo
     * @return void
     */
    function setTitulo($Titulo) {
        $this->Titulo = $Titulo;
    }
    
    /**
     * setDesarrollo
     *
     * @param  mixed $Desarrollo
     * @return void
     */
    function setDesarrollo($Desarrollo) {
        $this->Desarrollo = $Desarrollo;
    }
    
    /**
     * setFecha
     *
     * @param  mixed $Fecha
     * @return void
     */
    function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    /**
     * get all the news 
     *
     * @return void
     */
    public static function findAll() {
        $sql = "SELECT * FROM   usuario u, noticia n WHERE u.idUsu = n.idUsu ORDER BY n.fecha";

        $db = Database::getInstance();
        $db->query($sql);
        $listado = [];
        while ($noticia = $db->getObject("Noticia"))
            array_push($listado, $noticia);

        return $listado;
    }

    /**
     * get the data of the new that have the id = $idNoticia
     *
     * @param  $idNoticia
     * @return void
     */
    public static function find($idNoticia) {
        $db = Database::getInstance();
        $db->query("SELECT n.idNoticia, u.idUsu, u.foto, u.nombre , u.apellidos, DATE_FORMAT(n.fecha, '%d/%m/%Y') as fecha , n.titulo, n.Desarrollo
            FROM usuario u, noticia n  WHERE u.idUsu = n.idUsu AND n.idNoticia=$idNoticia;");
        return $db->getObject();
    }

    /**
     * Insert a new news in the database
     *
     * @return void
     */
    public function insertar() {
        $db = Database::getInstance();
        $db->query("INSERT INTO noticia (idUsu, Titulo, Desarrollo, Fecha) VALUES ({$this->idUsu},'{$this->Titulo}', '{$this->Desarrollo}',
                        current_time());");
    }

    /**
     * delete the news that have the id = $idNoticia
     *
     * @param  $idNoticia
     * @return void
     */
    public static function borrar($idNoticia) {
        $db = Database::getInstance();
        $db->query("DELETE FROM noticia WHERE idNoticia=$idNoticia;");
    }

    /**
     * Update the news that have the id = $idNoticia
     *
     * @param  $idNoticia
     * @return void
     */
    public function guardar($idNoticia) {
        $db = Database::getInstance();
        $sql = "UPDATE noticia SET Desarrollo='{$this->Desarrollo}' , Titulo='{$this->Titulo}' WHERE idNoticia=$idNoticia;";
        $db->query($sql);

        //echo $sql;
    }

}
