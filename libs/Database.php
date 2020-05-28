<?php

    class Database
    {
        private $conexion;
        private $resultado;
        private static $instancia = null;

        private function __construct($host = "localhost", $dbName = "coches2", $user = "root", $pass = "")
        {
            $this->conexion = new PDO("mysql:host=".$host.";dbname=".$dbName.";charset=utf8", $user, $pass)
                        or die("Error en la conexión con la base de datos");
        }

        public function getInstance()
        {
            if (self::$instancia == null)
                self::$instancia = new Database();

            return self::$instancia;
        }

        public function __destruct()
        {
            $this->conexion = null;
        }

        public function query($sql)
        {
            $this->resultado = $this->conexion->query($sql);
        }

        public function insert($sql)
        {
            $this->resultado = $this->conexion->prepare($sql);
            $this->resultado->execute();
            return $this->resultado;
        }


        public function getObject($cls = "StdClass")
		{
			return $this->resultado->fetchObject($cls) ;
		}

        public function lastId()
		{
			return $this->conexion->lastInsertId() ;
		}
    }