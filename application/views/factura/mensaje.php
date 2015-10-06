<div id="panel-oculto" class="container" style="display:none;">
    <div class="table-responsive">
        <table title="Datos de la session" class="table table-hover">
            <tr>
                <th>
                    Dato
                </th>
                <th>
                    Valor
                </th>
            </tr>
            <tr>
                <td>
                    Usuario ID
                </td>
                <td>
                    <?= $this->session->userdata("usuario_id") ?>
                </td>
            </tr>
            <tr>
                <td>
                    Empresa ID    
                </td>
                <td>
                    <?= $this->session->userdata("empresa_id") ?>
                </td>
            </tr>
            <tr>
                <td>
                    Sede ID    
                </td>
                <td>
                    <?= $this->session->userdata("sede_id") ?>
                </td>
            </tr>
            <tr>
                <td>
                    Persona ID
                </td>
                <td>
                    <?= $this->session->userdata("persona_id") ?>
                </td>
            </tr>
            <tr>
                <td>
                    Grado:
                </td>
                <td>
                    <?= $this->session->userdata("grado") ?>
                </td>
            </tr>
            <tr>
                <td>
                    Valor:
                </td>
                <td>
                    <?= $this->session->userdata("valor") ?>
                </td>
            </tr>
            <tr>
                <td>
                    ValorFactura
                </td>
                <td>
                    <?= $this->session->userdata("facturaNumero") ?>
                </td>
            </tr>
            <tr>
                <td>
                    Imprimir
                </td>
                <td>
                    <?= $this->session->userdata("imprimir") ?>
                </td>
            </tr>
            <tr>
                <td>
                    Descuento
                </td>
                <td>
                    <?= $this->session->userdata("descuento") ?>
                </td>
            </tr>
            <tr>
                <td>
                    Pedir Nombre en la factura
                </td>
                <td>
                    <?php
                    if ($this->session->userdata("pedir_nombre")) {
                        echo "Si";
                    } else {
                        echo "No";
                    }
                    ?>
                </td>
            </tr>

        </table>
        <?php foreach ($this->configuracion_model->listarTodo() as $configuracion) { ?>
            <div class="form-group">
                <label>
                    Factura Numero: 
                    <?= $configuracion->facturaNumero ?>
                </label>
            </div>
            <div class="form-group">
                Imprimir
                <?php if ($configuracion->imprimir) { ?>
                    <div class="radio">
                        <label>                            
                            Si
                        </label>
                    </div>
                <?php } else { ?>
                    <div class="radio">
                        <label>                            
                            No
                        </label>
                    </div>                
                <?php } ?>
            </div>
            <div class="form-group">
                Pedir Nombre
                <?php if ($configuracion->pedir_nombre) { ?>
                    <div class="radio">
                        <label>                            
                            Si
                        </label>
                    </div>
                <?php } else { ?>
                    <div class="radio">
                        <label>                            
                            No
                        </label>
                    </div>
                <?php } ?>
            </div>
            <div class="form-group">
                Logo:
                <?= $configuracion->logo_url ?>
            </div>
            <div class="form-group">
                Descuento:
                <?= $configuracion->descuento ?>
            </div>

        <?php } ?>
    </div>
</div>