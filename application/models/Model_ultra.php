<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_ultra extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function traer_usuarios($robot)
    {
        $sql = "SELECT rm.id, rm.nombre, rm.apellido1, rm.user, rm.token, a.activo FROM r_master_usuarios rm LEFT JOIN activo_servicio a ON a.usuario_id = rm.id AND a.servicio = ?
        ";

        $resultado = $this->db->query($sql,[$robot]);

        return $resultado->result();
    }
    
    public function insertReporte($data)
    {
        $this->db->insert('reportes_robot',$data);
    }

    public function addRompecabeza($data)
    {
        $this->db->insert('puzzle_fichas',$data);
    }

    public function parametro_puzzle()
    {
        $this->db->select('*');
        $resultado = $this->db->get('parametro_puzzle');

        return $resultado->result();
    }

    public function fichas()
    {
        $this->db->select('*');
        $resultado = $this->db->get('puzzle_fichas');

        return $resultado->result();
    }

    public function traer_pais($id)
    {
        $this->db->where('id',$id);
        $resultado = $this->db->get('pais');

        return $resultado->row();
    }

    public function usuariosActivos()
    {
        $resultado = $this->db->get('activo_servicio');

        return $resultado->result();
    }
    public function contar_usuariosActivos()
    {
        $this->db->select('count(*) as contar');
        $resultado = $this->db->get('activo_servicio');

        return $resultado->row();
    }

    public function updateActivo($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('activo_servicio',$data);
    }

    public function desactivar_inversion($data, $idUsuario)
    {
        $this->db->where('id_usuario', $idUsuario);
        $this->db->update('r_inversion_robot', $data);
    }

    public function desactivar_inversion_arbitraje($data,$idUsuario)
    {
        $this->db->where('usuario_id', $idUsuario);
        $this->db->update('arbitraje_fondeo', $data);
    }
    
}
