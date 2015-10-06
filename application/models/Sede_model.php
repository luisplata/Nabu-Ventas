<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class sede_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function listarTodo() {
        //where
        $where = array(
            "empresa.id" => $this->session->userdata("empresa_id")
        );
        $this->db->where($where);
        //datos para seleccionar    
        /**/
        $this->db->select("sede.id AS id,"
                . "sede.nombre AS nombre,"
                . "sede.telefono AS telefono,"
                . "sede.direccion AS direccion,"
                . "sede.email AS email,"
                . "sede.activo AS activo,"
                . "empresa.id AS empresa_id,"
                . "empresa.nombre AS empresa_nombre");
        //joins
        $this->db->join("empresa", "empresa.id = sede.empresa_id");
        //retornamos
        return $this->db->get("sede")->result();
    }

    public function guardar($sede) {
        if ($this->db->insert("sede", $sede)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function desactivar($id) {
        //datos a actualizar
        $update = array(
            "activo" => "0"
        );
        //where
        $where = array(
            "id" => $id
        );
        $this->db->where($where);
        if ($this->db->update("sede", $update)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function activar($id) {
        //datos a actualizar
        $update = array(
            "activo" => "1"
        );
        //where
        $where = array(
            "id" => $id
        );
        $this->db->where($where);
        if ($this->db->update("sede", $update)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function eliminar($id) {
        
    }

}
