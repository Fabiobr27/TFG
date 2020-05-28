<?php
require_once "libs/Database.php";
require_once "libs/Sesion.php";


class Login
{

    public function __construct()
    {
    }


    public static function esAdmin($id)
    {
        $db = Database::getInstance();
        $db->query("SELECT perfil FROM jugador WHERE idJug=$id");
        if ($db->getObject("Jugador") == false) return false;
        if ($db->getObject("Jugador")->fetch() == 1) return true;
        return false;
    }
}
