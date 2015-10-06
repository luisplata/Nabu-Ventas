<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Empresas extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("empresa_model", "empresa");
    }

    public function inicio() {
        $datos = array(
            "izq" => "izq",
            "der" => "empresas_v",
            "empresas" => $this->empresa->listarTodo()
        );
        //$this->configuracion_model->log("Se mostraros las empresas");
        $this->load->view("factura", $datos);
    }

    public function nuevaEmpresa() {
        $datos = array(
            "izq" => "izq",
            "der" => "nuevaEmpresa"
        );
        $this->load->view("factura", $datos);
    }

    public function registrarEmpresa() {
        $empresa = array(
            "nombre" => $this->input->post("nombre"),
            "direccion" => $this->input->post("direccion"),
            "nit" => $this->input->post("nit"),
            "email" => $this->input->post("email"),
            "telefono" => $this->input->post("telefono")
        );
        if ($this->empresa->guardar($empresa)) {
            $this->configuracion_model->log("Se registro la empresa " . $empresa['nombre']);
            redirect("empresas/inicio");
        } else {
            $this->configuracion_model->log("No se registro la empresa " . $empresa['nombre'], "error");
            redirect("empresas/nuevaEmpresa");
        }
    }

    public function eliminar($id) {
        if ($this->empresa->eliminar($id)) {
            $this->configuracion_model->log("Se elimino la empresa " . $id);
            redirect("empresas/inicio");
        } else {
            $this->configuracion_model->log("No se elimino la empresa " . $id, "error");
            redirect("empresas/nuevaEmpresa");
        }
    }

    public function desactivar($id) {
        if ($this->empresa->desactivar($id)) {
            $this->configuracion_model->log("Se desactivo la empresa " . $id);
            redirect("empresas/inicio");
        } else {
            $this->configuracion_model->log("No se desactivo la empresa " . $id, "warning");
            redirect("empresas/nuevaEmpresa");
        }
    }

    public function activar($id) {
        if ($this->empresa->activar($id)) {
            $this->configuracion_model->log("Se Activo la empresa " . $id);
            redirect("empresas/inicio");
        } else {
            $this->configuracion_model->log("No se activo la empresa " . $id, "warning");
            redirect("empresas/nuevaEmpresa");
        }
    }

}
