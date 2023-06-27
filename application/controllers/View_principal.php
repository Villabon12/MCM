<?php
defined('BASEPATH') or exit('No direct script access allowed');

class View_principal extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_view_principal');
		$this->load->model('Model_login');
	}

	public function index($ban = null)
	{
		$this->output->set_header('Cache-Control: no-cache, must-revalidate, max-age=0');
		$result['ganancia'] = $this->model_view_principal->cuentasGanancia();
		$this->load->view('view_principal/view', $result);
	}


	public function landing_page_prin()
	{
		$this->load->view('view_principal/landing_page_prin');
	}

	public function landing_page()
	{
		$this->load->view('view_principal/landing_page');
	}

	public function landing_page2()
	{
		$this->load->view('view_principal/landing_page2');
	}

	public function landing_page3()
	{
		$this->load->view('view_principal/landing_page3');
	}

	public function landing_page4()
	{
		$this->load->view('view_principal/landing_page4');
	}

	public function agra()
	{
		$this->load->view('view_principal/agradecimiento');
	}

	public function agra2()
	{
		$this->load->view('view_principal/agradecimiento2');
	}

	public function agra3()
	{
		$this->load->view('view_principal/agradecimiento3');
	}

	public function agra4()
	{
		$this->load->view('view_principal/agradecimiento4');
	}

	public function agra5()
	{
		$this->load->view('view_principal/agradecimiento5');
	}

	public function iq_trading()
	{
		$this->load->view('view_principal/iq_trading');
	}

	public function vista_slider()
	{
		$this->load->view('view_principal/vista_slider');
	}

	public function senales_binarias()
	{
		$this->load->model('Model_view_principal');
		$senales = $this->Model_view_principal->obtener_senales_binarias_historial();
		
		foreach ($senales as &$senal) {
			$fecha_creacion = strtotime($senal['fecha']);
			$minutos_transcurridos = round((time() - $fecha_creacion) / 60);
			$senal['minutos_transcurridos'] = $minutos_transcurridos;
		}
		
		$data['senales'] = $senales;
		$this->load->view('view_principal/senales_binarias', $data);
	}

	public function resumen()
	{
		$this->load->model('Model_view_principal');
		$senales_resumen = $this->Model_view_principal->obtener_senales_binarias_resumen();
		
		foreach ($senales_resumen as &$senal) {
			$fecha_creacion = strtotime($senal['fecha']);
			$minutos_transcurridos = round((time() - $fecha_creacion) / 60);
			$senal['minutos_transcurridos'] = $minutos_transcurridos;
		}
		
		$data['senales'] = $senales_resumen;
		$this->load->view('view_principal/resumen', $data);
	}

	public function calcular()
	{
		$principal = $this->input->post('balance');
		$tiempo = $this->input->post('periodo');
		$tasa_interes = ($this->input->post('ganancia') / 100);
		$principio = $principal;


		for ($i = 1; $i <= $tiempo; $i++) {
			$principal = $principal * (1 + $tasa_interes);
			echo '<tr>';
			echo '<th scope="row">' . $i . '</th>';
			echo '<td>' . $principio . '</td>';
			echo '<td>' . number_format($principal, 2) . '</td>';
			echo '<td>' . number_format(($principal - $principio), 2) . '</td>';
			echo '<td>' . number_format((($principal - $principio) * 100) / ($principio), 2) . '%</td> ';
			echo '</tr>';
		}
	}

	public function campana()
	{

		$perfil = $this->Model_login->cargar_datos();

		$arr = array(

			'idUser' => $perfil->id,

			'campana' => null

		);

		$registro = $this->Model_landingu->insertData($arr);

		$ari = array(

			'idPrin' => $registro,

		);

		$this->Model_landingu->insertDataTools($ari);

		redirect(base_url() . 'view_principal/landing_page/', 'refresh');
	}

	public function make()
	{
		$result['perfil'] = $this->Model_login->cargar_datos();

		$id = $result['perfil']->id;

		$info = $this->Model_landingu->infoUser($id);

		$result['tools'] = $this->Model_landingu->tools($info->id);

		$this->load->view('landingxuser/make', $result);
	}

	public function saveData()
	{
		$perfil = $this->Model_login->cargar_datos();
		$info = $this->Model_landingu->infoUser($perfil->id);

		$postData = $this->input->post();

		$ari = array(
			't1' => $postData['t1'],
			't2' => $postData['t2'],
			't3' => $postData['t3'],
			't4' => $postData['t4'],
			'd1' => $postData['d1'],
			'd2' => $postData['d2'],
			'd3' => $postData['d3'],
		);

		$this->Model_landingu->UpdateTools($ari, $info->id);

		redirect(base_url() . 'LandingUser/make', 'refresh');
	}
}
