<?php 

if($_SESSION["rol"] != "admin"){
  $item = 'idEmpresa';
  $valor = $_SESSION["empresa"];
  $usuarios = ControladorUsuarios::ctrMostrarusuarios($item, $valor);
}else{
  $item = null;
  $valor = null;
  $usuarios = ControladorUsuarios::ctrMostrarusuarios($item, $valor);
}

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
                    <h3>Usuarios registrados </h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Usuarios</li>
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
          <div class="card-body ">
            <div class="table-responsive">
            <div class="row " >
              <div class="col-10">
              </div>
              <div class="col-2">
                <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#ModalCrearUsuario">Crear Usuario</button>
            </div>  
            </div><br>
            <table id="table_id" class="table table-striped table-bordered dt-responsive">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Foto</th>
                  <th>Empresa</th>
                  <th>Nombre</th>
                  <th>e-Mail</th>
                  <th>Rol</th>
                  <th>Fecha registro</th>
                  <th>Estado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
            <?php foreach ($usuarios as $key => $value): ?>

                 <tr>
                  <td><?php echo($key+1); ?></td>
                  <td><img src="<?php echo $value["foto"]?>" class="img-fluid avatar avatar-xl me-3" width="30px"></td>
                  <td><?php echo $value["empresa"]?></td> 
                  <td><?php echo $value["nombre"]?></td> 
                  <td><?php echo $value["email"]?></td>
                  <td><?php echo $value["rol"]?></td>
                  <td><?php echo $value["fechaR"]?></td>
                  <td><?php  if($value["estado"] == 1){ echo "Activo";}else{echo "Inactivo";} ?></td>
                  <td>
                    <div class="btn-group" style="text-align:center"> 
                      <?php  if($value["estado"] == 1){ 
                        echo'<button class="btn btn-danger btnInactivarUsuario" idUsuario="'.$value["id"].'"><i class="bi bi-lock"></i></button>';
                      }else{
                        echo'<button class="btn btn-success btnActivarUsuario" idUsuario="'.$value["id"].'"><i class="bi bi-unlock"></i></button>';
                      }?>
                    </div>  
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

  <!-- Modal Crear -->
  <div class="modal fade" id="ModalCrearUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form role="form" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
                <label for="Nombre" class="form-label">Empresa</label>
                <select  class="form-select" name="empresaRegistro" id="empresaRegistro" required>
								<option value="<?php echo $_SESSION["empresa"]?>">Seleccionar Tipo Parada</option>
									<?php
                    if($_SESSION["rol"] == 'admin'){
                      $item = null;
                      $valor = null;
                      $tabla = 'empresa';
                      $categorias = ControladorGestionTurnos::ctrMostrarEmpresa($item, $valor, $tabla);
  
                      foreach ($categorias as $key => $value) {
                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                      }
                    }
									?>
							  </select>
            </div>
            <div class="mb-3">
              <label for="Nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" name="nombreRegistro" required>
            </div>
            <div class="mb-3">
              <label for="Correo" class="form-label">Correo</label>
              <input type="email" class="form-control" name="emailRegistro" required>
            </div>
            <div class="mb-3">
              <label for="Telefono" class="form-label">Contraseña</label>
              <input type="password" class="form-control"  name="passRegistro" required>
              <input type="hidden" class="form-control"  name="rolRegistro" required value="<?php echo $_SESSION["rol"]?>">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </div>
        <?php
          $registro = new ControladorUsuarios();
          $registro -> ctrRegistroUsuario();
        ?>
      </form>
    </div>
  </div>
     
  </section>
  <!-- /.content -->
</div>