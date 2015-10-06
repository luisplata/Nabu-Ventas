<div class="col-md-8 table-responsive" >
    <div class="center-block ">
        <?= anchor("egresos/nuevo", "Nuevo Egreso", 'class="btn btn-default"') ?>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>
                    Descripcion
                </th>
                <th>
                    Cantidad
                </th>
                <th>
                    fecha
                </th>
                <th>
                    Usuario
                </th>
                <th>
                    Accion
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($egresos as $value) { ?>
                <tr>
                    <td>
                        <?= $value->descripcion ?>
                    </td>                    
                    <td>
                        <?= $value->cantidad ?>
                    </td>
                    <td>
                        <?= $value->fecha ?>
                    </td>
                    <!--<td>
                        <img src="<?= base_url() ?>images/barcode/personal.php?numero=<?= $value->codigo ?>"/>
                    </td>-->
                    <td>
                        <?= $value->persona_nombre ?> <?= $value->persona_apellido ?> 
                    </td>
                    <td>
                        <?php //anchor("clientes/modificar/" . $value->id, "Modificar", 'class="btn btn-info"'); ?>
                        <?= anchor("egresos/eliminar/" . $value->id, "Eliminar", 'class="btn btn-warning"') ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>