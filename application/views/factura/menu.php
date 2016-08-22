<?php
switch ($this->session->userdata("grado")) {
    case 1:
//----------------------------------No Registrados-------------------------------------------------\\
        ?>
        <nav class="navbar navbar-default" role="navigation">
            <!-- El logotipo y el icono que despliega el menú se agrupan
                 para mostrarlos mejor en los dispositivos móviles -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Desplegar navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?= anchor("inicios/inicio", "NABU FACTURADORA", "class='navbar-brand'") ?>
            </div>
            <!-- Agrupar los enlaces de navegación, los formularios y cualquier
                 otro elemento que se pueda ocultar al minimizar la barra -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown 
                    <?= (strstr(uri_string(), '/', true) == "inicios") ? "active" : "" ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Inicio<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?= anchor("inicios/inicio", "Inicio") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("usuarios/cambiarPass", "Cambiar la Contraseña") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("login_c/cerrarsession", "Cerrar sesion") ?></li>

                        </ul>
                    </li>
                    <li class="dropdown
                    <?= (strstr(uri_string(), '/', true) == "usuarios") ? "active" : "" ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Usuarios<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                        </ul>
                    </li>
                    <li class="dropdown
                    <?=
                    (strstr(uri_string(), '/', true) == "productos" ||
                    strstr(uri_string(), '/', true) == "categorias" ) ? "active" : ""
                    ?>    
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Productos <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?= anchor("productos/inicio", "Productos") ?></li>
                        </ul>
                    </li>
                    <li class="dropdown
                    <?= (strstr(uri_string(), '/', true) == "facturas") ? "active" : "" ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Facturas<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?= anchor("facturacio/nuevaFactura", "Nueva Factura") ?></li>
                        </ul>
                    </li>
                </ul>
                <p class="navbar-text navbar-right">Conectado como 
                    "<?= $this->session->userdata("persona_nombre") ?> 
                    <?= $this->session->userdata("persona_apellido") ?>"</p>
            </div>
        </nav>
        <?php
        break;
//----------------------------------Fin de No registrados------------------------------------------\\
    case 2:
//----------------------------------Registrados----------------------------------------------------\\
        ?>
        <nav class="navbar navbar-default" role="navigation">
            <!-- El logotipo y el icono que despliega el menú se agrupan
                 para mostrarlos mejor en los dispositivos móviles -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Desplegar navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?= anchor("inicios/inicio", "NABU FACTURADORA", "class='navbar-brand'") ?>
            </div>
            <!-- Agrupar los enlaces de navegación, los formularios y cualquier
                 otro elemento que se pueda ocultar al minimizar la barra -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown 
                    <?= (strstr(uri_string(), '/', true) == "inicios") ? "active" : "" ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Inicio<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?= anchor("inicios/inicio", "Inicio") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("usuarios/cambiarPass", "Cambiar la Contraseña") ?></li>
                            <li class="divider"></li>                            
                            <li><?= anchor("login_c/cerrarsession", "Cerrar sesion") ?></li>
                        </ul>
                    </li>
                    <li class="dropdown
                    <?=
                    (strstr(uri_string(), '/', true) == "usuarios" ||
                    strstr(uri_string(), '/', true) == "clientes") ? "active" : ""
                    ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Usuarios<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?= anchor("clientes/inicio", "Clientes") ?></li>
                        </ul>
                    </li>
                    <li class="dropdown
                    <?=
                    (strstr(uri_string(), '/', true) == "productos" ||
                    strstr(uri_string(), '/', true) == "categorias" ) ? "active" : ""
                    ?>    
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Productos <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?= anchor("productos/inicio", "Productos") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("categorias/inicio", "Categorias") ?></li>
                        </ul>
                    </li>
                    <li class="dropdown
                    <?= (strstr(uri_string(), '/', true) == "facturas") ? "active" : "" ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Facturas<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?= anchor("facturacion/nuevaFactura", "Nueva Factura") ?></li>
                        </ul>
                    </li>
                </ul>
                <p  class="navbar-text navbar-right">Conectado como 
                    "<?= $this->session->userdata("persona_nombre") ?> 
                    <?= $this->session->userdata("persona_apellido") ?>"</p>
            </div>
        </nav>
        <?php
        break;
//-----------------------------------fin de registrados--------------------------------------------\\
    case 3:
//-----------------------------------Administradores-----------------------------------------------\\        
        ?>
        <nav class="navbar navbar-default" role="navigation">
            <!-- El logotipo y el icono que despliega el menú se agrupan
                 para mostrarlos mejor en los dispositivos móviles -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Desplegar navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?= anchor("inicios/inicio", "NABU FACTURADORA", "class='navbar-brand'") ?>
            </div>
            <!-- Agrupar los enlaces de navegación, los formularios y cualquier
                 otro elemento que se pueda ocultar al minimizar la barra -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown 
                    <?= (strstr(uri_string(), '/', true) == "inicios") ? "active" : "" ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Inicio<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?= anchor("inicios/inicio", "Inicio") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("usuarios/cambiarPass", "Cambiar la Contraseña") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("configuraciones", "Configuracion") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("login_c/cerrarsession", "Cerrar sesion") ?></li>
                        </ul>
                    </li>
                    <li class="dropdown
                    <?=
                    (strstr(uri_string(), '/', true) == "usuarios" ||
                    strstr(uri_string(), '/', true) == "clientes") ? "active" : ""
                    ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Usuarios<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?= anchor("usuarios/inicio", "Usuarios") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("clientes/inicio", "Clientes") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("sedes/inicio", "Sedes") ?></li>
                        </ul>
                    </li>
                    <li class="dropdown
                    <?=
                    (strstr(uri_string(), '/', true) == "productos" ||
                    strstr(uri_string(), '/', true) == "categorias" ) ? "active" : ""
                    ?>    
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Productos <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?= anchor("productos/inicio", "Productos") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("categorias/inicio", "Categorias") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("movimientos/inicio", "Movimientos") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("proveedor", "Proveedores") ?></li>
                        </ul>
                    </li>
                    <li class="dropdown
                    <?= (strstr(uri_string(), '/', true) == "facturas") ? "active" : "" ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Facturas<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?= anchor("facturacion/inicio", "Facturas") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("facturacion/nuevaFactura", "Nueva Factura") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("egresos", "Egresos") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("egresos/categorias", "Categorias de Egresos") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("facturacion/reporteDeCaja", "Reporte de Caja") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("facturacion/reporteDeCajaFechas", "Reporte de Caja Por Fechas") ?></li>
                        </ul>
                    </li>
                </ul>
                <p id="datosSession" class="navbar-text navbar-right">Conectado como 
                    "<?= $this->session->userdata("persona_nombre") ?> 
                    <?= $this->session->userdata("persona_apellido") ?>"
                </p>
            </div>
        </nav>
        <?php
        break;
//------------------------------------Fin administradores------------------------------------------\\
    case 4:
//------------------------------------Super Admin's------------------------------------------------\\        
        ?>
        <nav class="navbar navbar-default" role="navigation">
            <!-- El logotipo y el icono que despliega el menú se agrupan
                 para mostrarlos mejor en los dispositivos móviles -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Desplegar navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?= anchor("inicios/inicio", "NABU FACTURADORA", "class='navbar-brand'") ?>
            </div>
            <!-- Agrupar los enlaces de navegación, los formularios y cualquier
                 otro elemento que se pueda ocultar al minimizar la barra -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown 
                    <?= (strstr(uri_string(), '/', true) == "inicios") ? "active" : "" ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Inicio<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?= anchor("inicios/inicio", "Inicio") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("usuarios/cambiarPass", "Cambiar la Contraseña") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("configuraciones", "Configuracion") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("login_c/cerrarsession", "Cerrar sesion") ?></li>
                        </ul>
                    </li>
                    <li class="dropdown
                    <?=
                    (strstr(uri_string(), '/', true) == "usuarios" ||
                    strstr(uri_string(), '/', true) == "empresas" ||
                    strstr(uri_string(), '/', true) == "clientes" ) ? "active" : ""
                    ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Usuarios<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?= anchor("usuarios/inicio", "Usuarios") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("empresas/inicio", "Empresas") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("sedes/inicio", "Sedes") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("clientes/inicio", "Clientes") ?></li>
                        </ul>
                    </li>
                    <li class="dropdown
                    <?=
                    (
                    strstr(uri_string(), '/', true) == "productos" ||
                    uri_string() == "proveedor" ||
                    strstr(uri_string(), '/', true) == "movimientos" ||
                    strstr(uri_string(), '/', true) == "categorias" ) ? "active" : ""
                    ?>    
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Productos <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?= anchor("productos/inicio", "Productos") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("categorias/inicio", "Categorias") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("movimientos/inicio", "Movimientos") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("proveedor", "Proveedores") ?></li>
                        </ul>
                    </li>
                    <li class="dropdown
                    <?= (strstr(uri_string(), '/', true) == "facturas") ? "active" : "" ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Facturas<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?= anchor("facturacion/inicio", "Facturas") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("facturacion/nuevaFactura", "Nueva Factura") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("egresos", "Egresos") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("egresos/categorias", "Categorias de Egresos") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("facturacion/reporteDeCaja", "Reporte de Caja") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("facturacion/reporteDeCajaFechas", "Reporte de Caja Por Fechas") ?></li>
                        </ul>
                    </li>
                </ul>
                <p class="navbar-text navbar-right" id="alerta"><span id="datosSession">Conectado</span> como 
                    "<?= $this->session->userdata("persona_nombre") ?> 
                    <?= $this->session->userdata("persona_apellido") ?>"</p>
            </div>
        </nav>
        <?php
        break;
//----------------------------------Fin Super Admin------------------------------------------------\\        
    default:
//--------------------------------Entrada no autorizada------------------------------------------\\
        ?>
        <nav class="navbar navbar-default" role="navigation">
            <!-- El logotipo y el icono que despliega el menú se agrupan
                 para mostrarlos mejor en los dispositivos móviles -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Desplegar navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?= anchor("inicio/inicio", "NABU FACTURADORA", "class='navbar-brand'") ?>
            </div>
            <!-- Agrupar los enlaces de navegación, los formularios y cualquier
                 otro elemento que se pueda ocultar al minimizar la barra -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown 
                    <?= (strstr(uri_string(), '/', true) == "inicios") ? "active" : "" ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Inicio<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?= anchor("inicios/inicio", "Inicio") ?></li>
                            <li class="divider"></li>
                            <li><?= anchor("login_c/cerrarsession", "Cerrar sesion") ?></li>
                        </ul>
                    </li>
                    <li class="dropdown
                    <?= (strstr(uri_string(), '/', true) == "usuarios") ? "active" : "" ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Usuarios<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">

                        </ul>
                    </li>
                    <li class="dropdown
                    <?=
                    (strstr(uri_string(), '/', true) == "productos" ||
                    strstr(uri_string(), '/', true) == "categorias" ) ? "active" : ""
                    ?>    
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Productos <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">

                        </ul>
                    </li>
                    <li class="dropdown
                    <?= (strstr(uri_string(), '/', true) == "facturas") ? "active" : "" ?>
                        ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Facturas<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">

                        </ul>
                    </li>
                </ul>
                <p class="navbar-text navbar-right">Conectado como 
                    "<?= $this->session->userdata("persona_nombre") ?> 
                    <?= $this->session->userdata("persona_apellido") ?>"</p>
            </div>
        </nav>
        <?php
        break;
//------------------------------Fin de Entrada no Registrada---------------------------------------\\
}
?>

<div class="container">     