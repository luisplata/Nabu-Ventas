<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Inicios extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
    }

    public function inicio() {
        $datos["izq"] = "izq";
        $datos["der"] = "der";

        $this->load->view("factura", $datos);
    }

}
