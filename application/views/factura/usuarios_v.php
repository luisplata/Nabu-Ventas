<div class="col-md-8 table-responsive">
    <div class="nuevo">
        <?= anchor("usuarios/nuevoUsuario", "Nuevo Usuario", "class='btn btn-default'") ?>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>
                    Nombre
                </th>
                <th>
                    Apellido
                </th>
                <th>
                    Documento
                </th>
                <th>
                    Empresa
                </th>
                <th>
                    Accion
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $value) { ?>
                <tr>
                    <td>
                        <?= $value->nombre_persona ?>
                    </td>
                    <td>
                        <?= $value->apellido_persona ?>
                    </td>
                    <td>
                        <?= $value->documento ?>
                    </td>
                    <td>
                        <?= $value->empresa ?>
                    </td>
                    <td>
                        <?= anchor("usuarios/modificar/" . $value->usuario_id, "Modificar", "class='btn btn-info'") ?>
                        <?= anchor("usuarios/eliminar/" . $value->usuario_id, "Eliminar", "class='btn btn-warning'") ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>