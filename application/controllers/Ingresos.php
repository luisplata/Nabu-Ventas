<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ingresos extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("ingreso_model", "ingreso");
    }

    public function index() {
        /*
         * aqui mostraremos todos los imgresos y hacer un nuevo ingreso
         */
        $datos = array(
            "izq" => "izq",
            "der" => "ingresoespecial",
            "ingresos" => $this->ingreso->listarTodo()
        );
        $this->load->view("factura", $datos);
    }

    public function guardar() {
        $ingreso = array(
            "cantidad" => $this->input->post("cantidad"),
            "descripcion" => $this->input->post("descripcion"),
            "fecha" => date("Y-m-d H:m:s"),
            "sede_id" => $this->session->userdata("sede_id")
        );
        if ($this->ingreso->guardar($ingreso)) {
            
        } else {
            
        }
        redirect("ingresos");
    }

}
