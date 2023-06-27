<?php

defined('BASEPATH') or exit('No direct script access allowed');



class model_binarias extends CI_Model
{
	//metodo contructor 
	function __construct()
	{
		parent::__construct();
	}

	function insertData($data)
	{
		return $this->db->insert('userSenaBi', $data);
	}
	function insertDataFo($data)
	{
		return	 $this->db->insert('userSenaFo', $data);
	}
	public function lastID()
	{
		return $this->db->insert_id();
	}

	function PayService($data)
	{
		$this->db->insert('userSenaPay', $data);
	}
	function PayServiceFo($data)
	{
		$this->db->insert('userSenaPayFo', $data);
	}
	function InsertRegistro($data)
	{
		$this->db->insert('senales_binarias', $data);
	}
	// Inicio señales Binarias 
	function traerTodo()
	{
		$traer = "SELECT * FROM senales_binarias WHERE fecha >= NOW() - INTERVAL 1 DAY ORDER BY fecha DESC";
		$query = $this->db->query($traer);
		return $query->result();
	}
	function traerTodoIq()
	{
		$traer = "SELECT * FROM senales_binarias WHERE fecha >= NOW() - INTERVAL 1 DAY ORDER BY fecha DESC limit 4";
		$query = $this->db->query($traer);
		return $query->result();
	}
	function senalesLogin()
	{
		$traer = "SELECT * FROM senales_binarias WHERE fecha >= NOW() - INTERVAL 1 DAY ORDER BY fecha DESC limit 3";
		$query = $this->db->query($traer);
		return $query->result();
	}
	function traerTodoHistorial()
	{
		$traer = "SELECT * FROM senales_binarias ORDER BY fecha DESC";
		$query = $this->db->query($traer);
		return $query->result();
	}
	// Fin Señales Binarias 

	// Inicio Señales Forex
	function traerTodoForex()
	{
		$traer = "SELECT * FROM senales_forex ORDER BY fecha DESC LIMIT 20";
		$query = $this->db->query($traer);
		return $query->result();
	}
	function traerTodoHistorialForex()
	{
		$traer = "SELECT * FROM senales_forex ORDER BY fecha DESC";
		$query = $this->db->query($traer);
		return $query->result();
	}
	// Fin Señales Forex

	function traerData($id)
	{
		$traer = "SELECT * from userSenaBi Where idUser=?";
		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	function traerDataFo($id)
	{
		$traer = "SELECT * from userSenaFo Where idUser=?";
		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	function parametroBina($id)
	{
		$traer = "SELECT *  from parametros_binarias Where id=?";
		$query = $this->db->query($traer, $id);
		return $query->row();
	}
	function PaquetesBinarias()
	{
		$traer = "SELECT *  from preciosSenales where tipo=1 ";
		$query = $this->db->query($traer);
		return $query->result();
	}
	function PaquetesForex()
	{
		$traer = "SELECT *  from preciosSenales where tipo=2 ";
		$query = $this->db->query($traer);
		return $query->result();
	}
	function PaquetesBinariasOne($id)
	{
		$traer = "SELECT *  from preciosSenales where id=? ";
		$query = $this->db->query($traer,$id);
		return $query->row();
	}
	public function Updatedata($datos, $id)
	{
		$this->db->where('idUser', $id);
		$this->db->update('userSenaBi', $datos);
	}
	public function UpdatedataFo($datos, $id)
	{
		$this->db->where('idUser', $id);
		$this->db->update('userSenaFo', $datos);
	}
	function infoTemplate($id)
	{
		$traer = "SELECT *  from linkTree_plantillas Where id=?";
		$query = $this->db->query($traer, $id);
		return $query->row();
	}
	public function UpdateMaster($datos, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('r_master_usuarios', $datos);
	}
	public function searchUser($user, $pass, $cedula)
	{
		$traer = "SELECT count(*) as contar from r_master_usuarios Where correo=? and contrasena=? and cedula=?";
		$query = $this->db->query($traer, array($user, $pass, $cedula));
		return $query->row();
	}
	public function eliminar_registro_hpli()
	{
		$this->db->where('PAR', 'hpli');
		$this->db->delete('senales_binarias');
		return 1;
	}
}
