<div class="col-xs-4">
    <?= form_open("configuraciones/guardar") ?>
    <?php foreach ($configuraciones as $configuracion) { ?>
        <div class="form-group">
            <label>
                Factura Numero: 
                <?= $configuracion->facturaNumero ?>
            </label>
        </div>
        <div class="form-group">
            Imprimir
            <?php if ($configuracion->imprimir) { ?>
                <div class="radio">
                    <label>
                        <input checked type="radio" name="imprimir" class="" value="1" />
                        Si
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="imprimir" class="" value="0" />
                        No
                    </label>
                </div>
            <?php } else { ?>
                <div class="radio">                    
                    <label>
                        <input type="radio" name="imprimir" class="" value="1" />
                        Si
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input checked type="radio" name="imprimir" class="" value="0" />
                        No
                    </label>
                </div>
            <?php } ?>
        </div>
        <div class="form-group">
            Pedir Nombre
            <?php if ($configuracion->pedir_nombre) { ?>
                <div class="radio">
                    <label>
                        <input checked type="radio" name="pedir_nombre" class="" value="1" />
                        Si
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="pedir_nombre" class="" value="0" />
                        No
                    </label>
                </div>
            <?php } else { ?>
                <div class="radio">                    
                    <label>
                        <input type="radio" name="pedir_nombre" class="" value="1" />
                        Si
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input checked type="radio" name="pedir_nombre" class="" value="0" />
                        No
                    </label>
                </div>
            <?php } ?>
        </div>
        <div class="form-group">
            Logo:
            <?= $configuracion->logo_url ?>
        </div>
        <div class="form-group">
            Descuento:
            <input type="number" step="0.01" class="form-control" required name="descuento" placeholder="Descuento" value="<?= $configuracion->descuento ?>" />    
        </div>

    <?php } ?>

    <div class="form-group">
        <input type="submit" value="Guardar" class="btn btn-success" />
    </div>

</form>
</div>