<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class cliente_model extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
    }

    public function listarTodo() {
        $this->configuracion_model->logInterno("listar todos los clientes");
        $where = array(
            "cliente.eliminado" => "0",
            "credito.eliminado" => "0",
            "credito.empresa_id" => $this->session->userdata("empresa_id")
        );
        $this->db->where($where);
        $this->db->join("cliente", "cliente.id = credito.cliente_id");
        return $this->db->get("credito")->result();
    }

    public function guardar($cliente) {
        $cliente_id;
        $this->configuracion_model->logInterno("guardar cliente " . $this->db->insert_id);
        if ($this->db->insert("cliente", $cliente)) {
            //ahora creamos su cuenta de credito
            //sacamos la id del cliente
            $where = array(
                "documento" => $cliente['documento']
            );
            $this->db->where($where);
            $cliente_buscado = $this->db->get("cliente")->result();
            foreach ($cliente_buscado as $value) {
                $cliente_id = $value->id;
            }

            //no coloco ningun if porque son datos que provienen de un solo lado.

            return $this->crearCredito($cliente_id);
        } else {
            return FALSE;
        }
    }

    public function crearCredito($cliente_id) {
        //creamos el array para el ingreso de la cuenta de esta empresa
        $credito = array(
            "cliente_id" => $cliente_id,
            "empresa_id" => $this->session->userdata("empresa_id"),
            "descuento" => $this->session->userdata("descuento")
        );
        //insertamos los datos para crear su credito
        if ($this->db->insert("credito", $credito)) {
            $this->configuracion_model->logInterno("Se creo cuenta de credito " . $this->db->insert_id);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function eliminar($id) {
        
    }

    public function credito($id) {
        $this->configuracion_model->logInterno("busco el credito del cliente " . $id);
        //buscara el credito y lo devolvera
        $where3 = array(
            "credito.eliminado" => "0",
            "credito.cliente_id" => $id,
            "credito.empresa_id" => $this->session->userdata("empresa_id"),
            "cliente.eliminado" => "0"
        );
        $this->db->where($where3);
        $this->db->join("cliente", "cliente.id = credito.cliente_id");
        return $this->db->get("credito")->result();
    }

    public function pagar($credito, $where) {
        $this->db->where($where);
        if ($this->db->update("credito", $credito)) {
            $this->configuracion_model->logInterno("Se pago credito de cliente");
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function existe($documento, $telefono, $email) {
        $this->db->where("documento", $documento);
        $this->db->or_where("telefono", $telefono);
        $this->db->or_where("email", $email);
        $clientes = $this->db->get("cliente")->result();
        $this->configuracion_model->logInterno("busco al cliente si existe " . $documento);
        if ($clientes) {
            //significa que si existe
            foreach ($clientes as $value) {
                return $value->id;
            }
        } else {
            //no existe y no se que pasa en este caso
            return "a";
        }
    }

}
