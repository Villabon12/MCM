<?php

defined('BASEPATH') or exit('No direct script access allowed');



class model_wallet extends CI_Model
{



  function __construct()
  {

    parent::__construct();
  }


  public function consultaPais()
  {

    $sql = "SELECT * from pais";

    $query = $this->db->query($sql);

    return $query->result();
  }


  public function insertwallet($data)
  {

    $this->db->insert("master_wallet", $data);

    return $this->db->insert_id();
  }

  public function gananciasHoy($id)
  {

    $this->db->select('SUM(ganancia) as ganancia');
    $this->db->from('historial_inversion');
    $this->db->where('DATE(fecha)', date('Y-m-d'));
    $this->db->where('tipo', 'ganancia');
    $this->db->where('robot', 'binarias');
    $this->db->where('usuario_id', $id);

    $resultado = $this->db->get();

    return $resultado->row();
  }

  public function gananciasHoyArbitraje($id)
  {

    $this->db->select('SUM(ganancia) as ganancia');
    $this->db->from('historial_inversion_a');
    $this->db->where('DATE(fecha)', date('Y-m-d'));
    $this->db->where('tipo', 'ganancia');
    $this->db->where('robot', 'arbitraje');
    $this->db->where('usuario_id', $id);

    $resultado = $this->db->get();

    return $resultado->row();
  }

  public function gananciasConsulta($id,$fecha1,$fecha2)
  {
$sql = "SELECT SUM(ganancia) AS ganancia, SUM(sumar) AS porcentajeG 
FROM historial_inversion WHERE usuario_id = ? AND tipo='ganancia' AND 
DATE(fecha) >= ? AND DATE(fecha) <= ?";;

    $resultado = $this->db->query($sql,[$id,$fecha1,$fecha2]);

    return $resultado->row();
  }

  public function gananciasConsultaArbitraje($id,$fecha1,$fecha2)
  {
$sql = "SELECT SUM(ganancia) AS ganancia, SUM(sumar) AS porcentajeG 
FROM historial_inversion_a WHERE usuario_id = ? AND tipo='ganancia' AND 
DATE(fecha) >= ? AND DATE(fecha) <= ?";;

    $resultado = $this->db->query($sql,[$id,$fecha1,$fecha2]);

    return $resultado->row();
  }

  public function perdidaConsulta($id,$fecha1,$fecha2)
  {
$sql = "SELECT SUM(ganancia) AS perdida, SUM(sumar) AS porcentajeP 
FROM historial_inversion WHERE usuario_id = ? AND tipo='perdida' AND 
DATE(fecha) >= ? AND DATE(fecha) <= ?";;

    $resultado = $this->db->query($sql,[$id,$fecha1,$fecha2]);

    return $resultado->row();
  }
  public function perdidaConsultaArbitraje($id,$fecha1,$fecha2)
  {
$sql = "SELECT SUM(ganancia) AS perdida, SUM(sumar) AS porcentajeP 
FROM historial_inversion_a WHERE usuario_id = ? AND tipo='perdida' AND 
DATE(fecha) >= ? AND DATE(fecha) <= ?";;

    $resultado = $this->db->query($sql,[$id,$fecha1,$fecha2]);

    return $resultado->row();
  }

  public function perdidasHoy($id)
  {

    $this->db->select('SUM(ganancia) as perdida');
    $this->db->where('DATE(fecha)', date('Y-m-d'));
    $this->db->where('tipo', 'perdida');
    $this->db->where('robot', 'binarias');
    $this->db->where('usuario_id', $id);

    $resultado = $this->db->get('historial_inversion');

    return $resultado->row();
  }
  public function perdidasHoyArbitraje($id)
  {

    $this->db->select('SUM(ganancia) as perdida');
    $this->db->where('DATE(fecha)', date('Y-m-d'));
    $this->db->where('tipo', 'perdida');
    $this->db->where('robot', 'arbitraje');
    $this->db->where('usuario_id', $id);

    $resultado = $this->db->get('historial_inversion_a');

    return $resultado->row();
  }
  public function porcentajeHoyP($id)
  {

    $this->db->select('SUM(sumar) as perdida');
    $this->db->where('DATE(fecha)', date('Y-m-d'));
    $this->db->where('tipo', 'perdida');
    $this->db->where('robot', 'binarias');
    $this->db->where('usuario_id', $id);

    $resultado = $this->db->get('historial_inversion');

    return $resultado->row();
  }
  public function porcentajeHoyPArbitraje($id)
  {

    $this->db->select('SUM(sumar) as perdida');
    $this->db->where('DATE(fecha)', date('Y-m-d'));
    $this->db->where('tipo', 'perdida');
    $this->db->where('robot', 'binarias');
    $this->db->where('usuario_id', $id);

    $resultado = $this->db->get('historial_inversion_a');

    return $resultado->row();
  }

  public function balancePorcentajeHoy($id)
  {
    $date = date('Y-m-d');
    $sql = "	SELECT (SELECT SUM(sumar) FROM historial_inversion WHERE DATE(fecha) = ? AND tipo = 'ganancia' and usuario_id = ?) - (SELECT SUM(sumar) FROM historial_inversion WHERE DATE(fecha) = ? AND tipo = 'perdida' and usuario_id = ?) AS valor;
    ";

    $query = $this->db->query($sql, [$date,$id,$date,$id]);

    return $query->row();
  }

  public function porcentajeHoyG($id)
  {

    $this->db->select('SUM(sumar) as ganancia');
    $this->db->where('DATE(fecha)', date('Y-m-d'));
    $this->db->where('tipo', 'ganancia');
    $this->db->where('robot', 'binarias');
    $this->db->where('usuario_id', $id);

    $resultado = $this->db->get('historial_inversion');

    return $resultado->row();
  }

  public function porcentajeHoyGArbitraje($id)
  {

    $this->db->select('SUM(sumar) as ganancia');
    $this->db->where('DATE(fecha)', date('Y-m-d'));
    $this->db->where('tipo', 'ganancia');
    $this->db->where('robot', 'arbitraje');
    $this->db->where('usuario_id', $id);

    $resultado = $this->db->get('historial_inversion_a');

    return $resultado->row();
  }

  public function deposito($robot)
  {
    $id = $this->session->userdata('ID');

    $this->db->where('robot', $robot);
    $this->db->where('usuario_id', $id);
    $this->db->select('SUM(valor) as deposito');

    $resultado = $this->db->get('deposito');

    return $resultado->row();
  }
  
  public function retiro($robot)
  {
    $id = $this->session->userdata('ID');

    $this->db->select('SUM(valor) as retiro');
    $this->db->where('robot', $robot);
    $this->db->where('usuario_id', $id);

    $resultado = $this->db->get('retiros_inversion');

    return $resultado->row();
  }
}
