<div class="col-md-8">
    <?= form_open("usuarios/nuevoUsuarioRegistrado", array("rol" => "form")) ?>
    <div class="form-group">
        <label>
            Nombre
        </label>
        <input type="text" name="nombre" class="form-control" autofocus="autofocus"/>
    </div>


    <div class="form-group">
        <label>    
            Apellido
        </label>

        <input type="text" class="form-control" name="apellido" />
    </div>
    <div class="form-group">
        <label>
            Grado:
        </label>
        <select name="grado" class="form-control">
            <option value="1">
                No registrado
            </option>
            <option value="2">
                Registrado
            </option>
            <option value="3">
                Administrador
            </option>
            <?php if ($this->session->userdata("grado") == 4) {
                ?>
                <option value="4">
                    Super Administrador
                </option>
                <?php }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>
            Valor:   
        </label>

        <input type="number"name="valor" min="0" class="form-control"/>
    </div>

    <div class="form-group">
        <label>
            Documento
        </label>

        <input type="text" name="documento" class="form-control"/>

    </div>

    <div class="form-group">
        <label>
            Direccion
        </label>

        <input type="text" name="direccion" class="form-control"/>

    </div>
    <div class="form-group">
        <label>
            Email
        </label>

        <input type="text" name="email" class="form-control" />

    </div>
    <div class="form-group">
        <label>
            Telefono
        </label>

        <input type="text" name="telefono" class="form-control"/>

    </div>
    <div class="form-group">
        <div class="col-lg-offset-0 col-lg-10">
            <button type="submit" class="btn btn-default">Guardar</button>
            <button type="reset" class="btn btn-default">Resetear</button>
            </di
            </form>
        </div>
    </div>
</form>
</div>