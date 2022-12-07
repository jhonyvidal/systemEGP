<div class="modal-dialog" role="document">
    <div class="modal-content">
         <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel1">Agregar Parada</h5>
              <button type="button" class="close rounded-pill"
                  data-bs-dismiss="modal" aria-label="Close">
                  <i data-feather="x"></i>
              </button>
          </div>
            <div class="modal-body">
                
                <div class="card-body"> 
                    <form method="post" action="turnoActual">
                        <input type="hidden" name="idDpto" value="<?php echo $_POST["id"]; ?>">
                        <input type="hidden" name="idTurno" value="<?php echo $_POST["id2"]; ?>">
                        <p>
                        <div class="col-12">
                                    <div class="row">
                                       <div  class="col-md-6">
                                            Hora inicio
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="time" class="form-control form-control-xl" name="horaI" required="">
                                            <div class="form-control-icon">
                                                <i class="bi bi-watch"></i>
                                            </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            Hora fin
                                            <div class="form-group position-relative has-icon-left">
                                                <input type="time" class="form-control form-control-xl" name="horaF" required="">
                                            <div class="form-control-icon">
                                                <i class="bi bi-watch"></i>
                                            </div>
                                            </div>
                                        </div>
                                            
                                    </div>
                                </div>
                                <p>
                        <div class="form-group position-relative has-icon-left mb-2">
                            <select class="form-control form-control-xl" aria-label="Default select example" required="" name="idTParada">
                              <option></option>
                              <?php
                                require_once "../../controladores/gestionTurnos.controlador.php";
                                require_once "../../modelos/gestionTurnos.modelo.php";
                                $item = "idMaquina"; 
                                $valor = $_POST["id3"];
                                  $tParada = new ControladorGestionTurnos();
                                  $tParada -> ctrMostrarTipoParada($item, $valor); 
                                ?>
                            </select>
                            <div class="form-control-icon">
                                <i class="bi bi-tools"></i>
                            </div>
                        </div></p>
                        <input type="submit" id="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-3 auth-colorBtn" value="Crear Parada">
                    </form>
            </div>

            
           <div class="modal-footer">
            <button type="button" class="btn btn-outline-info ml-1" data-bs-dismiss="modal">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Cerrar</span>
            </button>                                
          </div>  
                                        
    </div>