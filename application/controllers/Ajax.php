<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Ajax extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $id = $this->input->post("id");
        $where = array(
            "eliminado" => "0",
            "codigo" => $id,
            "cantidad >" => "0",
            "empresa_id"=>$this->session->userdata("empresa_id"),
            "sede_id"=>$this->session->userdata("sede_id")
        );
        $this->db->where($where);
        $producto = $this->db->get("producto")->result();

        
        foreach ($producto as $value) {            
            echo "<tr>";
            echo "<td>" .
            $value->codigo
            . "</td>";
            echo "<td>" .
            $value->nombre
            . "</td>";
            echo "<td id='" . $value->codigo . "'>" .
            $value->precio .
            "<input type='hidden' name='codigo[]' value='" . $value->codigo . "' />" .
            "<input type='hidden' name='nombre[]' value='" . $value->nombre . "' />" .
            "<input type='hidden' name='precio[]' id='precioProducto[]' value='" . $value->precio . "' />" .
            "<input type='hidden' name='id[]'  value='" . $value->id . "' />" .
            "</td>";
            echo "</tr>";
        }
    }

    public function producto() {
        $datos = array("mensajes" => "Hola soy json", "error" => false, "dato" => $_REQUEST['dato']);        
        echo json_encode($datos);
    }

    public function mandarCorreo() {
        $para = "www.luisplata@gmail.com";
        $asunto = $this->input->post("asunto");
        $mensaje = $this->input->post("mensaje");
        //if (mail($para, $asunto, $mensaje)) {
        if (mail("www.luisplata@gmail.com", "Aqui probando", "Hola Mundo!")) {            
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function identificarCliente() {        
        //active record
        $this->db->like("documento",$this->input->post("documento"));
        $consulta = $this->db->get("cliente")->result();
        
            foreach ($consulta as $value) {                
            echo '<input form="facturadoraPrincipal" type="text" readonly '
                . 'value="'.$value->nombre.'" name="nombre_credito" class="form-control"/>';    
            echo '<input form="facturadoraPrincipal" type="hidden" readonly '
            . 'value="'.$value->documento.'" name="documento_credito" class="form-control"/>';    
        
            
        }
    }

}
