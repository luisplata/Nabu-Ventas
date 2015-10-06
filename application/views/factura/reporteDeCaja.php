<div class="col-md-8" >    
    <?= form_open("facturacion/crearReporte") ?>
    <div class="form-group col-lg-4">
        Escoje la fecha de Reporte
        <input type="date" class="form-control" value="<?= date("Y-m-d") ?>" name="fecha"/>
        <input type="submit" value="Hacer Reporte" class="btn btn-success" />
    </div>
</form>

</div>