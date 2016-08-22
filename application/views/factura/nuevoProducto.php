<div class="col-md-8">
    <?= form_open("productos/registrarNuevoproducto", array("rol" => "form")) ?>
    <div class="form-group">
        <label>
            Nombre
        </label>
        <input type="text" name="nombre" class="form-control" required="" autofocus="autofocus"/>
    </div>
    <div class="form-group">
        <label>
            Descripcion
        </label>
        <input type="text" name="descripcion" class="form-control"/>
    </div>
    <div class="form-group">
        <label>
            Precio
        </label>
        <input type="number" name="precio" class="form-control" required=""/>
    </div>
    <div class="form-group">
        <label>
            Costo
        </label>
        <input type="number" name="costo" class="form-control" />
    </div>
    <div class="form-group">
        <label>
            Cantidad
        </label>
        <input type="number" name="cantidad" class="form-control" required=""/>
    </div>
    <div class="form-group">
        <label>
            Proveedor
        </label>
        <select name="proveedor_id" class="form-control" required="">            
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
    <div class="form-group">
        <label>
            Codigo
        </label>
        <input type="text" name="codigo" required="" id="codigo" class="form-control createCode"/>
        <input type="button" value="Generar Codigo" onclick="numeroAleatorio()" />
    </div>
    <div class="form-group">
        <div class="col-lg-offset-0 col-lg-10">
            <button type="submit" class="btn btn-success">Guardar</button>
            <button type="reset" class="btn btn-warning">Resetear</button>
        </div>
    </div>    

</form>
</div>