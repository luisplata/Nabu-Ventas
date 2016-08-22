<div class="col-md-8 col-xs-8 table-responsive">
    <div class="nuevo">
        <?php if ($this->session->userdata("grado") >= 2) { ?>
            <?= anchor("productos/nuevoProducto", "Nuevo Producto", "class='btn btn-default'") ?>
        <?php } ?>
    </div>
    <table class="table table-hover ">
        <thead>
            <tr>
                <th>
                    Nombre
                </th>
                <th>
                    Codigo
                </th>
                <th>
                    Precio
                </th>
                <th>
                    Costo
                </th>
                <th>
                    Cantidad
                </th>
                <th>
                    Categoria
                </th>
                <th>
                    Accion
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $value) { ?>
                <tr title="<?= $value->producto_descripcion ?>">
                    <td>
                        <?= $value->producto ?>
                    </td>
                    <td>
                        <?= $value->codigo ?>
                    </td>
                    <td>
                        <?= $value->precio ?>
                    </td>
                    <td>
                        <?= $value->costo ?>
                    </td>
                    <td>
                        <?= $value->cantidad ?>
                    </td>
                    <td>
                        <?= $value->categoria ?>
                    </td>
                    <td>                        
                        <button class="btn btn-info ModificarProducto" data-id="<?= $value->producto_id ?>">Modificar</button>
                        <?php if ($this->session->userdata("grado") >= 2) { ?>
                            <?= anchor("productos/eliminar/" . $value->producto_id, "Eliminar", "class='btn btn-warning'") ?>
                        <?php } ?>
                        <?= anchor("productos/codigoDeBarra/" . $value->producto_id, "Codigo", "title='Imprimir Codigo de Barras' class='btn btn-default'") ?>
                    </td>
                </tr>               
            <?php } ?>
        </tbody>
    </table>

</div>
<div class="modal fade" id="ModificarProducto" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <?= form_open("productos/modificar", array("rol" => "form")) ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-6">                                            
                        <div class="form-group">
                            <label>
                                Nombre
                            </label>
                            <input type="hidden" name="id" id="modificarId" />
                            <input type="text" id="modificarNombre" name="nombre" class="form-control" required="" autofocus="autofocus"/>
                        </div>
                    </div>
                    <div class="col-xs-6">                                            
                        <div class="form-group">
                            <label>
                                Descripcion
                            </label>
                            <input type="text" id="modificarDescripcion" name="descripcion" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-xs-6">                                            
                        <div class="form-group">
                            <label>
                                Precio
                            </label>
                            <input type="number" id="modificarPrecio" name="precio" class="form-control" required=""/>
                        </div>
                    </div>
                    <div class="col-xs-6">                                            
                        <div class="form-group">
                            <label>
                                Costo
                            </label>
                            <input type="number" id="modificarCosto" name="costo" class="form-control" />
                        </div>
                    </div>
                    <div class="col-xs-6">                                            
                        <div class="form-group">
                            <label>
                                Cantidad
                            </label>
                            <input type="number" id="modificarCantidad" name="cantidad" class="form-control" required=""/>
                        </div>
                    </div>
                    <div class="col-xs-6">                                            
                        <div class="form-group">
                            <label>
                                Categoria
                            </label>
                            <select name="categoria_id" id="modificarCategoria" class="form-control" required="">
                                <?php foreach ($categorias as $value) {
                                    ?>
                                    <option value="<?= $value->id ?>">
                                        <?= $value->nombre ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-6">                                            
                        <div class="form-group">
                            <label>
                                Codigo
                            </label>
                            <div class="input-group">
                                <input type="text" name="codigo" required="" id="modificarCodigo" data-type="codigo" class="form-control"/>
                                <span class="input-group-btn">
                                    <button class="btn btn-default createCode" type="button">Generar Código</button>
                                </span>
                            </div><!-- /input-group -->
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
    $(document).on("click", ".ModificarProducto", function () {
        //Buscar el producto llenar el focumario y abrir modal
        $.ajax({
            method: "POST",
            url: "<?= base_url() ?>productos/GetOneProduct/" + this.dataset.id
        }).done(function (usuario) {
            var Usuario = JSON.parse(usuario);
            console.log(Usuario);
            //llenamos los datos del formulario
            $("#modificarNombre").val(Usuario.nombre);
            $("#modificarDescripcion").val(Usuario.descripcion);
            $("#modificarPrecio").val(Usuario.precio);
            $("#modificarCosto").val(Usuario.costo);
            $("#modificarCantidad").val(Usuario.cantidad);
            $("#modificarCategoria").val(Usuario.categoria_id);
            $("#modificarCodigo").val(Usuario.codigo);
            $("#modificarId").val(Usuario.id);
            $("#ModificarProducto").modal();
        }).fail(function () {
            alert("error");
        });

    });
    $(document).on("click", ".createCode", function () {
        numeroAleatorio();
    });
</script>