<div class="page-content">
    <div class="page-title">
      <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
              <h4>Gestión de información producion </h4>
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
      $empresa = ControladorGestionTurnos::ctrConsultarEmpresa();
    ?>
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h3>Crear Turno</h3>
                            <h5><b>Empresa: <?php echo $empresa["nombre"];  ?></b></h5>
                        
                            <form method="post" action="turnoActual">
                                <input type="hidden" name="idU" value="<?php echo $usuario["id"]; ?>">
                                 
                                <div class="col-12">
                                    <div class="row">
                                       <div  class="col-md-6">
                                            Hora inicio
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="time" class="form-control form-control-xl" name="horaInicio" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-watch"></i>
                                            </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            Hora fin
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="time" class="form-control form-control-xl" name="horaFin" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-watch"></i>
                                            </div>
                                            </div>
                                        </div>
                                            
                                    </div>
                                </div>
                                <p>
                                
                                <div class="form-group position-relative has-icon-left mb-2">
                                    <select class="form-control form-control-xl" aria-label="Default select example" required name="idDpto">
                                      <option>Selecione el departamento</option>
                                      <?php

                                        $item = "idEmpresa"; 
                                        $valor = $empresa["id"]; 

                                        $categorias = ControladorGestionTurnos::ctrMostrarDpto($item,$valor);

                                        foreach ($categorias as $key => $value) {
                                            echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                                        }

                                        ?>
                                    </select>
                                    <div class="form-control-icon">
                                        <i class="bi bi-tools"></i>
                                    </div>
                                </div></p>
                                <input type="submit" id="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-3 auth-colorBtn" value="Crear Turno">
                            </form>
                          <?php 
                                $creaTurno = new ControladorGestionTurnos();
                                $creaTurno -> ctrCreaTurno(); 
                          ?>

                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h3>Link Producción</h3>
                            <a target="_blank" href="http://localhost/EGP/EGPV2/vistas/ScreenView/index.php?empresa=<?php echo $empresa["id"] ?>&idU=<?php echo $_SESSION["idU"]?>">
                                <input type="button" id="link" class="btn btn-primary btn-block btn-lg shadow-lg mt-3 auth-colorBtn" value="Crear Link">
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
            
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <strong>Maquinas </strong>

                    <div class="btn-group btn-group">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


    </section>
</div>
