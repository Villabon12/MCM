<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_landing extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function cargarContenido($id)
    {
        $this->db->select('*');
        $this->db->where('usuario_id', $id);
        $resultados = $this->db->get('landingxuser');

        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }
    }

    public function insertarContenido($data)
    {
        $this->db->insert('landingxuser',$data);
    }

    public function actualizarContenido($data,$id)
    {
        $this->db->where('usuario_id',$id);
        $this->db->update('landingxuser',$data);
    }

    public function insertarUsuario($data)
    {
        $this->db->insert('eventos_principal',$data);
    }
}
