<?php

require_once "libs/Database.php";

/**
 *  Class Comentario
 * @author Fabio Benitez Ramirez 
 */
class Comentario {

    /**
     * idCom
     *
     * @var mixed
     */
    private $idCom;

    /**
     * codigoMod
     *
     * @var mixed
     */
    private $codigoMod;

    /**
     * idUsu
     *
     * @var mixed
     */
    private $idUsu;

    /**
     * texto
     *
     * @var mixed
     */
    private $texto;

    /**
     * fecha
     *
     * @var mixed
     */
    private $fecha;

    /**
     * positivos
     *
     * @var mixed
     */
    private $positivos;

    /**
     * negativos
     *
     * @var mixed
     */
    private $negativos;
    
    /**
     * getIdCom
     *
     * @return void
     */
    public function getIdCom() {
        return $this->idCom;
    }
    
    /**
     * getcodigoMod
     *
     * @return void
     */
    public function getcodigoMod() {
        return $this->idPos;
    }
    
    /**
     * setcodigoMod
     *
     * @param  mixed $codigoMod
     * @return void
     */
    public function setcodigoMod($codigoMod) {
        $this->codigoMod = $codigoMod;
        return $this;
    }
    
    /**
     * getIdUsu
     *
     * @return void
     */
    public function getIdUsu() {
        return $this->idUsu;
    }
    
    /**
     * setIdUsu
     *
     * @param  mixed $idUsu
     * @return void
     */
    public function setIdUsu($idUsu) {
        $this->idUsu = $idUsu;
        return $this;
    }
    
    /**
     * getTexto
     *
     * @return void
     */
    public function getTexto() {
        return $this->texto;
    }
    
    /**
     * setTexto
     *
     * @param  mixed $texto
     * @return void
     */
    public function setTexto($texto) {
        $this->texto = $texto;
        return $this;
    }
    
    /**
     * getFecha
     *
     * @return void
     */
    public function getFecha() {
        return $this->fecha;
    }
    
    /**
     * getPositivos
     *
     * @return void
     */
    public function getPositivos() {
        return $this->positivos;
    }
    
    /**
     * getNegativos
     *
     * @return void
     */
    public function getNegativos() {
        return $this->negativos;
    }

    /**
     * get all the comments where the code of the model = $cod
     *
     * @param  $cod
     * @return void
     */
    public static function findAll($cod) {
        $db = Database::getInstance();
        $db->query("SELECT c.idUsu, c.idCom, c.codigoMod, u.imagen, u.nombre, DATE_FORMAT(c.fecha, '%d/%m/%Y') as fechas, c.texto, c.positivos, c.negativos
            FROM usuario u, comentario c WHERE u.idUsu = c.idUsu AND c.codigoMod=$cod ORDER BY c.fecha;");
        $listado = [];
        while ($comentario = $db->getObject())
            array_push($listado, $comentario);

        return $listado;
    }

    /**
     * inser into the database a new comment
     *
     * @return void
     */
    public function insertar() {
        $db = Database::getInstance();
        $db->query("INSERT INTO comentario (codigoMod, idUsu, texto, fecha, positivos, negativos)
             VALUES ({$this->codigoMod}, {$this->idUsu}, '{$this->texto}',
                        current_time(), 0, 0);");
    }

    /**
     *  Update the comments in the database
     *
     * @param [type] $idCom
     * @return void
     */
    public function guardar($idCom) {
        $db = Database::getInstance();
        $sql = "UPDATE comentario SET texto='{$this->texto}' WHERE idCom=$idCom";
        $db->query($sql);
    }

    /**
     * get the comment where the idCom = $idCom
     *
     * @param [type] $idCom
     * @return void
     */
    public static function find($idCom) {
        $db = Database::getInstance();
        $db->query("SELECT * FROM comentario WHERE idCom=$idCom");
        return $db->getObject("Comentario");
    }

}
