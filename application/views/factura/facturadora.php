<div class="col-md-8">
    <div class="col-md-6">
        <form id="formulario_facturadora" class="text-center" rol="form">
            <input id="codigo_de_barra" name="id" autofocus="autofocus" type="number" class="form-control"/>
            <input type="submit" class="btn btn-default" value="Buscar"  id="buscar"/>
            <input type="submit" form="facturadoraPrincipal" class="btn btn-success" value="Facturar"/>
            <?= anchor("facturacion/nuevaFactura", "Cancelar", "class='btn btn-warning'") ?>
        </form>
    </div>
    <div class="col-md-6">
        <ul class="nav nav-pills">
            <li class="active">
                <a href="#efectivo" data-toggle="tab">
                    Efectivo
                </a>
            </li>
            <li>
                <a href="#credito" data-toggle="tab" id="pestanaCredito">
                    Credito
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="efectivo">
                <div class="form-group">
                    <input type="text" placeholder="Nombre"  form="facturadoraPrincipal" <?= ($this->configuracion_model->pedirNombre()) ? "required" : "" ?>
                           name="nombre_efectivo" class="form-control"/>
                </div>
                <div class="form-group">
                    <input form="facturadoraPrincipal" placeholder="Documento" type="text" <?= ($this->configuracion_model->pedirNombre()) ? "required" : "" ?>
                           name="documento_efectivo" class="form-control" />
                </div>
            </div>
            <div class="tab-pane fade" id="credito">
                <div id="datos">
                    <div class="form-group">
                        <input type="number" name="documento" id="documento" class="form-control" placeholder="Documento"/>    
                    </div>
                </div>
                <div id="cliente">
                    <!--Aqui se cargan los datos del cliente-->
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div id="total">
            <label>
                Total
            </label>
            <input type="number" name="totalDeTodo" class="form-control" readonly="" 
                   form="facturadoraPrincipal" value="0" id="totalDeTodo"/>
        </div>
    </div>
    <div id="resultado" class="col-lg-12">
        <?= form_open("facturacion/generarFactura", array("id" => "facturadoraPrincipal")) ?>
        <table id="productos" class="table">
            <tr>
                <th>
                    Codigo
                </th>
                <th>
                    Nombre
                </th>
                <th>
                    Precio
                </th>
            </tr>
        </table>
        </form>
    </div>
</div>