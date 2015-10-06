<div class="col-md-8 table-responsive" >
    <div class="center-block ">
        <?= anchor("categorias/nuevaCategoria", "Nueva Categoria", 'class="btn btn-default"')
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
                    Padre
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
                        <?= $value->padre ?>
                    </td  >
                    <td>
                        <?= anchor("categorias/modificar/" . $value->id, "Modificar", 'class="btn btn-info"') ?>
                        <?= anchor("categorias/eliminar/" . $value->id, "Eliminar", 'class="btn btn-warning"') ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>