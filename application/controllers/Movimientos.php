<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class movimientos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("movimiento_model", "movimiento");
        //$this->output->enable_profiler(TRUE);
    }

    public function inicio() {
        $datos = array(
            "izq" => "izq",
            "der" => "movimiento_v",
            "movimientos" => $this->movimiento->listarTodo()
        );
        $this->load->view("factura", $datos);
    }

    public function nuevoMovimiento() {
        $this->load->model("sede_model", "sede");
        $this->load->model("producto_model", "producto");
        $datos = array(
            "izq" => "izq",
            "der" => "nuevoMovimiento",
            "movimientos" => $this->movimiento->listarTodo(),
            "sedes" => $this->sede->listarTodo(),
            "productos" => $this->producto->listarTodo()
        );
        $this->load->view("factura", $datos);
    }

    public function guardar() {
        //armando el array
        //sacamos el codigo y el id del producto
        $producto = explode("-", $this->input->post("codigo"));
        $movimiento = array(
            "sede_salida" => $this->input->post("sede_salida"),
            "sede_entrada" => $this->input->post("sede_entrada"),
            "cantidad" => $this->input->post("cantidad"),
            "codigo" => $producto[0],
            "producto_id" => $producto[1],
            "fecha" => date("Y-m-d"),
            "empresa_id" => $this->session->userdata("empresa_id")
        );
        if ($this->movimiento->guardar($movimiento)) {
            $this->configuracion_model->log("Se guardo el movimiento del producto " . $movimient["codigo"]);
            redirect("movimientos/inicio");
        } else {
            $this->configuracion_model->log("No se guardo el movimiento!", "error");
            redirect("movimientos/nuevoMovimiento");
        }
    }

}
