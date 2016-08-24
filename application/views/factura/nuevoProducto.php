<style type="text/css">
    .proveedoresClass{
        margin: 5px;
    }
</style>
<div class="col-md-8">
    <?= form_open("productos/registrarNuevoproducto", array("rol" => "form")) ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <label>
                    Nombre
                </label>
                <input type="text" name="nombre" class="form-control" required="" autofocus="autofocus"/>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <label>
                    Descripcion
                </label>
                <input type="text" name="descripcion" class="form-control"/>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <label>
                    Precio
                </label>
                <input type="number" name="precio" class="form-control" required=""/>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <label>
                    Costo
                </label>
                <input type="number" name="costo" class="form-control" />
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <label>
                    Cantidad
                </label>
                <input type="number" name="cantidad" class="form-control" required=""/>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <label>
                    Proveedor
                </label>
                <span class="btn btn-success pull-right" id="AgregarProveedor">Agregar</span>
                <select name="proveedor_id" id="ListaProveedores" class="form-control" required="">            
                    <option default="default" disabled="disabled" selected="selected">Seleccione un Proveedor</option>
                    <?php foreach ($proveedores as $value) {
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
        <div class="col-xs-6" id="ListadoDeProveedores">            
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <label>
                    Categoria
                </label>
                <select name="categoria_id" class="form-control" required="">
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
                    Codigo
                </label>
                <input type="text" name="codigo" required="" id="codigo" class="form-control createCode"/>
                <input type="button" value="Generar Codigo" onclick="numeroAleatorio()" />
            </div>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <div class="col-lg-offset-0 col-lg-10">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="reset" class="btn btn-warning">Resetear</button>
                </div>
            </div>    
        </div>
    </div>

</form>
</div>
<script type="text/javascript">
    $(document).on("click", "#AgregarProveedor", function () {
        var proveedor_id = $("#ListaProveedores option:selected");
        var defaults = $(proveedor_id).attr("disabled");

        if (defaults == "disabled") {
            return false;
        }
        $(proveedor_id).attr("disabled", "disables");
        var span = '<span class="btn btn-info proveedoresClass">' + proveedor_id.text() + "</span>";
        var btnCerrar = '<span class="botonCerrar badge">&times;</span>';
        var input = '<input checked type="checkbox" value="' + proveedor_id.val() + '" class="hidden" name="proveedor_id[]"/>';
        span = $(span).append(btnCerrar);
        span = $(span).append(input);
        $("#ListadoDeProveedores").append(span);
    });
    $(document).on("click", ".proveedoresClass", function () {
        var inputHijo = $(this).children("input").val();
        var seleccionado = $("#ListaProveedores [value=" + inputHijo + "]");
        seleccionado.removeAttr("disabled");
        console.log(seleccionado.text());
        this.remove();
    });
</script>