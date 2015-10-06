<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login_c extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("Usuario_model", "usuario");
        //$this->output->enable_profiler(TRUE);
    }

    public function index() {
        $this->load->view("login");
    }

    public function login() {
        $usuario = array(
            "usuario.user" => $this->input->post("user"),
            "usuario.pass" => sha1($this->input->post("pass"))
        );
        if ($this->usuario->esta($usuario)) {
            $this->configuracion_model->log("ha sido identificado correctamente " . $this->session->userdata("usuario_id") . " " . $this->session->userdata("nombre") . " " . $this->session->userdata("apellido"));
            redirect("inicios/inicio");
        } else {
            //$this->configuracion_model->log("No fuiste identificado puede que no estes o colocaste mal usuario/contraseña", "error");
            redirect("login_c/index/noesta");
        }
    }

    public function cerrarsession() {
        $this->configuracion_model->log("Cerro session " . $this->session->userdata("usuario_id"));
        $this->session->sess_destroy();
        redirect("index.php/");
    }

    public function mandarCorreo() {
        $this->load->library('email');

        $this->email->from($this->input->post("de"));
        //array de correos
        $correo = array(
            "www.luisplata@gmail.com",
            "nabu-facturadora@upgradec.com"
        );
        $this->email->to($correo);
        $this->email->subject($this->input->post("asunto"));
        $this->email->message($this->input->post("mensaje"));

        if ($this->email->send()) {
            $this->configuracion_model->log("Se mando correo");
            redirect("login_c/index/mandoCorreo");
        } else {
            $this->configuracion_model->log("No se mando correo", "error");
            redirect("login_c/index/NoMandoCorreo");
        }
    }

}
