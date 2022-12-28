<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Puzzle extends CI_Controller

{
	function __construct()

	{

		parent::__construct();
		$this->load->model('model_login');
		$this->load->model('model_reporte');
		$this->load->model('model_servicio');
		$this->load->model('model_proceso');
		$this->load->model('model_email2');
		$this->load->model('model_puzzle1');
		$this->load->model('model_banco');
		$this->load->model('model_errorpage');
	}

	public function index($ban = null)

	{

		if ($this->session->userdata('is_logged_in')) {

			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin') {
				$token = $this->session->userdata('token');

				$result['perfil'] = $this->model_login->cargar_datos();
				$result['tipo'] = $this->model_puzzle1->cargar_tipo();
				$result['billetera'] = $this->model_proceso->cargar_billetera($token);
				$result['domicilio'] = $this->model_puzzle1->domicilio();

				$this->load->view('header_socio', $result);
				$this->load->view('puzzle/view_tabla', $result);
			} else {
				$intruso = array(
					'id_usuario' => $this->session->userdata('ID'),
					'texto' => 'vista puzzle empresa',
					'fecha_registro' => date("Y-m-d H:i:s"),
				);
				$this->model_errorpage->insertIntruso($intruso);
				redirect("" . base_url() . "errorpage/error");
			}
		} else {
			redirect("" . base_url() . "login/");
		}
	}

	public function comprarPuzzle($token)
	{
		$rompecabeza = $this->input->post('rompecabeza');
		$tipo = $this->input->post('tipo');
		$nota = $this->input->post('nota');
		$direccion = $this->input->post('direccion');
		$municipio = $this->input->post('municipio');
		$domicilio = $this->input->post('domicilio');

		$datos_puzzle = $this->model_puzzle1->cargarP($rompecabeza);
		$datos_tipo = $this->model_puzzle1->cargarT($tipo);
		$datosPersona = $this->model_proceso->consultar_referido($token);
		$billetera_user = $this->model_proceso->cargar_billetera($token);
		$empresa = $this->model_proceso->consultar_referido_niveles(6);

		$total = $datos_puzzle->valor + $datos_tipo->valor;
		$socio1 = $this->model_puzzle1->traer_parametro(5);
		$socio2 = $this->model_puzzle1->traer_parametro(7);
		$repartir1 = $datos_puzzle->valor * $socio1->valor;
		$repartir2 = $datos_puzzle->valor * $socio2->valor;
		$asignacion = $this->model_puzzle1->consultar_puzzle();
		if ($asignacion != false) {

			if ($billetera_user->cuenta_compra >= $total) {
				$data = array(
					"cuenta_compra" => $billetera_user->cuenta_compra - $total,
				);
				$this->model_proceso->actualizar_wallet($data, $billetera_user->token);
				if ($tipo == 1) {
					$papa = $this->model_proceso->consultar_referido_niveles($datosPersona->id_papa_pago);

					//Consultar si tiene papa y pagar
					if (count($papa) == 1) {

						$nivel1 = $this->model_puzzle1->traer_parametro(2);
						$resultado = $repartir1 * $nivel1->valor;

						$billetera_papa = $this->model_proceso->cargar_billetera($papa->token);
						$data1 = array(
							"cuenta_comision" => $billetera_papa->cuenta_comision + $resultado,
						);
						//historial de comisiones
						$pagar = array(
							"usuario_id" => $datosPersona->id,
							"beneficio_id" => $papa->id,
							"valor" => $resultado,
							"servicio" => 'puzzle',
							"detalle" => "compra puzzle"
						);
						$this->model_proceso->historialComisiones($pagar);

						$this->model_proceso->actualizar_wallet($data1, $billetera_papa->token);

						$abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);

						//Consultar si tiene abuelo y pagar
						if (count($abuelo) == 1) {

							$nivel2 = $this->model_puzzle1->traer_parametro(3);
							$resultado2 = $repartir2 * $nivel2->valor;

							$billetera_abuelo = $this->model_proceso->cargar_billetera($abuelo->token);
							$data2 = array(
								"cuenta_comision" => $billetera_abuelo->cuenta_comision + $resultado2,
							);
							$this->model_proceso->actualizar_wallet($data2, $billetera_abuelo->token);
							//Historial de comisiones
							$pagar2 = array(
								"usuario_id" => $datosPersona->id,
								"beneficio_id" => $abuelo->id,
								"valor" => $resultado2,
								"servicio" => 'puzzle',
								"detalle" => "compra puzzle"
							);
							$this->model_proceso->historialComisiones($pagar2);

							$bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);

							// Consultar si tiene bisabuelo y pagar
							if (count($bisabuelo) == 1) {

								$nivel3 = $this->model_puzzle1->traer_parametro(4);
								$resultado3 = $repartir2 * $nivel3->valor;

								$billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
								$data3 = array(
									"cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
								);
								$this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);

								//historial de comisiones
								$pagar3 = array(
									"usuario_id" => $datosPersona->id,
									"beneficio_id" => $bisabuelo->id,
									"valor" => $resultado3,
									"servicio" => 'puzzle',
									"detalle" => "compra puzzle"
								);
								$this->model_proceso->historialComisiones($pagar3);

								//pago empresa
								//AQUI EMPIEZA EL ERRORRRRRS
								$billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
								$data1 = array(
									"cuenta_global" => $billetera_empresa->cuenta_global + $total - $resultado - $resultado2 - $resultado3,
								);
								$this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
								//Compra del puzzle

								$porAcumulado = $this->model_puzzle1->traer_parametro(6);
								$acumulado = $this->model_puzzle1->acumulado();
								$total1 = ($total - $repartir1 - $repartir2 - $datos_tipo->valor);
								$cuentas = array(
									"valor" => $acumulado->valor + $total1
								);
								$historial = array(
									"usuario_id" => $datosPersona->id,
									"descripcion" => "compra",
									"puzzle_id" => $asignacion[0]->id,
									"direccion" => $direccion,
									"nota" => $nota,
									"municipio_id" => $municipio,
									"domicilio_id" => $domicilio
								);
								$this->model_puzzle1->insert_historial($historial);
								$this->model_puzzle1->insert_acumulado($cuentas);
								//Asignacion del puzzle al usuario

								$asiganr = array(
									"asignado" => 1
								);
								$this->model_puzzle1->updateCreacion($asignacion[0]->id, $asiganr);
								$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Compra exitosa</div>');
								redirect(base_url() . "Puzzle", "refresh");
							} else {
								//No tiene paga directo la empresa
								$billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
								$data1 = array(
									"cuenta_global" => $billetera_empresa->cuenta_global + $total - $resultado - $resultado2,
								);
								$this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

								$porAcumulado = $this->model_puzzle1->traer_parametro(6);
								$acumulado = $this->model_puzzle1->acumulado();
								$total1 = ($total - $repartir1 - $repartir2 - $datos_tipo->valor);
								$cuentas = array(
									"valor" => $acumulado->valor + $total1
								);
								$historial = array(
									"usuario_id" => $datosPersona->id,
									"descripcion" => "compra",
									"puzzle_id" => $asignacion[0]->id,
									"direccion" => $direccion,
									"nota" => $nota,
									"municipio_id" => $municipio,
									"domicilio_id" => $domicilio
								);
								$this->model_puzzle1->insert_historial($historial);
								$this->model_puzzle1->insert_acumulado($cuentas);
								//Asignacion del puzzle al usuario

								$asiganr = array(
									"asignado" => 1
								);
								$this->model_puzzle1->updateCreacion($asignacion[0]->id, $asiganr);
								$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Compra exitosa</div>');
								redirect(base_url() . "Puzzle", "refresh");
							}
						} else {
							$billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
							$data1 = array(
								"cuenta_global" => $billetera_empresa->cuenta_global + $total - $resultado,
							);
							$this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

							$porAcumulado = $this->model_puzzle1->traer_parametro(6);
							$acumulado = $this->model_puzzle1->acumulado();
							$total1 = ($total - $repartir1 - $datos_tipo->valor);
							$cuentas = array(
								"valor" => $acumulado->valor + $total1
							);
							$historial = array(
								"usuario_id" => $datosPersona->id,
								"descripcion" => "compra",
								"puzzle_id" => $asignacion[0]->id,
								"direccion" => $direccion,
								"nota" => $nota,
								"municipio_id" => $municipio,
								"domicilio_id" => $domicilio
							);
							$this->model_puzzle1->insert_historial($historial);
							$this->model_puzzle1->insert_acumulado($cuentas);
							//Asignacion del puzzle al usuario

							$asiganr = array(
								"asignado" => 1
							);
							$this->model_puzzle1->updateCreacion($asignacion[0]->id, $asiganr);
							$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Compra exitosa</div>');
							redirect(base_url() . "Puzzle", "refresh");
						}
						//No tiene paga directo la empresa

					} else {

						$billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
						$data1 = array(
							"cuenta_global" => $billetera_empresa->cuenta_global + $total,
						);
						$this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

						$porAcumulado = $this->model_puzzle1->traer_parametro(6);
						$acumulado = $this->model_puzzle1->acumulado();
						$total1 = $total * $porAcumulado->valor;
						$cuentas = array(
							"valor" => $acumulado->valor + $total1
						);
						$historial = array(
							"usuario_id" => $datosPersona->id,
							"descripcion" => "compra",
							"puzzle_id" => $asignacion[0]->id,
							"direccion" => $direccion,
							"nota" => $nota,
							"municipio_id" => $municipio,
							"domicilio_id" => $domicilio
						);
						$this->model_puzzle1->insert_historial($historial);
						$this->model_puzzle1->insert_acumulado($cuentas);
						//Asignacion del puzzle al usuario

						$asiganr = array(
							"asignado" => 1
						);
						$this->model_puzzle1->updateCreacion($asignacion[0]->id, $asiganr);
						$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Compra exitosa</div>');
						redirect(base_url() . "Puzzle", "refresh");
					}
				} else {
					# code...
				}
			} else {
				$this->session->set_flashdata('error', '<div class="alert alert-danger text-center">No tiene dinero suficiente</div>');
				redirect(base_url() . "Puzzle", "refresh");
			};
		} else {
			$this->session->set_flashdata('exito', '<div class="alert alert-danger text-center">No hay puzzle a la venta</div>');
			redirect(base_url() . "Puzzle", "refresh");
		}
	}

	function generateRandomString($length)
	{

		return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
	}

	public function getPuzzle()
	{
		$ciudad = $this->model_puzzle1->cargar_puzzle();
		echo json_encode($ciudad);
	}

	public function getDomicilio()
	{
		$estado = $this->input->post('estado');
		$ciudad = $this->model_login->getCiudad($estado);
		echo json_encode($ciudad);
	}

	public function crearPuzzle()
	{
		$tipo = $this->input->post('tipo');
		$rompecabeza = $this->input->post('rompecabeza');
		$cantidad = $this->input->post('cantidad');

		$datos_puzzle = $this->model_puzzle1->cargarP($rompecabeza);
		$datos_tipo = $this->model_puzzle1->cargarT($tipo);
		for ($i = 0; $i < $cantidad; $i++) {
			$valor = md5($this->generateRandomString(12));
			//Compra del puzzle

			$data = base_url() . "Puzzle/reclamar/$valor";
			$qr = $this->generate_qrcode($data);
			$data5 = array(
				"valor" => $datos_puzzle->valor + $datos_tipo->valor,
				"tipo_puzzle" => $datos_tipo->id,
				"n_ficha" => $datos_puzzle->fichas,
				"enlace" => $data,
				"code_qr" => $qr['file'],
				"codigo" => $valor
			);
			$this->model_puzzle1->comprar_puzzle($data5);
			$this->session->set_flashdata('error', '<div class="alert alert-success text-center">Puzzles Creados</div>');
			redirect(base_url() . "Puzzle/administracion", "refresh");
		}
	}


	function generate_qrcode($data)
	{
		/* Load QR Code Library */
		$this->load->library('ciqrcode');

		/* Data */
		$hex_data   = bin2hex($data);
		$save_name  = $hex_data . '.png';

		/* QR Code File Directory Initialize */
		$dir = 'assets/media/qrcode/';
		if (!file_exists($dir)) {
			mkdir($dir, 0775, true);
		}

		/* QR Configuration  */
		$config['cacheable']    = true;
		$config['imagedir']     = $dir;
		$config['quality']      = true;
		$config['size']         = '1024';
		$config['black']        = array(255, 255, 255);
		$config['white']        = array(255, 255, 255);
		$this->ciqrcode->initialize($config);

		/* QR Data  */
		$params['data']     = $data;
		$params['level']    = 'L';
		$params['size']     = 10;
		$params['savename'] = FCPATH . $config['imagedir'] . $save_name;

		$this->ciqrcode->generate($params);

		/* Return Data */
		$return = array(
			'content' => $data,
			'file'    => $dir . $save_name
		);
		return $return;
	}

	public function reclamar($valor)
	{
		$puzzle = $this->model_puzzle1->comprobar($valor);
		$result['puzzle'] =  $this->model_puzzle1->comprobar($valor);
		if ($puzzle->activo == 1) {
			$this->load->view('puzzle/ruleta_premio', $result);
		} else if ($puzzle->activo == 2) {
			$consultar = $this->model_puzzle1->consultar_p($puzzle->id);
			$user = $this->model_proceso->consultar_referido_niveles($consultar->usuario_id);
			
			$billetera = $this->model_proceso->cargar_billetera($user->token);
			$data1 = array(
				"cuenta_compra" => $billetera->cuenta_compra + ($puzzle->valor * 0.1),
			);

			$this->model_proceso->actualizar_wallet($data1, $billetera->token);

			$data = array(
				"activo" => 0
			);
			$this->model_puzzle1->actualizar($puzzle->id, $data);
			$this->load->view('puzzle/ruleta_premio', $result);
		} else {
			$intruso = array(
				'id_usuario' => $this->session->userdata('ID'),
				'texto' => 'Intento de reclamar premio',
				'fecha_registro' => date("Y-m-d H:i:s"),
			);
			$this->model_errorpage->insertIntruso($intruso);
			redirect("" . base_url() . "errorpage/error");
		}
	}

	public function vincular($valor)
	{
		$cedula = $this->input->post('cedula');
		$usuario = $this->model_errorpage->traerDatos($cedula);
		$puzzle = $this->model_puzzle1->comprobar($valor);

		if ($usuario != false) {
			$vinculo = $this->model_puzzle1->consultar($usuario->id, $puzzle->id);
			if ($vinculo != false) {
				$data2 = array(
					"activo" => 2
				);
				$this->model_puzzle1->actualizar($puzzle->id, $data2);
				redirect(base_url() . "Puzzle/reclamar/" . $valor, "refresh");
			} else {
				$this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Cedula no registra compra</div>');
				redirect(base_url() . "Puzzle/reclamar/" . $valor, "refresh");
			}
		} else {
			$this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Cedula no registrado en el sistema</div>');
			redirect(base_url() . "Puzzle/reclamar/" . $valor, "refresh");
		}
	}

	public function administracion()
	{
		
		if ($this->session->userdata('is_logged_in')) {

			if ($this->session->userdata('ROL') == 'Ultra') {

				$result['perfil'] = $this->model_login->cargar_datos();
				$result['puzzle'] = $this->model_puzzle1->cargar_puzzle_todos();
				$result['compra'] = $this->model_puzzle1->compra();
				$result['tipo'] = $this->model_puzzle1->cargar_puzzle();

				$this->load->view('header_socio', $result);
				$this->load->view('puzzle/view_inicio', $result);
			} else {
				$intruso = array(
					'id_usuario' => $this->session->userdata('ID'),
					'texto' => 'vista puzzle empresa',
					'fecha_registro' => date("Y-m-d H:i:s"),
				);
				$this->model_errorpage->insertIntruso($intruso);
				redirect("" . base_url() . "errorpage/error");
			}
		} else {
			redirect("" . base_url() . "login/");
		}
	}

	public function cambiar($id)
	{
		$data = array(
			"creacion" => 1
		);
		$this->model_puzzle1->actualizar($id,$data);
		$this->session->set_flashdata('error', '<div class="alert alert-success text-center">Puzzles Creados</div>');
		redirect(base_url() . "Puzzle/administracion", "refresh");
	}
	public function cambiar2($id)
	{
		$data = array(
			"vinculado" => 1
		);
		$this->model_puzzle1->actualizarUser($id,$data);
		$this->session->set_flashdata('error', '<div class="alert alert-success text-center">Puzzles Enviados</div>');
		redirect(base_url() . "Puzzle/administracion", "refresh");
	}

	public function acumuladoValor()
	{
		if ($this->session->userdata('is_logged_in')) {

			if ($this->session->userdata('ROL') == 'Ultra') {

				$result['perfil'] = $this->model_login->cargar_datos();
				$result['acumulado'] = $this->model_puzzle1->acumulado();

				$this->load->view('header_socio', $result);
				$this->load->view('puzzle/acumulado', $result);
			} else {
				$intruso = array(
					'id_usuario' => $this->session->userdata('ID'),
					'texto' => 'vista puzzle empresa',
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