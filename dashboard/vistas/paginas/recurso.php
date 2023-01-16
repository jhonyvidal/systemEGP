<div class="page-content">
    <div class="page-title">
      <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
            <?php
                    //crea Dpto
                    $creaDpto = new ControladorGestionMaquinas();
                    $creaDpto -> ctrCrearRecurso(); 
                    //Fin crea Dpto
                    $empresa = ControladorGestionTurnos::ctrConsultarEmpresa();
                    $valor = $empresa["id"];
                    $dpto = ControladorGestionMaquinas::ctrMostrarRecursoEmpresa($valor);
                ?>
              <h5>Registrar recursos 
              <p><?php echo $empresa["nombre"];  ?></p></h5>
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
              <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item active" aria-current="page">Recursos</li>
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
                    <div class="card-header">
                        <a href="javascript:void(0);" ata-bs-toggle="tooltip" title="Editar cita" data-bs-toggle="modal" data-bs-target="#modalCrearDpto" onclick="carga_ajaxPassword('<?php echo $valor; ?>', 'modalCrearDpto','vistas/paginas/modalCrearRecurso.php');">
                            <button type="submit" class="btn btn-lg shadow-lg mt-3 btn-success"><i class="bi bi-plus-circle-dotted"></i> Crear Recurso</button>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                        <?php foreach ($dpto as $key => $value): ?>
                        
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card sobraCrearLink">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted font-semibold"><?php echo $value["descripcion"]?></h6>
                                            <h6 class="font-extrabold mb-0"><?php echo($key+1); ?></h6>
                                        </div>
                                        <div class="col-md-3">
                                            <form method="post">
                                                <input type="hidden" name="idER" value="<?php echo $value["id"]; ?>">
                                                <button type="submit" class="btn botonEditar"><i class="bi bi-trash"></i></button>
                                            </form>  
                                        </div>
                                        </div>
                                        <br>
                                        <div>
                                            <form method="post" action="productos">
                                                <input type="hidden" name="idDpto" value="<?php echo $value["id"]; ?>">
                                                <input type="hidden" name="nombreD" value="<?php echo $value["descripcion"]; ?>">
                                              <button type="submit" class="btn btn-block btn-primary">Ver productos</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                         <?php endforeach ?>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
 <?php
    $eliminarDpto = new ControladorGestionMaquinas();
    $eliminarDpto -> ctrEliminarRecurso(); 
?>  
    </section>
</div>

<!--=====================================
VENTANA MODAL Crear Dpto
======================================-->
<div class="modal fade" id="modalCrearDpto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
