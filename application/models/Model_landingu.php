<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Model_landingu extends CI_Model
{
	//metodo contructor 
	function __construct()
	{
		parent::__construct();
	}

	function insertData($data)
	{
		$this->db->insert('landingUser', $data);
		return $this->db->insert_id();
	}
	public function GetPlantillas()
	{
		$traer = "SELECT * FROM landingPlantillas WHERE estado=1";
		$query = $this->db->query($traer);
		return $query->result();
	}
	public function GetCampaña()
	{
		$id = $this->session->userdata('ID');
		$traer = "SELECT * FROM landingUser WHERE idUser=? order by fechaCreacion desc";
		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	function insertDataTools($data)
	{
		$this->db->insert('landingTools', $data);
		return $this->db->insert_id();
	}
	function infoUser2($id)
	{
		$traer = "SELECT c1.* ,c2.nombre AS nombrePaquete FROM landingUser c1,landingpaquetes c2 WHERE c1.id=? AND c1.idPaquete=c2.id";
		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	function infoUser($id)
	{
		$traer = "SELECT *  FROM landingUser WHERE id=? ";
		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	function infoCam($name)
	{
		$traer = "SELECT * FROM landingUser WHERE ulrname=?";
		$query = $this->db->query($traer, [$name]);
		return $query->row();
	}
	function tools($id)
	{
		$traer = "SELECT c1.* FROM landingTools c1 , landingUser c2 WHERE c1.idPrin=c2.id AND idPrin=?";
		$query = $this->db->query($traer, [$id]);
		return $query->row();
	}
	public function UpdateTools($datos, $id)
	{
		$this->db->where('idPrin', $id);
		$this->db->update('landingTools', $datos);
	}
	function insertCard($data)
	{
		$this->db->insert('landingCards', $data);
	}
	function insertPay($data)
	{
		$this->db->insert('landingPay', $data);
	}
	function Cards($id)
	{
		$traer = "SELECT * FROM landingCards WHERE idUser=?";
		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	public function insertEmail($data)
	{
		$this->db->insert('landingEmbudo', $data);
	}
	public function UpdatePlanti($datos, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('landingUser', $datos);
	}
	///proceso embudo
	function insertSettEmbu($data)
	{
		$this->db->insert('landingSettEm', $data);
	}
	function ListembudoUsers($id)
	{
		$traer = "SELECT * FROM landingEmbudo WHERE id_user=?";
		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	function Listembudo($id)
	{
		$traer = "SELECT * FROM landingSettEm WHERE idCam=?";
		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	function SaveRegistro($data)
	{
		$this->db->insert('landingRegistroen', $data);
	}
	function Getday($id, $correo)
	{
		$traer = "SELECT count(*) as contar FROM landingRegistroen WHERE dia=? AND correo =?";
		$query = $this->db->query($traer, array($id, $correo));
		return $query->row();
	}
	function Getpaquetes()
	{
		$traer = "SELECT *  FROM landingpaquetes ";
		$query = $this->db->query($traer);
		return $query->result();
	}
	function GetpaquetesNofree()
	{
		$traer = "SELECT *  FROM landingpaquetes where id!=1";
		$query = $this->db->query($traer);
		return $query->result();
	}
	function infoPaquete($id)
	{
		$traer = "SELECT *  FROM landingpaquetes where id=?";
		$query = $this->db->query($traer, $id);
		return $query->row();
	}
	function Searchmsj($id, $dia)
	{
		$traer = "SELECT *  FROM landingSettEm WHERE dia=? AND idCam =?";
		$query = $this->db->query($traer, array($id, $dia));
		return $query->row();
	}
	function DataParametro($id)
	{
		$traer = "SELECT *  FROM parametros_landing WHERE id=?";
		$query = $this->db->query($traer, $id);
		return $query->row();
	}
	function insertvisita($data)
	{
		$this->db->insert('landingVisitas', $data);
	}
	function Countmsj($id)
	{
		$traer = "SELECT count(*) as contar  FROM landingSettEm WHERE idCam=? ";
		$query = $this->db->query($traer, $id);
		return $query->row();
	}
	function InfoPais($id)
	{
		$traer = "SELECT pais,COUNT(*) AS num FROM landingVisitas WHERE idCamp=?";
		$query = $this->db->query($traer, [$id]);
		return $query->result();
	}
	function InfoDetailFull($id, $ciudad)
	{
		$traer = "SELECT departamento,COUNT(*) AS num FROM landingVisitas WHERE idCamp=? AND pais=? GROUP BY departamento";
		$query = $this->db->query($traer, array($id, $ciudad));
		return $query->result();
	}
	function TraerMsj()
	{
		$traer = "SELECT id_user   FROM landingEmbudo WHERE id_user !=1 Group BY id_user";
		$query = $this->db->query($traer);
		return $query->result();
	}
	
}