<div class="col-md-8">
    <?= form_open("movimientos/guardar", array("role" => "form")) ?>
    <div class="form-group">
        <label>
            Sede De Salida del Producto
        </label>
        <select name="sede_salida" class="form-control" required>
            <option>

            </option>
            <?php
            foreach ($sedes as $value) {
                if ($value->id == $this->session->userdata("sede_id")) {
                    ?>
                    <option selected="" value="<?= $value->id ?>">
                        <?= $value->nombre ?>
                    </option>
                    <?php
                } else {
                    ?>
                    <option value="<?= $value->id ?>">
                        <?= $value->nombre ?>
                    </option>
                    <?php
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>
            Sede De Entrada del Producto
        </label>
        <select name="sede_entrada" class="form-control" required>
            <option>
            </option>
            <?php
            foreach ($sedes as $value) {
                if ($value->id == $this->session->userdata("sede_id")) {
                    ?>
                    <option disabled>
                        <?= $value->nombre ?>
                    </option>
                    <?php
                } else {
                    ?>
                    <option selected="" value="<?= $value->id ?>">
                        <?= $value->nombre ?>
                    </option>
                    <?php
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>
            Producto
        </label>
        <select multiple name="codigo" class="form-control" required="">
            <?php
            foreach ($productos as $value) {
                ?>
                <option value="<?= $value->codigo ?>-<?= $value->producto_id ?>">
                    <?= $value->producto ?>
                </option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <input type="number" min="0" name="cantidad" required="" class="form-control" value="1" />
    </div>
    <div class="form-group">
        <div class="col-lg-offset-0 col-lg-10">
            <button type="submit" class="btn btn-success">Guardar</button>
            <button type="reset" class="btn btn-warning">Resetear</button>
        </div>
    </div>
</form>
</div>