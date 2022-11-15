<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Estrategia extends CI_Controller
{



	function __construct()
	{

		parent::__construct();

		$this->load->model('model_login');

		$this->load->model('model_socios');
		$this->load->model('model_proceso');
		$this->load->model('model_servicio');

		$this->load->model('model_errorpage');
	}

	public function index($ban = null)

	{

		if ($this->session->userdata('is_logged_in')) {

			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin') {

				$token = $this->session->userdata('token');
				$result['perfil'] = $this->model_login->cargar_datos();
				$result['manual'] = $this->model_socios->manual();
				$result['automatico'] = $this->model_socios->automatico();
				$result['telegram'] = $this->model_socios->telegram();

				$this->load->view('header_socio', $result);
				$this->load->view('estrategia/view_table', $result);
				$this->load->view('footer_socio', $result);
			} else {

				$intruso = array(

					'id_usuario' => $this->session->userdata('ID'),

					'texto' => 'view_socios',

					'fecha_registro' => date("Y-m-d H:i:s"),

				);

				$this->model_errorpage->insertIntruso($intruso);

				redirect("" . base_url() . "errorpage/error");
			}
		} else {

			redirect("" . base_url() . "login/");
		}
	}

	public function encenderDia($id)
	{
		$data = array(
			"estado" => 1
		);

		$this->model_socios->actualizarDia($data, $id);

		$this->session->set_flashdata('exito', '<div class="alert alert-success text-center"><label class="login__input name">Dia Actualizado</label></div>');
		redirect(base_url()."MCM");
	}

	public function apagarDia($id)
	{
		$data = array(
			"estado" => 0
		);

		$this->model_socios->actualizarDia($data, $id);

		$this->session->set_flashdata('exito', '<div class="alert alert-success text-center"><label class="login__input name">Dia Actualizado</label></div>');
		redirect(base_url()."MCM");
	}

    public function parametros($ban = null)

	{

		if ($this->session->userdata('is_logged_in')) {

			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin') {

				$token = $this->session->userdata('token');
				$result['perfil'] = $this->model_login->cargar_datos();
				$result['manual'] = $this->model_socios->manual();
				$result['automatico'] = $this->model_socios->automatico();
				$result['telegram'] = $this->model_socios->telegram();

				$this->load->view('header_socio', $result);
				$this->load->view('estrategia/view_table', $result);
				$this->load->view('footer_socio', $result);
			} else {

				$intruso = array(

					'id_usuario' => $this->session->userdata('ID'),

					'texto' => 'view_socios',

					'fecha_registro' => date("Y-m-d H:i:s"),

				);

				$this->model_errorpage->insertIntruso($intruso);

				redirect("" . base_url() . "errorpage/error");
			}
		} else {

			redirect("" . base_url() . "login/");
		}
	}
}
