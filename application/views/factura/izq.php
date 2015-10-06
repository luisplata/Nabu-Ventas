<div class="col-md-4">
    <div class="text-center">
        <h2>Accesos Rapidos</h2>
        <?= anchor("facturacion/nuevaFactura", "Nueva Factura", "class='btn btn-default'") ?>
        <?PHP if ($this->session->userdata("grado") >= 2) { ?>
            <?= anchor("productos/ingresar", "Ingresar mas productos", "class='btn btn-default'") ?>
            <?= anchor("clientes/ingresar", "Ingresar Nuevo Cliente", "class='btn btn-default'") ?>
        <?php } ?>
        <?= anchor("devolucion/devolver", "Devoluciones", "class='btn btn-default'") ?>
    </div>
    <!--Colocando los productos bajos de stock solo para los que tengan grado 2 o mas -->

    <div class="table-responsive" style="overflow: scroll; height: 600px;">
        <?php
        $ci = &get_instance();
        $ci->load->model("producto_model", "producto");
        $productos = $ci->producto->productoStock();
        if ($productos) {
            ?>
            <h2>
                Productos con Bajo Stock
            </h2>
            <table class="table table-responsive table-condensed" title="Productos con bajo stock">
                <thead>
                    <tr>
                        <td>
                            Producto
                        </td>
                        <td>
                            Codigo
                        </td>
                        <td>
                            Cantidad
                        </td>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($productos as $value) {
                        ?>
                        <tr class="<?= ($value->cantidad <= 5) ? 'danger' : 'warning' ?>"
                            >
                            <td>
                                <?PHP if ($this->session->userdata("grado") >= 2) { ?>
                                    <?= anchor("productos/ingresar/" . $value->codigo, $value->nombre, "class='btn btn-default' title='Ingresar mas de este producto'")
                                    ?>
                                    <?php
                                } else {
                                    echo $value->nombre;
                                }
                                ?>
                            </td>
                            <td>
                                <?= $value->codigo ?>
                            </td>
                            <td>
                                <?= $value->cantidad ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table>
            <?php
        }
        ?>
    </div>

</div>