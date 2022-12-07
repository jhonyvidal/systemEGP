<div class="modal-dialog" role="document">
    <div class="modal-content">
         <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel1">Agregar maquina</h5>
              <button type="button" class="close rounded-pill"
                  data-bs-dismiss="modal" aria-label="Close">
                  <i data-feather="x"></i>
              </button>
          </div>
            <div class="modal-body">
                Selecione una maquina
                <div class="card-body"> 
                    <form method="post" action="turnoActual">
                        <input type="hidden" name="idDpto" value="<?php echo $_POST["id"]; ?>">
                        <input type="hidden" name="idTurno" value="<?php echo $_POST["id2"]; ?>">
                        <p>
                        <div class="form-group position-relative has-icon-left mb-2">
                            <select class="form-control form-control-xl" aria-label="Default select example" required="" name="idMaquina">
                              <option>Selecione una maquina</option>
                              <?php
                                require_once "../../controladores/gestionTurnos.controlador.php";
                                require_once "../../modelos/gestionTurnos.modelo.php";
                                $item = "idDepartamento"; 
                                $valor = $_POST["id"];
                                  $maquina = new ControladorGestionTurnos();
                                  $maquina -> ctrMostrarMaquina($item, $valor); 
                                ?>
                            </select>
                            <div class="form-control-icon">
                                <i class="bi bi-tools"></i>
                            </div>
                        </div></p>
                        <input type="submit" id="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-3 auth-colorBtn" value="Iniciar Maquina">
                    </form>
            </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-outline-info ml-1" data-bs-dismiss="modal">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Cerrar</span>
            </button>                                
          </div>  
                                        
    </div>