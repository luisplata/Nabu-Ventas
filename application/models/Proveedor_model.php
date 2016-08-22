<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Proveedor_model
 *
 * @author Luiis Plata
 */
class Proveedor_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function ListarTodo() {
        //
        $where = array(
            "eliminado" => "0",
            "sede_id" => $this->session->userdata("sede_id")
        );
        $this->db->where($where);
        $this->db->select("id, nombre, descripcion, nit");
        return $this->db->get("Proveedor")->result();
    }

    public function ListarUno($id) {
        //    
        $where = array(
            "eliminado" => "0",
            "sede_id" => $this->session->userdata("sede_id"),
            "id" => $id
        );
        $this->db->where($where);
        $this->db->select("id, nombre, descripcion, nit");
        return $this->db->get("Proveedor")->result();
    }

    public function Guardar($proveedor) {
        //
        if ($this->db->insert("Proveedor", $proveedor)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function Modificar($proveedor, $id) {
        //
        $this->db->set($proveedor);
        $this->db->where("id", $id);
        if ($this->db->update("Proveedor")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function Eliminar($id) {
        //        
        $this->db->set("eliminado", 1);
        $this->db->where("id", $id);
        if ($this->db->update("Proveedor")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
