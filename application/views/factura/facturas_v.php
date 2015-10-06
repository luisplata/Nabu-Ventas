<div class="col-md-8 table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>
                    Factura #
                </th>
                <th>
                    Fecha
                </th>
                <th>
                    Accion
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($facturas as $value) { ?>
                <tr>
                    <td>
                        <?= anchor("facturacion/verFactura/" . $value->facturaNumero, $value->facturaNumero 
                                ,"class='btn btn-default'")?>
                    </td>
                    <td>
                        <?= $value->fecha ?>
                    </td>
                    <td>
                        <?= anchor("categorias/modificar/" . 
                                $value->facturaNumero, "Modificar", "class='btn btn-info'") ?>
                        <?= anchor("categorias/eliminar/" . 
                                $value->facturaNumero, "Eliminar", "class='btn btn-warning'") ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>