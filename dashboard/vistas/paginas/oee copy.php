<?php 

$item = "idUsuario";
$valor = $usuario["id"];
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
          <div class="card-body">
            <div class="table-responsive">
            <table id="table_id" class="table table-striped table-bordered dt-responsive">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Hora Inicio</th>
                  <th>Hora Fin</th>
                  <th>Dpto</th>
                  <th>Usuario</th>
                  <th>Maquina</th>
                  <th>Buenos</th>
                  <th>Malos</th>
                  <th>Estado</th>
                  <th>Fecha registro</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
            <?php foreach ($turnos as $key => $value): ?>
                 <tr>
                  <td><?php echo $value["id"]; ?></td>
                  <td><?php echo $value["horaInicio"]?></td>
                  <td><?php echo $value["horaFin"]?>
                  <td><?php 
                    $item = "id"; 
                    $valor = $value["idDpto"];
                    $dpto = ControladorGestionTurnos::ctrMostrarDptoDelTurno($item, $valor);
                    echo $dpto["nombre"]; 
                    ?></td> 
                  <td><?php 
                    $item = "id"; 
                    $valor = $value["idUsuario"];
                    $usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                    echo $usuario["nombre"]; 
                    ?>
                  </td>
                  <td><?php 
                    $item = "id"; 
                    $valor = $value["idMaquina"];
                    $maquina = ControladorGestionTurnos::ctrMostrarMaquinaDelTurno($item, $valor);
                       if(isset($maquina["nombre"])) { echo $maquina["nombre"]; }else{ echo "No"; } 
                    ?></td>
                  <td><?php echo $value["pBuenos"]?></td>
                  <td><?php echo $value["pMalos"]?></td>
                  <td><?php 
                        if($value["estado"] = 0 ){ echo "Finalizado"; } else { echo "Abierto"; }
                    ?></td>
                  <td><?php echo $value["fechaR"]?></td>
                  <td> 
                    <form method="post" action="VerTurnoFinalizadoParadas">
                      <input type="hidden" name="idTurno" value="<?php echo $value["id"]; ?>">
                      <button type="submit" class="btn btn-sm btn-primary">Ver</button>
                    </form>
                  </td>
                   <td> 
                    <form method="post" action="VerTurnoFinalizadoParadas">
                      <input type="hidden" name="idTurno" value="<?php echo $value["id"]; ?>">
                      <button type="submit" class="btn btn-sm btn-primary">OEE</button>
                    </form>
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