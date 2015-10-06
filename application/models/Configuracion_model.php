<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class configuracion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function listarTodo() {
        $where = array(
            "empresa_id" => $this->session->userdata("empresa_id")
        );
        $this->db->where($where);
        return $this->db->get("configuracion")->result();
    }

    public function imprimir() {
        $where = array(
            "empresa_id" => $this->session->userdata("empresa_id")
        );
        $this->db->where($where);
        $configuracion = $this->db->get("configuracion")->result();
        foreach ($configuracion as $value) {
            $imprimir = $value->imprimir;
        }
        return $imprimir;
    }

    public function pedirNombre() {
        $where = array(
            "empresa_id" => $this->session->userdata("empresa_id")
        );
        $this->db->where($where);
        $configuracion = $this->db->get("configuracion")->result();
        foreach ($configuracion as $value) {
            $pedirNombre = $value->pedir_nombre;
        }
        return $pedirNombre;
    }

    public function log($accion = null, $tipo = "success") {
        $log = array(
            "accion" => $accion,
            "fecha" => date("Y-m-d H:m:s"),
            "empresa_id" => $this->session->userdata("empresa_id"),
            "sede_id" => $this->session->userdata("sede_id"),
            "usuario_id" => $this->session->userdata("usuario_id"),
            "ip" => $this->input->ip_address(),
            "navegador" => $this->input->user_agent()
        );
        if ($this->db->insert("log", $log)) {
            $this->session->set_userdata("mensaje", $accion);
            $this->session->set_userdata("tipo", $tipo);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function logInterno($accion) {
        $log = array(
            "accion" => $accion,
            "fecha" => date("Y-m-d H:m:s"),
            "empresa_id" => $this->session->userdata("empresa_id"),
            "sede_id" => $this->session->userdata("sede_id"),
            "usuario_id" => $this->session->userdata("usuario_id"),
            "ip" => $this->input->ip_address(),
            "navegador" => $this->input->user_agent()
        );
        if ($this->db->insert("log", $log)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function guardar($configuracion) {
        if ($this->db->update("configuracion", $configuracion)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
