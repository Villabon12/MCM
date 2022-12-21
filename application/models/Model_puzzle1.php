<?php
defined('BASEPATH') or exit('No direct script access allowed');
class model_puzzle1 extends CI_Model

{
    function __construct()
    {
        parent::__construct();
    }

    public function cargar_puzzle()
    {
        $this->db->select('*');
        $resultado = $this->db->get('puzzle_fichas');
        return $resultado->result();
    }

    public function cargar_tipo()
    {
        $this->db->select('*');
        $resultado = $this->db->get('tipo_puzzle');
        return $resultado->result();
    }

    public function cargarP($id)
    {
        $this->db->where('id', $id);
        $this->db->select('*');
        $resultado = $this->db->get('puzzle_fichas');
        return $resultado->row();
    }

    public function cargarT($id)
    {
        $this->db->where('id', $id);
        $this->db->select('*');
        $resultado = $this->db->get('tipo_puzzle');
        return $resultado->row();
    }

    public function traer_parametro($id)
    {
        $this->db->where('id', $id);
        $this->db->select('*');
        $resultado = $this->db->get('parametro_puzzle');
        return $resultado->row();
    }

    public function comprar_puzzle($data)
    {
        $this->db->insert('creacion_puzzle', $data);
    }

    public function acumulado()
    {
        $this->db->select("*");
        $this->db->from("acumulado_puzzle");
        $this->db->order_by("id", "desc");
        $resultados = $this->db->get();
        return $resultados->row();
    }

    public function insert_acumulado($data)
    {
        $this->db->insert('acumulado_puzzle', $data);
    }

    public function insert_historial($data)
    {
        $this->db->insert('historial_compra_puzzle', $data);
    }

    public function comprobar($valor)
    {
        $this->db->where('codigo', $valor);
        $this->db->select('*');
        $resultado = $this->db->get('creacion_puzzle');

        return $resultado->row();
    }

    public function actualizar($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('creacion_puzzle', $data);
    }

    public function consultar($id,$puzzle)
    {
        $this->db->where('usuario_id', $id);
        $this->db->where('puzzle_id', $puzzle);
        $this->db->select('*');
        $resultado = $this->db->get('historial_compra_puzzle');

        if ($resultado->num_rows() > 0) {
            return $resultado->row();
        } else {
            return false;
        }
    }
    public function consultar_p($puzzle)
    {
        $this->db->where('puzzle_id', $puzzle);
        $this->db->select('*');
        $resultado = $this->db->get('historial_compra_puzzle');

        if ($resultado->num_rows() > 0) {
            return $resultado->row();
        } else {
            return false;
        }
    }


    public function actualizarUser($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('historial_compra_puzzle',$data);
    }

    public function consultar_puzzle()
    {
        $this->db->where('asignado',0);
        $this->db->select('*');
        $resultado = $this->db->get('creacion_puzzle');

        if ($resultado->num_rows() > 0) {
            return $resultado->result();
        } else {
            return false;
        }
    }

    public function updateCreacion($id, $data)
    {
        $this->db->where('id',$id);
        $this->db->update('creacion_puzzle',$data);
    }

    public function domicilio()
    {
        $this->db->select('*');
        $resultado = $this->db->get('domicilio_puzzle');
        return $resultado->result();
    }

    public function cargar_puzzle_todos()
    {
        $this->db->select('c.*, t.nombre as tipo');
        $this->db->from('creacion_puzzle c');
        $this->db->join('tipo_puzzle t','t.id = c.tipo_puzzle');
        $resultado = $this->db->get('');

        return $resultado->result();
    }

    public function compra()
    {
        $this->db->select('c.*, u.nombre, u.apellido1, p.codigo, d.nombre as domicilio, e.estadonombre');
        $this->db->from('historial_compra_puzzle c');
        $this->db->join('r_master_usuarios u','u.id = c.usuario_id');
        $this->db->join('creacion_puzzle p','p.id = c.puzzle_id');
        $this->db->join('domicilio_puzzle d','d.id = c.domicilio_id');
        $this->db->join('estado e','e.id = c.municipio_id');
        $resultado = $this->db->get('');

        return $resultado->result();
    }
}
