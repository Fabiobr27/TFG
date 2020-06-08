<?php



	/**
	 */
	function route($url, $con, $ope, $params=[])
	{
		// construimos la ruta base
		$ruta = "$url?con=$con&ope=$ope" ;

		// añadimos los parámetros
		foreach($params as $key => $value)
			$ruta.="&$key=$value" ;

		// redirigimos
		header('location:'.$ruta) ;
	}

	/**
	 */
	function prettyCode($txt)
	{
		echo "<pre>".print_r($txt, true)."</pre>" ;
	}