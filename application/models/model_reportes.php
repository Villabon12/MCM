<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_reportes extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function montosMeses($year)
    {
        $id = $this->session->userdata('ID');

        $sql = "SELECT MONTH(hi.fecha) AS mes, (SELECT  SUM(hi2.ganancia) AS perdida
        FROM historial_inversion hi2
        WHERE MONTH(hi2.fecha)= MONTH(hi.fecha)
        AND hi2.tipo = 'ganancia'
        AND hi2.usuario_id=$id
        AND hi2.fecha >='$year-01-01'
        AND hi2.fecha <='$year-12-31') ganancia , 
    (SELECT  SUM(hi1.ganancia) AS perdida
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
}
