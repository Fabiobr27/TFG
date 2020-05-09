<?php

//Fabio Benitez Ramirez
	require_once "vendor/autoload.php" ;

	class BaseController 
	{
		protected $twig ;

		public function __construct()
		{
			//echo "instanciado el controlador Tablero<br/>" ;
			// instanciamos el cargador y le proporcionamos el directorio raíz
			// a partir del cual se encuentran las vistas.
			$loader = new \Twig\Loader\FilesystemLoader("./vistas") ;

			// instanciamos TWIG.
			$this->twig   = new \Twig\Environment($loader) ;
		}
	}