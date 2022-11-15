<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_servicio extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function costos_robot($servicio)
    {
        $this->db->select('*');
        $this->db->where('robot', $servicio);
        $resultado = $this->db->get('costo_servicio');

        return $resultado->result();
    }

    public function activo_servicio($servicio)
    {
        $idUsuario = $this->session->userdata('ID');

        $this->db->select('*');
        $this->db->where('activo', 1);
        $this->db->where('usuario_id', $idUsuario);
        $this->db->where('servicio', $servicio);
        $resultados = $this->db->get('activo_servicio');

        return $resultados->row();
    }

    public function insertInversion($data)
    {
        $this->db->insert('r_inversion_robot',$data);
    }

    public function cargarCapital()
    {
        $idUsuario = $this->session->userdata('ID');

        $this->db->select('*');
        $this->db->where('activo_id',1);
        $this->db->where('id_usuario',$idUsuario);

        $resultados = $this->db->get('r_inversion_robot');

        return $resultados->result();
    }

    public function sumInversion()
    {
        $idUsuario = $this->session->userdata('ID');

        $this->db->select('SUM(inversion) as total');
        $this->db->where('activo_id',1);
        $this->db->where('id_usuario',$idUsuario);
        $this->db->where('consignado',1);

        $resultados = $this->db->get('r_inversion_robot');

        return $resultados->row();
    }
    public function sumInversionBilletera()
    {
        $this->db->select('SUM(inversion) as total');
        $this->db->where('activo_id',1);
        $this->db->where('consignado',1);

        $resultados = $this->db->get('r_inversion_robot');

        return $resultados->row();
    }

    public function reportes()
    {
        $idUsuario = $this->session->userdata('ID');

        $sql = "SELECT ri.*, hi.valor_antiguo, hi.ganancia as gananciaxuser, hi.tipo as tipoxuser
        FROM resultado_inversion_b ri, historial_inversion hi, r_inversion_robot rb 
        WHERE hi.fecha = ri.fecha  AND hi.usuario_id = rb.id  AND rb.id_usuario = ? AND ri.senal != 'no' ORDER BY fecha DESC";

        $query = $this->db->query($sql,[$idUsuario]);

        return $query->result();
    }

    public function inversion($id,$update)
    {
        $this->db->where('consignado',0);
        $this->db->where('id_usuario',$id);
        $this->db->update('r_inversion_robot', $update);
    }

    public function codigo($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('r_master_usuarios',$data);
        return 1;
    }
}
