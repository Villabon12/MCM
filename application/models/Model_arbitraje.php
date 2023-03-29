<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_arbitraje extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function general()
    {
        $this->db->where('activo',1);

        $resultados = $this->db->get('arbitraje_fondeo');

        return $resultados->result();
    }
    public function cargarCapital()
    {
        $idUsuario = $this->session->userdata('ID');

        $this->db->select('*');
        $this->db->where('activo',1);
        $this->db->where('usuario_id',$idUsuario);

        $resultados = $this->db->get('arbitraje_fondeo');

        return $resultados->result();
    }

    public function cargarCapitalxid()
    {
        $idUsuario = $this->session->userdata('ID');

        $this->db->select('*');
        $this->db->where('usuario_id',$idUsuario);
        $this->db->limit(1);

        $resultados = $this->db->get('arbitraje_fondeo');

        return $resultados->row();
    }

    public function sumInversion()
    {
        $idUsuario = $this->session->userdata('ID');

        $this->db->select('*,SUM(valor) as total');
        $this->db->where('activo_id',1);
        $this->db->where('id_usuario',$idUsuario);
        $this->db->where('consignado',1);

        $resultados = $this->db->get('arbitraje_fondeo');

        return $resultados->row();
    }
    public function sumInversionBilletera()
    {
        $this->db->select('SUM(valor) as total');
        $this->db->where('activo_id',1);
        $this->db->where('consignado',1);

        $resultados = $this->db->get('arbitraje_fondeo');

        return $resultados->row();
    }

    public function inversion($id,$update)
    {
        $this->db->where('consignado',0);
        $this->db->where('id_usuario',$id);
        $this->db->update('arbitraje', $update);
    }

    public function codigo($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('r_master_usuarios',$data);
        return 1;
    }

    public function ganancia($id, $robot)
    {
        $this->db->where('usuario_id',$id);
        $this->db->where('tipo','ganancia');
        $this->db->where('robot',$robot);
        $this->db->select('SUM(ganancia) AS ganancia');

        $resultados = $this->db->get('historial_inversion');

        return $resultados->row();
    }

    public function perdida($id, $robot)
    {
        $this->db->where('usuario_id',$id);
        $this->db->where('tipo','perdida');
        $this->db->where('robot',$robot);
        $this->db->select('SUM(ganancia) AS perdida');

        $resultados = $this->db->get('historial_inversion');

        return $resultados->row();
    }

    public function comisiones()
    {
        $id = $this->session->userdata('ID');

        $this->db->where('beneficio_id',$id);
        $this->db->select('SUM(valor) AS valor');

        $resultados = $this->db->get('historial_comisiones');

        return $resultados->row();
    }

    public function comisiones2($id)
    {

        $this->db->where('beneficio_id',$id);
        $this->db->select('SUM(valor) AS valor');

        $resultados = $this->db->get('historial_comisiones');

        return $resultados->row();
    }
    
    public function actualizar_fondeo($id,$data)
    {
        $this->db->where('id',$id);
        $this->db->update('arbitraje_fondeo',$data);
    }

    public function insertarHistorial($data)
    {
        $this->db->insert('historial_inversion_a',$data);
    }
}
