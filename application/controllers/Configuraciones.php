<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Configuraciones extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $datos = array(
            "izq" => "izq",
            "der" => "configuracion",
            "configuraciones" => $this->configuracion_model->listarTodo()
        );
        $this->load->view("factura", $datos);
    }

    public function guardar() {
        $configuracion = array(
            "imprimir" => $this->input->post("imprimir"),
            "pedir_nombre" => $this->input->post("pedir_nombre"),
            "descuento" => $this->input->post("descuento")
        );
        if ($this->configuracion_model->guardar($configuracion)) {
            
        } else {
            
        }
        redirect("configuraciones");
    }

}
