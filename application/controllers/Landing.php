<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Landing extends CI_Controller

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

	public function tienda($id)
	{
		$this->load->helper('cookie');

		if (get_cookie('mi_cookie_1') == NULL || get_cookie('mi_cookie_2') == NULL) {
			$valor_cookie1 = 0;
			$valor_cookie2 = 0;
		} else {
			$valor_cookie1 = get_cookie('mi_cookie_1');
			$valor_cookie2 = get_cookie('mi_cookie_2');
		}

		$result['cookie1'] = $valor_cookie1;
		$result['cookie2'] = $valor_cookie2;
		$result['perfil'] = $this->model_login->cargar_datosReferencia($id);
		$result['logueado'] = $this->model_login->cargar_datos();
		$result['dolar'] = $this->model_puzzle1->traer_parametro(9);
		if ($result['perfil']->contar == 1) {
			if ($result['logueado'] == false) {
				$result['billetera'] = 0;
				$result['domicilio'] = $this->model_puzzle1->domicilio();
				$result['tipo'] = $this->model_puzzle1->cargar_tipo();

				$this->load->view('landing/landing_view', $result);
			} else {
				$valor =  $this->model_proceso->cargar_billetera($result['logueado']->token);
				$result['billetera'] = $valor->cuenta_compra;
				$result['domicilio'] = $this->model_puzzle1->domicilio();
				$result['tipo'] = $this->model_puzzle1->cargar_tipo();

				$this->load->view('landing/landing_view', $result);
			}
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

	public function login($id, $valor)
	{
		$result['accion'] = $valor;
		$result['perfil'] = $this->model_login->cargar_datosReferencia($id);
		$result['logueado'] = $this->model_login->cargar_datos();
		$result['pais'] = $this->model_login->traerPais();

		if ($result['perfil']->contar == 1) {

			$result['domicilio'] = $this->model_puzzle1->domicilio();
			$result['tipo'] = $this->model_puzzle1->cargar_tipo();

			$this->load->view('landing/login', $result);
		} else {
			$intruso = array(

				'id_usuario' => 0,

				'texto' => 'Iniciar sesion puzzle',

				'fecha_registro' => date("Y-m-d H:i:s"),

			);

			$this->model_errorpage->insertIntruso($intruso);
			redirect("" . base_url() . "errorpage/error");
		}
	}

	public function registrarNew($idpapa)
	{
		$contrasena = $this->input->post('contrasena');
		$contrasena1 = $this->input->post('contrasena1');
		$nombre = $this->input->post('nombre');
		$apellido = $this->input->post('apellido1');
		$correo = $this->input->post('correo');
		$celular = $this->input->post('celular');
		$user = $this->input->post('user');
		$cedula = $this->input->post('cedula');
		// if (
		// 	//comprobar que no tengan caracter especial
		// 	preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $nombre) && preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $apellido)
		// 	&& preg_match('/^[0-9a-zA-Z]+$/', $user) && preg_match('/^[0-9]+$/', $idpapa)
		// ) {
		if ($contrasena != $contrasena1) {
			$this->session->set_flashdata('error', '<h1 style="color:red;">Contraseña no coinciden</h1>');
			redirect(base_url() . "Landing/login/" . $idpapa."/registrar");
		} else {
			$result = $this->model_login->consultaregistro($user, $cedula, $correo);

			if ($result->contar == 1) { // no se puede registrar

				$this->session->set_flashdata('error', '<h1 style="color:red;"> Registro invalido, ya existen las credenciales</h1>');

				redirect(base_url() . "Landing/login/" . $idpapa);
			} else { // si se puede registrar

				$token = md5($nombre . "+" . $correo);
				$arre = array(
					"token" => $token,
					"nombre" => $nombre,
					"apellido1" => $apellido,
					"correo" => $correo,
					"celular" => $celular,
					"user" => $user,
					"id_papa_pago" => $idpapa,
					"tipo" => "Socio",
					"contrasena" => md5($contrasena),
					"pais_id" => $this->input->post('pais'),
					"ciudad_id" => $this->input->post('ciudad'),
					"cedula" => $cedula,
				);
				if ($this->model_login->registrar($arre) == 1) {
					$datos = array(
						"token" => $this->generateRandomString(25),
						"token_usuario" => $token
					);
					$id = $this->model_login->lastID();
					$this->model_login->insertWallet($datos);

					//aqui buscamos para elegir pierna
					$izquierda = $this->model_login->cargar_datosReferencia($idpapa);
					$estado = $this->model_login->cargar_datosReferencia($idpapa);
					$derecha = $this->model_login->cargar_datosReferencia($idpapa);
					if ($estado->ubicacion == "izquierda") {
						if ($izquierda->id_izquierda == 0) {
							$data = array(
								"id_izquierda" => $id,
							);
							$data2 = array(
								"posicion" => "Izquierda"
							);
							$this->model_login->ModificarDerecha($data, $izquierda->id);
							$this->model_login->ModificarDerecha($data2, $id);
							$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
							redirect(base_url() . "ingreso", "refresh");
						} else if ($izquierda->contar > 1) {
							do {
								if ($izquierda->id_izquierda == 0) {
									$data = array(
										"id_izquierda" => $id,
									);
									$data2 = array(
										"posicion" => "Izquierda"
									);
									$this->model_login->ModificarDerecha($data, $izquierda->id);
									$this->model_login->ModificarDerecha($data2, $id);
									$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
									redirect(base_url() . "ingreso", "refresh");
								}
								$izquierda = $this->model_login->cargar_datosReferencia($izquierda->id_izquierda);
							} while ($izquierda->id_izquierda != null);
						}
					} else {
						if ($derecha->id_derecha == 0) {
							$data = array(
								"id_derecha" => $id,
							);
							$data2 = array(
								"posicion" => "Derecha"
							);
							$this->model_login->ModificarDerecha($data, $derecha->id);
							$this->model_login->ModificarDerecha($data2, $id);
							$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
							redirect(base_url() . "ingreso", "refresh");
						} else {
							do {
								if ($derecha->id_derecha == 0) {
									$data = array(
										"id_derecha" => $id,
									);
									$data2 = array(
										"posicion" => "Derecha"
									);
									$this->model_login->ModificarDerecha($data, $derecha->id);
									$this->model_login->ModificarDerecha($data2, $id);
									$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
									redirect(base_url() . "ingreso", "refresh");
								}
								$derecha = $this->model_login->cargar_datosReferencia($derecha->id_derecha);
							} while ($derecha->id_derecha != null);
						}
					}
					$this->session->set_flashdata('error', '<h1 style="color:green;">Registro exitoso</h1>');
					redirect(base_url() . "Landing/login/" . $idpapa."/ingresar");
				} else {
					$this->session->set_flashdata('error', '<h1 style="color:red;">Un error al guardar</h1>');
					redirect(base_url() . "Landing/login/" . $idpapa."/registrar");
				}
			}
		}
		// } else {
		// 	$this->session->set_flashdata('error', '<div class="alert alert-danger text-center">No se admiten caracteres especiales</div>');
		// 	redirect(base_url() . "login/registrar/".$idpapa, "refresh");
		// }
	}

	function generateRandomString($length)
	{

		return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
	}

	public function validaAcceso($idpapa)
	{

		$user = $this->input->post('user');
		$pass = md5($this->input->post('pass'));

		$result = $this->model_login->consultaUser($user, $pass);

		if ($result->contar == 1) {
			$datos_user = $this->model_login->trae_user($user, $pass);
			$session = array(
				'ID' => $datos_user->id,
				'USUARIO' => $datos_user->correo,
				'NOMBRE' => $datos_user->nombre,
				'APELLIDO' => $datos_user->apellido1,
				'CORREO' => $datos_user->correo,
				'USER' => $datos_user->user,
				'CONTRASENA' => $datos_user->contrasena,
				'ROL' => $datos_user->tipo,
				'token' => $datos_user->token,
				'url_img' => $datos_user->img_perfil,
				'is_logged_in' => TRUE,
			);
			$this->session->set_userdata($session);


			if ($datos_user->tipo == 'Socio' || $datos_user->tipo == 'SocioAdmin' || $datos_user->tipo == 'Ultra') {
				if ($this->session->userdata('is_logged_in')) {
					redirect("" . base_url() . "Rompecabeza/" . $idpapa);
				}
			}

			//

		} else {
			//en caso contrario mostramos el error de usuario o contraseña invalido
			$this->session->set_flashdata('error', '<h1 style="color: red;">Usuario/Contraseña Invalido</h1>');
			redirect("" . base_url() . "Landing/login/$idpapa/registrar");
		}
	}

	public function session_dest($idpapa)
	{
		$session = array(
			'logueado' => FALSE
		);
		$this->session->set_userdata($session);
		$this->session->sess_destroy();
		redirect(base_url() . "Rompecabeza/" . $idpapa);
	}

	public function getValor()
	{
		// Crea una instancia de cURL
		$curl = curl_init();

		// Establece la URL de la API de Open Exchange Rates
		$url = "https://openexchangerates.org/api/latest.json?app_id=2cc97e45031e496289c86529f7c282cd";

		// Establece las opciones de cURL
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		// Ejecuta la solicitud HTTP
		$result = curl_exec($curl);

		// Cierra la conexión de cURL
		curl_close($curl);

		// Decodifica el resultado de la solicitud en formato JSON
		$result = json_decode($result);

		// Ahora puedes utilizar el resultado de la solicitud para obtener el tipo de cambio entre pesos colombianos y dólares estadounidenses
		$rate_usd_to_col = $result->rates->COP;

		$dolar = $this->input->post('id');
		$amount_col = $dolar * $rate_usd_to_col;
		$data = array(
			"valor" => $rate_usd_to_col
		);
		$this->model_puzzle1->actualizarParametro(9, $data);

		$datos = array(
			"imprimir" => number_format($amount_col,0),
			"valor" => $amount_col
		);
		echo json_encode($datos);
	}

	public function comprarPuzzle()
	{
		$token = $this->model_login->cargar_datos();

		$rompecabeza = $this->input->post('rompecabeza');
		$tipo = $this->input->post('tipo');
		$nota = $this->input->post('nota');
		$direccion = $this->input->post('direccion');
		$municipio = $this->input->post('municipio');
		$domicilio = $this->input->post('domicilio');

		$metodo = $this->input->post('metodo');
		$colombia = $this->input->post('colombia');

		$datos_puzzle = $this->model_puzzle1->cargarP($rompecabeza);
		$datos_tipo = $this->model_puzzle1->cargarT($tipo);
		$datosPersona = $this->model_proceso->consultar_referido($token->token);
		$billetera_user = $this->model_proceso->cargar_billetera($token->token);
		$empresa = $this->model_proceso->consultar_referido_niveles(6);

		$total = $datos_puzzle->valor + $datos_puzzle->costo + $datos_puzzle->envio;
		$socio1 = $this->model_puzzle1->traer_parametro(5);
		$socio2 = $this->model_puzzle1->traer_parametro(7);
		$repartir1 = $datos_puzzle->valor * $socio1->valor;
		$repartir2 = $datos_puzzle->valor * $socio2->valor;
		$asignacion = $this->model_puzzle1->consultar_puzzle();

		if ($asignacion != false) {
			if ($metodo == 2) {
				$mi_archivo = 'foto';
				$config['upload_path'] = './assets/img/fotosPerfil/';
				$config['allowed_types'] = "*";
				$config['maintain_ratio'] = TRUE;
				$config['create_thumb'] = FALSE;
				$config['width'] = 800;
				$config['height'] = 800;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload($mi_archivo)) {
					$error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('reco', '');
				} else {
					$data = array("upload_data" => $this->upload->data());
					$imagen = $data['upload_data']['file_name'];
					$data = array(
						"usuario_id" => $datosPersona->id,
						"direccion" => $direccion,
						"nota" => $nota,
						"municipio_id" => $municipio,
						"domicilio_id" => $domicilio,
						"comprobante" => $imagen,
						"pesos" => $colombia,
						"tipo_id" => $tipo,
						"puzzle_id" => $rompecabeza
					);
					if ($this->model_puzzle1->transferencia($data) == 1) {
						$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Compra exitosa</div>');
						redirect(base_url() . "Landing/compraRealizada");
					} else {
						$this->session->set_flashdata('exito', '<div class="alert alert-danger text-center">Error con la imagen</div>');
						redirect(base_url() . "Landing/compraRealizada");
					}
				}
			} else {
				if ($billetera_user->cuenta_compra >= $total) {
					$data = array(
						"cuenta_compra" => $billetera_user->cuenta_compra - $total,
					);
					$this->model_proceso->actualizar_wallet($data, $billetera_user->token);
					if ($tipo == 1) {
						$papa = $this->model_proceso->consultar_referido_niveles($datosPersona->id_papa_pago);
						$pagarPapa = $this->model_puzzle1->confirmarPago($datosPersona->id_papa_pago);

						//Consultar si tiene papa y pagar
						if ($papa != false && $pagarPapa != false) {

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
							$pagarAbuelo = $this->model_puzzle1->confirmarPago($papa->id_papa_pago);

							//Consultar si tiene abuelo y pagar
							if ($abuelo != false && $pagarAbuelo != false) {

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
								$pagarBisabuelo = $this->model_puzzle1->confirmarPago($abuelo->id_papa_pago);


								// Consultar si tiene bisabuelo y pagar
								if ($bisabuelo != false && $pagarBisabuelo != false) {

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
									$total1 = ($total - $repartir1 - $repartir2 - $datos_puzzle->costo - $datos_puzzle->envio);
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
									redirect(base_url() . "Landing/compraRealizada");
								} else if ($bisabuelo != false && $pagarBisabuelo == false) {
									//pago empresa
									//AQUI EMPIEZA EL ERRORRRRRS
									$billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
									$data1 = array(
										"cuenta_global" => $billetera_empresa->cuenta_global + $total - $resultado - $resultado2,
									);
									$this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
									//Compra del puzzle

									$porAcumulado = $this->model_puzzle1->traer_parametro(6);
									$acumulado = $this->model_puzzle1->acumulado();
									$total1 = ($total - $repartir1 - $repartir2 - $datos_puzzle->costo - $datos_puzzle->envio);
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
									redirect(base_url() . "Landing/compraRealizada");
								} else {
									//No tiene paga directo la empresa
									$billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
									$data1 = array(
										"cuenta_global" => $billetera_empresa->cuenta_global + $total - $resultado - $resultado2,
									);
									$this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

									$porAcumulado = $this->model_puzzle1->traer_parametro(6);
									$acumulado = $this->model_puzzle1->acumulado();
									$total1 = ($total - $repartir1 - $repartir2 - $datos_puzzle->costo - $datos_puzzle->envio);
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
									redirect(base_url() . "Landing/compraRealizada");
								}
							} else if ($abuelo != false && $pagarAbuelo == false) {

								$bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
								$pagarBisabuelo = $this->model_puzzle1->confirmarPago($abuelo->id_papa_pago);


								// Consultar si tiene bisabuelo y pagar
								if ($bisabuelo != false && $pagarBisabuelo != false) {

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
										"cuenta_global" => $billetera_empresa->cuenta_global + $total - $resultado - $resultado3,
									);
									$this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
									//Compra del puzzle

									$porAcumulado = $this->model_puzzle1->traer_parametro(6);
									$acumulado = $this->model_puzzle1->acumulado();
									$total1 = ($total - $repartir1 - $repartir2 - $datos_puzzle->costo - $datos_puzzle->envio);
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
									redirect(base_url() . "Landing/compraRealizada");
								} else if ($bisabuelo != false && $pagarBisabuelo == false) {
									//pago empresa
									//AQUI EMPIEZA EL ERRORRRRRS
									$billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
									$data1 = array(
										"cuenta_global" => $billetera_empresa->cuenta_global + $total - $resultado,
									);
									$this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
									//Compra del puzzle

									$porAcumulado = $this->model_puzzle1->traer_parametro(6);
									$acumulado = $this->model_puzzle1->acumulado();
									$total1 = ($total - $repartir1 - $repartir2 - $datos_puzzle->costo - $datos_puzzle->envio);
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
									redirect(base_url() . "Landing/compraRealizada");
								} else {
									//No tiene paga directo la empresa
									$billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
									$data1 = array(
										"cuenta_global" => $billetera_empresa->cuenta_global + $total - $resultado,
									);
									$this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

									$porAcumulado = $this->model_puzzle1->traer_parametro(6);
									$acumulado = $this->model_puzzle1->acumulado();
									$total1 = ($total - $repartir1 - $repartir2 - $datos_puzzle->costo - $datos_puzzle->envio);
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
									redirect(base_url() . "Landing/compraRealizada");
								}
							} else {
								$billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
								$data1 = array(
									"cuenta_global" => $billetera_empresa->cuenta_global + $total - $resultado,
								);
								$this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

								$porAcumulado = $this->model_puzzle1->traer_parametro(6);
								$acumulado = $this->model_puzzle1->acumulado();
								$total1 = ($total - $repartir1 - $datos_puzzle->costo - $datos_puzzle->envio);
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
								redirect(base_url() . "Landing/compraRealizada");
							}
							//No tiene paga directo la empresa

						} else if ($papa != false && $pagarPapa == false) {
							$abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);
							$pagarAbuelo = $this->model_puzzle1->confirmarPago($papa->id_papa_pago);

							//Consultar si tiene abuelo y pagar
							if ($abuelo != false && $pagarAbuelo != false) {

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
								$pagarBisabuelo = $this->model_puzzle1->confirmarPago($abuelo->id_papa_pago);


								// Consultar si tiene bisabuelo y pagar
								if ($bisabuelo != false && $pagarBisabuelo != false) {

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
										"cuenta_global" => $billetera_empresa->cuenta_global + $total - $resultado2 - $resultado3,
									);
									$this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
									//Compra del puzzle

									$porAcumulado = $this->model_puzzle1->traer_parametro(6);
									$acumulado = $this->model_puzzle1->acumulado();
									$total1 = ($total - $repartir1 - $repartir2 - $datos_puzzle->costo - $datos_puzzle->envio);
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
									redirect(base_url() . "Landing/compraRealizada");
								} else if ($bisabuelo != false && $pagarBisabuelo == false) {
									//pago empresa
									//AQUI EMPIEZA EL ERRORRRRRS
									$billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
									$data1 = array(
										"cuenta_global" => $billetera_empresa->cuenta_global + $total - $resultado2,
									);
									$this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
									//Compra del puzzle

									$porAcumulado = $this->model_puzzle1->traer_parametro(6);
									$acumulado = $this->model_puzzle1->acumulado();
									$total1 = ($total - $repartir1 - $repartir2 - $datos_puzzle->costo - $datos_puzzle->envio);
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
									redirect(base_url() . "Landing/compraRealizada");
								} else {
									//No tiene paga directo la empresa
									$billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
									$data1 = array(
										"cuenta_global" => $billetera_empresa->cuenta_global + $total - $resultado2,
									);
									$this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

									$porAcumulado = $this->model_puzzle1->traer_parametro(6);
									$acumulado = $this->model_puzzle1->acumulado();
									$total1 = ($total - $repartir1 - $repartir2 - $datos_puzzle->costo - $datos_puzzle->envio);
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
									redirect(base_url() . "Landing/compraRealizada");
								}
							} else if ($abuelo != false && $pagarAbuelo == false) {

								$bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
								$pagarBisabuelo = $this->model_puzzle1->confirmarPago($abuelo->id_papa_pago);


								// Consultar si tiene bisabuelo y pagar
								if ($bisabuelo != false && $pagarBisabuelo != false) {

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
										"cuenta_global" => $billetera_empresa->cuenta_global + $total - $resultado3,
									);
									$this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
									//Compra del puzzle

									$porAcumulado = $this->model_puzzle1->traer_parametro(6);
									$acumulado = $this->model_puzzle1->acumulado();
									$total1 = ($total - $repartir1 - $repartir2 - $datos_puzzle->costo - $datos_puzzle->envio);
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
									redirect(base_url() . "Landing/compraRealizada");
								} else if ($bisabuelo != false && $pagarBisabuelo == false) {
									//pago empresa
									//AQUI EMPIEZA EL ERRORRRRRS
									$billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
									$data1 = array(
										"cuenta_global" => $billetera_empresa->cuenta_global + $total,
									);
									$this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
									//Compra del puzzle

									$porAcumulado = $this->model_puzzle1->traer_parametro(6);
									$acumulado = $this->model_puzzle1->acumulado();
									$total1 = ($total - $repartir1 - $repartir2 - $datos_puzzle->costo - $datos_puzzle->envio);
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
									redirect(base_url() . "Landing/compraRealizada");
								} else {
									//No tiene paga directo la empresa
									$billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
									$data1 = array(
										"cuenta_global" => $billetera_empresa->cuenta_global + $total,
									);
									$this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

									$porAcumulado = $this->model_puzzle1->traer_parametro(6);
									$acumulado = $this->model_puzzle1->acumulado();
									$total1 = ($total - $repartir1 - $repartir2 - $datos_puzzle->costo - $datos_puzzle->envio);
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
									redirect(base_url() . "Landing/compraRealizada");
								}
							} else {
								$billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
								$data1 = array(
									"cuenta_global" => $billetera_empresa->cuenta_global + $total,
								);
								$this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

								$porAcumulado = $this->model_puzzle1->traer_parametro(6);
								$acumulado = $this->model_puzzle1->acumulado();
								$total1 = ($total - $repartir1 - $datos_puzzle->costo - $datos_puzzle->envio);
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
								redirect(base_url() . "Landing/compraRealizada");
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
							redirect(base_url() . "Landing/compraRealizada");
						}
					} else {
						# code...
					}
				} else {
					$this->session->set_flashdata('error', '<div class="alert alert-danger text-center">No tiene dinero suficiente</div>');
					redirect(base_url() . "Rompecabeza/" . $datosPersona->id_papa_pago);
				};
			}
		} else {
			$this->session->set_flashdata('exito', '<div class="alert alert-danger text-center">No hay puzzle a la venta</div>');
			redirect(base_url() . "Rompecabeza/" . $datosPersona->id_papa_pago);
		}
	}

	public function compraRealizada()
	{
		$this->load->view('landing/compra');
	}

	public function redireccionamiento($id)
	{
		$valor1 = $this->input->post('tipo');
		$valor2 = $this->input->post('rompecabeza');

		$this->load->helper('cookie');

		$cookie_1 = array(
			'name'   => 'mi_cookie_1',
			'value'  => $valor1,
			'expire' => 86400,
		);

		$cookie_2 = array(
			'name'   => 'mi_cookie_2',
			'value'  => $valor2,
			'expire' => 86400,
		);

		set_cookie($cookie_1);
		set_cookie($cookie_2);

		redirect(base_url() . "Landing/login/" . $id."/registrar");
	}
}
