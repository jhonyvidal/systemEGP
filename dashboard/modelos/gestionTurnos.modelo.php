<?php

require_once "conexion.php";

class ModeloGestionTurnos
{
    
/*=============================================
	Mostrar empresa
==============================================*/

	static public function mdlMostrarEmpresa($item, $valor, $tabla){
		if($item != null && $valor != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt-> close();
		$stmt = null;
	}

	/*=============================================
	Mostrar recursos
	==============================================*/

	static public function mdlMostrarRecursos($item, $valor, $tabla){
		if($item != null && $valor != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt-> close();
		$stmt = null;
	}

	/*=============================================
	Mostrar Articulos
	==============================================*/

	static public function mdlMostrarArticulos($item, $valor, $tabla){
		if($item != null && $valor != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt-> close();
		$stmt = null;
	}

	/*=============================================
	Mostrar Actividades
	==============================================*/

	static public function mdlMostrarActividades($item, $valor, $tabla){
		if($item != null && $valor != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt-> close();
		$stmt = null;
	}

/*=============================================
	Mostrar Turnos
==============================================*/

	static public function mdlMostrarTurnos($item, $valor, $estado, $idU, $tabla){
		if($item != null && $valor != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			if($estado != null){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE estado = :estado AND idUsuario = :idU");
			$stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
			$stmt->bindParam(":idU", $idU, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();
			}
		}
		$stmt-> close();
		$stmt = null;
	}

/*=============================================
	Mostrar empresa /y mostrar maquinas
==============================================*/
	static public function mdlMostrarDpto($tabla, $item, $valor){
			$stmt = Conexion::conectar()->prepare("SELECT *,a.idActividad,b.id,b.id_tipoparada,b.descripcion AS de
												   FROM $tabla a 
												   INNER JOIN actividad b ON a.idActividad=b.id
												   INNER JOIN tipoparada c ON b.id_tipoparada=c.id
												   WHERE $item = :$item  ");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		$stmt-> close();
		$stmt = null;
	}

	/*=============================================
	consulta total tiempo maquinas paradas x turno
	==============================================*/
	static public function mdlTotalParadasTurno($tabla, $item, $valor){
		$stmt = Conexion::conectar()->prepare("SELECT SUM(TIMESTAMPDIFF(MINUTE,horaInicioP,horaFinP)) as Total 
											   FROM $tabla  WHERE $item = :$item  ");
		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch();
	$stmt-> close();
	$stmt = null;
	}

/*=============================================
	Crear turno
==============================================*/
	static public function mdlCrearTurno($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`horaInicio`, `horaFin`, `idDpto`, `idUsuario`, `estado`) VALUES (:horaInicio, :horaFin, :idDpto, :idU, :estado)");
		$stmt->bindParam(":idU", $datos["idU"], PDO::PARAM_STR);
		$stmt->bindParam(":horaInicio", $datos["horaInicio"], PDO::PARAM_STR);
		$stmt->bindParam(":horaFin", $datos["horaFin"], PDO::PARAM_STR);
		$stmt->bindParam(":idDpto", $datos["idDpto"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
		if($stmt->execute()){
			return "ok";
		}else{
			return print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlCrearTurnoUI($tabla, $datos){
		$request = Conexion::conectar();
		$stmt = $request->prepare("INSERT INTO $tabla(`horaInicio`, `horaFin`, `idDpto`, `idUsuario`, `idProducto`, `estado`) VALUES (:horaInicio, :horaFin, :idDpto, :idU, :idProducto, :estado)");
		$stmt->bindParam(":idU", $datos["idU"], PDO::PARAM_STR);
		$stmt->bindParam(":idProducto", $datos["idProducto"], PDO::PARAM_STR);
		$stmt->bindParam(":horaInicio", $datos["horaInicio"], PDO::PARAM_STR);
		$stmt->bindParam(":horaFin", $datos["horaFin"], PDO::PARAM_STR);
		$stmt->bindParam(":idDpto", $datos["idDpto"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

		
		if($stmt->execute()){
			return  $request->lastInsertId("id");
		}else{
			return print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
	}
	/*=============================================
	Actuliazar turno
	==============================================*/
	static public function mdlActualizarTurnoUI($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET pBuenos = :pBuenos,pMalos=:pMalos,horaFin=:horaFin  WHERE id = :id");
		$stmt->bindParam(":pBuenos", $datos["pBuenos"], PDO::PARAM_STR);
		$stmt->bindParam(":pMalos", $datos["pMalos"], PDO::PARAM_STR);
		$stmt->bindParam(":horaFin", $datos["horaFin"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);

		if($stmt->execute()){
			return  "ok";
		}else{
			return print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
	}

	

/*=============================================
	Mostrar turno actual
==============================================*/
	static public function mdlMostrarTurnoActual($item, $valor, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND estado = 1 ORDER BY $tabla.id DESC LIMIT 1");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		$stmt-> close();
		$stmt = null;
	}
/*=============================================
	Agregar Maquina al turno
==============================================*/
	static public function mdlAgregaMaquina($tabla, $idTurno, $idMaquina){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idMaquina = $idMaquina WHERE id = $idTurno");
			$stmt -> execute();
			return $stmt -> fetchAll();
		$stmt-> close();
		$stmt = null;
	}

/*=============================================
	Crear parada de maquina
==============================================*/
	static public function mdlCrearParadaMaquina($tabla, $datos){


		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`horaInicioP`, `horaFinP`, `idActividad`, `idTurno`) VALUES (:horaI, :horaF, :idActividad, :idTurno)");
		$stmt->bindParam(":idTurno", $datos["idTurno"], PDO::PARAM_STR);
		$stmt->bindParam(":horaI", $datos["horaI"], PDO::PARAM_STR);
		$stmt->bindParam(":horaF", $datos["horaF"], PDO::PARAM_STR);
		$stmt->bindParam(":idActividad", $datos["idActividad"], PDO::PARAM_STR);

		if($stmt->execute()){
			return "ok";
		}else{
			return print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
	}
	/*=============================================
	Crear parada de maquina
	==============================================*/
	static public function mdlCrearParadaMaquinaUI($tabla, $datos){

		$request = Conexion::conectar();
		$stmt = $request->prepare("INSERT INTO $tabla(`horaInicioP`, `horaFinP`, `idActividad`, `idTurno`) VALUES (:horaI, :horaF, :idActividad, :idTurno)");
		$stmt->bindParam(":idTurno", $datos["idTurno"], PDO::PARAM_STR);
		$stmt->bindParam(":horaI", $datos["horaI"], PDO::PARAM_STR);
		$stmt->bindParam(":horaF", $datos["horaF"], PDO::PARAM_STR);
		$stmt->bindParam(":idActividad", $datos["idActividad"], PDO::PARAM_STR);

		if($stmt->execute()){
			return  $request->lastInsertId("id");
		}else{
			return print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
	}
	/*=============================================
	Crear parada de maquina
	==============================================*/
	static public function mdlActualizarParadaMaquinaUI($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET horaFinP = :horaF  WHERE id = :id");
		$stmt->bindParam(":horaF", $datos["horaF"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);

		if($stmt->execute()){
			return  "ok";
		}else{
			return print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
	}
	

/*=============================================
	Fin turno
==============================================*/
	static public function mdlFinTurno($tabla, $datos){
		$estado = 0;
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET pBuenos = :unidadB, pMalos = :unidadM, estado = :estado WHERE id = :idFinT");
		$stmt->bindParam(":idFinT", $datos["idFinT"], PDO::PARAM_INT);
		$stmt->bindParam(":unidadB", $datos["unidadB"], PDO::PARAM_INT);
		$stmt->bindParam(":unidadM", $datos["unidadM"], PDO::PARAM_INT);
		$stmt->bindParam(":estado", $estado, PDO::PARAM_INT);
		if($stmt->execute()){
			return "ok";
		}else{
			return print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
	}

/*=============================================
	Eliminar turno y las paradas de maquina
==============================================*/
static public function mdlEliminarTurnoYParadaMaquina($idT, $tabla, $tabla2){
			$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = $idT");
			$stmt -> execute();
			if($stmt->execute()){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla2 WHERE idTurno = $idT");
			$stmt -> execute();
			$paradas = $stmt -> fetchAll();
				foreach ($paradas as $key => $values){
					$id = $values["id"];
					$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla2 WHERE id = $id");
					$stmt -> execute();
						}
					return "ok"; 
				}else{
					return print_r(Conexion::conectar()->errorInfo());
				}
		$stmt-> close();
		$stmt = null;
	}


}