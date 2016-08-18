<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServiceVendedor
 *
 * @author Luiis Plata
 */
class ServiceVendedor extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        $this->load->model("Usuario_model", "usuario");
        $this->load->model("WebService", "web");
    }

    public function login($user, $pass) {
        $llave = $this->usuario->login($user, $pass);
        foreach ($llave as $value) {
            echo json_encode($value);
        }
    }

    public function productosBajoStock($llave) {
        $datos = $this->web->ProductosBajoStock($llave);
        echo json_encode($datos);
    }

    public function buscarProducto($codigo, $llave) {
        foreach ($this->web->buscarProducto($codigo, $llave) as $value) {
            echo json_encode($value);
        }
    }

}
