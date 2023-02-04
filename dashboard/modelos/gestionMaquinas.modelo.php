<?php
/**
@grcarvajal grcarvajal@gmail.com **Gildardo Restrepo Carvajal**
20/04/2022 aplicación energine plataforma de destion de sensores
Modelo de Gestión MAquinas
 */
require_once "conexion.php";

class ModeloGestionMaquinas
{
    
/*=============================================
	Crear Maquina
==============================================*/
	static public function mdlCrearMaquina($tabla, $datos){
		$tiempo = 60;
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`idDepartamento`, `nombre`, `producto`, `unidad`, `velocidad`, `tiempoMinutos`) VALUES (:idDpto, :nombre, :producto, :unidad, :velocidad, :tiempo)");
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":producto", $datos["producto"], PDO::PARAM_STR);
		$stmt->bindParam(":unidad", $datos["unidad"], PDO::PARAM_STR);
		$stmt->bindParam(":idDpto", $datos["idDpto"], PDO::PARAM_STR);
		$stmt->bindParam(":velocidad", $datos["velocidad"], PDO::PARAM_INT);
		$stmt->bindParam(":tiempo", $tiempo, PDO::PARAM_INT);
		if($stmt->execute()){
			return "ok";
		}else{
			return print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
	}
	/*=============================================
	Crear Producto
==============================================*/
static public function mdlCrearProducto($tabla, $datos){
	$tiempo = 60;
	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`id`,`id_recurso`, `descripcion`,`unidad`, `medida`, `velocidad`) VALUES (:id,:id_recurso, :descripcion, :medida,:medida, :velocidad)");
	$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
	$stmt->bindParam(":id_recurso", $datos["id_recurso"], PDO::PARAM_STR);
	$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
	$stmt->bindParam(":medida", $datos["medida"], PDO::PARAM_STR);
	$stmt->bindParam(":velocidad", $datos["velocidad"], PDO::PARAM_STR);
	// $stmt->bindParam(":tiempo", $tiempo, PDO::PARAM_INT);
	if($stmt->execute()){
		return "ok";
	}else{
		return print_r(Conexion::conectar()->errorInfo());
	}
	$stmt->close();
	$stmt = null;
}
/*=============================================
	Crear Actividad
==============================================*/
static public function mdlCrearActividad($tabla, $datos){
	$tiempo = 60;
	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`id_tipoparada`, `descripcion`) VALUES (:id_tipoparada, :descripcion)");
	$stmt->bindParam(":id_tipoparada", $datos["id_tipoparada"], PDO::PARAM_STR);
	$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
	// $stmt->bindParam(":tiempo", $tiempo, PDO::PARAM_INT);
	if($stmt->execute()){
		return "ok";
	}else{
		return print_r(Conexion::conectar()->errorInfo());
	}
	$stmt->close();
	$stmt = null;
}
/*=============================================
	Crear Departamento
==============================================*/
	static public function mdlCrearDpto($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`nombre`, `idEmpresa`) VALUES (:nombre, :idE)");
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":idE", $datos["idE"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			return print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
	}	

	/*=============================================
	Crear Recurso
	==============================================*/
	static public function mdlCrearRecurso($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`id`,`idEmpresa`, `descripcion`,`proceso`,`estado`) VALUES (:id,:idE,:descripcion,:proceso,1 )");
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":proceso", $datos["proceso"], PDO::PARAM_STR);
		$stmt->bindParam(":idE", $datos["idE"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			return print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
	}
	
	/*=============================================
	Crear Tipo Parada
	==============================================*/
	static public function mdlCrearTipoParada($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`idEmpresa`, `descripcion`,`nombre`) VALUES (:idE,:descripcion,:nombre )");
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":idE", $datos["idE"], PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			return print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
	}	


}