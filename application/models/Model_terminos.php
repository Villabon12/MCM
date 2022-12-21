<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_terminos extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function comprobar_registro($id)
    {
        $this->db->select('*');
        $this->db->where('usuario_id', $id);
        $this->db->where('nota', 'registro');
        $resultado = $this->db->get('terminos_condiciones');

        return $resultado->row();
    }

    public function insertTerminos($data)
    {
        $this->db->insert("terminos_condiciones",$data);
    }

    public function datosTraer($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $resultados = $this->db->get('costo_servicio');

        return $resultados->row();
    }

    public function actualizar_wallet($data, $token)
    {
        $this->db->where('token', $token);
        $this->db->update('wallet_principal', $data);
    }
    public function actualizar_wallet_empresa($data, $token)
    {
        $this->db->where('token', $token);
        $this->db->update('wallet_negocio', $data);
    }

    public function traer_parametro($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $resultados = $this->db->get('parametros_general');

        return $resultados->row();
    }

    public function consultar_referido($token)
    {
        $this->db->select('*');
        $this->db->where('token', $token);
        $resultados = $this->db->get('r_master_usuarios');

        return $resultados->row();
    }

    public function consultar_referido_niveles($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $resultados = $this->db->get('r_master_usuarios');

        return $resultados->row();
    }

    public function activar_servicio($data)
    {
        $this->db->insert("activo_servicio", $data);
        return 1;
    }

    public function historialComisiones($data)
    {
        $this->db->insert("historial_comisiones", $data);
        return 1;
    }

    public function traerInversion()
    {
        $idUsuario = $this->session->userdata('ID');

        $this->db->select('*');
        $this->db->where('activo_id', 1);
        $this->db->where('id_usuario', $idUsuario);
        $this->db->where('consignado', 1);
        $this->db->limit(1);

        $resultados = $this->db->get('r_inversion_robot');

        return $resultados->row();
    }

    public function desactivar($data)
    {
        $idUsuario = $this->session->userdata('ID');

        $this->db->where('usuario_id', $idUsuario);
        $this->db->update('activo_servicio', $data);
    }

    public function insertHistorial($data)
    {
        $this->db->insert("historial_transferencia", $data);
    }

    public function cargarInversion($id)
    {
        $this->db->select('*');
        $this->db->where('id_usuario', $id);
        $resultados = $this->db->get('r_inversion_robot');

        return $resultados->row();
    }

    public function cargarCapital()
    {
        $idUsuario = $this->session->userdata('ID');

        $this->db->select('*');
        $this->db->where('activo_id', 1);
        $this->db->where('id_usuario', $idUsuario);

        $resultados = $this->db->get('r_inversion_robot');

        return $resultados->row();
    }

    public function actualizarInversion($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('r_inversion_robot', $data);
    }

    public function deposito($data)
    {
        $this->db->insert('deposito', $data);
    }

    public function retirosI($data)
    {
        $this->db->insert('retiros_inversion', $data);
    }
}
