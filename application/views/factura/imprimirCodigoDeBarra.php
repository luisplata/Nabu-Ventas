<div class="col-md-8" >
    <?php foreach ($producto as $value) { ?>
        <img src="<?= base_url() ?>images/barcode/personal.php?numero=<?= $value->codigo ?>&nombre=<?=$value->nombre?>"/>
        <br/>
        Guardar la imagen e imprimirla donde dese.<br/>
        Este es el codigo de barra del producto: <?=$value->nombre?>
    <?php } ?>

</div>