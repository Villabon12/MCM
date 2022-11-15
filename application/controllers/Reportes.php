<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Reportes extends CI_Controller

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
				$this->load->view('reportes/view_inicio', $result);
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

    public function getData()
	{
		$year = $this->input->post('year');
        $id = $this->input->get('id');
		$resultados = $this->model_reporte->montosMeses($year ,$id);
		echo json_encode($resultados);
	}
}
