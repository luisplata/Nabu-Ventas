<div class="col-md-8 table-responsive" >
    <div class="center-block ">
        <?= anchor("movimientos/nuevoMovimiento", "Nuevo Movimiento", 'class="btn btn-default"') ?>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>
                    Fecha
                </th>
                <th>
                    Sede Salida
                </th>
                <th>
                    Sede Entrada
                </th>
                <th>
                    Producto
                </th>
                <th>
                    Cantidad
                </th>
                <th>
                    Accion
                </th>
            </tr>
        </thead>
        <tbody>            
            <?php foreach ($movimientos as $value) { ?>
                <tr >
                    <td>
                        <?= $value->fecha ?>
                    </td>
                    <td>
                        <?= $value->sede_salida ?>
                    </td>
                    <td>
                        <?= $value->sede_entrada ?>
                    </td>
                    <td>
                        <?= $value->producto_nombre ?>
                    </td>
                    <td>
                        <?= $value->cantidad ?>

                    </td>
                    <td>
                        <?=
                        anchor("movimientos/eliminar/" . $value->id, "Eliminar", ($this->session->userdata("valor") == "10") ? 'class="btn btn-warning"' : 'class="btn btn-warning disabled"')
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>