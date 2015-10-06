<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class egreso_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function listarTodo() {
        $where = ARRAY(
            "egreso.empresa_id" => $this->session->userdata("empresa_id"),
            "egreso.eliminado" => 0
        );
        $this->db->where($where);
        //join
        $this->db->join("categoria_egreso", "categoria_egreso.id = egreso.categoria_egreso_id");
        $this->db->join("usuario", "usuario.id = egreso.usuario_id");
        $this->db->join("persona", "persona.id = usuario.persona_id");
        //select
        $this->db->select("egreso.descripcion,"
                . "egreso.cantidad,"
                . "egreso.fecha,"
                . "egreso.id,"
                . "persona.nombre AS persona_nombre,"
                . "persona.apellido AS persona_apellido,"
                . "categoria_egreso.nombre AS categoria_egreso_nombre");
        return $this->db->get("egreso")->result();
    }

    public function listarUno($id) {
        $where = ARRAY(
            "egreso.empresa_id" => $this->session->userdata("empres_id"),
            "egreso.id" => $id
        );
        $this->db->where($where);
        //join
        $this->db->join("categoria_egreso", "categoria_egreso.id = egreso.categoria_egreso_id");
        $this->db->join("usuario", "usuario.id = egreso.usuario_id");
        //select
        $this->db->select("egreso.descripcion,"
                . "egreso.cantidad,"
                . "egreso.fecha,"
                . "usuario.nombre AS usuario_nombre,"
                . "usuario.apellido AS usuario_apellido,"
                . "categoria_egreso.nombre AS categoria_egreso_nombre");
        return $this->db->get("egreso")->result();
    }

    public function guardar($egreso) {
        if ($this->db->insert("egreso", $egreso)) {
            $this->configuracion_model->logInterno("Guardo el egreso " . $this->db->insert_id());
            return TRUE;
        } else {
            $this->configuracion_model->logInterno("No se guardo el egreso");
            return FALSE;
        }
    }

    public function eliminar($id) {
        $this->db->where("id = " . $id);
        $set = array(
            "eliminado" => 1
        );
        if ($this->db->update("egreso", $set)) {
            $this->configuracion_model->logInterno("Elimino el egreso " . $id);
            return TRUE;
        } else {
            $this->configuracion_model->logInterno("No elimino el egreso " . $id);
            return FALSE;
        }
    }

    public function listarTodoCategoria() {
        $where = array(
            "c_e.empresa_id" => $this->session->userdata("empresa_id"),
        );
        $this->db->where($where);
        $this->db->select("c_e.nombre,"
                . "c_e.descripcion,"
                . "c_e.id");
        return $this->db->get("categoria_egreso AS c_e")->result();
    }

    public function listarUnaCategoria($id) {
        $where = array(
            "c_e.empresa_id" => $this->session->userdata("empresa_id"),
            "c_e.id" => $id
        );
        $this->db->where($where);
        $this->db->select("c_e.nombre,"
                . "c_e.descripcion,"
                . "c_e.id");
        return $this->db->get("categoria_egreso AS c_e")->result();
    }

    public function guardarCategoria($categoria) {
        if ($this->db->insert("categoria_egreso", $categoria)) {
            $this->configuracion_model->logInterno("Se guardo una categoria_egreso " . $this->db->insert_id());
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function eliminarCategoria($id) {
        $this->db->where("id = " . $id);
        $set = array(
            "eliminado" => 1
        );
        if ($this->db->update("categoria_egreso", $set)) {
            $this->configuracion_model->logInterno("Se elimino la categoria " . $id);
            return TRUE;
        } else {
            $this->configuracion_model->logInterno("No elimino la categoria " . $id);
            return FALSE;
        }
    }

    public function modificarCategoria($categoria) {
        $this->db->where("id = " . $categoria['id']);
        if ($this->db->update("categoria_egreso", $categoria)) {
            $this->configuracion_model->logInterno("Se modifico la categoria " . $categoria['id']);
            return TRUE;
        } else {
            $this->configuracion_model->logInterno("No modifico la categoria " . $categoria['id']);
            return FALSE;
        }
    }

}
