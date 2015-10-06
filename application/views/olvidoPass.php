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
    <body>
        <div class="container">
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <div class="col-xs-4 col-xs-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Escriba su Correo electronico</div>
                    <div class="panel-body">
                        <?=  form_open("usuarios/olvidoPassL")?>
                        <input type="email" name="email" class="form-control" required autofocus />
                        <br/>
                        <input type="submit" class="btn btn-success form-control" />
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>