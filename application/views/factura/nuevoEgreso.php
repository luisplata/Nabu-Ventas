<div class="col-md-8">
    <?= form_open("egresos/guardar", array("role" => "form")) ?>
    <div class="form-group">
        <label>
            Descripcion
        </label>
        <input type="text" name="descripcion" class="form-control" autofocus="autofocus"/>
    </div>
    <div class="form-group">
        <label>
            Cantidad
        </label>
        <input type="number" name="cantidad" class="form-control" />
    </div>
    <div class="form-group">
        <label>
            Categoria
        </label>
        <select class="form-control" name="categoria_egreso_id">
            <?php foreach ($categorias as $value) { ?>
                <option value="<?= $value->id ?>">
                    <?= $value->nombre ?>
                </option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-0 col-lg-10">
            <button type="submit" class="btn btn-success">Guardar</button>
            <button type="reset" class="btn btn-warning">Resetear</button>
        </div>
    </div>
</form>
</div>