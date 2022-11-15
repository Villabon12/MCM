<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Equipo extends CI_Controller
{



	function __construct()
	{

		parent::__construct();

		$this->load->model('model_login');
		$this->load->model('model_socios');
		$this->load->model('model_errorpage');
		$this->load->model('model_servicio');
		$this->load->model('model_proceso');
	}

	public function index()
	{
		if ($this->session->userdata('is_logged_in')) {

			if ($this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Socio') {
				$perfil = $this->model_login->cargar_datos();
				$principald = $this->model_login->binarioArbolDerecha($perfil->id);
				$principali = $this->model_login->binarioArbolIzquierda($perfil->id);
				if ($perfil->id_derecha != 0) {
					$derecha = $this->model_login->binarioArbolDerecha($principald->r_d);
					$derechai = $this->model_login->binarioArbolIzquierda($principald->r_d);
				}else{
					$derecha = null;
					$derechai = null;
				}
				if ($perfil->id_izquierda != 0) {
					$izquierda = $this->model_login->binarioArbolDerecha($principali->r_d);
					$izquierdad = $this->model_login->binarioArbolIzquierda($principali->r_d);
				}else{
					$izquierda = null;
					$izquierdad = null;
				}
	
				
				$result['principal'] = $principald;
				$result['izquierdap'] = $principali;
				$result['derecha'] = $derecha;
				$result['derechai'] = $derechai;
				$result['izquierda'] = $izquierda;
				$result['izquierdad'] = $izquierdad;

				$result['perfil'] = $perfil;
				$result['team'] = $this->model_socios->cargar_equipo();

				$this->load->view('header_socio', $result);

				$this->load->view('equipo/view_inicio', $result);

				$this->load->view('footer_socio', $result);
			} else {

				$intruso = array(

					'id_usuario' => $this->session->userdata('ID'),

					'texto' => 'Equipo/Inicio',

					'fecha_registro' => date("Y-m-d H:i:s"),

				);

				$this->model_errorpage->insertIntruso($intruso);

				redirect("" . base_url() . "errorpage/error");
			}
		} else {

			redirect("" . base_url() . "login/");
		}
	}

	public function modificarUbica($token)

	{

		$ubica = $this->input->post('ubica');

		if ($ubica == "derecha") {

			$insertar = array("ubicacion" => "izquierda",);
			$this->model_login->updPerfil($insertar, $token);
			$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Cambio exitoso</div>');
			redirect(base_url() . "Equipo", "refresh");
		} else {

			$insertar = array("ubicacion" => "derecha",);
			$this->model_login->updPerfil($insertar, $token);
			$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Cambio exitoso</div>');
			redirect(base_url() . "Equipo", "refresh");
		}
	}

	private function izquierda($id)
	{
		$izquierda = $this->model_login->traerPrueba($id);

		do {

			print_r($izquierda);

			$izquierda = $this->model_login->traerPrueba($izquierda->id_izquierda);
		} while ($izquierda != null);
	}

	private function derecha($id)
	{
		$derecha = $this->model_login->traerPruebaDerecha($id);
		do {
			print_r($derecha);
			$derecha = $this->model_login->traerPruebaDerecha($derecha->id_derecha);
		} while ($derecha != null);
	}

	public function pruebas($id)
	{
		$principald = $this->model_login->binarioArbolDerecha($id);
		$principali = $this->model_login->binarioArbolIzquierda($id);
		$derecha = $this->model_login->binarioArbolDerecha($principald->r_d);
		$derechai = $this->model_login->binarioArbolIzquierda($principald->r_d);
		$izquierda = $this->model_login->binarioArbolDerecha($principali->r_d);
		$izquierdad = $this->model_login->binarioArbolIzquierda($principali->r_d);

		$result['perfil'] = $this->model_login->cargar_datos();
		$result['principal'] = $principald;
		$result['izquierdap'] = $principali;
		$result['derecha'] = $derecha;
		$result['derechai'] = $derechai;
		$result['izquierda'] = $izquierda;
		$result['izquierdad'] = $izquierdad;
		
		$this->load->view('header_socio',$result);
		$this->load->view('prueba',$result);
		$this->load->view('footer_socio',$result);
	}
}
