<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Categoria_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function listarTodo() {
        //$this->configuracion->logInterno("listar todas las categorias");
        $where = array(
            "eliminado" => "0",
            "empresa_id" => $this->session->userdata("empresa_id")
        );
        $this->db->where($where);
        $categorias = $this->db->get("categoria")->result();
        return $categorias;
    }

    public function guardar($categoria) {
        if ($this->db->insert("categoria", $categoria)) {
            $this->configuracion_model->logInterno("se guardo una categoria " . $this->db->insert_id());
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function GetCategoria($id) {
        $sql = "select "
                . "id, "
                . "nombre, "
                . "descripcion, "
                . "padre "
                . "from categoria "
                . "where id = ?";
        $filtro = array(
            $id
        );
        return $this->db->query($sql, $filtro)->result();
    }

    public function Modificar($categoria, $id) {
        $this->db->set($categoria);
        $this->db->where("id", $id);
        if ($this->db->update("categoria")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function Eliminar($id) {
        $this->db->set("eliminado", 1);
        $this->db->where("id", $id);
        if ($this->db->update("categoria")) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
