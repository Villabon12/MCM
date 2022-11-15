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

        $sql = "SELECT MONTH(hi.fecha) AS mes, (SELECT  SUM(hi2.porcentaje) AS perdida
        FROM historial_inversion hi2
        WHERE MONTH(hi2.fecha)= MONTH(hi.fecha)
        AND hi2.tipo = 'ganancia'
        AND hi2.usuario_id=$id
        AND hi2.fecha >='$year-01-01'
        AND hi2.fecha <='$year-12-31') ganancia , 
    (SELECT  SUM(hi1.porcentaje) AS perdida
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
GROUP BY 1;";
        $resultados = $this->db->query($sql);
        return $resultados->result();
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

    public function lastID()
    {
      return $this->db->insert_id();
    }
}
