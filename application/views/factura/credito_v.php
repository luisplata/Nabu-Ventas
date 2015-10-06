<div class="col-md-8 table-responsive">
    <?= form_open("clientes/pagar") ?>
    <table class="table table-responsive">
        <?php foreach ($credito as $value) { ?>
            <thead>
                <tr>
                    <td class="text-center">
                        <h2>Datos del Cliente <?= $value->nombre ?></h2>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Nombre
                    </td>
                    <td>
                        <?= $value->nombre ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Documento:
                    </td>
                    <td>
                        <?= $value->documento ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Credito:
                    </td>
                    <td>
                        <?= $value->credito ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Monto a Pagar
                    </td>
                    <td>
                        <input type="number" min="0" required autofocus name="monto"/>
                        <input type="hidden" name="cliente_id" value="<?= $value->cliente_id ?>"/>
                        <input type="hidden" name="credito" value="<?= $value->credito ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Enviar Pago" class="btn btn-success"/>
                    </td>
                    <td>
                        <?= anchor("clientes/inicio", "Cancelar", "class='btn btn-warning'") ?>
                    </td>
                </tr>
            </tbody>
        <?php } ?>
    </table>
</form>
</div>