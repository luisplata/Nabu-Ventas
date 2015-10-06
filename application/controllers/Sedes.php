<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class sedes extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("sede_model", "sede");
    }

    public function inicio() {
        $datos = array(
            "izq" => "izq",
            "der" => "sede_v",
            "sedes" => $this->sede->listarTodo()
        );
        $this->load->view("factura", $datos);
    }

    public function nuevaSede() {
        $this->load->model("empresa_model", "empresa");
        $datos = array(
            "izq" => "izq",
            "der" => "nuevaSede",
            "empresas" => $this->empresa->listarTodo()
        );
        $this->load->view("factura", $datos);
    }

    public function guardar() {
        $sede = array(
            "nombre" => $this->input->post("nombre"),
            "direccion" => $this->input->post("direccion"),
            "telefono" => $this->input->post("telefono"),
            "email" => $this->input->post("email"),
            "empresa_id" => $this->input->post("empresa_id")
        );
        if ($this->sede->guardar($sede)) {
            $this->configuracion_model->log("Se guardo la nueva sede " . $sede['nombre']);
            $sede_id = $this->db->insert_id();
            /* creamos el usuario de esta sede
             * para eso creamos a la persona y despues al usuario
             * obteniendo la id de esta insercion para usarla
             */
            $persona = array(
                "nombre" => "Sede",
                "apellido" => $sede['nombre'],
                "documento" => $sede['telefono'],
                "direccion" => $sede['direccion'],
                "email" => $sede['email'],
                "telefono" => $sede['telefono'],
            );
            $usuario = array(
                "user" => $sede['email'],
                "pass" => sha1($sede['telefono']),
                "grado" => "3",
                "valor" => "0",
                "empresa_id" => $this->session->userdata("empresa_id"),
                "sede_id" => $sede_id
            );
            $this->load->model("usuario_model", "usuario");
            $this->usuario->guardar($persona, $usuario);
            $this->configuracion_model->log("Se guardo la sede y se creo el usuario. Por defecto es email y telefono!");
            redirect("sedes/inicio");
        } else {
            $this->configuracion_model->log("No se guardo la sede " . $sede['nombre'], "error");
            redirect("sedes/nuevaSede");
        }
    }

    public function desactivar($id) {
        if ($this->sede->desactivar($id)) {
            $this->configuracion_model->log("Se desactivo la sede " . $id);
        } else {
            $this->configuracion_model->log("No se desactivo la sede " . $id, "warning");
        }
        redirect("sedes/inicio");
    }

    public function activar($id) {
        if ($this->sede->activar($id)) {
            $this->configuracion_model->log("Se activo la sede " . $id);
        } else {
            $this->configuracion_model->log("No se activo la sede " . $id, "warning");
        }
        redirect("sedes/inicio");
    }

    public function eliminar() {
        
    }

}
