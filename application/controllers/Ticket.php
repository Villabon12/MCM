<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Ticket extends CI_Controller

{
	function __construct()

	{

		parent::__construct();
		$this->load->model('model_login');
		$this->load->model('model_reporte');
		$this->load->model('model_servicio');
	}

	public function index($ban = null)

	{

		if ($this->session->userdata('is_logged_in')) {

			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin') {

				$result['perfil'] = $this->model_login->cargar_datos();
				$result['inversion'] = $this->model_reporte->cargarInversion();

				$this->load->view('header_socio', $result);
				$this->load->view('ticket/view_inicio', $result);
				$this->load->view('footer_socio');
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

	public function add()
	{
		$motivo = $this->input->post('motivo');

		$arre = array(
			"estado" => "en proceso",
			"pregunta" => $motivo
		);
		if ($this->model_reporte->insertTicket($arre) == 1) {
			$id = $this->model_reporte->lastID();

			$data = array(
				"ticket_id" => $id,
				"persona_id" => $this->session->userdata('ID'),
				
			);
		}else{
			$this->session->set_flashdata('exito', '<div class="alert alert-danger text-center">Ocurrio un error, revisa tu conexión a internet</div>');
			redirect(base_url() . "Ticket", "refresh");
		}
		
	}

}
