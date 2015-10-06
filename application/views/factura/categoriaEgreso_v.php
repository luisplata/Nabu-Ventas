<div class="col-md-8 table-responsive" >
    <div class="center-block ">
        <?= anchor("egresos/nuevaCategoria", "Nueva Categoria", 'class="btn btn-default"')
        ?>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>
                    Nombre
                </th>
                <th>
                    Descripcion
                </th>
                <th>
                    Accion
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $value) { ?>
                <tr >
                    <td>
                        <?= $value->nombre ?>
                    </td>
                    <td>
                        <?= $value->descripcion ?>
                    </td>
                    <td>
                        <?= anchor("egresos/modificarCategoria/" . $value->id, "Modificar", 'class="btn btn-info"') ?>
                        <?= anchor("categorias/eliminar/" . $value->id, "Eliminar", 'class="btn btn-warning"') ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>