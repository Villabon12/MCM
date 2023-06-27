<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_view_principal extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function cuentasGanancia()
    {
        $sql = "SELECT hi.fecha, hi.ganancia, u.user, p.icono FROM historial_inversion hi, r_inversion_robot r, r_master_usuarios u, pais p WHERE hi.usuario_id = r.id AND r.id_usuario = u.id AND u.pais_id = p.id AND hi.tipo = 'ganancia' AND hi.fecha > '2023-01-17' ORDER BY hi.fecha DESC LIMIT 100";

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function obtener_senales_binarias_historial()
    {
        $query = $this->db->query("SELECT * FROM senales_binarias ORDER BY fecha DESC");
        return $query->result_array();
    }

    public function obtener_senales_binarias_resumen()
    {
        $query = $this->db->query("SELECT * FROM senales_binarias ORDER BY fecha DESC LIMIT 20");
        return $query->result_array();
    }
}
