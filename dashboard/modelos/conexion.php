<?php
/**
@grcarvajal grcarvajal@gmail.com **Gildardo Restrepo Carvajal**
20/04/2022 aplicación energine plataforma de destion de sensores
modelo de conexion a la base de datos.
 */
class Conexion
{
	
	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=eklycsco_egp",
			            "root",
			            "");
						
		$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$link->exec("set names utf8");

		return $link;

	}
	
// 	static function conectar()
// 	{
//     $link = new PDO("mysql:host=localhost;dbname=egp",
// 						"root",
// 						"");
// 	   $link->exec("set names utf8");
// 		return $link;	
		
// 	}
	
	
}

