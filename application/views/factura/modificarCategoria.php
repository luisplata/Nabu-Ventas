<div class="col-md-8">
    <?= form_open("egresos/editarCategoria", array("role" => "form")) ?>
    <?php foreach ($categoria as $value) { ?>
        <div class="form-group">
            <label>
                Nombre
            </label>
            <input type="text" value="<?= $value->nombre ?>" name="nombre" class="form-control" autofocus="autofocus"/>
            <input type="hidden" value="<?= $value->id ?>" name="id" class="form-control" />
        </div>  
        <div class="form-group">
            <label>
                Descripcion
            </label>
            <input type="text" value="<?= $value->descripcion ?>" name="descripcion" class="form-control"/>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-0 col-lg-10">
                <button type="submit" class="btn btn-default">Guardar</button>
                <button type="reset" class="btn btn-default">Resetear</button>
            </div>
        </div>
    <?PHP } ?>
</form>
</div>