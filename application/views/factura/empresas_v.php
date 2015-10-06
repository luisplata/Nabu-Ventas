<div class="col-md-8 table-responsive" >
    <div class="center-block ">
        <?= anchor("empresas/nuevaEmpresa", "Nueva Empresa", 'class="btn btn-default"') ?>
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
                    E-Mail
                </th>
                <th>
                    Estado
                </th>
                <th>
                    Accion
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empresas as $value) { ?>
                <tr >
                    <td>
                        <?= $value->nombre ?>
                    </td>
                    <td>
                        <?= $value->telefono ?>
                    </td>
                    <td>
                        <?= $value->email ?>
                    </td>
                    <td>
                        <?php
                        if ($value->activo) {
                            echo "Activo";
                        } else {
                            echo 'Inactivo';
                        }
                        ?>
                    </td>
                    <td>
                        <?= anchor("empresas/modificar/" . $value->id, "Modificar", 'class="btn btn-info"') ?>
                        <?= anchor("empresas/eliminar/" . $value->id, "Eliminar", 'class="btn btn-warning"') ?>
                        <?php
                        if ($value->activo) {
                            echo anchor("empresas/desactivar/" . $value->id, "Inactivar", 'class="btn btn-danger"');
                        } else {
                            echo anchor("empresas/activar/" . $value->id, "Activar", 'class="btn btn-success"');
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>