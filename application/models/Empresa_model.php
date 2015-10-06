<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Empresa_model extends CI_Model {

    function __construct() {
        parent::__construct();
//        $this->output->enable_profiler(TRUE);
    }

    public function listarTodo() {
        $where = array(
            "eliminado" => "0"
        );
        $this->db->where($where);
        $this->db->select();
        $empresas = $this->db->get("empresa")->result();
        return $empresas;
    }

    public function guardar($empresa) {

        //insertar a la persona
        if ($this->db->insert("empresa", $empresa)) {
            //id de la empresa
            $empresa_id = $this->db->insert_id();
            $this->configuracion_model->logInterno("Se creo la empresa " . $empresa_id);
            //le creamos un usuario con valor de 10 para que entre al sistema
            //sacamos los datos de la empresa ya insertados para su manejo
            //hacemos el array de la persona de la empresa para su insercion
            $persona = array(
                "nombre" => $empresa['nombre'],
                "apellido" => "Principal",
                "documento" => $empresa['nit'],
                "direccion" => $empresa['direccion'],
                "email" => $empresa['email'],
                "telefono" => $empresa['telefono']
            );
            //hacemos el array de la sede con los datos de la empresa
            $sede = array(
                "nombre" => $empresa['nombre'],
                "direccion" => $empresa['direccion'],
                "telefono" => $empresa['telefono'],
                "email" => $empresa['email'],
                "empresa_id" => $empresa_id
            );

            //insertamos a la persona-empresa
            if ($this->db->insert("persona", $persona)) {
                $persona_id = $this->db->insert_id();
                $this->configuracion_model->logInterno("Se creo la persona " . $persona_id);
            } else {
                return FALSE;
            }
            //insertamos a la sede
            if ($this->db->insert("sede", $sede)) {
                $sede_id = $this->db->insert_id();
                $this->configuracion_model->logInterno("Se creo una sede " . $sede_id);
            } else {
                return FALSE;
            }




            //sacamos la id de la persona-empresa para agregar el usuario
            //creamos el usuario para la insercion
            $usuario = array(
                "user" => $empresa['email'],
                "pass" => sha1($empresa['nit']),
                "persona_id" => $persona_id,
                "grado" => "3",
                "valor" => "10",
                "empresa_id" => $empresa_id,
                "sede_id" => $sede_id
            );


            //lo insertamos

            if ($this->db->insert("usuario", $usuario)) {
                $this->configuracion_model->logInterno("Se crea e usuario " . $this->db->insert_id());
                //Creamos los archivos de configuracion
                $configuracion = array(
                    "empresa_id" => $empresa_id
                );
            } else {
                return FALSE;
            }
            //insertamos los datos de la configuracion
            if ($this->db->insert("configuracion", $configuracion)) {
                $this->configuracion_model->logInterno("Se crea configuracion " . $this->db->insert_id());

                /* creamos las categorias Default de la empresa en categoria y egresos_categoria */
                $categoria_default = array(
                    "nombre" => "Default",
                    "descripcion" => "Default",
                    "empresa_id" => $empresa_id
                );
                if ($this->db->insert("categoria", $categoria_default)) {
                    $this->configuracion_model->logInterno("Se creo la categoria default " . $usuario['user']);
                    if ($this->db->insert("categoria_egreso", $categoria_default)) {
                        $this->configuracion_model->logInterno("Se creo la categoria_egreso default " . $usuario['user']);
                    }
                }


                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function modificar($empresa) {

//        $this->db->where("id", $id);
//        $this->db->update("usuario", "eliminado = 1");
        redirect("index.php/usuarios/");
    }

    public function eliminar($id) {
        $datos = array(
            "eliminado" => "1"
        );
        $this->db->where("id", $id);
        if ($this->db->update("empresa", $datos)) {
            $this->configuracion_model->logInterno("Eliminaron el usuario " . $id);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function desactivar($id) {
        $datos = array(
            "activo" => "0"
        );
        $this->db->where("id", $id);
        if ($this->db->update("empresa", $datos)) {
            $this->configuracion_model->logInterno("Se desactivo la empresa " . $id);
            return TRUE;
        } else {
            $this->configuracion_model->logInterno("No se desactivo la empresa " . $id);
            return FALSE;
        }
    }

    public function activar($id) {
        $datos = array(
            "activo" => "1"
        );
        $this->db->where("id", $id);
        if ($this->db->update("empresa", $datos)) {
            $this->configuracion_model->logInterno("Se activo la empresa " . $id);
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
