<div class="table-responsive">
    <table class="table table-hover table-lg">
        <thead>
            <tr>
                <th>N°</th>
                <th>Fecha</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Turno</th>
                <th>Tipo Parada</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <?php foreach ($paradas as $key => $values): ?>
                <td class="col-auto">
                    <p class="mb-0"><?php echo $values["id"] ?></p>
                </td>
                <td class="col-auto">
                    <p class="mb-0"><?php echo $values["fechaR"]?></p>
                </td>
                <td class="col-auto">
                    <p class="mb-0"><?php echo $values["horaInicioP"]?></p>
                </td>
                <td class="col-auto">
                    <p class="mb-0"><?php echo $values["horaFinP"]; ?></p>
                </td>
                <td class="col-auto">
                    <p class="mb-0"><?php echo $values["idTurno"]; ?></p>
                </td>
                <td class="col-auto">
                    <p class="mb-0"><?php 
                    $item = "id"; 
                    $valor = $values["idTipoParada"];
                    $tP = ControladorGestionTurnos::ctrMostrarTipoParadaTurno($item, $valor);
                    echo $tP["nombre"]; 
                    ?></p>
                </td>
                <td>
                    <form method="post">
                      <input type="hidden" name="idParadaT" value="<?php echo $values["id"]; ?>">
                       <input type="hidden" name="idTurno" value="<?php echo $values["idTurno"]; ?>">
                      <button type="submit" class="btn botonEditar"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>