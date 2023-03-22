<?php
/**
@grcarvajal grcarvajal@gmail.com **Gildardo Restrepo Carvajal**
22/04/2022 aplicación energine plataforma de destion de sensores
Controlador de usuarios registro, login y recuperar contraseña.
 */

class ControladorGestionMaquinas
{

/*--=====================================
	Consultar departamentos de la empresa
======================================--*/	
static public function ctrMostrarDptoEmpresa($valor)
	{
		$op = 2;
		$estado = null;
		$item = "idEmpresa";
		$tabla = "departamento";
		$respuesta = ModeloGeneral::mdlMostrarDatos($op, $item, $valor, $estado, $tabla);
		return $respuesta;
	}
	/*--=====================================
	Consultar recurso de la empresa
======================================--*/	
static public function ctrMostrarRecursoEmpresa($valor)
{
	$op = 2;
	$estado = null;
	$item = "idEmpresa";
	$tabla = "recurso";
	$respuesta = ModeloGeneral::mdlMostrarDatos($op, $item, $valor, $estado, $tabla);
	return $respuesta;
}

/*--=====================================
	Consultar tipo Parada de la empresa
======================================--*/	
static public function ctrMostrarRecursoTipoParada($valor)
{
	$op = 2;
	$estado = null;
	$item = "idEmpresa";
	$tabla = "tipoparada";
	$respuesta = ModeloGeneral::mdlMostrarDatos($op, $item, $valor, $estado, $tabla);
	return $respuesta;
}

/*--=====================================
	Consultar las maquinas del departamentos de la empresa
======================================--*/	
static public function ctrMostrarMaquinasDptoEmpresa($valor)
	{
		$op = 2;
		$estado = null;
		$item = "idDepartamento";
		$tabla = "maquinas";
		$respuesta = ModeloGeneral::mdlMostrarDatos($op, $item, $valor, $estado, $tabla);
		return $respuesta;
	}
/*--=====================================
	Consultar los productos del recurso de la empresa
======================================--*/	
static public function ctrMostrarProductosRecurso($valor)
{
	$op = 2;
	$estado = null;
	$item = "id_recurso";
	$tabla = "producto";
	$respuesta = ModeloGeneral::mdlMostrarDatos($op, $item, $valor, $estado, $tabla);
	return $respuesta;
}
/*--=====================================
	Consultar los producto por Id
======================================--*/	
static public function ctrMostrarProductoId($valor)
{
	$op = 1;
	$estado = null;
	$item = "id";
	$tabla = "producto";
	$respuesta = ModeloGeneral::mdlMostrarProducto($op, $item, $valor, $estado, $tabla);
	return $respuesta;
}
/*--=====================================
	Consultar los actividades del tipo parada de la empresa
======================================--*/	
static public function ctrMostrarActividadTipoParada($valor)
{
	$op = 2;
	$estado = null;
	$item = "id_tipoparada";
	$tabla = "actividad";
	$respuesta = ModeloGeneral::mdlMostrarDatos($op, $item, $valor, $estado, $tabla);
	return $respuesta;
}
/*--=====================================
	Consultar las maquinas por id maquina
======================================--*/	
static public function ctrMostrarMaquinasPorId($valor)
	{
		$op = 1;
		$estado = null;
		$item = "id";
		$tabla = "maquinas";
		$respuesta = ModeloGeneral::mdlMostrarDatos($op, $item, $valor, $estado, $tabla);
		return $respuesta;
	}	
/*--=====================================
	Crear Maquina
======================================--*/	
static public function ctrCrearMaquina()
	{
		if(isset($_POST["producto"]))
		{
		$ruta = ControladorGeneral::ctrRutaApp();
		$tabla = "maquinas";
		$datos = array("idDpto" => $_POST["idDpto"],
    				   "nombre" => $_POST["nombre"],
    				   "producto" => $_POST["producto"],
    				   "unidad" => $_POST["unidad"],
    				   "velocidad" => $_POST["velocidad"]
    					);
		$respuesta = ModeloGestionMaquinas::mdlCrearMaquina($tabla, $datos);
		if($respuesta == "ok")
				    {
				    	$_SESSION["idDpto"] = $_POST["idDpto"];
				    	$_SESSION["nombreD"] = $_POST["nombreD"];
						echo '<script>
							swal({
								type:"success",
								title: "¡MAQUINA CREADA CORRECTAMENTE!",
								text: "¡Ver maquinas!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result){
								if(result.value){
									window.location = "'.$ruta.'maquinas";
								}
							});	
						</script>';
										
				}
		}
	}
	/*--=====================================
	Crear Producto
	======================================--*/	
	static public function ctrCrearProducto()
	{
		if(isset($_POST["descripcionProducto"]))
		{
		$ruta = ControladorGeneral::ctrRutaApp();
		$tabla = "producto";
		$datos = array("id" => $_POST["id"],
						"id_recurso" => $_POST["idDpto"],
						"descripcion" => $_POST["descripcionProducto"],
						"medida" => $_POST["medida"],
						"velocidad" => $_POST["velocidad"]
						);
		$respuesta = ModeloGestionMaquinas::mdlCrearProducto($tabla, $datos);
		if($respuesta == "ok")
					{
						$_SESSION["idDpto"] = $_POST["idDpto"];
						$_SESSION["nombreD"] = $_POST["descripcion"];
						echo '<script>
							swal({
								type:"success",
								title: "¡PRODUCTO CREADO CORRECTAMENTE!",
								text: "¡Ver maquinas!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result){
								if(result.value){
									window.location = "'.$ruta.'productos";
								}
							});	
						</script>';
										
				}
		}
	}
	/*--=====================================
	Crear Actividad
	======================================--*/	
	static public function ctrCrearActividad()
	{
		if(isset($_POST["descripcionActividad"]))
		{
		$ruta = ControladorGeneral::ctrRutaApp();
		$tabla = "actividad";
		$datos = array("id_tipoparada" => $_POST["idDpto"],
						"descripcion" => $_POST["descripcionActividad"],
						);
		$respuesta = ModeloGestionMaquinas::mdlCrearActividad($tabla, $datos);
		if($respuesta == "ok")
					{
						$_SESSION["idDpto"] = $_POST["idDpto"];
						$_SESSION["nombreD"] = $_POST["descripcionActividad"];
						echo '<script>
							swal({
								type:"success",
								title: "ACTIVIDAD CREADA CORRECTAMENTE!",
								text: "¡Ver tipo paradas!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result){
								if(result.value){
									window.location = "'.$ruta.'tipoParada";
								}
							});	
						</script>';
										
				}
		}
	}

	/*--=====================================
		Crear Departamento
	======================================--*/	
	static public function ctrCrearDpto()
	{
		if(isset($_POST["descripcion"]))
		{
			
		$ruta = ControladorGeneral::ctrRutaApp();
		$tabla = "departamento";
		$datos = array("idE" => $_POST["idE"],
    				   "nombre" => $_POST["nombre"],
    				   "descripcion" => $_POST["descripcion"]
    					);
					
		$respuesta = ModeloGestionMaquinas::mdlCrearDpto($tabla, $datos);
		
		if($respuesta == "ok")
				    {
						echo '<script>
							swal({
								type:"success",
								title: "¡DEPARTAMENTO CREADO CORRECTAMENTE!",
								text: "¡Ver Departamentos!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result){
								if(result.value){
									window.location = "'.$ruta.'departamentos";
								}
							});	
						</script>';
										
				}
		}
	}

	/*--=====================================
		Crear Recurso
	======================================--*/	
	static public function ctrCrearRecurso()
	{
		if(isset($_POST["procesoRecurso"]))
		{

		$ruta = ControladorGeneral::ctrRutaApp();
		$tabla = "recurso";
		$datos = array("id"=> $_POST["idRecurso"],
					   "idE" => $_POST["idE"],
    				   "proceso" => $_POST["procesoRecurso"],
    				   "descripcion" => $_POST["descripcionRecurso"]
    					);
					
		$respuesta = ModeloGestionMaquinas::mdlCrearRecurso($tabla, $datos);
		
		if($respuesta == "ok")
				    {
						echo '<script>
							swal({
								type:"success",
								title: "¡RECURSO CREADO CORRECTAMENTE!",
								text: "¡Ver Recursos!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result){
								if(result.value){
									window.location = "'.$ruta.'recurso";
								}
							});	
						</script>';
										
				}
		}
	}

	/*--=====================================
		Crear Tipo Parada
	======================================--*/	
	static public function ctrCrearTipoParada()
	{
		if(isset($_POST["nombreTipoParada"]))
		{

		$ruta = ControladorGeneral::ctrRutaApp();
		$tabla = "tipoparada";
		$datos = array("idE" => $_POST["idE"],
    				   "nombre" => $_POST["nombreTipoParada"],
    				   "descripcion" => $_POST["descripcionTipoParada"]
    					);
					
		$respuesta = ModeloGestionMaquinas::mdlCrearTipoParada($tabla, $datos);
		
		if($respuesta == "ok")
				    {
						echo '<script>
							swal({
								type:"success",
								title: "¡TIPO PARADA CREADA CORRECTAMENTE!",
								text: "¡Ver Recursos!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result){
								if(result.value){
									window.location = "'.$ruta.'tipoParada";
								}
							});	
						</script>';
										
				}
		}
	}

/*--=====================================
Eliminar maquina
======================================--*/
static public function ctrEliminarMaquina()
	{
	if(isset($_POST["idEMaquina"]))
		{
		$tabla = "maquinas";
		$idP = $_POST["idEMaquina"];
		$respuesta = ModeloGeneral::mdlEliminar($idP, $tabla);
		}
	}
/*--=====================================
Eliminar maquina
======================================--*/
static public function ctrEliminarProducto()
{
if(isset($_POST["idEProducto"]))
	{
	$tabla = "producto";
	$idP = $_POST["idEProducto"];
	$respuesta = ModeloGeneral::mdlEliminar($idP, $tabla);
	}
}
/*--=====================================
Eliminar Actividades
======================================--*/
static public function ctrEliminarActividad()
{
if(isset($_POST["idEActividad"]))
	{
	$tabla = "actividad";
	$idP = $_POST["idEActividad"];
	$respuesta = ModeloGeneral::mdlEliminar($idP, $tabla);
	}
}
/*--=====================================
Eliminar Departamento
======================================--*/
static public function ctrEliminarDpto()
	{
	if(isset($_POST["idED"]))
		{
		$tabla = "departamento";
		$idP = $_POST["idED"];
		$respuesta = ModeloGeneral::mdlEliminar($idP, $tabla);
		}
	}
/*--=====================================
Eliminar Recurso
======================================--*/
static public function ctrEliminarRecurso()
{
if(isset($_POST["idER"]))
	{
	$tabla = "recurso";
	$idP = $_POST["idER"];
	$respuesta = ModeloGeneral::mdlEliminar($idP, $tabla);
	}
}
/*--=====================================
Eliminar Tipo Parada
======================================--*/
static public function ctrEliminarTipoParada()
{
if(isset($_POST["idET"]))
	{
	$tabla = "tipoparada";
	$idP = $_POST["idET"];
	$respuesta = ModeloGeneral::mdlEliminar($idP, $tabla);
	}
}

} 
