<?php

    require_once "libs/Database.php";

    class Comentario
    {
        private $idCom;
        private $codigoMod;
        private $idUsu;
        private $texto;
        private $fecha;
        private $positivos;
        private $negativos;


        public function getIdCom()
        {
            return $this->idCom;
        }

        public function getcodigoMod()
        {
            return $this->idPos;
        }

        public function setcodigoMod($codigoMod)
        {
            $this->codigoMod = $codigoMod;
            return $this;
        }

        public function getIdUsu()
        {
            return $this->idUsu;
        }

        public function setIdUsu($idUsu)
        {
            $this->idUsu = $idUsu;
            return $this;
        }

        public function getTexto()
        {
            return $this->texto;
        }

        public function setTexto($texto)
        {
            $this->texto = $texto;
            return $this;
        }

        public function getFecha()
        {
            return $this->fecha;
        }

        public function getPositivos()
        {
            return $this->positivos;
        }

        public function getNegativos()
        {
            return $this->negativos;
        }

        public static function findAll($cod)
        {
            $db = Database::getInstance();
            $db->query("SELECT c.idUsu, c.idCom, c.codigoMod, u.imagen, u.nombre, DATE_FORMAT(c.fecha, '%d/%m/%Y') as fechas, c.texto, c.positivos, c.negativos
            FROM usuario u, comentario c WHERE u.idUsu = c.idUsu AND c.codigoMod=$cod ORDER BY c.fecha;");
            $listado = [];
            while ($comentario = $db->getObject())
                array_push($listado, $comentario);
            
            return $listado;
        }

        public function insertar()
        {
            $db = Database::getInstance();
            $db->query("INSERT INTO comentario (codigoMod, idUsu, texto, fecha, positivos, negativos)
             VALUES ({$this->codigoMod}, {$this->idUsu}, '{$this->texto}',
                        current_time(), 0, 0);");
        }

        public function guardar($idCom)
        {
            $db = Database::getInstance();
            $sql = "UPDATE comentario SET texto='{$this->texto}' WHERE idCom=$idCom";
            $db->query($sql);
        }

        public static function find($idCom)
        {
            $db = Database::getInstance();
            $db->query("SELECT * FROM comentario WHERE idCom=$idCom");
            return $db->getObject("Comentario");
        }
    }