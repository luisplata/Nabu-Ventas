<div class="col-md-8">
    <?= form_open("productos/masProductos") ?>
    <div class="form-group">
        <label>
            Cantidad:
        </label>
        <input type="number" value="" <?= (isset($codigo) ? "autofocus=''" : "autofocus=''") ?>  
               name="cantidad" class="form-control"/>
    </div>
    <div class="form-group">
        <label>
            Codigo:
        </label>
        <input type="number"
               value="<?= (isset($codigo)) ? $codigo : "" ?>"
               <?php (!isset($codigo) ? "autofocus=''" : "") ?>
               name="codigo" class="form-control"/>
    </div>
    <div class="form-group">
        <input type="submit" value="Ingresar" class="btn btn-success"/>
        <input type="reset" value="Resetear" class="btn btn-warning"/>
    </div>

</form>
</div>