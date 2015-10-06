<div class="col-md-8 table-responsive">
    <table class="table">
        <thead>
            <?php $total = 0; ?>
            <tr>
                <th>
                    Producto
                </th>
                <th>
                    Codigo
                </th>
                <th>
                    Precio
                </th>
            </tr>
        </thead>
        <tbody>
            <?= form_open("facturas/generarFactura", array("id" => "facturadoraPrincipal")) ?>
            <?php
            foreach ($factura as $value) {
                $total += $value->precio;
                ?>
                <tr>
                    <td>
                        <?= $value->producto_nombre ?>
                        <?php
                        echo "<input type='hidden' name='codigo[]' value='" . $value->codigo . "' />" .
                        "<input type='hidden' name='nombre[]' value='" . $value->producto_nombre . "' />" .
                        "<input type='hidden' name='precio[]' id='precioProducto[]' value='" .
                        $value->precio . "' />" .
                        "<input type='hidden' name='id[]'  value='" . $value->producto_id . "' />" .
                        "</td>";
                        ?>
                    </td>
                    <td>
                        <?= $value->codigo ?>
                    </td>
                    <td>
                        <?= $value->precio ?>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td>

                </td>
                <td>
                    Total
                </td>
                <td>
                    <?= $total ?>
                </td>
            </tr>
            <tr>
                <td>
                    <!--<input type="submit" value="Volver a Imprimir" class="btn btn-success"/> 
                    para volver a imprimir la factura modificar el accion del form
                    para imprimir la misma factura sin aumentar el contador de la factura-->
                </td>
                <td>
                    
                </td>
                <td>
                    
                </td>
            </tr>
            </form>
        </tbody>
    </table>
</div>