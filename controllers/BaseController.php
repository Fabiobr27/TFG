<?php
//twig self-management library
require_once "vendor/autoload.php";

class BaseController {

    protected $twig;

    public function __construct() {
        //indicates the root folder
        $vistas = new \Twig\Loader\FilesystemLoader("./views");

        //create twig with root folder
        $this->twig = new \Twig\Environment($vistas);
    }

}
