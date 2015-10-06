<div class="col-md-8 col-xs-8 table-responsive">
    <div class="nuevo">
        <?php if ($this->session->userdata("grado") >= 2) { ?>
            <?= anchor("productos/nuevoProducto", "Nuevo Producto", "class='btn btn-default'") ?>
        <?php } ?>
    </div>
    <table class="table table-hover ">
        <thead>
            <tr>
                <th>
                    Nombre
                </th>
                <th>
                    Codigo
                </th>
                <th>
                    Precio
                </th>
                <th>
                    Costo
                </th>
                <th>
                    Cantidad
                </th>
                <th>
                    Categoria
                </th>
                <th>
                    Accion
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $value) { ?>
                <tr title="<?= $value->producto_descripcion ?>">
                    <td>
                        <?= $value->producto ?>
                    </td>
                    <td>
                        <?= $value->codigo ?>
                    </td>
                    <td>
                        <?= $value->precio ?>
                    </td>
                    <td>
                        <?= $value->costo ?>
                    </td>
                    <td>
                        <?= $value->cantidad ?>
                    </td>
                    <td>
                        <?= $value->categoria ?>
                    </td>
                    <td>
                        <?= anchor("iproductos/modificar/" . $value->producto_id, "Modificar", "class='btn btn-info'") ?>
                        <?php if ($this->session->userdata("grado") >= 2) { ?>
                            <?= anchor("productos/eliminar/" . $value->producto_id, "Eliminar", "class='btn btn-warning'") ?>
                        <?php } ?>
                        <?= anchor("productos/codigoDeBarra/" . $value->producto_id, "Codigo", "title='Imprimir Codigo de Barras' class='btn btn-default'") ?>
                    </td>
                </tr>
            <?php } ?>
    </table>
</tbody>
</div>