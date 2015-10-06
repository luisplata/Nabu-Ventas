<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class clientes extends CI_Controller {

    function __construct() {
        parent::__construct();
//$this->output->enable_profiler(TRUE);
        $this->load->model("cliente_model", "cliente");
    }

//listar los clientes
    public function inicio() {
        $datos = array(
            "izq" => "izq",
            "der" => "cliente_v",
            "clientes" => $this->cliente->listarTodo()
        );
        $this->load->view("factura", $datos);
    }

//ingresar nuevo cliente
    public function ingresar() {
        $datos = array(
            "izq" => "izq",
            "der" => "nuevoCliente"
        );
        $this->load->view("factura", $datos);
    }

    public function guardar() {
//Se busca si existe el cliente
//Si existe solo se crea el credito en la empresa
//si no, se crea el cliente y su credito
        $cliente = $this->cliente->existe($this->input->post("documento"), $this->input->post("telefono"), $this->input->post("email"));
//echo $this->cliente->existe($this->input->post("documento"), $this->input->post("telefono"), $this->input->post("email"));
        echo $cliente;
        if (is_numeric($cliente)) {
//solo creamos el credito con la empresa
            if ($this->cliente->crearCredito($cliente)) {
                redirect("clientes/inicio");
            }
        } else {
//se crea el cliente y su credito con la empresa

            $cliente = array(
                "nombre" => $this->input->post("nombre"),
                "documento" => $this->input->post("documento"),
                "telefono" => $this->input->post("telefono"),
                "direccion" => $this->input->post("direccion"),
                "email" => $this->input->post("email"),
                "codigo" => date("Ymd") . $this->input->post("documento") . $this->session->userdata("empresa_id")
            );
            if ($this->cliente->guardar($cliente)) {
                $this->configuracion_model->log("Ingreso el cliente " . $cliente['documento']);
                redirect("clientes/inicio");
            } else {
                $this->configuracion_model->log("No ingreso el cliente " . $cliente["documento"], "error");
                /*
                 * Vamos a buscar a este cliente con los datos suministrados y ver si ya existe
                 * Al momento de no poder guardar
                 */
                redirect("clientes/ingresar/NoSeIngreso");
            }
        }
        /**/
//        $cliente = array(
//            "nombre" => $this->input->post("nombre"),
//            "documento" => $this->input->post("documento"),
//            "telefono" => $this->input->post("telefono"),
//            "direccion" => $this->input->post("direccion"),
//            "email" => $this->input->post("email"),
//            "codigo" => date("Ymd") . $this->input->post("documento") . $this->session->userdata("empresa_id")
//        );
//        if (!is_numeric($this->cliente->existe($this->input->post("documento"), $this->input->post("telefono"), $this->input->post("email")))) {
//            //significa que esiste y no es necesario crearlo de nuevo, pero si crear la deuda cuando 
//            if ($this->cliante->crearCredito($this->cliente->existe($this->input->post("documento"), $this->input->post("telefono"), $this->input->post("email")))) {
//                redirect("clientes/inicio");
//            }
//        } else {
//            if ($this->cliente->guardar($cliente)) {
//                redirect("clientes/inicio");
//            } else {
//                /*
//                 * Vamos a buscar a este cliente con los datos suministrados y ver si ya existe
//                 * Al momento de no poder guardar
//                 */
//                redirect("clientes/ingresar/NoSeIngreso");
//            }
//        }
//        redirect("clientes/ingresar/NoSeIngreso");
    }

    public function codigo($codigo) {
        $where = array(
            "codigo" => $codigo
        );
        $this->db->where($where);
        $cliente = $this->db->get("cliente")->result();
        $datos = array(
            "izq" => "izq",
            "der" => "imprimirCodigoDeBarra",
            "producto" => $cliente
        );
        $this->load->view("factura", $datos);
    }

    public function credito($id) {
        $datos = array(
            "izq" => "izq",
            "der" => "credito_v",
            "credito" => $this->cliente->credito($id)
        );
        $this->load->view("factura", $datos);
    }

    public function pagar() {
        $where = array(
            "cliente_id" => $this->input->post("cliente_id"),
            "empresa_id" => $this->session->userdata("empresa_id")
        );
        $pago = array(
            "credito" => $this->input->post("credito") + $this->input->post("monto")
        );
        if ($this->cliente->pagar($pago, $where)) {
            $this->configuracion_model->log("Ingreso pago cliente " . $this->input->post("cliente_id"));
            redirect("clientes/inicio");
        } else {
            $this->configuracion_model->log("No Ingreso el pago del cliente " . $this->input->post("cliente_id"), "error");
            redirect("clientes/credito/" . $this->input->post("cliente_id") . "/NoSeHizoElPago");
        }
    }

}
