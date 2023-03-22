<?php
/**
@grcarvajal grcarvajal@gmail.com **Gildardo Restrepo Carvajal**
20/04/2022 aplicación energine plataforma de destion de sensores
modelo para crear consultas generales para todos sirven
 */
require_once "conexion.php";

class ModeloGeneral
{

/*====================================================================================
	Contar registros en cualquier tabla, se debe enviar la tabla que se desea contar
=====================================================================================*/
static public function mdlContarRegistros($tabla)
{
	$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) total FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetch();
			$stmt-> close();
			$stmt = null;
	}
/*=============================================
	Mostrar empresa /y mostrar maquinas
==============================================*/
	static public function mdlliminarParadaMaquina($idP, $tabla){
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = $idP");
			$stmt -> execute();
			return "ok";
		$stmt-> close();
		$stmt = null;
	}
/*=============================================
	Eliminar dato de una tabla
==============================================*/
	static public function mdlEliminar($idP, $tabla){
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = $idP");
			$stmt -> execute();
			return "ok";
		$stmt-> close();
		$stmt = null;
	}

/*====================================================================================
	Mostrar datos para cualquier tabla, buscar por id, buscar por un parametro,
	por estado o toda la tabla
	$op = 1, buscar un valor por id, devuelve array solo un valor
	$op = 2, buscar muchos valores por id, devuelve array muchos valores
	$op = 3, buscar un valores por id con estado 1 o 0, devuelve array un valores
	$op = 4, traer todos los datos de una tabla
======================================================================================*/
	static public function mdlMostrarDatos($op, $item, $valor, $estado, $tabla){
		switch($op) {
		case 1:
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
			$stmt -> execute();
		 	return $stmt -> fetch();
		break;
		case 2:
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		 	$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		 	$stmt -> execute();
		 	return $stmt -> fetchAll();
		break;
		case 3:
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado = :estado AND $item = :$item  ORDER BY fechaR DESC LIMIT 50");
	 	$stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
	 	$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
	 	$stmt -> execute();
	 	return $stmt -> fetchAll();
		break;
		case 4:
		echo '$variable op es igual a 3.';
		break;
		
		}
		$stmt-> close();
		$stmt = null;
	}

	static public function mdlMostrarProducto($op, $item, $valor, $estado, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT *,A.descripcion AS nombre, B.descripcion AS recurso, B.proceso FROM $tabla A
											INNER JOIN recurso B ON A.id_recurso = B.id
											WHERE A.$item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
		$stmt -> execute();
		return $stmt -> fetch();

		$stmt-> close();
		$stmt = null;
	}
}



	// if($item != null){
	// 	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
	// 	$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
	// 	$stmt -> execute();
	// 	return $stmt -> fetch();
	// }else{ 
	// 	if($item2 != null){

	// 	}
	// }else{
	// 	if($estado != null){
	// 	$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado = :estado AND $item2 = :$item2");
	// 	$stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
	// 	$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);
	// 	$stmt -> execute();
	// 	return $stmt -> fetchAll();
	// }
	// }else{
	// 		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
	// 		$stmt -> execute();
	// 		return $stmt -> fetchAll();
	// 		}
		
	// 	$stmt-> close();
	// 	$stmt = null;
	
	
