<div class="col-xs-8">
    <button type="button" class="btn btn-info Nuevo">Nuevo Proveedor</button>
    <table class="table table-hover ">
        <thead>
            <tr>
                <th>
                    Nombre
                </th>
                <th>
                    Descripción
                </th>
                <th>
                    NIT
                </th>                
                <th>
                    Accion
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($proveedores as $value) { ?>
                <tr>
                    <td>
                        <?= $value->nombre ?>
                    </td>
                    <td>
                        <?= $value->descripcion ?>
                    </td>
                    <td>
                        <?= $value->nit ?>
                    </td>
                    <td>
                        <?php if ($this->session->userdata("grado") >= 2) { ?>
                            <button class="btn btn-info Modificar" data-id="<?= $value->id ?>">Modificar</button>
                            <?= anchor("proveedor/eliminar/".$value->id, "Eliminar", "class='btn btn-warning'") ?>
                        <?php } ?>
                    </td>
                </tr>               
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="ModalNuevo" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Agregar Proveedor</h4>
            </div>
            <?= form_open("proveedor/Guardar", array("rol" => "form")) ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">                                            
                        <div class="form-group">
                            <label>
                                Nombre
                            </label>
                            <input type="text" name="nombre" class="form-control" required=""/>
                        </div>
                    </div>
                    <div class="col-xs-12">                                            
                        <div class="form-group">
                            <label>
                                Descripción
                            </label>
                            <input type="text" name="descripcion" class="form-control" />
                        </div>
                    </div>
                    <div class="col-xs-12">                                            
                        <div class="form-group">
                            <label>
                                NIT
                            </label>
                            <input type="text" name="nit" class="form-control" required=""/>
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
</div><!-- /.modal -->
<div class="modal fade" id="ModalModificar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modificar Proveedor</h4>
            </div>
            <div class="modal-body">
                <?= form_open("proveedor/Modificar", array("rol" => "form")) ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">                                            
                            <div class="form-group">
                                <label>
                                    Nombre
                                </label>
                                <input type="hidden" name="id" id="modificarId"/>
                                <input type="text" id="modificarNombre" name="nombre" class="form-control" required=""/>
                            </div>
                        </div>
                        <div class="col-xs-12">                                            
                            <div class="form-group">
                                <label>
                                    Descripción
                                </label>
                                <input type="text" id="modificarDescripcion" name="descripcion" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xs-12">                                            
                            <div class="form-group">
                                <label>
                                    NIT
                                </label>
                                <input type="text" id="modificarNit" name="nit" class="form-control" required=""/>
                            </div>
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
</div><!-- /.modal -->
<script type="text/javascript">
    $(document).on("click", ".Nuevo", function () {
        $("#ModalNuevo").modal();
    });
    $(document).on("click", ".Modificar", function () {
        //Buscar el producto llenar el focumario y abrir modal
        $.ajax({
            method: "POST",
            url: "<?= base_url() ?>proveedor/GetOne/" + this.dataset.id
        }).done(function (proveedor) {
            var Proveedor = JSON.parse(proveedor);
            console.log(Proveedor);
            //llenamos los datos del formulario
            $("#modificarNombre").val(Proveedor.nombre);
            $("#modificarDescripcion").val(Proveedor.descripcion);
            $("#modificarNit").val(Proveedor.nit);
            $("#modificarId").val(Proveedor.id);
            $("#ModalModificar").modal();
        }).fail(function () {
            alert("error");
        });

    });
</script>