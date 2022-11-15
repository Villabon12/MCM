<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class model_wallet extends CI_Model {



  function __construct(){

    parent::__construct();

  }


  public function consultaPais(){

    $sql="SELECT * from pais";

    $query=$this->db->query($sql);

    return $query->result();

  }


  public function insertwallet($data){

    $this->db->insert("master_wallet", $data);

    return $this->db->insert_id();

  }

  public function gananciasHoy()
  {
    $id = $this->session->userdata('ID');

    $this->db->select('SUM(ganancia) as ganancia');
    $this->db->where('fecha',date('Y-m-d'));
    $this->db->where('tipo','ganancia');
    $this->db->where('robot','binarias');
    $this->db->where('usuario_id',$id);

    $resultado = $this->db->get('historial_inversion');

    return $resultado->row();
  }

  public function perdidasHoy()
  {
    $id = $this->session->userdata('ID');

    $this->db->select('SUM(ganancia) as perdida');
    $this->db->where('fecha',date('Y-m-d'));
    $this->db->where('tipo','perdida');
    $this->db->where('robot','binarias');
    $this->db->where('usuario_id',$id);

    $resultado = $this->db->get('historial_inversion');

    return $resultado->row();
  }
  public function deposito()
  {
    $id = $this->session->userdata('ID');

    $this->db->select('SUM(valor) as deposito');
    $this->db->where('robot','binarias');
    $this->db->where('usuario_id',$id);

    $resultado = $this->db->get('deposito');

    return $resultado->row();
  }
  public function retiro()
  {
    $id = $this->session->userdata('ID');

    $this->db->select('SUM(valor) as retiro');
    $this->db->where('robot','binarias');
    $this->db->where('usuario_id',$id);

    $resultado = $this->db->get('retiros_inversion');

    return $resultado->row();
  }

}
