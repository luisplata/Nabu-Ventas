<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Producto_model extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
    }

    public function listarTodo() {
        $where = array(
            "producto.eliminado" => "0",
            "empresa.activo" => "1",
            "producto.empresa_id" => $this->session->userdata("empresa_id"),
            "producto.sede_id" => $this->session->userdata("sede_id")
        );
        $this->db->where($where);
        $this->db->select(
                "producto.id AS producto_id,"
                . "producto.nombre AS producto,"
                . "producto.codigo,"
                . "producto.descripcion AS producto_descripcion,"
                . "producto.precio,"
                . "producto.costo,"
                . "producto.cantidad,"
                . "empresa.id AS empresa_id,"
                . "empresa.nombre AS empresa,"
                . "categoria.id AS categoria_id,"
                . "categoria.nombre AS categoria"
        );
        $this->db->join("empresa", "empresa.id = producto.empresa_id");
        $this->db->join("categoria", "categoria.id = producto.categoria_id");
        $productos = $this->db->get("producto")->result();
        return $productos;
    }

    public function guardar($producto) {
        /* Se tiene que crea el producto en todas las sede de la empresa
         * se hara de la siguiente forma:
         * -se listaran las sedes de la empresa actual
         * -se creara un producto igual cambiando la sede
         * - se guardaran los prudtos
         */
        $this->load->model("sede_model", "sede");

        $sedes = $this->sede->listarTodo();


        if ($this->db->insert("producto", $producto)) {
//            if ($this->configuracion_model->duplicado() == 1) {
//                foreach ($sedes as $value) {
//                    if ($value->id != $this->session->userdata("sede_id")) {
//                        $producto['sede_id'] = $value->id;
//                        $producto['cantidad'] = "0";
//                        $this->db->insert("producto", $producto);
//                    }
//                }
//            } else {
//                
//            }


            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function productoStock() {
        //agregar nuevo campo a configuracion: NumMinProducto
        $where = array(
            "cantidad <" => "10",
            "eliminado" => "0",
            "empresa_id" => $this->session->userdata("empresa_id"),
            "sede_id" => $this->session->userdata("sede_id")
        );

        $this->db->where($where);

        return $this->db->get("producto")->result();
    }

    public function agregarMas($codigo, $cantidad) {
        //haciendo un query unido para esto
        if (empty($cantidad)) {
            $cantidad = 0;
        }
        if (empty($codigo)) {
            $codigo = 0;
        }

        $resutlado = $this->db->query("UPDATE producto SET "
                . "cantidad = (cantidad + " . $cantidad . ") "
                . "WHERE codigo = " . $codigo . " AND sede_id=" . $this->session->userdata("sede_id"));
        if ($resutlado) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function obtenerUno($id) {
        $where = array(
            "id" => $id,
            "eliminado" => "0",
            "empresa_id" => $this->session->userdata("empresa_id")
        );
        $this->db->where($where);

        return $this->db->get("producto")->result();
    }

    public function obtenerUnoCodigo($codigo) {
        $where = array(
            "codigo" => $codigo,
            "eliminado" => "0",
            "empresa_id" => $this->session->userdata("empresa_id"),
            "sede_id" => $this->session->userdata("sede_id")
        );
        $this->db->where($where);

        return $this->db->get("producto")->result();
    }

    public function eliminar($id) {
        $where = array(
            "id" => $id,
            "empresa_id" => $this->session->userdata("empresa_id")
        );
        $this->db->where($where);
        $set = array(
            "eliminado" => 1
        );
        if ($this->db->update("producto", $set)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function codigo() {
        $an = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $su = strlen($an) - 1;
        return substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1);
    }

}
