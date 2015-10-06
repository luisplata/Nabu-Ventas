<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class movimiento_model extends CI_Model {

    function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
    }

    public function listarTodo() {
        //where
        $where = array(
            "movimiento.empresa_id" => $this->session->userdata("empresa_id"),
            "movimiento.sede_salida" => $this->session->userdata("sede_id")
        );
        $this->db->where($where);
        //datos a seleccionar
        /**/
        $this->db->select("movimiento.fecha,"
                . "movimiento.cantidad,"
                . "movimiento.id,"
                . "sede_salida.nombre AS sede_salida,"
                . "sede_salida.id AS sede_salida_id,"
                . "sede_entrada.nombre AS sede_entrada,"
                . "sede_entrada.id AS sede_entrada_id,"
                . "producto.nombre AS producto_nombre,"
                . "producto.codigo AS producto_codigo,"
                . "producto.id AS producto_id,"
                . "empresa.id AS empresa_id,"
                . "empresa.nombre AS empresa_nombre"
        );
        //joins
        $this->db->join("sede as sede_salida", "sede_salida.id = movimiento.sede_salida");
        $this->db->join("sede as sede_entrada", "sede_entrada.id = movimiento.sede_entrada");
        $this->db->join("empresa", "empresa.id = sede_entrada.empresa_id");
        $this->db->join("producto", "producto.id = movimiento.producto_id");

        //retornando los datos
        return $this->db->get("movimiento")->result();
    }

    public function guardar($movimiento) {

        /* algoritmo del movimiento
         * - se verifica que la cantidad de resta no sea mayor a la que hay
         *      asi tenemos al producto en caso que no este creada para la sede
         *      que entra
         * - se verifica que el producto este creado en la sede
         *      que entra
         *      - si esta se suma
         *      - sino se crea un producto igual cambiando la sede
         * - se resta a la sede a la que sale el producto
         * - se registra el movimiento
         *
          $movimiento = array(
          "sede_salida" => $this->input->post("sede_salida"),
          "sede_entrada" => $this->input->post("sede_entrada"),
          "cantidad" => $this->input->post("cantidad"),
          "codigo" => $producto[0],
          "producto_id" => $producto[1],
          "fecha" => date("Y-m-d"),
          "empresa_id" => $this->session->userdata("empresa_id")
          );
         */
        //obteniendo el producto de la sede_salida de la base de datos
        $where = array(
            "id" => $movimiento['producto_id'],
            "sede_id" => $movimiento['sede_salida']
        );
        $this->db->where($where);
        $p = $this->db->get("producto")->result();
        foreach ($p as $value) {
            $producto = array(
                "nombre" => $value->nombre,
                "codigo" => $value->codigo,
                "descripcion" => $value->descripcion,
                "precio" => $value->precio,
                "costo" => $value->costo,
                "cantidad" => $value->cantidad - $movimiento['cantidad'],
                "empresa_id" => $value->empresa_id,
                "sede_id" => $value->sede_id,
                "eliminado" => $value->eliminado
            );
            $cantidad2 = $value->cantidad;
        }
        //ya tenemos al producto cargado
        //verificamos que la cantidad no sea mayor al numero que hay
        if ($movimiento['cantidad'] > $cantidad2) {
            //retornamos false enseguida porque no se puede
            return FALSE;
        }
        //producto de la sede que entra
        $where = array(
            "codigo" => $movimiento['codigo'],
            "sede_id" => $movimiento['sede_entrada']
        );
        $this->db->where($where);
        $p = $this->db->get("producto")->result();
        if ($this->db->count_all_results() <= 0) {
            //no esta el producto con la sede_entranada
            //creamos el producto e ingresamos a la base de datos con la sede_entrada
            //cambiamos datos
            $producto['cantidad'] = $movimiento['cantidad'];
            $producto['sede_id'] = $movimiento['sede_entrada'];
            $this->db->insert("producto", $producto);
        } else {
            //si existe
            //cargamos los datos del producto de la sede entrada
            foreach ($p as $value) {
                $producto_entrada = array(
                    "nombre" => $value->nombre,
                    "codigo" => $value->codigo,
                    "descripcion" => $value->descripcion,
                    "precio" => $value->precio,
                    "costo" => $value->costo,
                    "cantidad" => $value->cantidad + $movimiento['cantidad'],
                    "empresa_id" => $value->empresa_id,
                    "sede_id" => $value->sede_id,
                    "eliminado" => $value->eliminado
                );
            }
            //sumamos al producto de la sede_entrada
            //necesitamos una clausula where para actualizarlo
            $where = array(
                "codigo" => $movimiento['codigo'],
                "sede_id" => $movimiento['sede_entrada']
            );
            $this->db->where($where);
            if ($this->db->update("producto", $producto_entrada)) {
                //si esto es exito restamos a la sede_salida
                //clausula where
                $where = array(
                    "codigo" => $movimiento['codigo'],
                    "sede_id" => $movimiento['sede_salida']
                );
                $this->db->where($where);
                if ($this->db->update("producto", $producto)) {
                    //dejamos que siga el fluido
                } else {
                    //return FALSE;
                }
            } else {
                //return FALSE;
            }
        }
        if ($this->db->insert("movimiento", $movimiento)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
