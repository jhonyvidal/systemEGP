<?php 
if($usuario["rol"] != "admin"){
  echo '<script>
  window.location = "'.$ruta.'inicio";
  </script>';
  return;
}
$item = null;
$valor = null;
$tabla = 'empresa';
$empresas = ControladorGestionTurnos::ctrMostrarEmpresa($item, $valor, $tabla);

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
                    <h3>Empresas registradas </h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Empresas</li>
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
                <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">Crear Empresa</button>
              </div>  
            </div><br>
            <table id="table_id" class="table table-striped table-bordered dt-responsive tablaEmpresa">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Nit</th>
                  <th>Dirección</th>
                  <th>e-Mail</th>
                  <th>Telefono</th>
                  <th>Fecha registro</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
            <?php foreach ($empresas as $key => $value): ?>

                <tr>
                  <td><?php echo($key+1); ?></td>
                  <td><?php echo $value["nombre"]?></td> 
                  <td><?php echo $value["nit"]?></td>
                  <td><?php echo $value["direccion"]?></td>
                  <td><?php echo $value["email"]?></td>
                  <td><?php echo $value["telefono"]?></td>
                  <td><?php echo $value["fechaR"]?></td>
                  <td>
                      <div class="btn-group"> 
                        <button class="btn btn-warning btnEditarEmpresa" data-bs-toggle="modal" data-bs-target="#modalEditarEmpresa" idEmpresa="<?php echo $value["id"]?>"><i class="bi bi-pencil"></i></button>
                        <button class="btn btn-danger btnEliminarEmpresa" idEmpresa="<?php echo $value["id"]?>"><i class="bi bi-trash"></i></button>
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
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form role="form" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Crear Empresa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="Nombre" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="Nombre" name="Nombre" required>
            </div>
            <div class="mb-3">
              <label for="Nit" class="form-label">Nit</label>
              <input type="text" class="form-control" id="Nit"  name="Nit" required>
            </div>
            <div class="mb-3">
              <label for="Direccion" class="form-label">Dirección</label>
              <input type="text" class="form-control" id="Direccion" name="Direccion" required>
            </div>
            <div class="mb-3">
              <label for="Correo" class="form-label">Correo</label>
              <input type="email" class="form-control" id="Correo" name="Email" required>
            </div>
            <div class="mb-3">
              <label for="Telefono" class="form-label">Teléfono</label>
              <input type="tel" class="form-control" id="Telefono" name="Telefono" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </div>
      </form>
      <?php

        $crearEmpresa = new ControladorEmpresas();
        $crearEmpresa -> ctrCrearEmpresa();

      ?>
    </div>
  </div>

  <!-- Modal  Editar-->
  <div class="modal fade" id="modalEditarEmpresa" tabindex="-2" aria-labelledby="modalEditarEmpresaLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form role="form" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalEditarEmpresaLabel">Editar Empresa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="Nombre" class="form-label">Nombre</label>
              <input type="hidden" id="idEmpresa" name="idEmpresa">
              <input type="text" class="form-control" id="EditNombre" name="Nombre" required>
            </div>
            <div class="mb-3">
              <label for="Nit" class="form-label">Nit</label>
              <input type="text" class="form-control" id="EditNit"  name="Nit" required>
            </div>
            <div class="mb-3">
              <label for="Direccion" class="form-label">Dirección</label>
              <input type="text" class="form-control" id="EditDireccion" name="Direccion" required>
            </div>
            <div class="mb-3">
              <label for="Correo" class="form-label">Correo</label>
              <input type="email" class="form-control" id="EditCorreo" name="Email" required>
            </div>
            <div class="mb-3">
              <label for="Telefono" class="form-label">Teléfono</label>
              <input type="tel" class="form-control" id="EditTelefono" name="Telefono" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Editar</button>
          </div>
        </div>
      </form>
      <?php

        $crearEmpresa = new ControladorEmpresas();
        $crearEmpresa -> ctrEditarEmpresa();

      ?>
    </div>
  </div>
     
  </section>
  <!-- /.content -->
</div>