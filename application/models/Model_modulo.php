<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_modulo extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function cargar()
    {
        $this->db->order_by('fecha_creacion','DESC');
        $resultado = $this->db->get('modulo');

        return $resultado->result();
    }

    public function cargar_libro()
    {
        $this->db->order_by('fecha_creacion','DESC');
        $resultado = $this->db->get('libros');

        return $resultado->result();
    }

    public function cargar_detalle()
    {
        $this->db->select('m.titulo as titulo1, mi.*');
        $this->db->from('detalle_modulo mi');
        $this->db->join('modulo m','mi.modulo_id = m.id');
        $resultado = $this->db->get('');

        return $resultado->result();
    }

    public function detalle_modulo($id)
    {
        $this->db->select('m.titulo as titulo1, mi.*');
        $this->db->from('detalle_modulo mi');
        $this->db->join('modulo m','mi.modulo_id = m.id');
        $this->db->where('mi.modulo_id',$id);
        $resultado = $this->db->get('');

        return $resultado->result();
    }

    public function muestra_modulo($id)
    {
        $this->db->where('id',$id);
        $resultado = $this->db->get('detalle_modulo');

        return $resultado->row();
    }

    public function crear_modulo($data)
    {
        $this->db->insert('modulo',$data);
    }

    public function crear_libro($data)
    {
        $this->db->insert('libros',$data);
    }

    public function crear_detalle($data)
    {
        $this->db->insert('detalle_modulo',$data);
    }
    
    public function update_detalle($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('detalle_modulo',$data);
    }

    public function update_libro($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('libros',$data);
    }
}
