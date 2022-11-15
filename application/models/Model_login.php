<?php

defined('BASEPATH') or exit('No direct script access allowed');



class model_login extends CI_Model
{



  function __construct()
  {

    parent::__construct();
  }

  public function cargar_datos()
  {
    $idUsuario = $this->session->userdata('ID');
    $sql = "SELECT u.*FROM r_master_usuarios u WHERE u.id= ?";

    $query = $this->db->query($sql, [$idUsuario]);

    return $query->row();
  }

  public function agrupar()
  {
    $this->db->select("SUM(estado) as total");
    $this->db->from("r_master_usuarios");
    $resultados = $this->db->get();
    return $resultados->row();
  }

  public function cargar_datosReferencia($id)
  {
    $this->db->select("*");
    $this->db->from("r_master_usuarios");
    $this->db->where("id", $id);
    $resultados = $this->db->get();
    return $resultados->row();
  }

  public function traerPais()
  {
    $this->db->select("*");
    $this->db->order_by('paisnombre', 'asc');
    $resultados = $this->db->get("pais");
    return $resultados->result();
  }

  public function registrar($data)
  {
    $this->db->insert("r_master_usuarios", $data);
    return 1;
  }

  public function lastID()
  {
    return $this->db->insert_id();
  }

  public function insertWallet($data)
  {
    return $this->db->insert('wallet_principal', $data);
  }

  /* Fin consulta para taer el id del usuario consultado  */


  public function trae_user($user = null, $pass = null)
  {

    $sql = "SELECT * FROM r_master_usuarios
  WHERE (user=? || correo = ?) AND contrasena= ?;";

    $query = $this->db->query($sql, array($user, $user, $pass));

    return $query->row();
  }


  public function verifica_user($user)
  {

    $sql = "SELECT count(*) cuenta FROM r_master_usuarios u WHERE u.user='$user'";

    $query = $this->db->query($sql);

    return $query->row()->cuenta;
  }


  public function actualizarUsuario($dato, $id)
  {

    $this->db->where('id', $id);

    $this->db->update('r_master_usuarios', $dato);
  }

  public function updPerfil($dato, $token)
  {

    $this->db->where('token', $token);

    $this->db->update('r_master_usuarios', $dato);
    return 1;
  }

  public function actualizarPerfil($datos, $id)

  {

    $this->db->where('id', $id);

    $this->db->update('r_master_usuarios', $datos);
  }

  public function validarcontra($id, $contra_ori)
  {

    $sql = "SELECT COUNT(*) AS contar
	FROM r_master_usuarios WHERE id=? AND contrasena=? ;";
    //$sql = "SELECT * FROM some_table WHERE id = ? AND status = ? AND author = ?";
    //$this->db->query($sql, array(3, 'live', 'Rick'));
    $query = $this->db->query($sql, array($id, $contra_ori));

    return $query->row();
  }



  public function consultaUser($user, $contra)
  {

    $sql = "SELECT COUNT(*) AS contar
  FROM r_master_usuarios WHERE (user= ? || correo = ?) AND
  contrasena = ? ;";


    $query = $this->db->query($sql, array($user, $user, $contra));

    return $query->row();
  }

  public function getCiudad($id)
  {
    $this->db->select("*");
    $this->db->where("ubicacionpaisid", $id);
    $this->db->order_by('estadonombre', 'asc');
    $resultados = $this->db->get("estado");
    return $resultados->result();
  }

  public function consultaregistro($user, $cedula, $correo)
  {

    $sql = "SELECT COUNT(*) AS contar
	  FROM r_master_usuarios WHERE (user=? ||cedula= ? ||correo=?) ;";

    $query = $this->db->query($sql, array($user, $cedula, $correo));

    return $query->row();
  }

  function ModificarDerecha($datos, $id)
  {
    $this->db->where('id', $id);
    $this->db->update('r_master_usuarios', $datos);
  }

  public function binarioArbolDerecha($id)
  {
    $sql = "SELECT r1.id AS id_p, r1.nombre AS nombre_p, r1.apellido1 AS apellido_p, r1.img_perfil AS img_p, 
    r2.id AS r_d, r2.nombre AS nombre_d, r2.apellido1 AS apellido_d, r2.img_perfil AS img_d 
    FROM r_master_usuarios r1, r_master_usuarios r2 WHERE r1.id = ? AND r1.id_derecha = r2.id ";

    $query = $this->db->query($sql, [$id]);

    return $query->row();
  }

  public function binarioArbolIzquierda($id)
  {
    $sql = "SELECT r1.id AS id_p, r1.nombre AS nombre_p, r1.apellido1 AS apellido_p, r1.img_perfil AS img_p, 
    r2.id AS r_d, r2.nombre AS nombre_d, r2.apellido1 AS apellido_d, r2.img_perfil AS img_d 
    FROM r_master_usuarios r1, r_master_usuarios r2 WHERE r1.id = ? AND r1.id_izquierda = r2.id ";

    $query = $this->db->query($sql, [$id]);

    return $query->row();
  }

  public function traerPrueba($id)

  {

    $sql = "SELECT id,id_papa_pago, id_izquierda ,nombre,apellido1

		FROM r_master_usuarios

		WHERE id= ?";

    $query = $this->db->query($sql, [$id]);



    return $query->row();
  }


  public function traerPruebaDerecha($id)

  {

    $sql = "SELECT id, id_papa_pago, id_derecha ,nombre,apellido1

		FROM r_master_usuarios

		WHERE id= ?";

    $query = $this->db->query($sql, [$id]);



    return $query->row();
  }
}
