<div class="col-md-8">
    <?= form_open("clientes/guardar", array("role" => "form")) ?>
    <div class="form-group">
        <label>
            Nombre
        </label>
        <input type="text" name="nombre" required="" class="form-control" autofocus="autofocus"/>
    </div>
    <div class="form-group">
        <label>
            Documento
        </label>
        <input type="number" name="documento" class="form-control" required="" />
    </div>
    <div class="form-group">
        <label>
            Telefono
        </label>
        <input type="number" name="telefono" class="form-control" required=""/>
    </div>
    <div class="form-group">
        <label>
            Direccion
        </label>
        <input type="text" name="direccion" class="form-control" required=""/>
    </div>
    <div class="form-group">
        <label>
            Email
        </label>
        <input type="email" name="email" class="form-control" required=""/>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-0 col-lg-10">
            <button type="submit" class="btn btn-success">Guardar</button>
            <button type="reset" class="btn btn-warning">Resetear</button>
        </div>
    </div>
</form>
</div>