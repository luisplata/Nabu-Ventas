<div class="col-md-8 table-responsive" >
    <div class="center-block ">
        <?= ($this->session->userdata("grado") >= 4) ? anchor("sedes/nuevaSede", "Nueva Sede", 'class="btn btn-default"') : "" ?>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>
                    Nombre
                </th>
                <th>
                    Telefono
                </th>
                <th>
                    E-Mail
                </th>
                <th>
                    Empresa
                </th>
                <th>
                    Estado
                </th>
                <th>
                    Accion
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sedes as $value) { ?>
                <tr >
                    <td>
                        <?= $value->nombre ?>
                    </td>
                    <td>
                        <?= $value->telefono ?>
                    </td>
                    <td>
                        <?= $value->email ?>
                    </td>
                    <td>
                        <?= $value->empresa_nombre ?>
                    </td>
                    <td>
                        <?php
                        if ($value->activo) {
                            ?>
                            <button class="btn btn-success" >Activo</button>
                            <?php
                        } else {
                            ?>
                            <button class="btn btn-danger" >Desactivado</button>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($this->session->userdata("valor") == 10) {
                            echo anchor("sedes/modificar/" . $value->id, "Modificar", 'class="btn btn-info"');
                            if ($value->activo) {
                                echo anchor("sedes/desactivar/" . $value->id, "Inactivar", 'class="btn btn-danger"');
                            } else {
                                echo anchor("sedes/activar/" . $value->id, "Activar", 'class="btn btn-success"');
                            }
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>