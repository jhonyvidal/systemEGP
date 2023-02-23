<?php 

$item = "idUsuario";
$valor = $usuario["id"];
$estado = 1;
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
                    <h3>Turnos finalizados ver OEE</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Turnos finalizados oee</li>
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
          <input id="cantidad"  type="hidden" value="<?php echo Count($turnos); ?>">       
          <div class="card-body">
            <div class="row">
                <div class="col-10">
                </div>
                <div class="col-2">
                  <a href="vistas/Excel/ExcelOee.php?user=<?php echo $usuario["id"]?>" class="btn btn-sm btn-success float-end">Descargar Excel</a>
                </div> 
            </div><br>
            <div class="table-responsive">
            <table id="table_id" class="table table-striped table-bordered dt-responsive">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Fecha</th>
                  <th>Trabajo</th>
                  <th>Maquina-Producción</th>
                  <th>OEE</th>
                  <th>Disponibilidad</th>
                  <th>Rendimiento</th>
                  <th>Calidad</th>
                  <th>Tipo</th>
                  <th>Actividad</th>
                  <th>Tiempo</th>
                </tr>
              </thead>
              <tbody>
            
              <?php foreach ($turnos as $key => $value): ?>
                 <tr>
                  <td><?php echo $value["id"]; ?></td>
                  <td><?php echo $value["fechaR"]; ?></td>
                  <td><?php echo $value["horaInicio"]?><br><?php echo $value["horaFin"]?> </td>
                  <td style="min-width: 170px;">
                    <div class="row">
                      <div class="col-6" style="text-align:center">
                        <?php 
                        $item = "id"; 
                        $valor = $value["idDpto"];
                        $dpto = ControladorGestionTurnos::ctrMostrarDptoDelTurno($item, $valor);
                        echo $dpto["nombre"]; 
                        ?>
                      </div>
                      <div class="col-6">
                       <canvas id="myChartTest<?php echo $key; ?>" width="100" height="100" data1="<?php echo $value["pBuenos"]?>" data2="<?php echo $value["pMalos"]?>"></canvas>
                      </div>
                    </div>
                   
                  </td> 
                  <td>
                  <?php 
                     $producto = ControladorGestionMaquinas::ctrMostrarProductoId($value['idProducto']);
                     $unidadesEsperadas = $producto['velocidad'];
                     $horasProgramadas = 24;
                     $item = "idTurno"; 
                     $valor = $value["id"];
                     $total = ControladorGestionTurnos::ctrTotalParadasTurno($item, $valor);
                     $disponibilidad = round((1- (($total["Total"] / 60) / $horasProgramadas)) * 100,1); 
                     $rendimiento = round((($value["pBuenos"] + $value["pMalos"]) / $unidadesEsperadas) * 100,2);
                     $calidad = round($value["pMalos"] == 0 ? 100:(1-($value["pMalos"] / ($value["pBuenos"] + $value["pMalos"]))) * 100 ,1);
                     $newOee =  round((1- (($total["Total"] / 60) / $horasProgramadas) * 
                                ((($value["pBuenos"] + $value["pMalos"]) / $unidadesEsperadas) * 
                                $value["pMalos"] !== 0 ? 1-($value["pMalos"] / ($value["pBuenos"] + $value["pMalos"])): 100)) * 100,2);
                     $oee = ((1440 - $total["Total"]) * 100) / 1440;
                    ?>
                    <div class="circle-container" id="colOEE<?php echo $key ?>" oee="<?php echo $newOee ?>"></div>
                  </td>
                  <td>
                    <div class="circle-ciclo" id="colCiclo<?php echo $key; ?>" total="<?php echo  $disponibilidad?>"></div>
                  </td>
                  <td>
                    <div class="circle-rendimiento" id="colRen<?php echo $key; ?>" rendimiento="<?php echo  $rendimiento?>"></div>
                  </td>
                  <td>
                    <div class="circle-calidad" id="colCal<?php echo $key; ?>" calidad="<?php echo  $calidad?>"></div>
                  </td>
                  <td><?php 
                    $item = "idTurno"; 
                    $valor = $value["id"];
                    $paradas = ControladorGestionTurnos::ctrMostrarParadasTurnoActual($item, $valor);
                    foreach ($paradas as $keyParada => $valueParada){
                      echo $valueParada["nombreParada"]; ?></br><?php
                    }
                    ?></td>
                     <td><?php  foreach ($paradas as $keyParada => $valueParada){
                      echo $valueParada["de"]; ?></br><?php
                    }?></td>
                  <td><?php  foreach ($paradas as $keyParada => $valueParada){
                      echo $valueParada["horaInicioP"].' '.$valueParada["horaFinP"]; ?></br><?php
                    }?></td>
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