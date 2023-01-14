<?php

require_once "../controladores/empresa.controlador.php";
require_once "../modelos/empresa.modelo.php";

class AjaxEmpresas{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idEmpresa;

	public function ajaxEditarEmpresa(){

		$item = "id";
		$valor = $this->idEmpresa;

		$respuesta = ControladorEmpresas::ctrMostrarEmpresa($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idEmpresa"])){

	$cliente = new AjaxEmpresas();
	$cliente -> idEmpresa = $_POST["idEmpresa"];
	$cliente -> ajaxEditarEmpresa();

}