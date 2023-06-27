<?php

defined('BASEPATH') or exit('No direct script access allowed');

class model_scalping extends CI_Model
{
    public function __construct()
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

    public function requisito()
    {
        $idUsuario = $this->session->userdata('ID');

        $sql = 'SELECT count(*) as contar FROM r_master_usuarios WHERE id_papa_pago = ? AND YEAR(fecha_registro) = YEAR(NOW())';

        $query = $this->db->query($sql, [$idUsuario]);

        return $query->row();

    }

    public function ganancia($id)
    {
        $this->db->where('usuario_id', $id);
        $this->db->where('tipo', 'ganancia');
        $this->db->select('SUM(ganancia) AS ganancia');

        $resultados = $this->db->get('historial_inversion');

        return $resultados->row();
    }

    public function perdida($id)
    {
        $this->db->where('usuario_id', $id);
        $this->db->where('tipo', 'perdida');
        $this->db->select('SUM(ganancia) AS perdida');

        $resultados = $this->db->get('historial_inversion');

        return $resultados->row();
    }

    public function comisiones()
    {
        $id = $this->session->userdata('ID');

        $this->db->where('beneficio_id', $id);
        $this->db->select('SUM(valor) AS valor');

        $resultados = $this->db->get('historial_comisiones');

        return $resultados->row();
    }

    public function comisiones2($id)
    {
        $this->db->where('beneficio_id', $id);
        $this->db->select('SUM(valor) AS valor');

        $resultados = $this->db->get('historial_comisiones');

        return $resultados->row();
    }

    public function traerDatos()
    {
        $this->db->where('r.id = d.usuario_id');
        $this->db->where('r2.id = r.id_papa_pago');
        $this->db->select('d.fecha, d.valor, r.nombre, r.apellido1, r.user, r2.nombre as papa, r2.apellido1 as papap');
        $this->db->from('deposito_scalping d, r_master_usuarios r, r_master_usuarios r2');

        $resultados = $this->db->get();

        return $resultados->result();
    }

    public function insertarDeposito($data)
    {
        $this->db->insert('deposito_scalping',$data);
    }
    public function insertarDepositoW($data)
    {
        $this->db->insert('wsport_fondeo',$data);
    }

    public function usuarios()
    {
        $this->db->order_by('nombre','ASC');
        $resultado = $this->db->get('r_master_usuarios');

        return $resultado->result();
    }
}
