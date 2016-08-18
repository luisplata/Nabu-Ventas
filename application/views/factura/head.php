<?php
if ($this->session->userdata("usuario_id") == null) {
    redirect("index.php/login_c/index/NoTieneDatosDeSession", "refresh");
}
?>
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
        <link rel="stylesheet" href="<?= base_url() ?>css/general.css" type="text/css" media="screen" />
        <script src="<?= base_url() ?>js/jquery-2.1.1.min.js" language="Javascript"></script>
        <script src="<?= base_url() ?>js/ajax.js" language="Javascript"></script>


        <!-- Librería jQuery requerida por los plugins de JavaScript habilitar cuando haya internet-->
        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <!-- Todos los plugins JavaScript de Bootstrap (también puedes
                     incluir archivos JavaScript individuales de los únicos
                     plugins que utilices) -->
        <script src="<?= base_url() ?>js/bootstrap.min.js"></script>
        <!--css-->
        <link href="<?= base_url() ?>css/bootstrap.min.css" rel="stylesheet" media="screen">
        <!-- bootstrap-->

        <!--
        Sacando las alertas
        -->
        <!-- include the script -->
        <script src="<?= base_url() ?>js/alertify.min.js"></script>
        <!-- include the style -->
        <link rel="stylesheet" href="<?= base_url() ?>css/alertify.min.css" />
        <!-- include a theme -->
        <link rel="stylesheet" href="<?= base_url() ?>css/default.min.css" />
        <!--
        Sacando las alertas
        -->
        <script>

            $(document).ready(function () {
                /*Mensajes de Alerta*/
                alertify.set('notifier', 'position', 'top-right');
                alertify.set('notifier', 'delay', 6);
                alertify.<?= $this->session->userdata("tipo") ?>('<?= $this->session->userdata("mensaje") ?>');
                /*Mensajes de Alerta*/

                //metodo para hacer la cuenta var pathname = window.location.pathname;
                //alert(window.location.pathname);
                // servidor nuevo controlador
                //if (window.location.pathname === "/facturacion/nuevaFactura") {
                    //local
                    if (window.location.pathname === "/ventas/facturacion/nuevaFactura") {
                    $("#totalDeTodo").val(0);

                    //haciendo el ajax desde aqui        
                    $("#formulario_facturadora").submit(function () {

                        $.ajax({
                            data: {id: $("#codigo_de_barra").val()},
                            success: function (data, textStatus, jqXHR) {
                                $("#productos").append(data);
                                $("#total").load();
                                sacarTotal();
                                $("#codigo_de_barra").val(" ");
                            },
                            url: "<?= base_url() ?>ajax/",
                            beforeSend: function (xhr) {
                            },
                            type: "post"
                                    //fin del ajax
                        });
                        //guardamos todos los resultados en pantalla
                        return false;
                        //cierre del Submit
                    });
                    //fin de ajax

                    //Buscando al cliente por ajax
                    $("#documento").on("keypress", function () {
                        $.ajax({
                            data: {nombre: $("#nombre").val(), documento: $("#documento").val()},
                            success: function (data, textStatus, jqXHR) {
                                //$("#datos").hide("slow","linear");
                                $("#cliente").html(data);
                            },
                            url: "<?= base_url() ?>ajax/identificarCliente",
                            beforeSend: function (xhr) {
                            },
                            type: "POST"
                                    //fin del ajax
                        });
                    });
                    //hasta aqui busca cliente ajax


                    //Para sacar el total de los productos
                    function sacarTotal() {
                        var totalDeTodo = 0;
                        var productos = document.getElementsByName("precio[]");
                        for (i = 0; i < productos.length; i++)
                        {
                            totalDeTodo += parseInt(productos[i].value);
                            //$("#total").text(totalDeTodo);
                            $("#totalDeTodo").val(totalDeTodo);
                        }
                    }
                }

                //fin del ready
            });
            function numeroAleatorio() {
                var aleatorio = Math.round(Math.random() * 10000);
                $("#codigo").val(aleatorio);
            }

        </script>
    </head>
    <body>
        <div class="container" style="width: 100%">
            <div class="banner">
            </div>

        </div>