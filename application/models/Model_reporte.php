<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_reporte extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function montosMeses($year, $id)
    {

        $sql = "SELECT MONTH(hi.fecha) AS mes, (SELECT(SELECT  SUM(hi2.sumar)
        FROM historial_inversion hi2
        WHERE MONTH(hi2.fecha)= MONTH(hi.fecha)
        AND hi2.tipo = 'ganancia'
        AND hi2.usuario_id=$id
        AND hi2.fecha >='$year-01-01'
        AND hi2.fecha <='$year-12-31') - 
    (SELECT  SUM(hi1.sumar)
        FROM historial_inversion hi1
        WHERE MONTH(hi1.fecha)= MONTH(hi.fecha)
        AND hi1.tipo = 'perdida'
        AND hi1.usuario_id=$id
        AND hi1.fecha >='$year-01-01'
        AND hi1.fecha <='$year-12-31'))ganancia					
FROM historial_inversion hi
WHERE hi.fecha >='$year-01-01'
AND hi.fecha <='$year-12-31'
AND hi.usuario_id = $id
GROUP BY 1;";
        $resultados = $this->db->query($sql);
        return $resultados->result();
    }

    public function porcMeses($year, $id)
    {

        $sql = "SELECT MONTH(hi.fecha) AS mes, (SELECT  SUM(hi2.sumar) AS perdida
        FROM historial_inversion hi2
        WHERE MONTH(hi2.fecha)= MONTH(hi.fecha)
        AND hi2.tipo = 'ganancia'
        AND hi2.usuario_id=$id
        AND hi2.fecha >='$year-01-01'
        AND hi2.fecha <='$year-12-31') ganancia , 
    (SELECT  SUM(hi1.sumar) AS perdida
        FROM historial_inversion hi1
        WHERE MONTH(hi1.fecha)= MONTH(hi.fecha)
        AND hi1.tipo = 'perdida'
        AND hi1.usuario_id=$id
        AND hi1.fecha >='$year-01-01'
        AND hi1.fecha <='$year-12-31') perdida					
FROM historial_inversion hi
WHERE hi.fecha >='$year-01-01'
AND hi.fecha <='$year-12-31'
AND hi.usuario_id = $id
GROUP BY 1 ;";
        $resultados = $this->db->query($sql);
        return $resultados->row();
    }

    public function cargarInversion()
    {
        $idUsuario = $this->session->userdata('ID');

        $this->db->select('*');
        $this->db->where('activo_id',1);
        $this->db->where('id_usuario',$idUsuario);
        $this->db->limit(1);

        $resultados = $this->db->get('r_inversion_robot');

        return $resultados->row();
    }

    public function insertTicket($data)
    {
        $this->db->insert('ticket',$data);
        return 1;
    }

    public function detalleInsert($data)
    {
        $this->db->insert('detalle_ticket',$data);
    }

    public function lastID()
    {
      return $this->db->insert_id();
    }

    public function cargar_ticket()
    {
        $id = $this->session->userdata('ID');

        $this->db->select('*');
        $this->db->where('usuario_id',$id);
        $resultados = $this->db->get('ticket');

        return $resultados->result();
    }
    public function cargar_ticket_empresa()
    {
        $this->db->select('t.*, u.user');
        $this->db->from('ticket t');
        $this->db->join('r_master_usuarios u','t.usuario_id = u.id');
        $this->db->where('t.empresa_id',6);
        $resultados = $this->db->get();

        return $resultados->result();
    }

    public function detalle($id)
    {
        $this->db->select('*');
        $this->db->where('ticket_id',$id);
        $resultados = $this->db->get('detalle_ticket');

        return $resultados->result();
    }

    public function anoHoy()
    {
        $sql = "SELECT YEAR(NOW()) AS ano";

        $resultado = $this->db->query($sql);

        return $resultado->row();
    }
    public function mesHoy()
    {
        $sql = "SELECT MONTH(NOW()) AS mes";

        $resultado = $this->db->query($sql);

        return $resultado->row();
    }

    public function inicialMes($id,$mes, $year)
    {
        $sql = "SELECT valor_antiguo FROM historial_inversion 
        WHERE usuario_id = ? AND MONTH(fecha) = ? AND YEAR(fecha) = ? LIMIT 1;";

        $resultado = $this->db->query($sql,[$id,$mes, $year]);

        return $resultado->row();
    }

    public function gananciaMes($id,$mes,$year)
    {
        $sql = "SELECT SUM(ganancia) as ganancia FROM historial_inversion 
        WHERE usuario_id = ? AND MONTH(fecha) = ? AND YEAR(fecha) = ? AND tipo = 'ganancia';";

        $resultado = $this->db->query($sql,[$id,$mes, $year]);

        return $resultado->row();
    }
    public function perdidaMes($id,$mes,$year)
    {
        $sql = "SELECT SUM(ganancia) as perdida FROM historial_inversion 
        WHERE usuario_id = ? AND MONTH(fecha) = ? AND YEAR(fecha) = ? AND tipo = 'perdida';";

        $resultado = $this->db->query($sql,[$id,$mes,$year]);

        return $resultado->row();
    }

    public function balanceTotalMes($mes, $year)
    {
        $sql = "SELECT ((SELECT SUM(saldo_final) AS ganancia FROM reportes_robot 
        WHERE MONTH(fecha) = ? AND YEAR(fecha) = ? AND estado = 1) - (SELECT SUM(saldo_inicial) AS ganancia FROM reportes_robot 
        WHERE MONTH(fecha) = ? AND YEAR(fecha) = ? AND estado = 1)) AS resta";

        $resultado = $this->db->query($sql,[$mes,$year, $mes, $year]);

        return $resultado->row();
    }

    public function balanceMensualRepartido($mes, $year)
    {
        $sql = "SELECT((SELECT SUM(ganancia) AS ganancia FROM historial_inversion WHERE MONTH(fecha) = ? AND YEAR(fecha) = ? AND tipo = 'ganancia')-
(SELECT SUM(ganancia) AS ganancia FROM historial_inversion WHERE MONTH(fecha) = ? AND YEAR(fecha) = ? AND tipo = 'perdida')) AS repartir;";

        $resultado = $this->db->query($sql,[$mes,$year, $mes, $year]);

        return $resultado->row();
    }

    public function traer_ticket($id)
    {
        $this->db->select('*');
        $this->db->where('id',$id);
        $resultado = $this->db->get('ticket');

        return $resultado->row();
    }

    public function traer_usuario($id)
    {
        $this->db->select('*');
        $this->db->where('id',$id);
        $resultado = $this->db->get('r_master_usuarios');

        return $resultado->row();
    }
}
