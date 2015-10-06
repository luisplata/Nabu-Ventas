<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class devolucion extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("devolucion_model", "devolucion");
        //$this->output->enable_profiler(TRUE);
    }

    public function index() {
        $datos = array(
            "izq" => "izq",
            "der" => "devolucion"
        );
        $this->load->view("factura", $datos);
    }

    public function devolver() {
        $datos = array(
            "izq" => "izq",
            "der" => "devolucion"
        );
        $this->load->view("factura", $datos);
    }

//    public function devolucion() {
//        //formulario para hacer una devolucion
//        $datos = array(
//            "izq" => "izq",
//            "der" => "devolucion"
//        );
//        $this->load->view("factura", $datos);
//    }

    public function guardar() {
        $this->load->model("producto_model", "producto");
        //tenemos que buscar la id del producto
        $codigo = $this->input->post("codigo");
        //echo $this->input->post("codigo");
        $producto = $this->producto->obtenerUnoCodigo($codigo);

        foreach ($producto as $value) {
            $id = $value->id;
            break;
        }
        //ahora aumentamos en uno la cantidad del producto
        $devolucion = array(
            "fecha" => date("Y-m-d"),
            "producto_id" => $id,
            "sede_id" => $this->session->userdata("sede_id"),
            "empresa_id" => $this->session->userdata("empresa_id")
        );
        if ($this->devolucion->guardar($devolucion)) {
            $this->configuracion_model->log("Se Devolvio el producto " . $codigo);
        } else {
            $this->configuracion_model->log("No Devolvio el producto " . $codigo, "error");
        }
        redirect("devolucion/devolver");
    }

}
