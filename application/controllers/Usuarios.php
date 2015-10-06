<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Usuarios extends CI_Controller {

    function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
        $this->load->model("usuario_model", "usuario");
    }

    public function inicio() {
        $datos = array(
            "izq" => "izq",
            "der" => "usuarios_v",
            "usuarios" => $this->usuario->listarTodo()
        );
        $this->load->view("factura", $datos);
    }

    public function nuevoUsuario() {
        $datos = array(
            "izq" => "izq",
            "der" => "nuevoUsuario"
        );
        $this->load->view("factura", $datos);
    }

    public function nuevoUsuarioRegistrado() {

        $persona = array(
            "nombre" => $this->input->post("nombre"),
            "apellido" => $this->input->post("apellido"),
            "documento" => $this->input->post("documento"),
            "direccion" => $this->input->post("direccion"),
            "email" => $this->input->post("email"),
            "telefono" => $this->input->post("telefono")
        );
        $usuario = array(
            "user" => $this->input->post("email"),
            "pass" => sha1($this->input->post("documento")),
            "grado" => $this->input->post("grado"),
            "valor" => $this->input->post("valor"),
            "empresa_id" => $this->session->userdata("empresa_id"),
            "sede_id" => $this->session->userdata("sede_id")
        );
        if ($usuario['grado'] >= 4) {
            if ($this->session->userdata("grado") == 4) {
                if ($this->usuario->guardar($persona, $usuario)) {
                    $this->configuracion_model->log("Se guardo el usuario " . $persona['documento']);
                    redirect("usuarios/inicio");
                } else {
                    $this->configuracion_model->log("No se guardo el usuario " . $persona['documento'], "error");
                    redirect("usuarios/nuevousuario");
                }
            } else {
                $this->configuracion_model->log("No tienes los permisos suficientes!", "warning");
                redirect("login_c/cerrarsession");
            }
        }
        //para los administradores
        if ($usuario['grado'] <= 3) {
            if ($this->session->userdata("grado") >= 3) {
                if ($this->usuario->guardar($persona, $usuario)) {
                    $this->configuracion_model->log("Se guardo el usuario " . $usuario['documento']);
                    redirect("usuarios/inicio");
                } else {
                    $this->configuracion_model->log("No se guardo el usuario " . $usuario['documento'], "error");
                    redirect("usuarios/nuevousuario");
                }
            } else {
                $this->configuracion_model->log("No tienes los permisos sufucientes!", "warning");
                redirect("inicios/inicio");
                //redirect("index.php/login_c/cerrarsession");
            }
        }
        redirect("inicios/inicio");
    }

    public function eliminar($id) {
        $this->usuario->eliminar($id);
        $this->configuracion_model->log("Se elimino el usuario " . $id);
        redirect("usuarios/inicio");
    }

    public function cambiarPass() {
        $datos = array(
            "izq" => "izq",
            "der" => "cambiarPass"
        );
        $this->load->view("factura", $datos);
    }

    public function cambiarPassL() {
        if ($this->usuario->cambiarPass($this->input->post("passV"), $this->input->post("passN"))) {
            $this->configuracion_model->log("Se cambio la contraseña con exito!");
            redirect("inicios/inicio");
        } else {
            $this->configuracion_model->log("No se cambio la contraseña! te equivocaste en la contraseña vieja!", "warning");
            redirect("usuarios/cambiarPass");
        }
    }

    public function olvidoPass() {

        $this->load->view("olvidoPass");
    }

    public function olvidoPassL() {
        $email = $this->input->post("email");
        if ($this->usuario->olvidoPass($email)) {
            //cambio la contraseña y envio el correo
            redirect("");
        } else {
            //no cambio la contraseña y no envio el correo
            redirect("no cambio la contraseña");
        }
    }

}
