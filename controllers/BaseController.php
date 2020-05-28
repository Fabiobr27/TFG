<?php
//librería de autogestión twig
require_once "vendor/autoload.php" ;
    class BaseController
    {
        protected $twig;

        public function __construct()
        {
            //indicar carpeta raíz
            $vistas = new \Twig\Loader\FilesystemLoader("./views") ;

            //crear twig con la carpeta raíz
            $this->twig = new \Twig\Environment($vistas) ;
        }
        
    }