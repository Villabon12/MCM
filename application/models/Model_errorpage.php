<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_errorpage extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function insertIntruso($dato)
  {
    $this->db->insert('master_security', $dato);
  }

  public function verificarEmail($email)
  {
    $this->db->select('COUNT(*) as contar');
    $this->db->where('correo', $email);

    $resultado = $this->db->get('r_master_usuarios');
    return $resultado->row();
  }

  public function verificarUsuario($email)
  {
    $this->db->select('COUNT(*) as contar');
    $this->db->where('user', $email);

    $resultado = $this->db->get('r_master_usuarios');
    return $resultado->row();
  }

  public function verificarCedula($cedula)
  {
    $this->db->select('COUNT(*) as contar');
    $this->db->where('cedula',$cedula);

    $resultado = $this->db->get('r_master_usuarios');
    return $resultado->row();
  }

  public function traerDatos($cedula)
  {
    $this->db->select('*');
    $this->db->where('cedula',$cedula);

    $resultado = $this->db->get('r_master_usuarios');
    
    if ($resultado->num_rows() > 0) {
      return $resultado->row();
  } else {
      return false;
  }
  }

  public function traerDatosUser($cedula)
  {
    $this->db->select('*');
    $this->db->where('token',$cedula);

    $resultado = $this->db->get('r_master_usuarios');
    return $resultado->row();
  }

  public function update($data,$id)
  {
    $this->db->where("cedula",$id);
    $this->db->update("r_master_usuarios",$data);
    return 1;
  }
}
