<?php

class ControladorEmpresas{

	/*=============================================
	CREAR EMPRESAS
	=============================================*/
	static public function ctrCrearEmpresa(){

		if(isset($_POST["Nombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["Nombre"]) &&
			   preg_match('/^[0-9]+$/', $_POST["Nit"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["Email"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["Telefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["Direccion"])){

			   	$tabla = "empresa";

			   	$datos = array("nombre"=>$_POST["Nombre"],
					           "nit"=>$_POST["Nit"],
                               "direccion"=>$_POST["Direccion"],
					           "email"=>$_POST["Email"],
					           "telefono"=>$_POST["Telefono"]
                            );

			   	$respuesta = ModeloEmpresas::mdlIngresarEmpresa($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La empresa ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "empresas";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Validar campos no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "empresas";

							}
						})

			  	</script>';



			}

		}

	}

	/*=============================================
	MOSTRAR EMPRESA
	=============================================*/

	static public function ctrMostrarEmpresa($item, $valor){

		$tabla = "empresa";

		$respuesta = ModeloEmpresas::mdlMostrarEmpresa($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR EMPRESAS
	=============================================*/

	static public function ctrEditarEmpresa(){

		if(isset($_POST["Nombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["Nombre"]) &&
			   preg_match('/^[0-9]+$/', $_POST["Nit"]) &&
			   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["Email"]) && 
			   preg_match('/^[()\-0-9 ]+$/', $_POST["Telefono"]) && 
			   preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["Direccion"])){

			   	$tabla = "empresa";

			   	$datos = array("id"=>$_POST["idEmpresa"],
								"nombre"=>$_POST["Nombre"],
								"nit"=>$_POST["Nit"],
								"direccion"=>$_POST["Direccion"],
								"email"=>$_POST["Email"],
								"telefono"=>$_POST["Telefono"]);

			   	$respuesta = ModeloEmpresas::mdlEditarEmpresa($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La Empresa ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "empresas";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Los campos no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "empresas";

							}
						})

			  	</script>';



			}

		}

	}
}