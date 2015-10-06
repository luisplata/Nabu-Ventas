<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Factura_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function listarTodo() {
        $where = array(
            "factura.eliminado" => "0",
            "factura.empresa_id" => $this->session->userdata("empresa_id")
        );
        $this->db->where($where);
        //los join
        $this->db->join("usuario", "usuario.id = factura.usuario_id");
        $this->db->join("producto", "producto.id = factura.producto_id");
        $this->db->join("empresa", "producto.id = factura.empresa_id");
        //el select
        $this->db->select("factura.id AS factura_id,"
                . "factura.fecha,"
                . "usuario.id AS usuario_id,"
                . "factura.factura AS facturaNumero");
        return $this->db->get("factura")->result();
    }

    public function listarTodasFacturas() {
        $where = array(
            "factura.eliminado" => "0",
            "factura.empresa_id" => $this->session->userdata("empresa_id"),
            "factura.sede_id" => $this->session->userdata("sede_id")
        );
        $this->db->where($where);
        //los join
        $this->db->join("usuario", "usuario.id = factura.usuario_id");
        $this->db->join("producto", "producto.id = factura.producto_id");
        $this->db->join("empresa", "empresa.id = factura.empresa_id");
        //Sacando el orden de la muestra de la factura
        $this->db->group_by("factura.factura");
        //ordenamos
        $this->db->order_by("factura.factura", "desc");
        //el select
        $this->db->select("factura.id AS factura_id,"
                . "factura.fecha,"
                . "factura.factura AS facturaNumero");
        return $this->db->get("factura")->result();
    }

    public function listaFactura($facturaNum) {
        $where = array(
            "factura.eliminado" => "0",
            "factura.empresa_id" => $this->session->userdata("empresa_id"),
            "factura.factura" => $facturaNum
        );
        $this->db->where($where);
        //los join
        $this->db->join("usuario", "usuario.id = factura.usuario_id");
        $this->db->join("producto", "producto.id = factura.producto_id");
        $this->db->join("empresa", "empresa.id = factura.empresa_id");
        //el select
        $this->db->select("producto.nombre AS producto_nombre,"
                . "producto.codigo,"
                . "producto.precio,"
                . "producto.id AS producto_id");
        return $this->db->get("factura")->result();
    }

    public function ultimoNumero() {
        //sacando la ultima factura de la base de datos
        $where = array(
            "empresa_id" => $this->session->userdata("empresa_id")
        );
        $this->db->where($where);
        $confi = $this->db->get("configuracion")->result();
        foreach ($confi as $value) {
            return $ultimoNumero = $value->facturaNumero;
        }
    }

    public function guardar($array, $cliente, $credito = FALSE) {

        foreach ($array as $productoIndividual) {
            //se crea la consulta para que 
            /* problema, cuando hay mas de una persona trabajando, no se actualiza el numero 
             * hay que sacar el numero de la factura directo de la base de datos, para que no hayya
             * inconvenientes de confundir facturas
             * tambien, voy a tener dificultad en cuanto al producto que se esta disminuendo.
             * ya que estoy cojiendo la id, tengo que cojer el codigo, y al sede para filtrar
             */

            //haciendo el array de la factura
            if ($credito) {
                $insert = array(
                    "producto_id" => $productoIndividual['id'],
                    "usuario_id" => $this->session->userdata("usuario_id"),
                    "fecha" => date("Y-m-d"),
                    "factura" => ($this->ultimoNumero() + 1),
                    "empresa_id" => $this->session->userdata("empresa_id"),
                    "sede_id" => $this->session->userdata("sede_id"),
                    "cliente_id" => $cliente,
                    "credito" => 1
                );
            } else {
                $insert = array(
                    "producto_id" => $productoIndividual['id'],
                    "usuario_id" => $this->session->userdata("usuario_id"),
                    "fecha" => date("Y-m-d"),
                    "factura" => ($this->ultimoNumero() + 1),
                    "empresa_id" => $this->session->userdata("empresa_id"),
                    "sede_id" => $this->session->userdata("sede_id"),
                    "cliente_id" => $cliente
                );
            }
            if ($this->db->insert("factura", $insert)) {
                //ahora vamos a disminuir en uno el producto que pase por aqui
                //haciendo un query unico para esta funcion
                $this->db->query("UPDATE producto SET "
                        . "cantidad = (cantidad -1) "
                        . "WHERE id = " . $productoIndividual['id']
                        . " AND sede_id = " . $this->session->userdata("sede_id"));
            }
        }
        //$this->session->set_userdata("facturaNumero", $insert['factura']+1);
        $data = array(
            'facturaNumero' => $this->ultimoNumero() + 1
        );

        $this->db->where('empresa_id', $this->session->userdata("empresa_id"));
        $this->db->update('configuracion', $data);

        return TRUE;
    }

    public function listarFacturas($fecha) {
        /* Vamos a recojer todos los datos que necesitemos para crear el reporte
         * para el reporte necesitamos lo siguiente:
         * lista completa de facturas
         * empleados que atendieron ese dia
         * cuantas facturas hicieron
         * 
         */
        /* Facturas */
        $where = array(
            "factura.empresa_id" => $this->session->userdata("empresa_id"),
            "factura.sede_id" => $this->session->userdata("sede_id"),
            "factura.fecha" => $fecha,
            "factura.eliminado" => "0"
        );
        $this->db->where($where);
        //select
        /**/
        $this->db->select("factura.id,"
                . "factura.fecha,"
                . "factura.factura,"
                . "empresa.id AS empresa_id,"
                . "empresa.nombre AS empresa_nombre,"
                . "producto.id AS producto_id,"
                . "producto.nombre AS producto_nombre,"
                . "producto.precio AS producto_precio,"
                . "producto.costo AS producto_costo,"
                . "sede.id AS sede_id,"
                . "sede.nombre AS sede_nombre,"
                . "usuario.id AS usuario_id,"
                . "persona.id AS persona_id,"
                . "persona.nombre AS persona_nombre,"
                . "persona.apellido AS persona_apellido,"
                . "persona.documento AS persona_documento");
        //joins
        $this->db->join("empresa", "empresa.id = factura.empresa_id");
        $this->db->join("producto", "producto.id = factura.producto_id");
        $this->db->join("sede", "sede.id = factura.sede_id");
        $this->db->join("usuario", "usuario.id = factura.usuario_id");
        $this->db->join("persona", "persona.id = usuario.persona_id");
        //facturas completas
        $reporte["facturas"] = $this->db->get("factura")->result();
        /* Egresos generados */
        $where = array(
            "egreso.empresa_id" => $this->session->userdata("empresa_id"),
            "egreso.fecha" => $fecha,
            "egreso.eliminado" => "0"
        );

        $this->db->where($where);
        //select
        /**/
        $this->db->select("egreso.id, egreso.descripcion, egreso.cantidad, egreso.fecha, "
                . "persona.nombre AS persona_nombre,"
                . "persona.apellido AS persona_apellido,"
                . "empresa.nombre AS empresa_nombre,"
                . "categoria_egreso.nombre AS categoria_egreso_nombre");
        //joins
        $this->db->join("empresa", "empresa.id = egreso.empresa_id");
        $this->db->join("usuario", "usuario.id = egreso.usuario_id");
        $this->db->join("persona", "persona.id = usuario.persona_id");
        $this->db->join("categoria_egreso", "categoria_egreso.id = egreso.categoria_egreso_id");
        //egreso completas
        $reporte["egreso"] = $this->db->get("egreso")->result();


        /* empleados que atendieron */
        $where = array(
            "factura.empresa_id" => $this->session->userdata("empresa_id"),
            "factura.sede_id" => $this->session->userdata("sede_id"),
            "factura.fecha" => $fecha,
            "factura.eliminado" => "0"
        );
        $this->db->where($where);
        //select
        /**/
        $this->db->select("persona.id,"
                . "persona.nombre,"
                . "persona.apellido,"
                . "persona.documento,"
                . "usuario.id AS usuario_id,"
                . "COUNT(factura.factura) AS cantidad");
        //joins
        $this->db->join("empresa", "empresa.id = factura.empresa_id");
        $this->db->join("producto", "producto.id = factura.producto_id");
        $this->db->join("sede", "sede.id = factura.sede_id");
        $this->db->join("usuario", "usuario.id = factura.usuario_id");
        $this->db->join("persona", "persona.id = usuario.persona_id");
        //goup_by
        $this->db->group_by("factura.usuario_id");
        //empleados que atendieron
        $reporte["empleados"] = $this->db->get("factura")->result();
        /* cantidad de facturas por empleado */
        $query = $this->db->query("SELECT "
                . "usuario.id AS usuario_id, persona.id AS persona_id,factura.factura "
                . "FROM factura "
                . "INNER JOIN empresa ON empresa.id = factura.empresa_id "
                . "INNER JOIN producto ON producto.id = factura.producto_id "
                . "INNER JOIN sede ON sede.id = factura.sede_id "
                . "INNER JOIN usuario ON usuario.id = factura.usuario_id "
                . "INNER JOIN persona ON persona.id = usuario.persona_id "
                . "WHERE factura.empresa_id = " . $this->session->userdata('empresa_id') . " "
                . "AND factura.fecha = '" . $fecha . "' "
                . "AND factura.sede_id = " . $this->session->userdata("sede_id") . " "
                . "AND factura.eliminado = 0 "
                . "GROUP BY factura.factura");
        //cantidad de facturas por empleado
        $reporte["numeroPorEmpleado"] = $query->result();

        /* Las Devoluciones que se restan al ingreso */
        $where1 = array(
            "devolucion.empresa_id" => $this->session->userdata("empresa_id"),
            "devolucion.sede_id" => $this->session->userdata("sede_id"),
            "devolucion.eliminado" => 0
        );
        $this->db->where($where1);
        $this->db->select("devolucion.id,"
                . "devolucion.fecha,"
                . "producto.nombre AS producto_nombre,"
                . "producto.precio AS producto_precio,"
                . "producto.costo AS producto_costo");

        $this->db->join("producto", "producto.id = devolucion.producto_id");

        $reporte['devoluciones'] = $this->db->get("devolucion")->result();
        
         /*
         * Ingresos especiales
         */
        $where = array(
            "ingreso_especial.eliminado" => "0",
            "sede.id" => $this->session->userdata("sede_id"),
            "ingreso_especial.fecha" => $fecha,
        );
        $this->db->where($where);
        //$this->db->where('fecha BETWEEN "' . $inicio . '" AND "' . $final . '"');
        $this->db->select("ingreso_especial.id,"
                . "ingreso_especial.cantidad,"
                . "ingreso_especial.descripcion,"
                . "ingreso_especial.fecha,"
                . "sede.id AS sede_id");
        $this->db->join("sede", "sede.id = ingreso_especial.sede_id");
        //return $this->db->get("ingreso_especial")->result();

        $reporte['ingresos_especiales'] = $this->db->get("ingreso_especial")->result();
        /*
         * Hasta aqui
         */
        
        return $reporte;
    }

    public function listarFacturasFechas($inicio, $final) {
        /*
         * Se mostraran los siguientes datos:
         * - Detalles de los usuarios y sus facturas generadas
         * - facturas realizadas desde fecha inicio y fecha final
         * - egresos durante estas fechas
         * 
         * Detalles de usuarios y sus facturas:
         * 
         */

        /* empleados que atendieron */
        //armando la consulta
        $query = $this->db->query("SELECT "
                . "persona.id, persona.nombre, persona.apellido, persona.documento, "
                . "usuario.id AS usuario_id, "
                . "COUNT(factura.factura) AS cantidad "
                . "FROM factura "
                . "INNER JOIN empresa ON empresa.id = factura.empresa_id "
                . "INNER JOIN producto ON producto.id = factura.producto_id "
                . "INNER JOIN sede ON sede.id = factura.sede_id "
                . "INNER JOIN usuario ON usuario.id = factura.usuario_id "
                . "INNER JOIN persona ON persona.id = usuario.persona_id "
                . "WHERE "
                . "fecha BETWEEN '" . $inicio . "' AND '" . $final . "' AND "
                . "factura.empresa_id = " . $this->session->userdata('empresa_id') . " AND "
                . "factura.sede_id = " . $this->session->userdata('sede_id') . " AND "
                . "factura.eliminado = 0 "
                . "GROUP BY factura.usuario_id");
        //empleados que atendieron
        $reporte["empleados"] = $query->result();
        /* cantidad de facturas por empleado */
        $query1 = $this->db->query("SELECT "
                . "usuario.id AS usuario_id, persona.id AS persona_id,factura.factura "
                . "FROM factura "
                . "INNER JOIN empresa ON empresa.id = factura.empresa_id "
                . "INNER JOIN producto ON producto.id = factura.producto_id "
                . "INNER JOIN sede ON sede.id = factura.sede_id "
                . "INNER JOIN usuario ON usuario.id = factura.usuario_id "
                . "INNER JOIN persona ON persona.id = usuario.persona_id "
                . "WHERE factura.empresa_id = " . $this->session->userdata('empresa_id') . " "
                . "AND factura.fecha BETWEEN '" . $inicio . "' AND '" . $final . "' "
                . "AND factura.sede_id = " . $this->session->userdata("sede_id") . " "
                . "AND factura.eliminado = 0 "
                . "GROUP BY factura.factura");
        //cantidad de facturas por empleado
        $reporte["numeroPorEmpleado"] = $query1->result();

        $where2 = array(
            "egreso.empresa_id" => $this->session->userdata("empresa_id"),
            "egreso.eliminado" => "0"
        );

        $this->db->where($where2);
        $this->db->where('fecha BETWEEN "' . $inicio . '" AND "' . $final . '"');
        //select
        /**/
        $this->db->select("egreso.id, egreso.descripcion, egreso.cantidad, egreso.fecha, "
                . "persona.nombre AS persona_nombre,"
                . "persona.apellido AS persona_apellido,"
                . "empresa.nombre AS empresa_nombre,"
                . "categoria_egreso.nombre AS categoria_egreso_nombre");
        //joins
        $this->db->join("empresa", "empresa.id = egreso.empresa_id");
        $this->db->join("usuario", "usuario.id = egreso.usuario_id");
        $this->db->join("persona", "persona.id = usuario.persona_id");
        $this->db->join("categoria_egreso", "categoria_egreso.id = egreso.categoria_egreso_id");
        //egreso completas
        $reporte["egreso"] = $this->db->get("egreso")->result();


        /* Facturas */
        $where = array(
            "factura.empresa_id" => $this->session->userdata("empresa_id"),
            "factura.sede_id" => $this->session->userdata("sede_id"),
            "factura.eliminado" => "0"
        );
        $this->db->where($where);
        $this->db->where('fecha BETWEEN "' . $inicio . '" AND "' . $final . '"');

        //select
        /**/
        $this->db->select("factura.id,"
                . "factura.fecha,"
                . "factura.factura,"
                . "empresa.id AS empresa_id,"
                . "empresa.nombre AS empresa_nombre,"
                . "producto.id AS producto_id,"
                . "producto.nombre AS producto_nombre,"
                . "producto.precio AS producto_precio,"
                . "producto.costo AS producto_costo,"
                . "sede.id AS sede_id,"
                . "sede.nombre AS sede_nombre,"
                . "usuario.id AS usuario_id,"
                . "persona.id AS persona_id,"
                . "persona.nombre AS persona_nombre,"
                . "persona.apellido AS persona_apellido,"
                . "persona.documento AS persona_documento");
        //joins
        $this->db->join("empresa", "empresa.id = factura.empresa_id");
        $this->db->join("producto", "producto.id = factura.producto_id");
        $this->db->join("sede", "sede.id = factura.sede_id");
        $this->db->join("usuario", "usuario.id = factura.usuario_id");
        $this->db->join("persona", "persona.id = usuario.persona_id");
        //facturas completas
        $reporte["facturas"] = $this->db->get("factura")->result();

        /* Las Devoluciones que se restan al ingreso */
        $where1 = array(
            "devolucion.empresa_id" => $this->session->userdata("empresa_id"),
            "devolucion.sede_id" => $this->session->userdata("sede_id"),
            "devolucion.eliminado" => 0
        );
        $this->db->where($where1);
        $this->db->select("devolucion.id,"
                . "devolucion.fecha,"
                . "producto.nombre AS producto_nombre,"
                . "producto.precio AS producto_precio,"
                . "producto.costo AS producto_costo");

        $this->db->join("producto", "producto.id = devolucion.producto_id");

        $reporte['devoluciones'] = $this->db->get("devolucion")->result();
        /*
         * Ingresos especiales
         */
        $where = array(
            "ingreso_especial.eliminado" => "0",
            "sede.id" => $this->session->userdata("sede_id")
        );
        $this->db->where($where);
        $this->db->where('fecha BETWEEN "' . $inicio . '" AND "' . $final . '"');
        $this->db->select("ingreso_especial.id,"
                . "ingreso_especial.cantidad,"
                . "ingreso_especial.descripcion,"
                . "ingreso_especial.fecha,"
                . "sede.id AS sede_id");
        $this->db->join("sede", "sede.id = ingreso_especial.sede_id");
        //return $this->db->get("ingreso_especial")->result();

        $reporte['ingresos_especiales'] = $this->db->get("ingreso_especial")->result();
        /*
         * Hasta aqui
         */
        return $reporte;
    }

}
