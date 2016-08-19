<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Facturacion extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        $this->load->model("factura_model", "factura");
    }

    public function inicio() {
        $datos = array(
            "izq" => "izq",
            "der" => "facturas_v",
            "facturas" => $this->factura->listarTodasFacturas()
        );
        $this->load->view("factura", $datos);
    }

    public function verFactura($facturaNum = 0) {
        $datos = array(
            "izq" => "izq",
            "der" => "verFactura",
            "factura" => $this->factura->listaFactura($facturaNum),
        );
        $this->load->view("factura", $datos);
    }

    public function nuevaFactura() {
        $datos = array(
            "izq" => "izq",
            "der" => "facturadora"
        );
        $this->load->view("factura", $datos);
    }

    //funcion donde se hace todo el manejo de los productos para mostrarlo en la factura
    public function generarFactura() {
        $credito = FALSE;
        $productos["codigo"] = $this->input->post("codigo");
        $productos["nombre"] = $this->input->post("nombre");
        $productos["precio"] = $this->input->post("precio");
        $productos["id"] = $this->input->post("id");
        //agarramos el cliente que lleno los campos de efectivo
        $cliente_efectivo = array(
            "documento" => $this->input->post("documento_efectivo"),
            "nombre" => $this->input->post("nombre_efectivo")
        );
        //agarramos el cliente que es por credito
        $cliente_credito = array(
            "documento" => $this->input->post("documento_credito"),
            "nombre" => $this->input->post("nombre_credito")
        );
        //validamos cual de los dos tipos de cliente es: en efectivo o credito
        $a = $this->input->post("documento_credito");
        //validar si hay datos
        if (empty($productos['codigo'])) {
            redirect("facturas/nuevaFactura");
        }
        if (empty($a)) {
            //es en efectivo
            $cliente = $cliente_efectivo;
            //buscamos al cliente X con su numero de cedula
            $where = array(
                "documento" => $cliente['documento']
            );
            $this->db->where($where);
            $clientes = $this->db->get("cliente_x");
            if ($clientes->num_rows() > 0) {
                foreach ($clientes->result() as $value) {
                    $cliente_id = $value->id;
                    $cliente['nombre'] = $value->nombre;
                    $cliente['documento'] = $value->documento;
                }
            } else {
                $this->db->insert("cliente_x", $cliente);
                $cliente_id = $this->db->insert_id();
            }
            $credito = FALSE;
        } else {
            $cliente = $cliente_credito;

            //buscamos al cliente con su numero de cedula
            $where = array(
                "documento" => $cliente['documento']
            );
            $this->db->where($where);
            $clientes = $this->db->get("cliente")->result();
            foreach ($clientes as $value) {
                $cliente_id = $value->id;
                $cliente['nombre'] = $value->nombre;
            }
            //Ahora se guarda el cliente X o se suma la deuda al cliente
            //se suma el dato a su credito hacer la prueba si el cliente no tiene credito con esta empresa?
            $query = "UPDATE credito SET credito = (credito - " . $this->input->post("totalDeTodo") . ") WHERE cliente_id = " . $cliente_id;
            $resultado = $this->db->simple_query($query);
            if ($resultado) {
                $credito = TRUE;
            }
        }



        //armando el arreglo de los productos
        $productosTotal = array();
        $producto = array();
        foreach ($productos['codigo'] as $value) {
            $producto['codigo'][] = $value;
        }
        foreach ($productos['nombre'] as $value) {
            $producto['nombre'][] = $value;
        }
        foreach ($productos['precio'] as $value) {
            $producto['precio'][] = $value;
        }
        foreach ($productos['id'] as $value) {
            $producto['id'][] = $value;
        }


        for ($i = 0; $i < count($producto['codigo']); $i++) {
            $productosTotal[] = array(
                "codigo" => $producto['codigo'][$i],
                "nombre" => $producto['nombre'][$i],
                "precio" => $producto['precio'][$i],
                "id" => $producto['id'][$i]
            );
        }
        if ($this->factura->guardar($productosTotal, $cliente_id, $credito)) {
            $this->configuracion_model->log("Se genero la factura con exito!");
            if ($credito) {
                $datos = array(
                    "productos" => $productosTotal,
                    "totalDeTodo" => $this->input->post("totalDeTodo"),
                    "cliente" => $cliente,
                    "facturaNumero" => $this->factura->ultimoNumero(),
                    "credito" => "true"
                );
            } else {
                $datos = array(
                    "productos" => $productosTotal,
                    "totalDeTodo" => $this->input->post("totalDeTodo"),
                    "cliente" => $cliente,
                    "facturaNumero" => $this->factura->ultimoNumero(),
                    "credito" => "false"
                );
            }



            if ($this->configuracion_model->imprimir() == 1) {
                $this->load->view("plantilla_1", $datos);
            } else {
                redirect("facturacion/nuevaFactura");
            }
        } else {
            $this->configuracion_model->log("No se genero la factura, Paso algo!", "error");
            redirect("inicios/inicio");
        }
    }

    public function reporteDeCaja() {
        $datos = array(
            "izq" => "izq",
            "der" => "reporteDeCaja"
        );
        $this->load->view("factura", $datos);
    }

    public function crearReporte() {
        /* Esto es lo que se hara aqui:
         * se buscaran todas las facturas realizadas en esa fecha
         * se organizaran, para tener el total de cada factura, y sumarla
         * se tendra tambien los datos de gasto - costo para tener tambien la ganancia
         */
        $datos = $this->factura->listarFacturas($this->input->post("fecha"));
        $this->load->view("reporte", $datos);
    }

    public function crearReporteFechas() {
        /* Esto es lo que se hara aqui:
         * se buscaran todas las facturas realizadas en esa fecha
         * se organizaran, para tener el total de cada factura, y sumarla
         * se tendra tambien los datos de gasto - costo para tener tambien la ganancia
         */
        $datos = $this->factura->listarFacturasFechas($this->input->post("fechaInicio"), $this->input->post("fechaFinal"));
        $this->load->view("reporte", $datos);
    }

    public function reporteDeCajaFechas() {
        $datos = array(
            "izq" => "izq",
            "der" => "reporteDeCajaFechas"
        );
        $this->load->view("factura", $datos);
    }

}
