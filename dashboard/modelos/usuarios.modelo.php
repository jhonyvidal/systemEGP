<?php
/**
@grcarvajal grcarvajal@gmail.com **Gildardo Restrepo Carvajal**
20/04/2022 aplicación energine plataforma de destion de sensores
Modelo de usuarios login, registro y recuperar contraseña
 */
require_once "conexion.php";

class ModeloUsuarios

{
    
/*=============================================
	Registro de usuarios
=============================================*/
	static public function mdlRegistroUsuario($tabla, $datos){
	    $foto = "vistas/img/usuarios/default/default.png";
	    $estado = 1;
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(`rol`, `usuarioLink`, `nombre`, `email`, `password`, `verificacion`, `foto`, `estado`, `idEmpresa`) VALUES (:rol, :usuarioLink, :nombre, :email, :password, :verificacion, :foto, :estado, :empresa)");

		$stmt->bindParam(":rol", $datos["rol"], PDO::PARAM_STR);
		$stmt->bindParam(":usuarioLink", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":verificacion", $datos["verificacion"], PDO::PARAM_STR);
		$stmt->bindParam(":empresa", $datos["empresa"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $foto, PDO::PARAM_STR);
		$stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
			return print_r(Conexion::conectar()->errorInfo());
		}
		$stmt->close();
		$stmt = null;
	}
	
/*================================================================
	Registro de log de login ingreso del cliente a la aplicacion
=================================================================*/
static public function mdlRegistroIngresoUsuarios($idU, $navU, $ipU)
	{
		$tabla = "log_ingreso";
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuarioId, navegador, ipUsuario) VALUES (:idU, :navU, :ipU)");
		$stmt->bindParam(":idU", $idU, PDO::PARAM_INT);
		$stmt->bindParam(":navU", $navU, PDO::PARAM_STR);
		$stmt->bindParam(":ipU", $ipU, PDO::PARAM_STR);
		$stmt-> execute();
		return print_r("Ingresando....");
		$stmt-> close();
		$stmt = null;
	}

    
/*=============================================
	Mostrar Usuarios
==============================================*/

	static public function mdlMostrarUsuarios($tabla, $item, $valor){
		if($item == 'idEmpresa' && $valor != null){
			$stmt = Conexion::conectar()->prepare("SELECT A.id,A.rol,A.email,A.nombre,A.password,A.foto,A.estado,A.idEmpresa,A.usuarioLink,
												B.nombre AS empresa FROM $tabla A
												INNER JOIN empresa B ON A.idEmpresa=B.id
												WHERE A.$item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetchAll();
		}else if($item != null && $valor != null){
			$stmt = Conexion::conectar()->prepare("SELECT A.id,A.rol,A.email,A.nombre,A.password,A.foto,A.estado,A.idEmpresa,A.usuarioLink,
											    B.nombre AS empresa FROM $tabla A
												INNER JOIN empresa B ON A.idEmpresa=B.id
												WHERE A.$item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT A.id,A.rol,A.email,A.nombre,A.password,A.foto,A.estado,A.idEmpresa,A.usuarioLink,
												B.nombre AS empresa FROM $tabla A
												INNER JOIN empresa B ON A.idEmpresa=B.id");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt-> close();
		$stmt = null;
	}

	/*=============================================
	Actualizar usuario
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $id, $item, $valor){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id = :id_usuario");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_usuario", $id, PDO::PARAM_INT);
		if($stmt -> execute()){
			return "ok";
		}else{
			return print_r(Conexion::conectar()->errorInfo());
		}
		$stmt-> close();

		$stmt = null;
		
	}

	/*=============================================
	ACTIVAR USUARIO
	=============================================*/

	static public function mdlActivarUsuario($tabla, $id, $item, $valor){
		if($id == 1){
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = 1 WHERE id = :id_usuario");

			$stmt -> bindParam(":id_usuario", $valor, PDO::PARAM_INT);
			if($stmt -> execute()){
				return "ok";
			}else{
				return print_r(Conexion::conectar()->errorInfo());
			}
			$stmt-> close();
	
			$stmt = null;
		}else{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = 0 WHERE id = :id_usuario");

			$stmt -> bindParam(":id_usuario", $valor, PDO::PARAM_INT);
			if($stmt -> execute()){
				return "ok";
			}else{
				return print_r(Conexion::conectar()->errorInfo());
			}
			$stmt-> close();
	
			$stmt = null;
		}
		
		
	}

/*=============================================
Actualizar usuario completar datos perfil
=============================================*/
static public function mdlActualizarPerfilUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, email = :email, pais = :pais, ciudad = :ciudad, contenido = :contenido WHERE id = :idUsuario");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
		$stmt->bindParam(":contenido", $datos["contenido"], PDO::PARAM_STR);
		$stmt->bindParam(":idUsuario", $datos["id"], PDO::PARAM_INT);
		if($stmt -> execute()){
			return "ok";
		}else{
			return print_r(Conexion::conectar()->errorInfo());
		}
		$stmt-> close();
		$stmt = null;		
	}

}