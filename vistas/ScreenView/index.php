<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Screen Machine</title>
  <link rel="stylesheet" href="../../dashboard/vistas/assets/css/bootstrap.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css'><link rel="stylesheet" href="./style.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>
<body>


	<?php
		if(isset($_GET["empresa"])){
			// require_once "../../dashboard/controladores/gestionMaquinas.controlador.php";
			require_once "../../dashboard/modelos/general.modelo.php";
			require_once "../../dashboard/controladores/gestionTurnos.controlador.php";
			require_once "../../dashboard/modelos/gestionTurnos.modelo.php";
			require_once "../../dashboard/controladores/empresa.controlador.php";
			require_once "../../dashboard/modelos/empresa.modelo.php";

			$item = 'id';
			$valor = $_GET["empresa"];
			$empresa = ControladorEmpresas::ctrMostrarEmpresa($item,$valor);

			foreach ($empresa as $key => $value) {
				$request[$key] = $value;
			}
		}else{
			echo '<script>
					window.location = "'.$rutaInicio.'login";
				</script>';	 		 	 	
		}
    ?>
<img src="FullScreenIcon.webp" id="fullScreenImg" alt="FullScreen">
<!-- partial:index.partial.html -->
<div class="courses-container" id="step1">
	<div class="course">
		<div class="course-preview">
			<h6>Sistema EGP</h6>
			<h2><?php echo $request["nombre"]; ?></h2>
			<a href="#"><?php echo $request["nit"]; ?></a>
			<h6><?php echo $request["direccion"]; ?></h6>
			<input type="hidden" class="form-control"  id="idU" value="<?php echo $_GET["idU"]?>" readonly>
		</div>
		<div class="course-info">
			<div class="progress-container">
				<div class="progress"></div>
				<span class="progress-text">
				<?php echo $request["email"]; ?>
				</span>
			</div>
			<h6>Contador de paradas</h6>
			<h2>Inicio de turno</h2>
			<div class="row">
				<div class="col-4">
					<label for="Recurso">Recurso</label>
					<div class="input-group">
						<select  class="form-select" name="Recurso" id="Recurso" require>
							<option value="">Seleccionar una opción</option>
								<?php

									$item = 'idEmpresa';
									$valor = $_GET["empresa"];

									$categorias = ControladorGestionTurnos::ctrMostrarRecursos($item,$valor);

									foreach ($categorias as $key => $value) {
										echo '<option value="'.$value["id"].'" proceso="'.$value["proceso"].'" descripcion="'.$value["descripcion"].'">'.$value["id"].' - '.$value["descripcion"].'</option>';
									}
								?>
						</select>
					</div>
				</div>
				<div class="col-4">
					<label for="Descripción">Descripción</label>
					<div class="input-group mb-3">
						<input type="text" class="form-control"  id="Descripción" readonly>
					</div>
				</div>
				<div class="col-4">
					<label for="Proceso">Proceso</label>
					<div class="input-group mb-3">
						<input type="text" class="form-control"  id="Proceso" readonly>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-4">
					<label for="Artículo">Artículo</label>
					<div class="input-group">
						<select  class="form-select" name="Artículo" id="Artículo" require>
							<option value="">Seleccionar una opción</option>
								<?php

									$item = null;
									$valor = null;

									$categorias = ControladorGestionTurnos::ctrMostrarArticulos($item,$valor);

									foreach ($categorias as $key => $value) {
										echo '<option value="'.$value["id"].'" unidad="'.$value["unidad"].'" velocidad="'.$value["velocidad"].'"  >'.$value["descripcion"].'</option>';
									}

								?>
						</select>
					</div>
				</div>
				<div class="col-4">
					<label for="Unidad">Unidad</label>
					<div class="input-group mb-3">
						<input type="text" class="form-control"  id="Unidad" readonly>
						</div>
				</div>
				<div class="col-4">
					<label for="Proceso">Rendimiento</label>
					<div class="input-group mb-3">
						<input type="text" class="form-control"  id="Rendimiento" readonly>
						</div>
				</div>
			</div>
			<button id="startMachine" class="btn">Iniciar Turno</button>
		</div>
	</div>
</div>
<div class="courses-container" id="step2">
	<div class="course" >
		<div class="course-preview">
			<h2><?php echo $request["nombre"]; ?></h2>
			<a href="#"><?php echo $request["nit"]; ?></a>
			<h6><?php echo $request["direccion"]; ?></h6>
		</div>
		<div class="course-info">
			<div class="progress-container">
				<div class="progress"></div>
				<span class="progress-text">
				<?php echo $request["email"]; ?>
				</span>
			</div>
			<h6>Contador de paradas</h6>
			<h2>Paradas de maquina</h2>
			<div id="start"  style="margin-top: 50px; text-align: center;">
				<input type="hidden" id="turno"></input>
				<input type="hidden" id="idParada"></input>

				<div class="row">
					<div class="col-4">
						<label for="tipoParada">Tipo Parada</label>
						<div class="input-group">
							<select  class="form-select" name="tipoParada" id="tipoParada" require>
								<option value="">Seleccionar Tipo Parada</option>
									<?php

										$item = null;
										$valor = null;

										$categorias = ControladorGestionTurnos::ctrMostrarTipoParadaTurno($item,$valor);

										foreach ($categorias as $key => $value) {
											echo '<option value="'.$value["id"].'" unidad="'.$value["unidad"].'" velocidad="'.$value["velocidad"].'"  >'.$value["descripcion"].'</option>';
										}

									?>
							</select>
						</div>
					</div>
					<div class="col-4">
						<label for="actividad">Actividad</label>
						<div class="input-group">
							<select  class="form-select" name="actividad" id="actividad" require>
								<option value="">Seleccionar Actividad</option>
							</select>
						</div>
					</div>
					<div class="col-4">
						<button detail="start" class="btnCreateStop">Adicionar Parada</button>
					</div>
					
				</div>
			</div>
			<div id="finish"  style="margin-top: 50px;display: none;text-align: center;">
				<div class="row">
					<div class="col-12 p-3">
						<div id="timeProgress" style="font-size:30px"></div>
					</div>
					<div class="col-3"></div>
					<div class="col-3">
						<label for="actividad">Hora Inicio</label>
						<div class="input-group">
							<input  type="time" class="form-control" name="fechaInicio" id="fechaInicio" required>
						</div>
					</div>
					<div class="col-3">
						<label for="actividad">Hora Fin</label>
						<div class="input-group">
							<input  type="time" class="form-control" name="fechaFin" id="fechaFin" required>
						</div>
					</div>
					<div class="col-12">
						<button  detail="finish" class="btnCreateStop">Finalizar parada</button>
					</div>
				</div>	
				
			</div>
			<button  class="btn floating-btn">Finalizar Turno</button>
		</div>
	</div>
</div>

<!-- SOCIAL PANEL HTML -->
<div style="position: relative;">
	<div class="social-panel-container">
		<div class="social-panel">
			<p>Cerrar Turno
			</p>
			<button class="close-btn"><i class="fas fa-times"></i></button>
			<h4>Esta seguro de cerrar el turno</h4>

			<ul>
				<li>
				<div style="text-align: center;">
					<label>Cantidad productos buenos</label>
					<div class="divInputPlus">
						<input type="number" value="0" id="pBuenos" placeholder="">
					</div>
				</div>
				</li>
				<!-- <li>
					<div class="divbtnPlus firstDivPlus">
						<button  id="1" class="btnPlus btnPlusFunction">+</button>
					</div>
					<div class="divbtnPlus">
						<button  id="2" class="btnPlus btnPlusFunction">-</button>
					</div>

				</li> -->
			</ul>
			<ul>
				<li>
				<div style="text-align: center;">
					<label>Cantidad productos malos</label>
					<div class="divInputPlus">
						<input type="number" value="0" id="pMalos" placeholder="">
					</div>
				</div>
				</li>
				<!-- <li>
					<div class="divbtnPlus firstDivPlus">
						<button  id="3" class="btnPlus btnPlusFunction">+</button>
					</div>
					<div class="divbtnPlus">
						<button  id="4" class="btnPlus btnPlusFunction">-</button>
					</div>

				</li> -->
			</ul>
			<div  style="text-align: center;">
				<button  id="finishMachine" class="btn">Finalizar Turno</button>
			</div>
		</div>
	</div>
</div>

<!-- <button class="floating-btn">
	Get in Touch
</button> -->

<!-- partial -->
<script  src="./script.js"></script>

</body>
</html>
