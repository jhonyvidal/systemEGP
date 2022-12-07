<div class="modal-dialog" role="document">
    <div class="modal-content">
         <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel1">Crar maquina departamento <?php echo $_POST["id2"]; ?></h5>
              <button type="button" class="close rounded-pill"
                  data-bs-dismiss="modal" aria-label="Close">
                  <i data-feather="x"></i>
              </button>
          </div>
            <div class="modal-body">
                 <div class="card-body"> 
                    <form method="post" action="maquinas">
                        <input type="hidden" name="idDpto" value="<?php echo $_POST["id"]; ?>">
                        <input type="hidden" name="nombreD" value="<?php echo $_POST["id2"]; ?>">
                        <p>
                        <div class="col-12">
                            <div class="row">
                               <div  class="col-md-6">
                                    Nombre maquina
                                    <div class="form-group position-relative has-icon-left">
                                        <input type="text" class="form-control form-control-xl" name="nombre" required="">
                                        <div class="form-control-icon">
                                            <i class="bi bi-tag"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    Producto que fabrica
                                    <div class="form-group position-relative has-icon-left">
                                        <input type="text" class="form-control form-control-xl" name="producto" required="">
                                         <div class="form-control-icon">
                                            <i class="bi bi-bag"></i>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                         <div class="col-12">
                            <div class="row">
                               <div  class="col-md-6">
                                    Unidad de medida
                                    <div class="form-group position-relative has-icon-left">
                                        <input type="text" class="form-control form-control-xl" name="unidad" required="">
                                         <div class="form-control-icon">
                                            <i class="bi bi-box"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    Cantidad por hora
                                    <div class="form-group position-relative has-icon-left">
                                        <input type="number" class="form-control form-control-xl" name="velocidad" required="">
                                         <div class="form-control-icon">
                                            <i class="bi bi-watch"></i>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <input type="submit" id="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-3 auth-colorBtn" value="Crear Maquina">
                    </form>
            </div>
           <div class="modal-footer">
            <button type="button" class="btn btn-outline-info ml-1" data-bs-dismiss="modal">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Cerrar</span>
            </button>                                
          </div>  
                                        
    </div>