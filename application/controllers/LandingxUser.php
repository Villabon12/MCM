<?php

defined('BASEPATH') or exit('No direct script access allowed');



class LandingxUser extends CI_Controller

{
	function __construct()

	{
		parent::__construct();
		$this->load->model('model_login');
		$this->load->model('model_errorpage');
	}

	public function landing($id)
	{
		$result['perfil'] = $this->model_login->cargar_datosReferencia($id);
		if (count($result['perfil']) == 1) {
			$this->load->view('landingxuser/template');
		} else {
			$intruso = array(

				'id_usuario' => 0,

				'texto' => 'Landing puzzle',

				'fecha_registro' => date("Y-m-d H:i:s"),

			);

			$this->model_errorpage->insertIntruso($intruso);
			redirect("" . base_url() . "errorpage/error");
		}
	}
} 
?>