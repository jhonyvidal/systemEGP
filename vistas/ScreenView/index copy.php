<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Screen Machine</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css'><link rel="stylesheet" href="./style.css">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>
<body>


	<?php
		require_once "../../dashboard/controladores/gestionMaquinas.controlador.php";
		require_once "../../dashboard/modelos/general.modelo.php";
		require_once "../../dashboard/controladores/gestionTurnos.controlador.php";
		require_once "../../dashboard/modelos/gestionTurnos.modelo.php";

		$maquina = ControladorGestionMaquinas::ctrMostrarMaquinasPorId(1);;
		foreach ($maquina as $key => $value) {
            $request[$key] = $value;
        }
    ?>
<img src="FullScreenIcon.webp" id="fullScreenImg" alt="FullScreen">
<!-- partial:index.partial.html -->
<div class="courses-container" id="step1">
	<div class="course">
		<div class="course-preview">
			<h6><?php echo $request["nombre"]; ?></h6>
			<h2><?php echo $request["nombre"]; ?></h2>
			<a href="#"><?php echo $request["producto"]; ?></a>
			<h6><?php echo $request["velocidad"]; ?></h6>
			<h6><?php echo $request["tiempoMinutos"]; ?> Min</h6>
		</div>
		<div class="course-info">
			<div class="progress-container">
				<div class="progress"></div>
				<span class="progress-text">
				<?php echo $request["velocidad"]; ?> <?php echo $request["producto"]; ?>
				</span>
			</div>
			<h6>Contador de paradas</h6>
			<h2>Inicio de turno</h2>
			<button id="startMachine" class="btn">Iniciar Turno</button>
		</div>
	</div>
</div>
<div class="courses-container" id="step2">
	<div class="course" >
		<div class="course-preview">
			<h6><?php echo $request["nombre"]; ?></h6>
			<h2><?php echo $request["nombre"]; ?></h2>
			<a href="#"><?php echo $request["producto"]; ?></a>
			<h6><?php echo $request["velocidad"]; ?></h6>
			<h6><?php echo $request["tiempoMinutos"]; ?> Min</h6>
		</div>
		<div class="course-info">
			<div class="progress-container">
				<div class="progress"></div>
				<span class="progress-text">
				<?php echo $request["velocidad"]; ?> <?php echo $request["producto"]; ?>
				</span>
			</div>
			<h6>Contador de paradas</h6>
			<h2>Paradas de maquina</h2>
			<div id="start"  style="margin-top: 50px; text-align: center;">
				<input type="hidden" id="turno"></input>
				<input type="hidden" id="idParada"></input>
				<select name="tipoParada" id="tipoParada" require>
					<?php

						$item = null;
						$valor = null;

						$categorias = ControladorGestionTurnos::ctrMostrarTipoParadaTurno($item,$valor);

						foreach ($categorias as $key => $value) {
							echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
						}

					?>
				</select>
				<button detail="start" class="btnCreateStop">Adicionar Parada</button>
	
			</div>
			<div id="finish"  style="margin-top: 50px;display: none;text-align: center;">
				<button  detail="finish" class="btnCreateStop">Finalizar parada</button>
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
				<li>
					<div class="divbtnPlus firstDivPlus">
						<button  id="1" class="btnPlus btnPlusFunction">+</button>
					</div>
					<div class="divbtnPlus">
						<button  id="2" class="btnPlus btnPlusFunction">-</button>
					</div>

				</li>
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
				<li>
					<div class="divbtnPlus firstDivPlus">
						<button  id="3" class="btnPlus btnPlusFunction">+</button>
					</div>
					<div class="divbtnPlus">
						<button  id="4" class="btnPlus btnPlusFunction">-</button>
					</div>

				</li>
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
