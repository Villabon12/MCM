<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_ultra extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function traer_usuarios()
    {
        $sql = "SELECT rm.id, rm.nombre, rm.apellido1, rm.user, rm.token, a.activo FROM r_master_usuarios rm LEFT JOIN activo_servicio a ON a.usuario_id = rm.id
        ";

        $resultado = $this->db->query($sql);

        return $resultado->result();
    }
    
    public function insertReporte($data)
    {
        $this->db->insert('reportes_robot',$data);
    }
    
}
