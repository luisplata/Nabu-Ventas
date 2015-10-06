<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class devolucion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function listarTodo() {
        $where = array(
            "devolucion.empresa_id" => $this->session->userdata("empresa_id"),
            "devolucion.sede_id" => $this->session->userdata("sede_id")
        );
        $this->configuracion_model->logInterno("Listo las devoluciones " . $where['devolucion.empresa_id']);
        $this->db->where($where);
        $this->db->select("devolucion.fecha, devolucion.id, devolucion.producto_id,"
                . "producto.nombre");
        $this->db->join("producto", "producto.id = devolucion.producto_id");
        return $this->db->get("devolucion")->result();
    }

    public function guardar($devolucion) {

        //aqui hacemos para aumentar la cantidad del inventario
        $sql = "UPDATE producto SET cantidad = (cantidad + 1) WHERE id = " . $devolucion['producto_id'];
        if ($this->db->query($sql)) {
            $this->configuracion_model->logInterno("Aumento en 1 el producto " . $devolucion['producto_id']);
            //ahora insertamos en la tabla
            if ($this->db->insert("devolucion", $devolucion)) {
                $this->configuracion_model->logInterno("log de devoluvion del producto " . $devolucion['producto_id']);
                return TRUE;
            }
        } else {
            $this->configuracion_model->logInterno("No aumento en 1 la cantidad del producto " . $devolucion['producto_id']);
            return FALSE;
        }
    }

    public function eliminar($id) {
        $where = array(
            "id" => $id
        );
        $this->db->where($where);
        $set = array(
            "eliminado" => 1
        );
        if ($this->db->update("devolucion", $set)) {
            $this->configuracion_model->logInterno("Elimino la devolucion " . $id);
            return TRUE;
        } else {
            $this->configuracion_model->logInterno("No elimino la devoluvion " . $id);
            return FALSE;
        }
    }

}
