<?php
/**
@grcarvajal grcarvajal@gmail.com **Gildardo Restrepo Carvajal**
22/04/2022 aplicación energine plataforma de destion de sensores
Controlador de usuarios registro, login y recuperar contraseña.
 */

class ControladorGestionTurnos
{

/*--=====================================
	Consultar empresa
======================================--*/	
	static public function ctrConsultarEmpresa()
	{
	$item = "id";
	$valor = $_SESSION["idU"];
	$usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
		$idE = $usuario["idEmpresa"];
		$item = "id";
		$valor = $idE;
		$tabla = "empresa";
		$empresa = ModeloGestionTurnos::mdlMostrarEmpresa($item, $valor, $tabla);
		return $empresa;
	}

/*--=====================================
	Mostrar turnos
	======================================--*/
	static public function ctrMostrarTurnos($item, $valor, $estado, $idU)
	{
	$tabla = "turno";
	$respuesta = ModeloGestionTurnos::mdlMostrarTurnos($item, $valor, $estado, $idU, $tabla);
	return $respuesta;
	}

/*--=====================================
	Mostrar turnos estado cerrado 0
	======================================--*/
	static public function ctrMostrarTurnosFinalizados($op, $item, $valor, $estado)
	{
	$tabla = "turno";
	$respuesta = ModeloGeneral::mdlMostrarDatos($op, $item, $valor, $estado, $tabla);
	return $respuesta;
	}

	/*--=====================================
	Mostrar Visor de Perdidas
	======================================--*/
	static public function ctrMostrarVisorPerdidas($fechaInicial, $fechaFin, $type, $tipoParada , $empresa)
	{
		$tabla = "paradasmaquina";
		$respuesta = ModeloGestionTurnos::mdlVisorPerdidas($fechaInicial, $fechaFin, $type, $tabla, $tipoParada,  $empresa);
		return $respuesta;
	}

/*--=====================================
	Mostrar paradas turno actual
	======================================--*/
	static public function ctrMostrarParadasTurnoActual($item, $valor)
	{
	$tabla = "paradasmaquina";
	$respuesta = ModeloGestionTurnos::mdlMostrarDpto($tabla, $item, $valor);
	return $respuesta;
	}

	/*--=====================================
	consulta total tiempo maquinas paradas x turno
	======================================--*/
	static public function ctrTotalParadasTurno($item, $valor)
	{
		$tabla = "paradasmaquina";
		$respuesta = ModeloGestionTurnos::mdlTotalParadasTurno($tabla, $item, $valor);
		return $respuesta;
	}

/*--=====================================
Mostrar paradas turno actual
======================================--*/
	static public function ctrMostrarTipoParadaTurno($item, $valor)
	{
	$tabla = "tipoparada";
	$respuesta = ModeloGestionTurnos::mdlMostrarEmpresa($item, $valor, $tabla);
	return $respuesta;
	}

/*--=====================================
Mostrar Recursos
======================================--*/
	static public function ctrMostrarRecursos($item, $valor)
	{
	$tabla = "recurso";
	$respuesta = ModeloGestionTurnos::mdlMostrarRecursos($item, $valor, $tabla);
	return $respuesta;
	}

	/*--=====================================
	Mostrar Articulos
	======================================--*/
	static public function ctrMostrarArticulos($item, $valor)
	{
	$tabla = "producto";
	$respuesta = ModeloGestionTurnos::mdlMostrarArticulos($item, $valor, $tabla);
	return $respuesta;
	}

/*--=====================================
Eliminar paradas turno actual
======================================--*/
	static public function ctreliminarParadaMaquina()
	{
	if(isset($_POST["idParadaT"]))
		{
		$tabla = "paradasmaquina";
		$idP = $_POST["idParadaT"];
		$respuesta = ModeloGeneral::mdlEliminar($idP, $tabla);
		}
	}

	/*--=====================================
	consultar empresa
	======================================--*/
	static public function ctrMostrarEmpresa($item, $valor, $tabla)
	{
		$respuesta = ModeloGestionTurnos::mdlMostrarEmpresa($item, $valor, $tabla);
		return $respuesta;
	}

	/*--=============================================
	consultar departamentos de la empresa 
	==============================================--*/
	static public function ctrMostrarDpto($item, $valor)
	{
		$tabla = "departamento";
		$respuesta = ModeloGestionTurnos::mdlMostrarRecursos( $item, $valor, $tabla);
		return $respuesta;
		
	}

	/*--=============================================
	consultar solo un departamentos de la empresa 
	==============================================--*/
	static public function ctrMostrarDptoDelTurno($item, $valor)
	{
	$tabla = "departamento";
	$respuesta = ModeloGestionTurnos::mdlMostrarEmpresa($item, $valor, $tabla);
		return $respuesta;
	}

	/*--=============================================
	consultar una maquina por el id
	==============================================--*/
	static public function ctrMostrarMaquinaDelTurno($item, $valor)
	{
	$tabla = "maquinas";
	$respuesta = ModeloGestionTurnos::mdlMostrarEmpresa($item, $valor, $tabla);
		return $respuesta;
	}

	/*--=============================================
	Crear turno
	==============================================--*/
	static public function ctrCreaTurnoUI($datos)
	{

		$tabla = "turno";
		
		$respuesta = ModeloGestionTurnos::mdlCrearTurnoUI($tabla, $datos);
		return $respuesta;
		
	}
	/*--=============================================
	Actualizar turno
	==============================================--*/
	static public function ctrActualizarTurnoUI($datos)
	{

		$tabla = "turno";
		
		$respuesta = ModeloGestionTurnos::mdlActualizarTurnoUI($tabla, $datos);
		return $respuesta;
		
	}
	
	/*--=============================================
	Crear turno
	==============================================--*/
	static public function ctrCreaTurno()
	{
		if(isset($_POST["horaInicio"]))
		{
		$ruta = ControladorGeneral::ctrRutaApp();
		$tabla = "turno";
		$datos = array("idU" => $_POST["idU"],
    				   "horaInicio" => $_POST["horaInicio"],
    				   "horaFin" => $_POST["horaFin"],
    				   "idDpto" => $_POST["idDpto"],
    				   "estado" => 1
    					);
		$respuesta = ModeloGestionTurnos::mdlCrearTurno($tabla, $datos);
		if($respuesta == "ok")
				    {
						echo '<script>
							swal({
								type:"success",
								title: "¡TURNO CREADO CORRECTAMENTE!",
								text: "¡Ya puede iniciar una maquina y crear paradas!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result){
								if(result.value){
									window.location = "'.$ruta.'turnoActual";
								}
							});	
						</script>';
										
				}
		}
	}

/*--=====================================
	Mostrar turno actual
	======================================--*/
	static public function ctrMostrarTurnoActual($item, $valor)
	{
	$tabla = "turno";
	$respuesta = ModeloGestionTurnos::mdlMostrarTurnoActual($item, $valor, $tabla);
	return $respuesta;
	}

/*--=============================================
	consultar maquina para el turno
	==============================================--*/
	static public function ctrMostrarMaquina($item, $valor)
	{
	$tabla = "maquinas";
	$respuesta = ModeloGestionTurnos::mdlMostrarDpto($tabla, $item, $valor);

		foreach ($respuesta as $key => $value){
		echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

		}
	}

/*--=============================================
	Agregar Maquina al turno
	==============================================--*/
	static public function ctrAgregaMaquina()
	{
		if(isset($_POST["idMaquina"]))
		{
		$tabla = "turno";
		$idTurno = $_POST["idTurno"];
    	$idMaquina = $_POST["idMaquina"];
		$respuesta = ModeloGestionTurnos::mdlAgregaMaquina($tabla, $idTurno, $idMaquina);
		}
	}


/*--=============================================
	consultar maquina para el turno
	==============================================--*/
	static public function ctrMostrarTipoParada($item, $valor)
	{
		$tabla = "tipoparada";
		$respuesta = ModeloGestionTurnos::mdlMostrarDpto($tabla, $item, $valor);

		foreach ($respuesta as $key => $value){
			echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
		}
	}

/*--=============================================
	Crear parada de maquina
	==============================================--*/
	static public function ctrCrearParadaMaquina()
	{
		if(isset($_POST["idActividad"]))
		{
		$tabla = "paradasmaquina";
		$datos = array("idTurno" => $_POST["idTurno"],
    				   "horaI" => $_POST["horaI"],
    				   "horaF" => $_POST["horaF"],
    				   "idActividad" => $_POST["idActividad"]
    					);
		$respuesta = ModeloGestionTurnos::mdlCrearParadaMaquina($tabla, $datos);
		}
	}
	/*--=============================================
	Crear parada de maquina
	==============================================--*/
	static public function ctrCrearParadaMaquinaUI($datos)
	{

		$tabla = "paradasmaquina";
		$respuesta = ModeloGestionTurnos::mdlCrearParadaMaquinaUI($tabla, $datos);
		return $respuesta;
		
	}
	/*--=============================================
	Mostrar Actividades
	==============================================--*/
	static public function ctrMostrarActividades($item, $valor)
	{

		$tabla = "actividad";
		$respuesta = ModeloGestionTurnos::mdlMostrarActividades($item, $valor, $tabla);
		return $respuesta;
		
	}
	/*--=============================================
	Mostrar Causas
	==============================================--*/
	static public function ctrMostrarCausas($item, $valor)
	{

		$tabla = "causa";
		$respuesta = ModeloGestionTurnos::mdlMostrarActividades($item, $valor, $tabla);
		return $respuesta;
		
	}
	/*--=============================================
	Mostrar Productos
	==============================================--*/
	static public function ctrMostrarProductos($item, $valor)
	{

		$tabla = "producto";
		$respuesta = ModeloGestionTurnos::mdlMostrarActividades($item, $valor, $tabla);
		return $respuesta;
		
	}
	/*--=============================================
	Actualizar parada de maquina
	==============================================--*/
	static public function ctrActualizarParadaMaquinaUI($datos)
	{

		$tabla = "paradasmaquina";
		$respuesta = ModeloGestionTurnos::mdlActualizarParadaMaquinaUI($tabla, $datos);
		return $respuesta;
		
	}
	

	/*--=============================================
	Crear parada de maquina con parametros
	==============================================--*/
	static public function ctrApiCrearParadaMaquina($data)
	{
		$tabla = "paradasmaquina";
		$respuesta = ModeloGestionTurnos::mdlCrearParadaMaquina($tabla, $data);
		return $respuesta;
	}

/*--=============================================
	Fin turno
==============================================--*/
	static public function ctrFinTurno()
	{
		if(isset($_POST["unidadB"]))
		{
		$ruta = ControladorGeneral::ctrRutaApp();
		$tabla = "turno";
		$datos = array("idFinT" => $_POST["idFinT"],
    				   "unidadB" => $_POST["unidadB"],
    				   "unidadM" => $_POST["unidadM"]
    					);
		// echo $_POST["idFinT"];
		// echo $_POST["unidadB"];
		// echo $_POST["unidadM"];
		$respuesta = ModeloGestionTurnos::mdlFinTurno($tabla, $datos);
		if($respuesta == "ok")
				    {
						echo '<script>
							swal({
								type:"success",
								title: "¡TURNO FINALIZADO CORRECTAMENTE!",
								text: "¡Crear Nuevo turno!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result){
								if(result.value){
									window.location = "'.$ruta.'inicio";
								}
							});	
						</script>';
										
				}
		}
	}

/*--=====================================
Eliminar paradas turno actual
======================================--*/
	static public function ctrEliminarTurnoYParadaMaquina()
	{
	if(isset($_POST["idTurnoA"]))
		{
		$tabla = "turno";
		$tabla2 = "paradasmaquina";
		$idT = $_POST["idTurnoA"];
		$respuesta = ModeloGestionTurnos::mdlEliminarTurnoYParadaMaquina($idT, $tabla, $tabla2);
		if($respuesta == "ok")
				    {
						echo '<script>
							swal({
								type:"success",
								title: "¡TURNO ELIMINADO CORRECTAMENTE!",
								text: "¡Ver turnos.......!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
								}).then(function(result){
								if(result.value){
									window.location = "'.$ruta.'turnos";
								}
							});	
						</script>';
										
				}
		}
	}


} 

