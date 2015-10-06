<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Plantilla de factura</title>
        <!-- CSS de Bootstrap -->
        <link href="<?= base_url() ?>css/bootstrap.min.css" rel="stylesheet" media="screen">

        <!-- librerías opcionales que activan el soporte de HTML5 para IE8 -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="">
            <!--            <div class="container" style="margin-left: 1px;">
                            <div class="col-md-3">
                                <h3>
                                    Factura No <?= $facturaNumero ?> <br/> 
                                </h3>
                                <img src="<?= base_url() . $this->session->userdata("logo_url") ?>" class="img-responsive img-circle"/>
                                <h5>
                                    <small>
                                        Empresa: <?= $this->session->userdata("empresa_nombre") ?><br/>
                                        Direccion: <?= $this->session->userdata("empresa_direccion") ?><br/>
                                        Telefono: <?= $this->session->userdata("empresa_telefono") ?><br/>
                                    </small>
                                </h5>
                            </div>
                        </div>
            
                        <div class="container" style="margin-left: 1px;">
                            <div class="col-md-3">
                                <table class="table table-condensed">
                                    <tr><?php $totalDeTodo = 0; //el que tiene el total de todo                                                        ?>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Nombre
                                        </th>
                                        <th>
                                            Precio
                                        </th>
                                        <th>
                                            Total
                                        </th>
                                    </tr>
            <?php
            foreach ($productos as $value) {
                $totalDeTodo += $value['precio'];
                ?> 
                                                                                                                                                                                <tr>
                                                                                                                                                                                    <td>
                <?= $value["id"] ?>
                                                                                                                                                                                    </td>
                                                                                                                                                                                    <td>
                <?= $value["nombre"] ?>
                                                                                                                                                                                    </td>
                                                                                                                                                                                    <td>
                <?= $value["precio"] ?>
                                                                                                                                                                                    </td>
                                                                                                                                                                                    <td>
                <?= $value["precio"] ?>
                                                                                                                                                                                    </td>
                                                                                                                                                                                </tr>
                <?php
            }
            ?>
            
                                    <tr>
            
                                        <td colspan="3">
                                            Recivido:
                                        </td>
                                        <td colspan="2" id="recivido">
            
                                        </td>
            
                                    </tr>
            
                                    <tr>
                                        <td colspan="3">
                                            Total: 
                                        </td>
                                        <td id="total" colspan="2">
            <?php echo $totalDeTodo ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            Vuelto:
                                        </td>
                                        <td colspan="2" id="vuelto">
            
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="container">
                            <div class="col-md-3 text-justify">
                                <h5>
                                    Datos del cliente<br/>
                                    <small>
                                        Nombre: <?= $cliente['nombre'] ?><br/>
                                        Documento: <?= $cliente['documento'] ?>
                                    </small>
            
                                </h5>
                            </div>
                        </div>-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <center>
                            Nombre De la Empresa
                        </center>
                    </div>
                </div>
                <div class="container-fluid">
                    <table class="table table-bordered" style="width: 100%">
                        <tr>
                            <td>
                                <img src="<?= base_url() . $this->session->userdata("logo_url") ?>" class="img-responsive" />
                            </td>
                            <td>
                                Cliente
                                <small>
                                    Nombre: <?= $cliente['nombre'] ?><br/>
                                    Documento: <?= $cliente['documento'] ?>
                                </small>
                            </td>
                            <td>
                                factura
                            </td>
                            <td>
                                Empresa
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-hover table-responsive table-striped" style="width: 100%" >
                            <thead>
                                <tr>
                                    <th>
                                        Producto
                                    </th>
                                    <th>
                                        Cantidad
                                    </th>
                                    <th>
                                        Precio Unitario
                                    </th>
                                    <th>
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Clicle
                                    </td>
                                    <td>
                                        1
                                    </td>
                                    <td>
                                        100
                                    </td>
                                    <td>
                                        100
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="">
                                        <span class="pull-right">
                                            Total
                                        </span>
                                    </td>
                                    <td>
                                        $100
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>


                <div class="col-lg-12 text-uppercase">
                    <table class="table table-responsive" style="width: 100%">
                        <tr>
                            <td>
                                <div class="text-center ">
                                    <br>
                                    <br>
                                    __________________________________<br/>
                                    Forma Empresa
                                </div>
                            </td>
                            <td>
                                <div class="text-center ">
                                    <br>
                                    <br>
                                    __________________________________<br/>
                                    Firma Cliente
                                </div>
                            </td>
                        </tr>
                    </table>


                </div>
                <span class="pull-right" style="color: #000; opacity: 0.5; float: right">
                    ventas.nabu.com.co
                </span>
            </div>
        </div>

        <!-- Librería jQuery requerida por los plugins de JavaScript -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <!-- Todos los plugins JavaScript de Bootstrap (también puedes
                     incluir archivos JavaScript individuales de los únicos
                     plugins que utilices) -->
        <script src="<?= base_url() ?>js/bootstrap.min.js"></script>


        <script>
            //para imprimir
            $(document).ready(function () {
                //alert(window.location.hostname);
                var credito =<?= $credito ?>;
                if (credito) {
                    $("#vuelto").text("0");
                } else {
                    //var recivido = prompt("Recivio: ");
                    $("#recivido").text(recivido);
                    //var total = $("#total").text();
                    var vuelto = recivido - total;
                    $("#vuelto").text(vuelto);
                    //alert("Vuelto: " + vuelto);
                    if (vuelto < 0) {
                        alert("Estas reciviendo menos de lo que es");
                    }
                }

                //window.print();
                //servidor
                //$(location).attr('href', "http://" + window.location.hostname + "/facturacion/nuevaFactura");
                //local
//                $(location).attr('href', "http://" + window.location.hostname + ":8080/Nabu-Facturadora"
//                        + "/facturacion/nuevaFactura");
            });
        </script>

    </body>
</html>


