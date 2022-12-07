<div class="page-content">
    <div class="page-title">
      <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
            <?php   //crea Maquina
                    $creaMaquina = new ControladorGestionMaquinas();
                    $creaMaquina -> ctrCrearMaquina(); 
                    //Fina crea maquina
                    $empresa = ControladorGestionTurnos::ctrConsultarEmpresa();
                    if(isset($_POST["idDpto"]))
                        {
                        $valor = $_POST["idDpto"];
                        $depto = $_POST["nombreD"];
                        $maquinas = ControladorGestionMaquinas::ctrMostrarMaquinasDptoEmpresa($valor);
                         }else{
                            $valor = $_SESSION["idDpto"];
                            $depto = $_SESSION["nombreD"];
                            $maquinas = ControladorGestionMaquinas::ctrMostrarMaquinasDptoEmpresa($valor);
                         }
                ?>
              <h5>Registrar maquinas 
              <p><?php echo $empresa["nombre"];  ?></p></h5>
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
              <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item active" aria-current="page">Maquinas</li>
                      <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                  </ol>
              </nav>
          </div>
      </div>
    </div>
    <section class="row">
        <div class="col-12 col-lg-12">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="javascript:void(0);" ata-bs-toggle="tooltip" title="Editar cita" data-bs-toggle="modal" data-bs-target="#modalCrearMaquina" onclick="carga_ajaxEditarLink('<?php echo $valor; ?>', '<?php echo $depto; ?>', 'modalCrearMaquina','vistas/paginas/modalCrearMaquina.php');">
                            <button type="submit" class="btn btn-lg shadow-lg mt-3 btn-success"><i class="bi bi-gear-wide-connected"></i> Crear maquina</button>
                        </a>
                         <div class="table-responsive">
                            <table class="table table-hover table-lg">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Dpto</th>
                                  <th>Nombre</th>
                                  <th>Producto</th>
                                  <th>Unidad</th>
                                  <th>Velocidad</th>
                                  <th>Fecha Registro</th>
                                  <th></th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                 <?php foreach ($maquinas as $key => $value): ?>
                                 <tr>
                                  <td class="col-auto"><?php echo($key+1); ?></td>
                                  <td class="col-auto"><?php echo $depto; ?></td> 
                                  <td class="col-auto"><?php echo $value["nombre"]?></td> 
                                  <td class="col-auto"><?php echo $value["producto"]?></td> 
                                  <td class="col-auto"><?php echo $value["unidad"]?></td>
                                  <td class="col-auto"><?php echo $value["velocidad"]?></td>
                                  <td class="col-auto"><?php echo $value["fechaR"]?></td>
                                  <td class="col-auto">
                                     <form method="post">
                                      <input type="hidden" name="idEMaquina" value="<?php echo $value["id"]; ?>">
                                      <button type="submit" class="btn botonEditar"><i class="bi bi-trash"></i></button>
                                    </form>  
                                  </td>
                                </tr> 
                              <?php endforeach ?>      
                              </tbody>
                            </table>
                            </div>
                            <?php
                                $eliminarMaquina = new ControladorGestionMaquinas();
                                $eliminarMaquina -> ctrEliminarMaquina(); 
                            ?>    
                    </div>
                </div>
            </div>
        </div>
        </div>

    </section>
</div>

<!--=====================================
VENTANA MODAL Crear MAQUINA
======================================-->
<div class="modal fade" id="modalCrearMaquina" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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

