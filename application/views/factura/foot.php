</div>

<script>
    $(document).ready(function () {
        $("#datosSession").on("click", function () {
            $("#panel-oculto").toggle("slow");
        });
        $("#ver").on("click", function () {
            $("#desarrolladores").toggle("show");
        });
    });
</script>
<div class="container" style="margin-top: 30px;">
    <div class="text-center well">
        &copy;<?= $this->config->item("EMPRESA") ?> Todos los derechos reservados<br/>
        Desarrollado con <?= anchor($this->config->item("FRAMEWORK_BACKEND_URL"), $this->config->item("FRAMEWORK_BACKEND"), "target='_blank'") ?> <br/>
        Diseñado con <?= anchor($this->config->item("FRAMEWORK_FRONTEND_URL"), $this->config->item("FRAMEWORK_FRONTEND"), "target='_blank'") ?><br/>
        Desarrolladores: <span id="ver" class="btn btn-default">Ver</span>
        <div id="desarrolladores" class="table-responsive" style="display:none;">
            <table class="table">
                <thead>
                    <tr>
                        <td>
                            Nombre
                        </td>
                        <td>
                            ROL
                        </td>
                        <td>
                            Correo
                        </td>
                        <td>
                            Telefono
                        </td>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($this->config->item("DESARROLLADORES") as $value) { ?>
                        <tr>
                            <?php foreach ($value as $datos) { ?>
                                <td>
                                    <?= $datos['nombre'] ?>
                                </td>
                                <td>
                                    <?= $datos['rol'] ?>
                                </td>
                                <td>
                                    <?= $datos['correo'] ?>
                                </td>
                                <td>
                                    <?= $datos['telefono'] ?>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>


    </div>
</div>
</body>
</html>