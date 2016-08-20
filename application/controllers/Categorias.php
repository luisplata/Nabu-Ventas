<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Categorias extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        $this->load->model("categoria_model", "categoria");
    }

    public function inicio() {
        $datos = array(
            "izq" => "izq",
            "der" => "categorias_v",
            "categorias" => $this->categoria->listarTodo()
        );
        $this->load->view("factura", $datos);
    }

    public function nuevaCategoria() {
        $datos = array(
            "izq" => "izq",
            "der" => "nuevaCategoria",
            "categorias" => $this->categoria->listarTodo()
        );
        $this->load->view("factura", $datos);
    }

    public function registrarCategoria() {
        $categoria = array(
            "nombre" => $this->input->post("nombre"),
            "descripcion" => $this->input->post("descripcion"),
            "padre" => $this->input->post("padre"),
            "empresa_id" => $this->session->userdata("empresa_id")
        );

        if ($this->categoria->guardar($categoria)) {
            $this->configuracion_model->log("Ingreso categoria " . $categoria['nombre']);
            redirect("categorias/inicio");
        } else {
            $this->configuracion_model->log("Ingreso categoria " . $categoria['nombre'], "error");
            redirect("categorias/nuevaCategoria");
        }
    }

    public function Categoria($id) {
        echo json_encode($this->categoria->GetCategoria($id)[0]);
    }

    public function Modificar() {
        $categoria = array(
            "nombre" => $this->input->post("nombre"),
            "descripcion" => $this->input->post("descripcion"),
            "padre" => $this->input->post("padre")
        );
        if ($this->categoria->Modificar($categoria, $this->input->post("id"))) {
            redirect("categorias/inicio/?mensaje=Se modificó con Exito&tipo=success");
        } else {
            redirect("categorias/inicio/?mensaje=No se modificó con Exito&tipo=error");
        }
    }
    public function Eliminar($id) {
        if($this->categoria->eliminar($id)){
            redirect("categorias/inicio/?mensaje=Se eliminó con Exito&tipo=success");
        }else{
            redirect("categorias/inicio/?mensaje=No se eliminó con Exito&tipo=error");
        }
    }
}
