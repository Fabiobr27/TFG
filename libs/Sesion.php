<?php

	require_once("Database.php") ;
	require_once("models/Usuario.php") ;
	
	/**
	 * Class Sesion
	 * @author Fabio Benitez Ramirez
	 */
	class Sesion
	{		
		/**
		 * usuario
		 *
		 * @var mixed
		 */
		private $usuario ; 		
		/**
		 * time_expire
		 *
		 * @var undefined
		 */
		private $time_expire = 3000 ;				// segundos

		private static $instancia = null ;

	
		/**
		 * __construct
		 *
		 * @return void
		 */
		private function __construct() { }

	
		/**
		 * __clone
		 *
		 * @return void
		 */
		private function __clone() { }	

			
		/**
		 * getUsuario
		 *
		 * @return void
		 */
		public function getUsuario()
		{
			return $this->usuario ;
		}

	
		/**
		 * close
		 *
		 * @return void
		 */
		public function close()
		{
			// empty the session variables
			session_unset();

			// destroy session
			session_destroy() ;
		}

				
		/**
		 * getInstance
		 *
		 * @return void
		 */
		public static function getInstance()
		{
			session_start() ;

			// comprobamos 
			if (isset($_SESSION["_sesion"])):
				self::$instancia = unserialize($_SESSION["_sesion"] ) ;
			else:
				if (self::$instancia===null) 
					self::$instancia = new Sesion() ;
			endif ;

			// devolvemos la instancia
			return self::$instancia ;
		}

			
		/**
		 * 
		 *
		 * @param  mixed $ema
		 * @param  mixed $pas
		 * @return bool
		 */
		public function login(string $ema, string $pas):bool
		{
			// instanciar la clase Database
			$db = Database::getInstance() ;

			// buscamos el usuario
	
			$sql = "SELECT * FROM usuario WHERE email='$ema' AND pass=MD5('$pas') ;" ;
			$db->query($sql);

                
                //if the user is correct, we start the session
			if ($user = $db->getObject("Usuario")):

			
				$this->usuario = $user->getIdUsu();

				
				$_SESSION["time"]    = time() ;
				$_SESSION["_sesion"] = serialize(self::$instancia) ;

				// the session has started
				return true ;

			endif ;

			// the session has not started
			return false ;
		}

				
		/**
		 * Check if the session has expired
		 *
		 * @return bool
		 */
		public function isExpired():bool
		{
			return (time() - $_SESSION["time"] > $this->time_expire) ;
		}

		
		/**
		 * 
		 * Check if you are logged in
		 *
		 * @return bool
		 */
		public function isLogged():bool
		{
			return !empty($_SESSION) ;
		}

			
		/**
		 * Check that there is an active session
		 *
		 * @return bool
		 */
		public function checkActiveSession():bool
		{
			if ($this->isLogged())
				if (!$this->isExpired()) return true ;
			//
			return false ;
		}

			
		/**
		 * redirect
		 *
		 * @param  mixed $url
		 * @return void
		 */
		public function redirect(string $url)
		{
			header("Location: $url") ;
			die() ;
		}

	

	}
