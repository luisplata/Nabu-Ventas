<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebService
 *
 * @author Luiis Plata
 */
class WebService extends CI_Model{
    //put your code here
    function __construct() {
        parent::__construct();
        }

    public function ProductosBajoStock($llave) {
        return $this->db->query("CALL ProductosBajoStock('$llave')")->result();
    }
    
    public function buscarProducto($codigo,$llave) {
        return $this->db->query("call buscarProducto('$codigo','$llave')")->result();
    }
}
