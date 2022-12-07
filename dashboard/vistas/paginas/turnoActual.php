<div class="page-content">
    <div class="page-title">
      <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
              
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
              <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                  </ol>
              </nav>
          </div>
      </div>
    </div>
    <?php
        //crea Dpto
                    $finTurno = new ControladorGestionTurnos();
                    $finTurno -> ctrFinTurno(); 
                    //Fin crea Dpto
        $paradaMaquina = new ControladorGestionTurnos();
        $paradaMaquina -> ctrCrearParadaMaquina(); 
        $agregaMaquina = new ControladorGestionTurnos();
        $agregaMaquina -> ctrAgregaMaquina(); 
        $creaTurno = new ControladorGestionTurnos();
        $creaTurno -> ctrCreaTurno(); 
        $empresa = ControladorGestionTurnos::ctrConsultarEmpresa();
        if(isset($_POST["idTurno"]))
        {
            $item = "id"; 
            $valor = $_POST["idTurno"];
            $turno = ControladorGestionTurnos::ctrMostrarTurnoActual($item, $valor);
                }else{
                    $item = "idUsuario"; 
                    $valor = $usuario["id"]; 
                    $turno = ControladorGestionTurnos::ctrMostrarTurnoActual($item, $valor);
            }    
    ?>
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="col-12 col-lg-12">
                <div class="card">
                        <div class="card-body">
                            <h5><b>Turno abierto. Empresa: <?php echo $empresa["nombre"];  ?></b></h5>
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Hora Inicio</th>
                                            <th>Hora Fin</th>
                                            <th>Departamento</th>
                                            <th>Maquina</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="col-auto">
                                                <p class="mb-0"><?php echo $turno["id"]?></p>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0"><?php echo $turno["fechaR"]?></p>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0"><?php echo $turno["horaInicio"]?></p>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0"><?php echo $turno["horaFin"]; ?></p>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0"><?php 
                                                $item = "id"; 
                                                $valor = $turno["idDpto"];
                                                $dpto = ControladorGestionTurnos::ctrMostrarDptoDelTurno($item, $valor);
                                                echo $dpto["nombre"]; 
                                                ?></p>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0"><?php //echo $turno["idMaquina"];
                                                $item = "id"; 
                                                $valor = $turno["idMaquina"];
                                                $maquina = ControladorGestionTurnos::ctrMostrarMaquinaDelTurno($item, $valor);
                                                   if(isset($maquina["nombre"])) { echo $maquina["nombre"]; }else{ echo "No"; }                                             
                                                ?></p>
        
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" ata-bs-toggle="tooltip" title="Editar cita" data-bs-toggle="modal" data-bs-target="#modalFinTurno" onclick="carga_ajaxPassword('<?php echo $turno["id"]; ?>', 'modalFinTurno','vistas/paginas/modalFinTurno.php');">
                                                <button type="submit" class="btn btn-sm btn-primary">Fin Turno</button>
                                            </td>
                                            <td>
                                            <a href="javascript:void(0);" ata-bs-toggle="tooltip" title="Editar cita" data-bs-toggle="modal" data-bs-target="#modalMaquina" onclick="carga_ajaxEditarLink('<?php echo $turno["idDpto"]; ?>', '<?php echo $turno["id"]; ?>', 'modalMaquina','vistas/paginas/modalMaquina.php');">
                                                <button type="submit" class="btn botonEditar"><i class="bi bi-gear"></i></button>
                                            </a>
                                         </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <a href="javascript:void(0);" ata-bs-toggle="tooltip" title="Editar cita" data-bs-toggle="modal" data-bs-target="#modalParada" onclick="carga_parada('<?php echo $turno["idDpto"]; ?>', '<?php echo $turno["id"]; ?>', '<?php echo $turno["idMaquina"]; ?>', 'modalParada','vistas/paginas/modalParada.php');">
                                            <input type="submit" id="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-3 auth-colorBtn" value="Agregar parada de maquina">
                                        </a>
                                    </div>
                                </div>
                            </div>

                        <?php
                            $item = "idTurno"; 
                            $valor = $turno["id"];
                            $paradas = ControladorGestionTurnos::ctrMostrarParadasTurnoActual($item, $valor);
                            require_once "vistas/paginas/tablaParadasMaquina.php"; 
                            
                        ?>
                </div>
            </div>
        </div>
    </div>
    </section>
</div>
<?php
    $eliminarParada = new ControladorGestionTurnos();
    $eliminarParada -> ctreliminarParadaMaquina(); 
?>

<!--=====================================
VENTANA MODAL AGREGAR MAQUINA
======================================-->
<div class="modal fade" id="modalMaquina" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">EGP, procesando.....</h4>
      </div>
      <div class="modal-body">
        <h1>EGP, procesando.....</h1>
      </div>
      
    </div>
  </div>
</div>
<!--/modal-->


<!--=====================================
VENTANA MODAL AGREGAR MAQUINA
======================================-->
<div class="modal fade" id="modalParada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">EGP, procesando.....</h4>
      </div>
      <div class="modal-body">
        <h1>EGP, procesando.....</h1>
      </div>
      
    </div>
  </div>
</div>
<!--/modal-->

<!--=====================================
VENTANA MODAL REGISTRAR FIN TURNO
======================================-->
<div class="modal fade" id="modalFinTurno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">EGP, procesando.....</h4>
      </div>
      <div class="modal-body">
        <h1>EGP, procesando.....</h1>
      </div>
      
    </div>
  </div>
</div>
<!--/modal-->