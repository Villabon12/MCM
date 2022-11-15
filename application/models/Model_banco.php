<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_banco extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function cargar()
    {
        $this->db->select('c.*, r.*');
        $this->db->from('consignaciones c');
        $this->db->join('r_master_usuarios r','r.token = c.usuario_token');
        $resultado = $this->db->get();

        return $resultado->result();
    }

    public function cargar_inversion()
    {
        $this->db->select('ri.*, r.*');
        $this->db->from('r_inversion_robot ri');
        $this->db->join('r_master_usuarios r','r.id = ri.id_usuario');
        $resultado = $this->db->get();

        return $resultado->result();
    }

    public function cargarHistorial()
    {
        $token = $this->session->userdata('token');

        $this->db->select('c.*, r.*');
        $this->db->from('consignaciones c');
        $this->db->join('r_master_usuarios r','r.token = c.usuario_token');
        $this->db->where('c.usuario_token',$token);
        $resultado = $this->db->get();

        return $resultado->result();
    }

    public function cargarHistorialTransferencia()
    {
        $token = $this->session->userdata('token');

        $this->db->select('c.fecha, c.valor, r.nombre as nombre, r.apellido1 as apellido, r2.nombre as nombre1, r2.apellido1 as apellido1');
        $this->db->from('historial_transferencia c');
        $this->db->where('c.usuario_token',$token);
        $this->db->join('r_master_usuarios r','r.token = c.usuario_token');
        $this->db->join('r_master_usuarios r2','r2.token = c.persona_token');
        $resultado = $this->db->get();

        return $resultado->result();
    }

    public function insertar($servicio)
    {
		return $this->db->insert("consignaciones", $servicio);

    }

    public function comprobar($hash)
    {
        $this->db->select('*');
        $this->db->where('hash',$hash);
        $resultado = $this->db->get('consignaciones');

        return $resultado->row();
    }

    public function billeteraEmpresa()
    {
        $this->db->select('*');
        $this->db->where('token','4e1adc6257178bd4a7dfddb99d4d8054');

        $resultado = $this->db->get('wallet_negocio');

        return $resultado->row();
    }

    public function billetera($usuario)
    {
        $this->db->select('*');
        $this->db->where('token_usuario',$usuario);

        $resultado = $this->db->get('wallet_principal');

        return $resultado->row();
    }

    public function updBilletera($token,$datos)
    {
        $this->db->where('token_usuario', $token);
        $this->db->update('wallet_principal', $datos);

        return 1;
    }

    public function updBilleteraE($token,$datos)
    {
        $this->db->where('usuario_token', $token);
        $this->db->update('wallet_negocio', $datos);
    }

    public function insertHistorial($data)
    {
        return $this->db->insert("historial_retiro", $data);
    }

    public function updConsigna($token,$datos)
    {
        $this->db->where('hash', $token);
        $this->db->update('consignaciones', $datos);
    }

    public function traerCedula($user)
    {
        $this->db->select('*');
        $this->db->where('user',$user);

        $resultado = $this->db->get('r_master_usuarios');

        return $resultado->row();
    }

    public function insertRetiro($data)
    {
        $this->db->insert('retiros',$data);
    }
}
