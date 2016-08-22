<?php

class productos extends CI_Controller {

    function __construct() {
        parent::__construct();
//        $this->output->enable_profiler(TRUE);
        $this->load->model("producto_model", "producto");
        $this->load->model("categoria_model", "categoria");
        $this->load->model("Proveedor_model", "proveedor");
    }

    public function inicio() {
        $datos = array(
            "izq" => "izq",
            "der" => "productos_v",
            "productos" => $this->producto->ListarTodo(),
            "categorias" => $this->categoria->ListarTodo()
        );
        $this->load->view("factura", $datos);
    }

    public function nuevoProducto() {
        $datos = array(
            "izq" => "izq",
            "der" => "nuevoProducto",
            "categorias" => $this->categoria->ListarTodo(),
            "proveedores" => $this->proveedor->ListarTodo()
        );
        $this->load->view("factura", $datos);
    }

    public function registrarNuevoproducto() {
        $producto = array(
            "nombre" => $this->input->post("nombre"),
            "codigo" => $this->input->post("codigo"),
            "descripcion" => $this->input->post("descripcion"),
            "precio" => $this->input->post("precio"),
            "costo" => $this->input->post("costo"),
            "cantidad" => $this->input->post("cantidad"),
            "categoria_id" => $this->input->post("categoria_id"),
            "empresa_id" => $this->session->userdata("empresa_id"),
            "sede_id" => $this->session->userdata("sede_id")
        );
        if ($this->producto->Guardar($producto, $this->input->post("proveedor_id"))) {

            $this->configuracion_model->log("Se guardo el producto " . $producto['nombre']);
            redirect("productos/inicio");
        } else {
            $this->configuracion_model->log("No se guardo el producto " . $producto['nombre'], "error");
            redirect("productos/nuevoProducto");
        }
    }

    public function ingresar($codigo = NULL) {
        if (empty($codigo)) {
            //cuando no hay
        } else {
            //cuando hay algo
        }

        $datos = array(
            "izq" => "izq",
            "der" => "ingresoDeNuevosProductos",
            "codigo" => $codigo
        );
        $this->load->view("factura", $datos);
    }

    public function masProductos() {
        if ($this->producto->agregarMas($this->input->post("codigo"), $this->input->post("cantidad"))) {
            $this->configuracion_model->log("Se ingresaron mas productos de " . $this->input->post("codigo"));
            redirect("productos/inicio");
        } else {
            $this->configuracion_model->log("No se ingresaron mas productos " . $this->input->post("codigo") . " vuelve a intentarlo!", "error");
            redirect("productos/ingresar/" . $this->input->post("codigo"));
        }
    }

    public function codigoDeBarra($id) {
        $producto = $this->producto->obtenerUno($id);
        if ($producto) {
            $datos = array(
                "izq" => "izq",
                "der" => "imprimirCodigoDeBarra",
                "producto" => $producto
            );
            $this->load->view("factura", $datos);
        }
    }

    public function eliminar($id) {
        if ($this->producto->eliminar($id)) {
            $this->configuracion_model->log("Se elimino el producto " . $id);
            redirect("productos/inicio/eliminado");
        } else {
            $this->configuracion_model->log("No se elimino el producto " . $id, "error");
            redirect("productos/inicio/NoSeElimino");
        }
    }

    public function GetOneProduct($id) {
        echo json_encode($this->producto->ObtenerUno($id)[0]);
    }

    public function Modificar() {
        $producto = array(
            "nombre" => $this->input->post("nombre"),
            "descripcion" => $this->input->post("descripcion"),
            "precio" => $this->input->post("precio"),
            "costo" => $this->input->post("costo"),
            "cantidad" => $this->input->post("cantidad"),
            "categoria_id" => $this->input->post("categoria_id"),
            "codigo" => $this->input->post("codigo")
        );
        if ($this->producto->Modificar($producto, $this->input->post("id"))) {
            redirect("productos/Inicio/?mensaje=Se modificó con Exito&tipo=success");
        } else {
            redirect("productos/Inicio/?mensaje=No se modificó con Exito&tipo=error");
        }
    }

}
