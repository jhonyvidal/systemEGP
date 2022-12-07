<?php 

$item = "id";
$valor = $_POST["idTurno"];
$estado = 0;
$op = 3;
$turnos = ControladorGestionTurnos::ctrMostrarTurnosFinalizados($op, $item, $valor, $estado);
?>
<div class="content-wrapper" style="min-height: 1058.31px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
        </div>
          <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Turnos finalizado</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Turno finalizado</li>
                            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
          </div>


      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12 col-lg-12">          
        <div class="card sobraCrearLink">        
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover table-lg">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Hora Inicio</th>
                  <th>Hora Fin</th>
                  <th>Dpto</th>
                  <th>Maquina</th>
                  <th>Buenos</th>
                  <th>Malos</th>
                  <th>Estado</th>
                  <th>Fecha registro</th>
                </tr>
              </thead>
              <tbody>
            <?php foreach ($turnos as $key => $value): ?>
                 <tr>
                  <td class="col-auto"><?php echo $value["id"]; ?></td>
                  <td class="col-auto"><?php echo $value["horaInicio"]?></td>
                  <td class="col-auto"><?php echo $value["horaFin"]?>
                  <td class="col-auto"><?php 
                        $item = "id"; 
                        $valor = $value["idDpto"];
                        $dpto = ControladorGestionTurnos::ctrMostrarDptoDelTurno($item, $valor);
                        echo $dpto["nombre"]; 
                        ?></td> 
                  <td class="col-auto"><?php 
                        $item = "id"; 
                        $valor = $value["idMaquina"];
                        $maquina = ControladorGestionTurnos::ctrMostrarMaquinaDelTurno($item, $valor);
                           if(isset($maquina["nombre"])) { echo $maquina["nombre"]; }else{ echo "No"; } 
                  ?></td>
                  <td class="col-auto"><?php echo $value["pBuenos"]?></td>
                  <td class="col-auto"><?php echo $value["pMalos"]?></td>
                  <td class="col-auto"><?php if($value["estado"] == 0 ){ echo "Finalizado"; } else { echo "Abierto"; } ?></td>
                  <td class="col-auto"><?php echo $value["fechaR"]?></td>
                </tr>           
              <?php endforeach ?>                  
              </tbody>
            </table>
            </div>
      <button class="btn btn-block btn-info"></button>
      <h5 class="text-center">Paradas del turno</h5>
   <?php
        $item = "idTurno"; 
        $valor = $value["id"];
        $paradas = ControladorGestionTurnos::ctrMostrarParadasTurnoActual($item, $valor);
      ?>  
  <div class="table-responsive">
    <table class="table table-hover table-lg">
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Turno</th>
                <th>Tipo Parada</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <?php foreach ($paradas as $key => $values): ?>
                <td class="col-auto">
                    <p class="mb-0"><?php echo $values["id"] ?></p>
                </td>
                <td class="col-auto">
                    <p class="mb-0"><?php echo $values["fechaR"]?></p>
                </td>
                <td class="col-auto">
                    <p class="mb-0"><?php echo $values["horaInicioP"]?></p>
                </td>
                <td class="col-auto">
                    <p class="mb-0"><?php echo $values["horaFinP"]; ?></p>
                </td>
                <td class="col-auto">
                    <p class="mb-0"><?php echo $values["idTurno"]; ?></p>
                </td>
                <td class="col-auto">
                    <p class="mb-0"><?php 
                    $item = "id"; 
                    $valor = $values["idTipoParada"];
                    $tP = ControladorGestionTurnos::ctrMostrarTipoParadaTurno($item, $valor);
                    echo $tP["nombre"]; 
                    ?></p>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>          
          </div>
        </div>
      </div>
    </div>
     
  </section>
  <!-- /.content -->
</div>