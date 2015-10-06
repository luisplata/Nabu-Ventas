<div class="col-md-8 table-responsive" >
    <div class="center-block ">
        <?= anchor("clientes/ingresar", "Nuevo Cliente", 'class="btn btn-default"') ?>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>
                    Nombre
                </th>
                <th>
                    Telefono
                </th>
                <th>
                    Direccion
                </th>
                <th>
                    Credito
                </th>
                <th>
                    Accion
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $value) { ?>
                <tr class="bg-<?= ($value->credito >= 0) ? "success" : "danger" ?>">
                    <td>
                        <?= $value->nombre ?>
                    </td>                    
                    <td>
                        <?= $value->telefono ?>
                    </td>
                    <td>
                        <?= $value->direccion ?>
                    </td>
                    <!--<td>
                        <img src="<?= base_url() ?>images/barcode/personal.php?numero=<?= $value->codigo ?>"/>
                    </td>-->
                    <td>
                        <?= $value->credito ?> 
                    </td>
                    <td>
                        <?php //anchor("clientes/modificar/" . $value->id, "Modificar", 'class="btn btn-info"'); ?>
                        <?= anchor("clientes/credito/" . $value->id, "Pagar", 'title="Pagar Credito" class="btn btn-success"') ?>
                        <?= anchor("clientes/codigo/" . $value->codigo, "Codigo", 'class="btn btn-default"') ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>