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

} 