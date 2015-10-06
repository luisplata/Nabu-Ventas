<?php
if ($this->session->userdata("usuario_id") != NULL) {
    redirect("inicios/inicio", "refresh");
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
        <title>NABU FACTURADORA</title>
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
            <div class="col-md-4">
<!--Para centrar el login-->
            </div>
            <div class="col-md-4" id="loginModal">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <img title="Creador de codigos de barras" src="<?= base_url() ?>images/barcode/personal.php?numero=Nabu-Ventas"/>
                    <!--Asi uso el generador de codigos de barras-->
                    <h1>Nabu - Ventas</h1>
                    <h2><small>Aun no tienes tu cuenta?</small></h2>
                </div>
                <div class="modal-body">

                    <div class="well">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#login" data-toggle="tab">Login</a></li>
                            <li><a href="#create" data-toggle="tab">Pide tu cuenta</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane active in" id="login">
                                <?= form_open("login_c/login", "class='form-horizontal'") ?>
                                <fieldset>
                                    <div id="legend">
                                        <legend class="text-center"><h3>Login</h3></legend>
                                    </div>    
                                    <div class="control-group">
                                        <!-- Username -->
                                        <label>Username</label>
                                        <input type="text" required name="user" autofocus="autofocus" placeholder="correo" class="form-control">
                                    </div>

                                    <div class="control-group">
                                        <!-- Password-->
                                        <br/>
                                        <label>Password</label>
                                        <input type="password" required id="password" name="pass" placeholder="Contraseña" class="form-control">
                                    </div>


                                    <div class="control-group">
                                        <!-- Button -->
                                        <br/>
                                        <input type="submit" value="Ingresar" class="btn btn-success"/>  <?=  anchor("usuarios/olvidoPass","Olvido la contraseña?","class='pull-right'")?>
                                    </div>
                                </fieldset>
                                </form>                
                            </div>



                            <div class="tab-pane fade form" id="create">
                                <!--Crear cuenta de prueba?-->
                                <?= form_open("login_c/mandarCorreo") ?>
                                <div class="form-group">
                                    <label>Correo</label>
                                    <input type="email" name="de" 
                                           placeholder="Tu Correo" required class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Asunto</label>
                                    <input type="text" name="asunto" 
                                           value="Quiero Un Usuario de Nabu-Ventas!" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Mensaje</label>
                                    <textarea name="mensaje" class='form-control'></textarea>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <input type="submit" id="botonEnviar" 
                                               value="Enviar Correo" class="btn btn-success"/>
                                        <input type="reset" value="Resetrear" class="btn btn-warning"/>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                    <script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>

                </div>

            </div>

        </div>
    </body>
</html>