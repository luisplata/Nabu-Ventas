<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ingreso_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function listarTodo() {
        $where = array(
            "ingreso_especial.eliminado" => "0",
            "sede.id" => $this->session->userdata("sede_id")
        );
        $this->db->where($where);
        $this->db->select("ingreso_especial.id,"
                . "ingreso_especial.cantidad,"
                . "ingreso_especial.descripcion,"
                . "ingreso_especial.fecha,"
                . "sede.id AS sede_id");
        $this->db->join("sede", "sede.id = ingreso_especial.sede_id");
        return $this->db->get("ingreso_especial")->result();
    }

    public function listarTodoEmpresa($id) {
        
    }

    public function guardar($ingreso) {
        if ($this->db->insert("ingreso_especial", $ingreso)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function eliminar($id) {
        
    }

}
