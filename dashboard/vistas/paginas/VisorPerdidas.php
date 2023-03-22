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
                    <h3>Visor Arbol de Perdidas</h3>
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
          <div class="card-body"  >
            <div id="formfilter">
              <div class="row">
                <div class="col-3">
                <!-- <select  class="form-select" name="tipoDefiltro" id="tipoDefiltro">
                  <option value="1">Tipo de Parada</option>
                  <option value="2">Actividad</option>
                  <option value="3">Productos</option>
                  <option value="4">Recursos</option>
                  <option value="5">Procesos</option>
                </select> -->
                </div>
                <div class="col-7">
                </div>
                <div class="col-2">
                  <a href="oee" class="btn btn-sm btn-secondary float-end">Ver Detalle</a>
                </div>  
              </div><br>
              <div class="row" id="rowVisor1" style="margin-top: -50px;">
                <div class="col-3">
                  <input type="date" name="fechaInicio" id="fechaInicio" value="" class="form-control">
                </div>
                <div class="col-3">
                  <input type="date" name="fechaFin" id="fechaFin" value="" class="form-control">
                </div>
                <!-- <div class="col-3" style="display:none" id="selecTipoParada">
                  <select  class="form-select" name="tipoParada" id="VisorTipoParada" require>
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
                </div> -->
                <div class="col-2">
                  <input type="hidden" value="<?php echo $_SESSION["empresa"];?>" id="idEmpresa"></input>
                  <!-- <button type="submit" class="btn btn-sm btn-primary" id="btnConsultar" disabled>Consultar</button> -->
                </div> 
                <!-- <div class="col-12 order-md-2">
                  <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item breadOee colorActiveBread">OEE Total</li>
                            <li class="breadcrumb-item breadGen">Visor General</li>
                            <li class="breadcrumb-item breadDet">Visor Detallado</li>
                        </ol>
                  </nav>
                </div>  -->
                
              <br></div>
            </div>
            <div class="p-3 text-center">
              <h2 id="tittleDinamic">Visor OEE</h2>  
            </div>
            

            <div class="row mt-5" id="step1" style="display:none">
              <div class="col-3 text-center">
              </div>
              <div class="col-6 text-center">
                  <canvas id="visorStep1" width="100" height="100"></canvas>
              </div>
              <div class="col-3 text-center">
              </div>
            </div>

            <div class="row mt-5" id="step2" style="display:none">
              <div class="col-3 text-center">
              </div>
              <div class="col-6 text-center">
                  <canvas id="visorStep2" width="100" height="100"></canvas>
              </div>
              <div class="col-3 text-center">
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="row">
                  <div class="col-4">
                  </div>
                  <div class="col-4">
                    <div class="card sobraCrearLink"
                        style="border: 1px solid rgba(0,0,0,.125);
                              border-radius: .7rem;
                            ">
                        <div class="card-body" style="text-align:center">
                          <h3>OEE</h3>
                          <p id="textOEE"></p>
                        </div> 
                    </div>
                  </div>
                  <div class="col-4">
                  </div>
                  <div class="col-4">
                    <div class="card sobraCrearLink"  id="CardDisponibilidad"
                        style="border: 1px solid rgba(0,0,0,.125);
                              border-radius: .7rem;
                              "> 
                     
                      <div class="card-body" style="text-align:center">
                        <h5>Disponibilidad</h5>
                        <p id="textDisponibilidad"></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="card sobraCrearLink"  id="CardRendimiento"
                        style="border: 1px solid rgba(0,0,0,.125);
                              border-radius: .7rem;
                            "> 
                      <div class="card-body" style="text-align:center">
                        <h5>Rendimiento</h5>
                        <p id="textRendimiento"></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="card sobraCrearLink"  
                        style="border: 1px solid rgba(0,0,0,.125);
                              border-radius: .7rem;
                            "> 
                      <div class="card-body" style="text-align:center">
                        <h5>Calidad</h5>
                        <p id="textCalidad"></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="row">
                  <div class="col-6">
                    <div class="card sobraCrearLink" 
                            style="border: 1px solid rgba(0,0,0,.125);
                                  border-radius: .7rem;
                                "> 
                          <div class="card-body" style="text-align:center">
                            <canvas id="visor" width="80" height="80" ></canvas>
                          </div>
                    </div> 
                  </div> 
                  <div class="col-6">
                    <div class="card sobraCrearLink" 
                            style="border: 1px solid rgba(0,0,0,.125);
                                  border-radius: .7rem;
                                "> 
                          <div class="row">
                            <div class="col-3">
                            </div> 
                            <div class="col-6 selectTipoParada" style="margin-top:10px">
                              <select  class="form-select" name="tipoParada" id="VisorTipoParada" require>
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
                          <div class="card-body" style="text-align:center">
                      <canvas id="visor2" width="80" height="80" ></canvas>
                    </div> 
                  </div> 
                </div> 
              </div>  
            </div>

            <div class="row" id="step3" style="display:none">
            
              <div class="col-6">
                  <canvas id="visor2" width="100" height="100" ></canvas>
              </div>
              <div class="col-6">
                  <canvas id="visor3" width="100" height="100" ></canvas>
              </div>
              <div class="col-6">
                  <canvas id="visor4" width="100" height="100" ></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
     
  </section>
  <!-- /.content -->
</div>