<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class model_gastos extends CI_Model {



  function __construct(){

    parent::__construct();

  }



  public function salida(){

    $sql="SELECT * FROM master_gastos ORDER BY fecha_registro DESC";

    $query=$this->db->query($sql);

    return $query->result();

  }



  public function creaGasto($dato){

    $this->db->insert("master_gastos", $dato);

  }


  public function getGenero()
  {
    $resultado = $this->db->get('genero');
    return $resultado->result();
  }

  public function getTipo()
  {
    $resultado = $this->db->get('tipo_documento');
    return $resultado->result();
  }

  public function updPerfil($id,$data)
  {
    $this->db->where('id',$id);
    $this->db->update('master_usuarios',$data);
  }


}

