<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Ultra extends CI_Controller

{
	function __construct()

	{

		parent::__construct();
		$this->load->model('model_login');
		$this->load->model('model_reporte');
		$this->load->model('model_servicio');
		$this->load->model('model_ultra');
		$this->load->model('model_proceso');
		$this->load->model('model_errorpage');
		
	}

	public function servicio_binaria($ban = null)

	{

		if ($this->session->userdata('is_logged_in')) {

			if ($this->session->userdata('ROL') == 'Ultra') {

				$result['perfil'] = $this->model_login->cargar_datos();
				$result['binaria'] = $this->model_ultra->traer_usuarios('binaria');
				$result['servicio'] = $this->model_servicio->costos_robot('binaria');
				$idxuser = $this->model_servicio->reportesxuser();
				if (count($idxuser) == 1) {
					$ganancia = $this->model_servicio->ganancia($idxuser->idxuser);
					$perdida = $this->model_servicio->perdida($idxuser->idxuser);
					$valor = $this->model_servicio->comisiones();

					$result['valor'] = number_format($valor->valor + ($ganancia->ganancia - $perdida->perdida), 2);
				} else {
					$ganancia = 0;
					$perdida = 0;
					$valor = $this->model_servicio->comisiones();

					$result['valor'] = number_format($valor->valor + ($ganancia - $perdida), 2);
				}

				$this->load->view('header_socio', $result);
				$this->load->view('servicio/activar_binaria', $result);
                $this->load->view('footer_socio', $result);

			} else {
				$intruso = array(
					'id_usuario' => $this->session->userdata('ID'),
					'texto' => 'Activacion Robot Binaria',
					'fecha_registro' => date("Y-m-d H:i:s"),
				);
				$this->model_errorpage->insertIntruso($intruso);
				redirect("" . base_url() . "errorpage/error");
			}
		} else {
			redirect("" . base_url() . "login/");
		}
	}

	public function activar()
	{
		$servicio = $this->input->post('servicio');
        $servicio = $this->model_proceso->datosTraer($servicio);

		//Activacion del servicio
        $fecha_actual = date("Y-m-d");
        $data5 = array(
            "usuario_id" => $this->input->post('id'),
            "servicio" => $servicio->robot,
            "fecha_compra" => $fecha_actual,
            "activo" => 1,
            "fecha_termina" => date("Y-m-d", strtotime($fecha_actual . " + " . $servicio->dias . " days"))
        );
        $this->model_proceso->activar_servicio($data5);
        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Activacion exitosa</div>');
        redirect(base_url() . "Ultra/servicio_binaria", "refresh");
		
	}

	public function insertReporte()
	{
		$senal = $this->input->post('senal');
		$mercado = $this->input->post('mercado');
		$saldo_inicial = $this->input->post('saldo_inicial');
		$saldo_final = $this->input->post('saldo_final');
		$porcentaje = $this->input->post('porcentaje');
		$precio_entrada = $this->input->post('precio_entrada');
		$precio_salida = $this->input->post('precio_salida');
		$porcentaje_a = $this->input->post('porcentaje_a');
		$tipo = $this->input->post('tipo');
		$estado = $this->input->post('estado');

		$data = array(
			"señal" => $senal,
			"mercado" => $mercado,
			"saldo_inicial" => $saldo_inicial,
			"saldo_final" => $saldo_final,
			"porcentajeregistrado" => $porcentaje,
			"precio_entrada" => $precio_entrada,
			"precio_salida" => $precio_salida,
			"porcentaje_apostado" => $porcentaje_a,
			"tipo" => $tipo,
			"estado" => $estado,
		);

		$this->model_ultra->insertReporte($data);
		$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Insercion exitosa</div>');
        redirect(base_url() . "Binaria/reportesRobot", "refresh");
	}

	public function servicio_arbitraje($ban = null)

	{

		if ($this->session->userdata('is_logged_in')) {

			if ($this->session->userdata('ROL') == 'Ultra') {

				$result['perfil'] = $this->model_login->cargar_datos();
				$result['arbitraje'] = $this->model_ultra->traer_usuarios('arbitraje');
				$result['servicio'] = $this->model_servicio->costos_robot('arbitraje');
				$idxuser = $this->model_servicio->reportesxuser();
				if (count($idxuser) == 1) {
					$ganancia = $this->model_servicio->ganancia($idxuser->idxuser);
					$perdida = $this->model_servicio->perdida($idxuser->idxuser);
					$valor = $this->model_servicio->comisiones();

					$result['valor'] = number_format($valor->valor + ($ganancia->ganancia - $perdida->perdida), 2);
				} else {
					$ganancia = 0;
					$perdida = 0;
					$valor = $this->model_servicio->comisiones();

					$result['valor'] = number_format($valor->valor + ($ganancia - $perdida), 2);
				}

				$this->load->view('header_socio', $result);
				$this->load->view('servicio/activar_arbitraje', $result);
                $this->load->view('footer_socio', $result);

			} else {
				$intruso = array(
					'id_usuario' => $this->session->userdata('ID'),
					'texto' => 'Activacion Robot Arbitraje',
					'fecha_registro' => date("Y-m-d H:i:s"),
				);
				$this->model_errorpage->insertIntruso($intruso);
				redirect("" . base_url() . "errorpage/error");
			}
		} else {
			redirect("" . base_url() . "login/");
		}
	}

	public function activar_arbitraje()
	{
        $servicio = $this->model_proceso->datosTraer(14);

		//Activacion del servicio
        $fecha_actual = date("Y-m-d");
        $data5 = array(
            "usuario_id" => $this->input->post('id'),
            "servicio" => $servicio->robot,
            "fecha_compra" => $fecha_actual,
            "activo" => 1,
            "fecha_termina" => date("Y-m-d", strtotime($fecha_actual . " + " . $servicio->dias . " days"))
        );
        $this->model_proceso->activar_servicio($data5);
        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Activacion exitosa</div>');
        redirect(base_url() . "Ultra/servicio_arbitraje", "refresh");
		
	}

}
