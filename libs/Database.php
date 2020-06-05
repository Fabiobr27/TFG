<?php
    
    /**
     * Class Database
     * @author Fabio Benitez Ramirez
     */
    class Database
    {        
        /**
         * conexion
         *
         * @var mixed
         */
        private $conexion;        
        /**
         * resultado
         *
         * @var mixed
         */
        private $resultado;
        private static $instancia = null;
        
        /**
         * __construct
         *
         * Make the connection to the database
         * 
         * @param  mixed $host
         * @param  mixed $dbName
         * @param  mixed $user
         * @param  mixed $pass
         * @return void
         */
        private function __construct($host = "localhost", $dbName = "coches2", $user = "root", $pass = "")
        {
            $this->conexion = new PDO("mysql:host=".$host.";dbname=".$dbName.";charset=utf8", $user, $pass)
                        or die("Error en la conexión con la base de datos");
        }
        
        /**
         * getInstance
         *
         * @return void
         */
        public function getInstance()
        {
            if (self::$instancia == null)
                self::$instancia = new Database();

            return self::$instancia;
        }
        
        /**
         * __destruct
         *
         * @return void
         */
        public function __destruct()
        {
            $this->conexion = null;
        }
        
        /**
         * Make queries to the database
         *
         * @param  mixed $sql
         * @return void
         */
        public function query($sql)
        {
            $this->resultado = $this->conexion->query($sql);
        }
        
        /**
         *  Insert the new data into the database
         *
         * @param  mixed $sql
         * @return void
         */
        public function insert($sql)
        {
            $this->resultado = $this->conexion->prepare($sql);
            $this->resultado->execute();
            return $this->resultado;
        }

        
        /**
         * Get the object from the database
         *
         * @param  mixed $cls
         * @return void
         */
        public function getObject($cls = "StdClass")
		{
			return $this->resultado->fetchObject($cls) ;
		}
        
        /**
         * Get the last id from the database
         *
         * @return void
         */
        public function lastId()
		{
			return $this->conexion->lastInsertId() ;
		}
    }