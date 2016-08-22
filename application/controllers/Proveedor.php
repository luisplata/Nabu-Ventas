<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Provedor
 *
 * @author Luiis Plata
 */
class Proveedor extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();

        $this->load->model("Proveedor_model", "proveedor");
    }

    public function index() {
        $datos = array(
            "izq" => "izq",
            "der" => "proveedores",
            "proveedores" => $this->proveedor->ListarTodo()
        );
        $this->load->view("factura", $datos);
    }

    public function GetOne($id) {
        echo json_encode($this->proveedor->ListarUno($id)[0]);
    }

    public function Guardar() {
        $proveedor = array(
            "nombre" => $this->input->post("nombre"),
            "descripcion" => $this->input->post("descripcion"),
            "nit" => $this->input->post("nit"),
            "sede_id" => $this->session->userdata("sede_id")
        );
        if ($this->proveedor->guardar($proveedor)) {
            redirect("proveedor/?mensaje=Se Guardo el provedor con exito&tipo=success");
        } else {
            redirect("proveedor/?mensaje=No se Guardo el provedor con exito&tipo=error");
        }
    }

    public function Eliminar($id) {
        if ($this->proveedor->Eliminar($id)) {
            $this->configuracion_model->log("Se elimino el proveedor " . $id);
            redirect("proveedor/?mensaje=Se elimino el proveedor con exito&tipo=success");
        } else {
            $this->configuracion_model->log("No se elimino el proveedor " . $id, "error");
            redirect("productos/?mensaje=No se elimino el proveedor&tipo=error");
        }
    }

    public function Modificar() {
        $proveedor = array(
            "nombre" => $this->input->post("nombre"),
            "descripcion" => $this->input->post("descripcion"),
            "nit" => $this->input->post("nit")
        );
        if ($this->proveedor->Modificar($proveedor, $this->input->post("id"))) {
            redirect("proveedor/?mensaje=Se Modificó el proveedor con exito&tipo=success");
        } else {
            redirect("proveedor/?mensaje=No se Modificó el proveedor con exito&tipo=error");
        }
    }

}
