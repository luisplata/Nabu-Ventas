<div class="col-md-8">
    <?= form_open("categorias/registrarCategoria", array("role" => "form")) ?>
    <div class="form-group">
        <label>
            Nombre
        </label>
        <input type="text" name="nombre" class="form-control" autofocus="autofocus"/>
    </div>
    <div class="form-group">
        <label>
            Descripcion
        </label>
        <input type="text" name="descripcion" class="form-control" autofocus="autofocus"/>
    </div>
    <div class="form-group">
        <label>
            Padre
        </label>
        <select class="form-control" name="padre">
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
        <div class="col-lg-offset-0 col-lg-10">
            <button type="submit" class="btn btn-default">Guardar</button>
            <button type="reset" class="btn btn-default">Resetear</button>
        </div>
    </div>
</form>
</div>