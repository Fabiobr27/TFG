<?php

//Fabio Benitez Ramirez
require_once "Data.php";

class Database {

    private static $instancia = null;

    public function __construct() {
        global $data;
        $this->pdo = new PDO("mysql:host=" . $data["host"] . ";dbname=" . $data["dbno"] . ";charset=utf8", $data["user"], $data["pass"])
                or die("Error de conexión con la base de datos.");
    }

    public function getInstance() {
        if (self::$instancia == null)
            self::$instancia = new Database();

        return self::$instancia;
    }

    public function __destruct() {
        $this->pdo = null;
    }

    public function query($sql) {
        $this->res = $this->pdo->query($sql);
    }

   
    public function getObject($cls = "StdClass") {
        return $this->res->fetchObject($cls);
    }

    public function lastId() {
        return $this->pdo->lastInsertId();
    }

}
