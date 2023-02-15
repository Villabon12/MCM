<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_proceso extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function cargar_billetera($token)
    {
        $this->db->select('*');
        $this->db->where('token_usuario', $token);
        $resultado = $this->db->get('wallet_principal');

        return $resultado->row();
    }

    public function cargar_billetera_global($token)
    {
        $this->db->select('*');
        $this->db->where('usuario_token', $token);
        $resultado = $this->db->get('wallet_negocio');

        return $resultado->row();
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

    public function traer_parametro_arbitraje($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $resultados = $this->db->get('parametro_Arbitraje');

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

    public function historialRetiro($data)
    {
        $this->db->insert("historial_retiros_individual", $data);
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

    public function desactivar($data,$robot)
    {
        $idUsuario = $this->session->userdata('ID');

        $this->db->where('usuario_id', $idUsuario);
        $this->db->where('servicio',$robot);
        $this->db->update('activo_servicio', $data);
    }
    public function desactivar_inversion($data)
    {
        $idUsuario = $this->session->userdata('ID');

        $this->db->where('id_usuario', $idUsuario);
        $this->db->update('r_inversion_robot', $data);
    }
    public function desactivar_inversion_arbitraje($data)
    {
        $idUsuario = $this->session->userdata('ID');

        $this->db->where('id_usuario', $idUsuario);
        $this->db->update('arbitraje_fondeo', $data);
    }

    public function insertHistorial($data)
    {
        $this->db->insert("historial_transferencia", $data);
    }

    public function insertHistorialPuzzle($data)
    {
        $this->db->insert("historial_transferencia_puzzle", $data);
    }

    public function cargarInversion($id)
    {
        $this->db->select('*');
        $this->db->where('id_usuario', $id);
        $resultados = $this->db->get('r_inversion_robot');

        if ($resultados->num_rows() > 0) {
            return $resultados->row();
        } else {
            return false;
        }
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

    public function cargarCapital_arbitraje()
    {
        $idUsuario = $this->session->userdata('ID');

        $this->db->select('*');
        $this->db->where('activo', 1);
        $this->db->where('usuario_id', $idUsuario);

        $resultados = $this->db->get('arbitraje_fondeo');

        return $resultados->row();
    }

    public function actualizarInversion($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('r_inversion_robot', $data);
    }

    public function actualizarInversion_arbitraje($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('arbitraje_fondeo', $data);
    }

    public function deposito($data)
    {
        $this->db->insert('deposito', $data);
    }

    public function retirosI($data)
    {
        $this->db->insert('retiros_inversion', $data);
    }

    public function cambiarEstado($data,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('ticket',$data);
    }

    public function revisar_activo($id)
    {
        $this->db->where('activo',1);
        $this->db->where('usuario_id',$id);
        $this->db->select('*');
        $resultado = $this->db->get('activo_servicio');

        return $resultado->row();
    }
    
    public function cargarHistorialPremios()
    {
        $token = $this->session->userdata('ID');

        $this->db->select('c.fecha, c.valor, r.nombre as nombre, r.apellido1 as apellido, c.detalle');
        $this->db->from('historial_premios c');
        $this->db->where('c.usuario_id',$token);
        $this->db->join('r_master_usuarios r','r.id = c.usuario_id');
        $resultado = $this->db->get();

        return $resultado->result();
    }
}
