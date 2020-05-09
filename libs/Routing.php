<?php

	///Fabio Benitez Ramirez
	function route($url, $con, $ope, $params=[])
	{
		
		$ruta = "$url?con=$con&ope=$ope" ;

		foreach($params as $key => $value)
			$ruta.="&$key=$value" ;

		
		header('location:'.$ruta) ;
	}

	function prettyCode($txt)
	{
		echo "<pre>".print_r($txt, true)."</pre>" ;
	}