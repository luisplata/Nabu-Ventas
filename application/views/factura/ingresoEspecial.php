<div class="col-xs-4 table-responsive">    
    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <td>
                    Fecha
                </td>
                <td>
                    Cantidad
                </td>
                <td>
                    Descripcion
                </td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ingresos as $ingreso) { ?>
                <tr>
                    <td>
                        <?= $ingreso->fecha ?>
                    </td>
                    <td>
                        <?= $ingreso->cantidad ?>
                    </td>
                    <td>
                        <?= $ingreso->descripcion ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="col-xs-4">
    <?= form_open("ingresos/guardar") ?>
    <div class="form-group">
        <input type="text" class="form-control" required name="descripcion" placeholder="Descripcion" />    
    </div>
    <div class="form-group">
        <input type="number" step="0.01" class="form-control" required name="cantidad" placeholder="Cantidad" />    
    </div>

    <div class="form-group">
        <input type="submit" value="Guardar" class="btn btn-success" />
    </div>

</form>
</div>