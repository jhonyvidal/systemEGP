<?php

require_once "../controladores/general.controlador.php";
require_once "../controladores/gestionTurnos.controlador.php";
require_once "../modelos/gestionTurnos.modelo.php";

class AjaxTurnos{
    /*--=============================================
	Crear turno
	==============================================--*/
	static public function ajaxCreaTurnoUI()
	{
		
		$datos = array("idU" => $_POST["idU"],
    				   "horaInicio" => $_POST["horaInicioUI"],
    				   "horaFin" => $_POST["horaFinUI"],
    				   "idDpto" => $_POST["idDpto"],
					   "idProducto"=> $_POST["idProducto"],
    				   "estado" => 1
    					);

		$respuesta = ControladorGestionTurnos::ctrCreaTurnoUI($datos);

		echo json_encode($respuesta);
	}

    static public function ajaxCrearParadaMaquinaUI()
	{

		$datos = array("idTurno" => $_POST["idTurno"],
    				   "horaI" => $_POST["horaI"],
    				   "horaF" => $_POST["horaF"],
    				   "idActividad" => $_POST["idActividad"],
					   "idCausa" => $_POST["idCausa"]
    					);
		$respuesta = ControladorGestionTurnos::ctrCrearParadaMaquinaUI($datos);
        echo json_encode($respuesta);
		
	}

	static public function ajaxMostrarActividades()
	{

		$item = "id_tipoparada";
		$valor = $_POST["idTipoParadaScreen"];
		$respuesta = ControladorGestionTurnos::ctrMostrarActividades($item,$valor);
        echo json_encode($respuesta);
		
	}

	static public function ajaxMostrarCausas()
	{

		$item = "id_actividad";
		$valor = $_POST["idActividadScreen"];
		$respuesta = ControladorGestionTurnos::ctrMostrarCausas($item,$valor);
        echo json_encode($respuesta);
		
	}
	

	static public function ajaxMostrarArticulos()
	{

		$item = "id_recurso";
		$valor = $_POST["idTipoRecursoScreen"];
		$respuesta = ControladorGestionTurnos::ctrMostrarProductos($item,$valor);
        echo json_encode($respuesta);
		
	}

    static public function ajaxActualizarParadaMaquinaUI()
	{

		$datos = array("id" => $_POST["idParada"],
    				   "horaF" => $_POST["horaF"],
    					);
		$respuesta = ControladorGestionTurnos::ctrActualizarParadaMaquinaUI($datos);
        echo json_encode($respuesta);
		
	}
    static public function ajaxActualizarTurnoUI()
	{
		
		$datos = array("id" => $_POST["id"],
                       "pBuenos" => $_POST["pBuenos"],
    				   "pMalos" => $_POST["pMalos"],
    				   "horaFin" => $_POST["horaFin"],
    					);

		$respuesta = ControladorGestionTurnos::ctrActualizarTurnoUI($datos);

		echo json_encode($respuesta);
	}

	static public function ajaxMostrarTipoParada()
	{
		
		$fechaInicial = null;
		$fechaFin = null;
		$type = 1;
		$empresa = $_POST["idEmpresa"];

		if(isset($_POST["fechaInicio"])){
			$fechaInicial= $_POST["fechaInicio"];
			$fechaFin = $_POST["fechaFin"];
		}

		$perdidas = ControladorGestionTurnos::ctrMostrarVisorPerdidas($fechaInicial, $fechaFin, $type, null, $empresa);
		
		echo json_encode($perdidas);
	}

	static public function ajaxMostrarTipoActividad()
	{
		
		$fechaInicial = null;
		$fechaFin = null;
		$type = 2;
		$tipoParada = $_POST["tipoParada"];
		$empresa = $_POST["idEmpresa"];

		if(isset($_POST["fechaInicio"])){
			$fechaInicial= $_POST["fechaInicio"];
			$fechaFin = $_POST["fechaFin"];
		}
		
		$perdidas = ControladorGestionTurnos::ctrMostrarVisorPerdidas($fechaInicial, $fechaFin, $type, $tipoParada, $empresa);

		echo json_encode($perdidas);
	}

	static public function ajaxMostrarProducto()
	{
		
		$fechaInicial = null;
		$fechaFin = null;
		$type = 3;
		$empresa = $_POST["idEmpresa"];

		if(isset($_POST["fechaInicio"])){
			$fechaInicial= $_POST["fechaInicio"];
			$fechaFin = $_POST["fechaFin"];
		}
		
		$perdidas = ControladorGestionTurnos::ctrMostrarVisorPerdidas($fechaInicial, $fechaFin, $type, null, $empresa);

		echo json_encode($perdidas);
	}

	static public function ajaxMostrarRecurso()
	{
		
		$fechaInicial = null;
		$fechaFin = null;
		$type = 4;
		$empresa = $_POST["idEmpresa"];

		if(isset($_POST["fechaInicio"])){
			$fechaInicial= $_POST["fechaInicio"];
			$fechaFin = $_POST["fechaFin"];
		}
		
		$perdidas = ControladorGestionTurnos::ctrMostrarVisorPerdidas($fechaInicial, $fechaFin, $type, null, $empresa);

		echo json_encode($perdidas);
	}
	
    
	
}

if(isset($_POST["horaInicioUI"])){
    $categoria = new AjaxTurnos();
    $categoria -> ajaxCreaTurnoUI();
}
if(isset($_POST["idActividad"])){
    $categoria = new AjaxTurnos();
    $categoria -> ajaxCrearParadaMaquinaUI();
}
if(isset($_POST["idParada"])){
    $categoria = new AjaxTurnos();
    $categoria -> ajaxActualizarParadaMaquinaUI();
}
if(isset($_POST["pBuenos"])){
    $categoria = new AjaxTurnos();
    $categoria -> ajaxActualizarTurnoUI();
}
if(isset($_POST["idTipoParada"])){
    $categoria = new AjaxTurnos();
    $categoria -> ajaxMostrarTipoParada();
}
if(isset($_POST["idTipoActividad"])){
    $categoria = new AjaxTurnos();
    $categoria -> ajaxMostrarTipoActividad();
}
if(isset($_POST["visorProducto"])){
    $categoria = new AjaxTurnos();
    $categoria -> ajaxMostrarProducto();
}
if(isset($_POST["visorRecurso"])){
    $categoria = new AjaxTurnos();
    $categoria -> ajaxMostrarRecurso();
}
if(isset($_POST["idTipoParadaScreen"])){
    $categoria = new AjaxTurnos();
    $categoria -> ajaxMostrarActividades();
}
if(isset($_POST["idActividadScreen"])){
    $categoria = new AjaxTurnos();
    $categoria -> ajaxMostrarCausas();
}
if(isset($_POST["idTipoRecursoScreen"])){
    $categoria = new AjaxTurnos();
    $categoria -> ajaxMostrarArticulos();
}





