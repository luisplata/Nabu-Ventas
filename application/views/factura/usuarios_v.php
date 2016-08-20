<div class="col-md-8 table-responsive">
    <div class="nuevo">        
        <button class="btn btn-default ModalNuevoUsuario">Nuevo Usuario</button>
    </div>
    <table class="table table-hover">
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
                    Empresa
                </th>
                <th>
                    Accion
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $value) { ?>
                <tr>                    
                    <td>
                        <?= $value->nombre_persona ?>
                    </td>
                    <td>
                        <?= $value->apellido_persona ?>
                    </td>
                    <td>
                        <?= $value->documento ?>
                    </td>
                    <td>
                        <?= $value->empresa ?>
                    </td>
                    <td>                        
                        <button class="btn btn-info ModalModificarUsuario" data-id="<?= $value->usuario_id ?>">Modificar</button>
                        <?= anchor("usuarios/eliminar/" . $value->usuario_id, "Eliminar", "class='btn btn-warning'") ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="ModalNuevoUsuario" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Editar Usuario</h4>
            </div>
            <?= form_open("usuarios/nuevoUsuarioRegistrado", array("rol" => "form")) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>
                        Nombre
                    </label>
                    <input type="text" name="nombre" class="form-control" autofocus="autofocus"/>
                </div>
                <div class="form-group">
                    <label>    
                        Apellido
                    </label>

                    <input type="text" class="form-control" name="apellido" />
                </div>
                <div class="form-group">
                    <label>
                        Grado:
                    </label>
                    <select name="grado" class="form-control">
                        <option value="1">
                            No registrado
                        </option>
                        <option value="2">
                            Registrado
                        </option>
                        <option value="3">
                            Administrador
                        </option>
                        <?php if ($this->session->userdata("grado") == 4) {
                            ?>
                            <option value="4">
                                Super Administrador
                            </option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>
                        Valor:   
                    </label>

                    <input type="number"name="valor" min="0" class="form-control"/>
                </div>

                <div class="form-group">
                    <label>
                        Documento
                    </label>

                    <input type="text" name="documento" class="form-control"/>

                </div>

                <div class="form-group">
                    <label>
                        Direccion
                    </label>

                    <input type="text" name="direccion" class="form-control"/>

                </div>
                <div class="form-group">
                    <label>
                        Email
                    </label>

                    <input type="text" name="email" class="form-control" />

                </div>
                <div class="form-group">
                    <label>
                        Telefono
                    </label>

                    <input type="text" name="telefono" class="form-control"/>

                </div>                
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal NEW -->
<div class="modal fade" id="ModalModificarUsuario" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <?= form_open("usuarios/modificar", array("rol" => "form")) ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>
                                Nombre
                            </label>
                            <input type="text" name="nombre" id="modificarNombre" class="form-control" autofocus="autofocus"/>
                            <input type="hidden" id="modificarId" name="id" >
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>    
                                Apellido
                            </label>

                            <input type="text" class="form-control" id="modificarApellido" name="apellido" />
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>    
                                Usuario
                            </label>

                            <input type="text" class="form-control" id="modificarUser" name="user" />
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>
                                Grado:
                            </label>
                            <select name="grado" id="modificarGrado" class="form-control">
                                <option value="1">
                                    No registrado
                                </option>
                                <option value="2">
                                    Registrado
                                </option>
                                <option value="3">
                                    Administrador
                                </option>
                                <?php if ($this->session->userdata("grado") == 4) {
                                    ?>
                                    <option value="4">
                                        Super Administrador
                                    </option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>
                                Valor:   
                            </label>

                            <input type="number"name="valor" id="modificarValor" min="0" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>
                                Documento
                            </label>

                            <input type="text" name="documento" id="modificarDocumento" class="form-control"/>

                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>
                                Direccion
                            </label>

                            <input type="text" name="direccion" id="modificarDireccion" class="form-control"/>

                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>
                                Email
                            </label>

                            <input type="text" name="email" id="modificarEmail" class="form-control" />

                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>
                                Telefono
                            </label>

                            <input type="text" name="telefono" id="modificarTelefono" class="form-control"/>

                        </div>   
                    </div>    
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal Edit -->
<script type="text/javascript">
    $(document).on("click", ".ModalNuevoUsuario", function () {
        $("#ModalNuevoUsuario").modal();
    });
    $(document).on("click", ".ModalModificarUsuario", function () {
        $.ajax({
            method: "POST",
            url: "<?= base_url() ?>usuarios/getusuario/" + this.dataset.id
        }).done(function (usuario) {
            var Usuario = JSON.parse(usuario);
            console.log(Usuario);
            //llenamos los datos del formulario
            $("#modificarNombre").val(Usuario.nombre);
            $("#modificarApellido").val(Usuario.apellido);
            $("#modificarDocumento").val(Usuario.documento);
            $("#modificarValor").val(Usuario.valor);
            $("#modificarDireccion").val(Usuario.direccion);
            $("#modificarEmail").val(Usuario.email);
            $("#modificarTelefono").val(Usuario.telefono);
            $("#modificarId").val(Usuario.id);
            $("#modificarGrado").val(Usuario.grado);
            $("#modificarUser").val(Usuario.user);
            $("#ModalModificarUsuario").modal();
        }).fail(function () {
            alert("error");
        });

    });
</script>