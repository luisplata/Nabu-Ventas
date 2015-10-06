<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class egresos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("egreso_model", "egreso");
        //$this->output->enable_profiler(TRUE);
    }

    public function index() {
        $datos = array(
            "izq" => "izq",
            "der" => "egresos_v",
            "egresos" => $this->egreso->listarTodo()
        );
        $this->load->view("factura", $datos);
    }

    public function nuevo() {
        $datos = array(
            "izq" => "izq",
            "der" => "nuevoEgreso",
            "categorias" => $this->egreso->listarTodoCategoria()
        );
        $this->load->view("factura", $datos);
    }

    public function eliminar($id) {
        if ($this->egreso->eliminar($id)) {
            $this->configuracion_model->log("Se elimino el egreso " . $id);
        } else {
            $this->configuracion_model->log("No se elimino el egreso " . $id, "error");
        }
        redirect("egresos");
    }

    public function categorias() {
        $datos = array(
            "izq" => "izq",
            "der" => "categoriaEgreso_v",
            "categorias" => $this->egreso->listarTodoCategoria()
        );
        $this->load->view("factura", $datos);
    }

    public function nuevaCategoria() {
        $datos = array(
            "izq" => "izq",
            "der" => "nuevaCategoriaEgreso",
        );
        $this->load->view("factura", $datos);
    }

    public function eliminarCategoria($id) {
        if ($this->egreso->eliminarCategoria($id)) {
            $this->configuracion_model->log("Se elimino la categoria " . $id);
        } else {
            $this->configuracion_model->log("No se elimino la categoria " . $id, "error");
        }
        redirect("egresos");
    }

    public function modificarCategoria($id) {
        $datos = array(
            "izq" => "izq",
            "der" => "modificarCategoria",
            "categoria" => $this->egreso->listarUnaCategoria($id)
        );
        $this->load->view("factura", $datos);
    }

    public function editarCategoria() {
        $categoria = array(
            "nombre" => $this->input->post("nombre"),
            "descripcion" => $this->input->post("descripcion"),
            "id" => $this->input->post("id"),
        );
        if ($this->egreso->modificarCategoria($categoria)) {
            $this->configuracion_model->log("Se modifico la categoria " . $categoria['nombre']);
        } else {
            $this->configuracion_model->log("No se modifico la categoria " . $categoria['nombre'], "warning");
        }
        redirect("egresos/categorias");
    }

    public function guardar() {
        $egreso = array(
            "descripcion" => $this->input->post("descripcion"),
            "cantidad" => $this->input->post("cantidad"),
            "categoria_egreso_id" => $this->input->post("categoria_egreso_id"),
            "fecha" => date("Y-m-d"),
            "usuario_id" => $this->session->userdata("usuario_id"),
            "usuario_id" => $this->session->userdata("usuario_id"),
            "empresa_id" => $this->session->userdata("empresa_id"),
        );
        if ($this->egreso->guardar($egreso)) {
            $this->configuracion_model->log("Se guardo el egreso " . $egreso['descripcion']);
        } else {
            $this->configuracion_model->log("No se guardo el egreso " . $egreso['dscripcion'], "error");
        }
        redirect("egresos");
    }

    public function guardarCategoriaEgreso() {
        $egreso = array(
            "descripcion" => $this->input->post("descripcion"),
            "nombre" => $this->input->post("nombre"),
            "empresa_id" => $this->session->userdata("empresa_id"),
        );
        if ($this->egreso->guardarCategoria($egreso)) {
            $this->configuracion_model->log("Se guardo la categoria " . $egreso['nombre']);
        } else {
            $this->configuracion_model->log("No se Guardo la categoria " . $egreso['nombre'], "error");
        }
        redirect("egresos/categorias");
    }

}
