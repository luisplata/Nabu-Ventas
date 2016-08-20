<div class="col-md-8 table-responsive" >
    <div class="center-block ">
        <?= anchor("categorias/nuevaCategoria", "Nueva Categoria", 'class="btn btn-default"')
        ?>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>
                    Nombre
                </th>
                <th>
                    Descripcion
                </th>
                <th>
                    Padre
                </th>
                <th>
                    Accion
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $value) { ?>
                <tr >
                    <td>
                        <?= $value->nombre ?>
                    </td>
                    <td>
                        <?= $value->descripcion ?>
                    </td>
                    <td>                        
                        <?php
                        foreach ($categorias as $categoriaIndividual) {
                            if ($categoriaIndividual->id == $value->padre) {
                                ?>
                                <?= $categoriaIndividual->nombre ?>
                                <?php
                                break;
                            }
                        }
                        ?>
                    </td>
                    <td>                        
                        <button class="btn btn-info modificar" data-id="<?= $value->id ?>">Modificar</button>
                        <?= anchor("categorias/eliminar/" . $value->id, "Eliminar", 'class="btn btn-warning"') ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="modalModificarCategoria" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <?= form_open("categorias/modificar", array("role" => "form")) ?>
            <div class="modal-body">
                <div class="row">          
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>
                                Nombre
                            </label>
                            <input type="hidden" name="id" id="modificarId"/>
                            <input type="text" id="modificarNombre" name="nombre" class="form-control" autofocus="autofocus"/>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>
                                Padre
                            </label>
                            <select class="form-control" name="padre" id="modificarPadre">
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
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>
                                Descripcion
                            </label>
                            <textarea name="descripcion" id="modificarDescripcion" class="form-control" autofocus="autofocus" ></textarea>

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
    $(document).on("click", ".modificar", function () {
        $.ajax({
            method: "POST",
            url: "<?= base_url() ?>categorias/categoria/" + this.dataset.id
        }).done(function (categoria) {
            var Categoria = JSON.parse(categoria);
            //llenamos los datos del formulario
            $("#modificarNombre").val(Categoria.nombre);
            $("#modificarDescripcion").val(Categoria.descripcion);
            $("#modificarPadre").val(Categoria.padre);
            $("#modificarId").val(Categoria.id);
            $("#modalModificarCategoria").modal();
        }).fail(function () {
            alert("error");
        });
    });
</script>