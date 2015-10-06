<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Usuario_model extends CI_Model {

    function __construct() {
        parent::__construct();
//        $this->output->enable_profiler(TRUE);
    }

    public function esta($usuario) {
        $usuario["usuario.eliminado"] = "0";
        $usuario["empresa.activo"] = "1";
        $this->db->where($usuario);
        $this->db->select("empresa.id as empresa_id, usuario.id AS usuario_id,"
                . "usuario.persona_id, usuario.grado, usuario.valor,"
                . "persona.nombre AS persona_nombre,"
                . "persona.apellido AS persona_apellido,"
                . "sede.id AS sede_id");
        $this->db->join("empresa", "empresa.id = usuario.empresa_id");
        $this->db->join("persona", "persona.id = usuario.persona_id");
        $this->db->join("sede", "sede.id = usuario.sede_id");
        $usuarios = $this->db->get("usuario")->result();
        
        if ($usuarios) {
            
            foreach ($usuarios as $value) {
                $this->session->set_userdata("usuario_id", $value->usuario_id);
                $this->session->set_userdata("empresa_id", $value->empresa_id);
                $this->session->set_userdata("persona_id", $value->persona_id);
                $this->session->set_userdata("sede_id", $value->sede_id);
                $this->session->set_userdata("persona_nombre", $value->persona_nombre);
                $this->session->set_userdata("persona_apellido", $value->persona_apellido);
                $this->session->set_userdata("grado", $value->grado);
                $this->session->set_userdata("valor", $value->valor);
            }
            $this->configuracion_model->logInterno("existe y si son los datos correctos del login ".$usuario['usuario.user']);
            //sacando los datos de configuracion
            $configuracion["configuracion.eliminado"] = "0";
            $configuracion["empresa.activo"] = "1";
            $configuracion['empresa.id'] = $this->session->userdata("empresa_id");
            $this->db->where($configuracion);
            $this->db->select("configuracion.facturaNumero, "
                    . "configuracion.imprimir,"
                    . "configuracion.descuento,"
                    . "configuracion.pedir_nombre,"
                    . "configuracion.logo_url,"
                    . "empresa.nombre AS empresa_nombre,"
                    . "empresa.direccion AS empresa_direccion,"
                    . "empresa.telefono AS empresa_telefono");
            $this->db->join("empresa", "empresa.id = configuracion.empresa_id");
            $configuraciones = $this->db->get("configuracion")->result();
            if ($configuraciones) {
                $this->configuracion_model->logInterno("Se cargaron los datos de confguracion de la empresa ".$configuracion['empresa.id']);
                foreach ($configuraciones as $datos) {
                    //$this->session->set_userdata("facturaNumero", $datos->facturaNumero);
                    $this->session->set_userdata("imprimir", $datos->imprimir);
                    $this->session->set_userdata("descuento", $datos->descuento);
                    $this->session->set_userdata("pedir_nombre", $datos->pedir_nombre);
                    $this->session->set_userdata("logo_url", $datos->logo_url);
                    $this->session->set_userdata("empresa_nombre", $datos->empresa_nombre);
                    $this->session->set_userdata("empresa_direccion", $datos->empresa_direccion);
                    $this->session->set_userdata("empresa_telefono", $datos->empresa_telefono);
                }
            }
            //hasta aqui
            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function listarTodo() {
        $where = array(
            "usuario.eliminado" => "0",
            "empresa.activo" => "1",
            "empresa.id" => $this->session->userdata("empresa_id")
        );
        $this->db->where($where);
        $this->db->select(
                "usuario.id AS usuario_id, "
                . "usuario.grado, "
                . "usuario.valor, "
                . "empresa.id AS empresa_id, "
                . "empresa.nombre as empresa,"
                . "persona.id AS persona_id, "
                . "persona.nombre as nombre_persona,"
                . "persona.apellido AS apellido_persona, "
                . "persona.documento,"
                . "persona.direccion, persona.email, "
                . "persona.telefono");
        $this->db->join("empresa", "empresa.id = usuario.empresa_id");
        $this->db->join("persona", "persona.id = usuario.persona_id");
        $usuarios = $this->db->get("usuario")->result();
        return $usuarios;
    }

    public function listarUnoEnSession() {
        $where = array(
            "usuario.eliminado" => "0",
            "empresa.activo" => "1",
            "empresa.id" => $this->session->userdata("empresa_id"),
            "usuario.id" => $this->session->userdata("usuario_id")
        );
        $this->db->where($where);
        $this->db->select(
                "usuario.id AS usuario_id, "
                . "usuario.grado, "
                . "usuario.valor, "
                . "usuario.user, "
                . "usuario.pass, "
                . "empresa.id AS empresa_id, "
                . "empresa.nombre as empresa,"
                . "persona.id AS persona_id, "
                . "persona.nombre as nombre_persona,"
                . "persona.apellido AS apellido_persona, "
                . "persona.documento,"
                . "persona.direccion, persona.email, "
                . "persona.telefono");
        $this->db->join("empresa", "empresa.id = usuario.empresa_id");
        $this->db->join("persona", "persona.id = usuario.persona_id");
        $usuarios = $this->db->get("usuario")->result();
        return $usuarios;
    }

    public function listarUnoEnEmail($email) {
        $where = array(
            "usuario.eliminado" => "0",
            "persona.eliminado" => "0",
            "persona.email" => $email
        );
        $this->db->where($where);
        $this->db->select(
                "usuario.id AS usuario_id, "
                . "usuario.grado, "
                . "usuario.valor, "
                . "usuario.user, "
                . "usuario.pass, "
                . "empresa.id AS empresa_id, "
                . "empresa.nombre as empresa,"
                . "persona.id AS persona_id, "
                . "persona.nombre as nombre_persona,"
                . "persona.apellido AS apellido_persona, "
                . "persona.documento,"
                . "persona.direccion, persona.email, "
                . "persona.telefono");
        $this->db->join("empresa", "empresa.id = usuario.empresa_id");
        $this->db->join("persona", "persona.id = usuario.persona_id");
        $usuarios = $this->db->get("usuario")->result();
        return $usuarios;
    }

    public function guardar($perona, $usuario) {
        //insertar a la persona
        if ($this->db->insert("persona", $perona)) {
            $usuario['persona_id'] = $this->db->insert_id();
            //insertar al usuario
            if ($this->db->insert("usuario", $usuario)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function modificar($id) {
        /*
          $this->db->where("id", $id);
          $this->db->update("usuario", "eliminado = 1");
          redirect("index.php/usuarios/");
         */
    }

    public function eliminar($id) {
        $datos = array(
            "eliminado" => "1"
        );
        $this->db->where("id", $id);
        if ($this->db->update("usuario", $datos)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function cambiarPass($passV, $passN) {
        /* Buscamos el usuario con la id en session que es el que quiere cambiar de contraseña
         * despues comparamos la contraseña vieja
         * si es igual de dejamos cambiar la contraseña
         */

        foreach ($this->listarUnoEnSession() as $value) {
            $usuario = $value;
        }
        echo $usuario->pass;
        echo '<br/>';
        echo sha1($passV);
        echo '<br/>';
        if ($usuario->pass == sha1($passV)) {
            echo 'son iguales';
            //significa que son la misma
            //preparamos el array para el cambio de la contraseña
            $where = array(
                "id" => $this->session->userdata("usuario_id")
            );
            $this->db->where($where);
            $set = array(
                "pass" => sha1($passN)
            );
            if ($this->db->update("usuario", $set)) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function olvidoPass($email) {
        /* lo que hara el scrip
         * buscara a la persona del correo
         * Se creara la contraseña nueva
         * buscara el usuario relacionado a esa persona
         * cambiara en la base de datos la contraseña nueva
         * mandara una nueva contraseña por correo con el usuario y contraseña         
         */

        $this->load->library("email");
        //Tenemos a la persona y a su usuario
        $usuario = $this->listarUnoEnEmail($email);
        //print_r($usuario);
        if ($usuario) {
            //return TRUE;
            //hay datos de usuario
            //creando la contraseña nueva
            $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
            $desordenada = str_shuffle($caracteres);
            $password = substr($desordenada, 1, 10);

            //sacando los datos necesarios para crear el mensaje
            foreach ($usuario as $value) {
                $email2 = $value->email;
                $user = $value->user;
                $usuario_id = $value->usuario_id;
            }

            //ahora se cambia la contraseña en la base de datos
            $where = array(
                "id" => $usuario_id
            );
            $this->db->where($where);
            $set = array(
                "pass" => sha1($password)
            );
            if ($this->db->update("usuario", $set)) {
                //ya se cambio la contraseña
                //crearndo el mensaje
                $mensaje = "Hola, usted ah restaurado su contraseña \n"
                        . "Su usuario es: " . $user . " \n"
                        . "Su contraseña nueva es: " . $password;

                //mandamos correo                

                $this->email->from('ventas@nabu.com.co', 'Administrador');
                $this->email->to($email);
                $this->email->subject('Restauracion de Contraseña');
                $this->email->message($mensaje);
//                if ($this->email->send()) {
//                    return TRUE;
//                } else {
//                    return FALSE;
//                }
                //mandando correo con PHP
                $para = $email2;
                $asunto = "Restauracion de Contraseña";
                $mensaje = $mensaje;
                //if (mail($para, $asunto, $mensaje)) {
                if (mail($para, $asunto, $mensaje)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
                //echo $this->email->print_debugger();
            } else {
                //no cambio la contraseña
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

}
