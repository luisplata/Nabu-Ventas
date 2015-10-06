<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title><?= $this->config->item("NOMBREAPP") ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="<?= base_url() ?>js/jquery-2.1.1.min.js" language="Javascript"></script>
        <script src="<?= base_url() ?>js/ajax.js" language="Javascript"></script>

        <!-- Librería jQuery requerida por los plugins de JavaScript -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <!-- Todos los plugins JavaScript de Bootstrap (también puedes
                     incluir archivos JavaScript individuales de los únicos
                     plugins que utilices) -->
        <script src="<?= base_url() ?>js/bootstrap.min.js"></script>
        <!--css-->
        <link href="<?= base_url() ?>css/bootstrap.min.css" rel="stylesheet" media="screen">
        <!-- bootstrap-->
    </head>
    <body><?php
        //totales de todo
        $totalEgreso = 0;
        $totalIngreso = 0;
        $totalDevoluciones = 0;
        $total = 0;
        $ingresosEspeciales = 0;
        /*
         * Hacer una serie de graficos para mostrar mejor los datos
         */
        ?>
        <!--
        Aqui se ahara el diseño nuevo:
        se realizara de la siguiente forma:
        - se haran 3 cuadros de col-4 para dividir en 3 la pantalla
        - se colocara el titulo de cada cuadro en la cabeza
        - se coloca un div con el contenido de este mismo.
        - debajo de estos en el centro se colocara el div donde se dara la ganancia.
        -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-6 col-sm-6">
                    <div class="text-center h2">
                        Datos de Cajero 
                    </div>
                    <div style="overflow: auto; height: 500px;">
                        <table class="table table-hover table-bordered">
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
                                        Facturas Realizadas
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($empleados as $key => $value) { ?>
                                    <?php $cantidad = 0 ?>
                                    <tr>
                                        <td>
                                            <?= $value->nombre ?>
                                        </td>
                                        <td>
                                            <?= $value->apellido ?>
                                        </td>
                                        <td>
                                            <?= $value->documento ?>
                                        </td>
                                        <td>
                                            <?php
                                            /* Aqui vamos a hacer lo siguiente:
                                             * Vamos a pasar la lista de facturas y si la id de la persona es igual, ++
                                             * sino dejamos pasar
                                             */
                                            foreach ($numeroPorEmpleado as $value2) {
                                                if ($value2->usuario_id == $value->usuario_id) {
                                                    $cantidad++;
                                                }
                                            }
                                            ?>
                                            <?= $cantidad ?>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6">
                    <div class="text-center h2">
                        Facturas
                    </div>
                    <div style="overflow: auto; height: 500px;">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td>
                                        No
                                    </td>
                                    <td>
                                        Descripcion
                                    </td>
                                    <td>
                                        precio
                                    </td>
                                    <td>
                                        Costo
                                    </td>
                                    <td>
                                        Ganancia
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_precio_total = 0;
                                $total_costo_total = 0;
                                foreach ($numeroPorEmpleado as $value) {
                                    $total = 0;
                                    $total_precio = 0;
                                    $total_costo = 0;
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $value->factura ?>
                                        </td>
                                        <td>
                                            <table class="table table-condensed table-responsive table-striped">
                                                <?php
                                                foreach ($facturas as $value3) {

                                                    if ($value->factura == $value3->factura) {
                                                        $total += $value3->producto_precio;
                                                        $total_precio +=$value3->producto_precio;
                                                        $total_costo += $value3->producto_costo;
                                                        ?>
                                                        <tr>
                                                            <td>
                                                                <?= $value3->producto_nombre ?>
                                                            </td>
                                                            <td>
                                                                <div class="pull-right">
                                                                    <?= number_format($value3->producto_precio) ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <tr>
                                                    <td  colspan="2">
                                                        <div class="pull-right">
                                                            Total : <?= number_format($total) ?>    
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <?= number_format($total_precio) ?>
                                        </td>
                                        <td>
                                            <?= number_format($total_costo) ?>
                                        </td>
                                        <td>
                                            <?= number_format($total_precio - $total_costo) ?>
                                            <?php
                                            $total_costo_total += $total_costo;
                                            $total_precio_total += $total_precio;
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="2">
                                        <div class="pull-right">
                                            TOTALES
                                        </div>
                                    </td>
                                    <TD>
                                        <?= number_format($total_precio_total) ?>
                                    </TD>
                                    <td>
                                        <?= number_format($total_costo_total) ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo number_format($total_precio_total - $total_costo_total);
                                        $totalIngreso = $total_precio_total - $total_costo_total;
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6">
                    <div class="text-center h2">
                        Egresos
                    </div>
                    <div style="overflow: auto; height: 500px;">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td>
                                        Descripcion
                                    </td>
                                    <td>
                                        Usuario
                                    </td>
                                    <td>
                                        Fecha
                                    </td>
                                    <td>
                                        Cantidad
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $cantidad = 0;
                                foreach ($egreso as $value) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $value->descripcion ?>
                                        </td>
                                        <td>
                                            <?= $value->persona_nombre ?>
                                        </td>
                                        <td>
                                            <?= $value->fecha ?>
                                        </td>
                                        <td>
                                            <?= number_format($value->cantidad) ?>
                                            <?php
                                            $cantidad += $value->cantidad;
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="4">
                                        <span class="pull-right">
                                            Total: <?php
                                            echo $cantidad;
                                            $totalEgreso = $cantidad;
                                            ?>
                                        </span>
                                    </td>                               
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6">
                    <div class="text-center h2">
                        Devouciones
                    </div>
                    <div style="overflow: auto; height: 500px;">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td>
                                        Fecha
                                    </td>
                                    <td>
                                        Producto
                                    </td>
                                    <td>
                                        Precio
                                    </td>                                    
                                    <td>
                                        Costo
                                    </td>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $precio = 0;
                                $totalDevoluvionesPrecio = 0;
                                $totalDevoluvionesCosto = 0;
                                foreach ($devoluciones as $value) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $value->fecha ?>
                                        </td>
                                        <td>
                                            <?= $value->producto_nombre ?>
                                        </td>
                                        <td>

                                            <?= number_format($value->producto_precio) ?>
                                            <?php $totalDevoluvionesPrecio +=$value->producto_precio ?>

                                        </td>
                                        <td>
                                            <?= number_format($value->producto_costo) ?>
                                            <?php $totalDevoluvionesCosto +=$value->producto_costo ?>
                                            <?php
                                            $precio += ($value->producto_precio - $value->producto_costo);
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td  colspan="2">
                                        <div class="pull-right">
                                            Totales:    
                                        </div>

                                    </td>                                    
                                    <td>
                                        <?= $totalDevoluvionesPrecio ?>
                                    </td>
                                    <td>
                                        <?= $totalDevoluvionesCosto ?>
                                        <span class="pull-right">
                                            Diferencia:  <?= number_format($precio) ?>
                                            <?php
                                            $totalDevoluciones = $precio;
                                            ?>
                                        </span>
                                    </td>                               
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6">
                    <div class="text-center h2">
                        Ingresos Especiales
                    </div>
                    <div style="overflow: auto; height: 500px;">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Cantidad
                                    </th>
                                    <th>
                                        Descripcion
                                    </th>                                    
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $totalIngresosEspeciales = 0;
                                foreach ($ingresos_especiales as $key => $value) {
                                    ?>
                                    <?php $cantidad = 0 ?>
                                    <tr>
                                        <td>
                                            <?= $value->fecha ?>
                                        </td>
                                        <td>
                                            <?= $value->cantidad ?>
                                            <?php
                                            $ingresosEspeciales += $value->cantidad;
                                            $totalIngresosEspeciales +=$value->cantidad;
                                            ?>
                                        </td>
                                        <td>
                                            <?= $value->descripcion ?>
                                        </td>                                        
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td>
                                        <div class="pull-right">
                                            Total:    
                                        </div>
                                    </td>
                                    <td colspan="2">
                                        <?= $totalIngresosEspeciales ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-xs-12 col-sm-12 text-capitalize text-center bg-info">
                    <span class="h2">
                        ganancia: <?php
                        $total = $totalIngreso - $totalEgreso - $totalDevoluciones + $ingresosEspeciales;
                        ?>
                        <?= number_format($total) ?>
                    </span>
                    <br/>
                    <?= anchor("facturacion/reporteDeCaja", "Atras", "class='btn btn-success'") ?>
                </div>

            </div>
        </div>
    </div>


    <script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
</body>
</html>