<div class="col-md-8" >    
    <?= form_open("facturacion/crearReporteFechas") ?>
    <div class="form-group col-lg-4" style="margin-left: auto;margin-right: auto">
        Escoje la fecha de Reporte
        <br/>
        Inicio:
        <input type="date" class="form-control" value="<?= date('Y-m-d', strtotime('-1 month')) ?>" name="fechaInicio"/>
        <br/>
        Final:
        <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="fechaFinal"/>
        <input type="submit" value="Hacer Reporte" class="btn btn-success" />
    </div>
</form>

</div>