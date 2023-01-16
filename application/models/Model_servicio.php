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

    public function cargarCapitalxid()
    {
        $idUsuario = $this->session->userdata('ID');

        $this->db->select('*');
        $this->db->where('activo_id',1);
        $this->db->where('id_usuario',$idUsuario);
        $this->db->limit(1);

        $resultados = $this->db->get('r_inversion_robot');

        return $resultados->row();
    }

    public function sumInversion()
    {
        $idUsuario = $this->session->userdata('ID');

        $this->db->select('*,SUM(inversion) as total');
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
        $fecha = date("Y-m-d");

        $sql = "SELECT ri.*, hi.valor_antiguo, hi.ganancia as gananciaxuser, hi.tipo as tipoxuser
        FROM resultado_inversion_b ri, historial_inversion hi, r_inversion_robot rb 
        WHERE hi.fecha = ri.fecha  AND hi.usuario_id = rb.id  AND rb.id_usuario = ? 
        AND DATE(ri.fecha) = ? AND ri.senal != 'no' ORDER BY fecha DESC";

        $query = $this->db->query($sql,[$idUsuario, $fecha]);

        return $query->result();
    }

    public function consulta_reportes($fecha1,$fecha2)
    {
        $idUsuario = $this->session->userdata('ID');

        $sql = "SELECT ri.*, hi.valor_antiguo, hi.ganancia as gananciaxuser, hi.tipo as tipoxuser
        FROM resultado_inversion_b ri, historial_inversion hi, r_inversion_robot rb 
        WHERE hi.fecha = ri.fecha  AND hi.usuario_id = rb.id  AND rb.id_usuario = ? AND ri.senal != 'no'  AND date(ri.fecha) >=?
        AND date(ri.fecha) <=? ORDER BY fecha DESC";

        $query = $this->db->query($sql,[$idUsuario, $fecha1, $fecha2]);

        return $query->result();
    }

    public function reportesxuser()
    {
        $idUsuario = $this->session->userdata('ID');

        $sql = "SELECT ri.*, hi.valor_antiguo, hi.ganancia as gananciaxuser, hi.tipo as tipoxuser, hi.usuario_id as idxuser
        FROM resultado_inversion_b ri, historial_inversion hi, r_inversion_robot rb 
        WHERE hi.fecha = ri.fecha  AND hi.usuario_id = rb.id  AND rb.id_usuario = ? AND ri.senal != 'no' ORDER BY fecha DESC LIMIT 1";

        $query = $this->db->query($sql,[$idUsuario]);

        
        return $query->row();
    }

    public function consultarCampos()
    {
        $idUsuario = $this->session->userdata('ID');

        $sql = "SELECT * FROM r_master_usuarios WHERE id = ? AND (celular IS NULL OR ciudad_id IS NULL OR fecha_nacimiento IS NULL OR fecha_nacimiento ='0000-00-00')
        ";

        $query = $this->db->query($sql,[$idUsuario]);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
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

    public function ganancia($id)
    {
        $this->db->where('usuario_id',$id);
        $this->db->where('tipo','ganancia');
        $this->db->select('SUM(ganancia) AS ganancia');

        $resultados = $this->db->get('historial_inversion');

        return $resultados->row();
    }

    public function perdida($id)
    {
        $this->db->where('usuario_id',$id);
        $this->db->where('tipo','perdida');
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
}
