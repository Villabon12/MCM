<?php
defined('BASEPATH') or exit('No direct script access allowed');

class login extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('model_login');
		$this->load->model('model_socios');
		$this->load->model('model_errorpage');
	}

	public function index($ban = null)
	{
		$result['usuario'] = $this->model_login->agrupar();
		$this->load->view('view_tiindo', $result);
	}

	public function ingreso($ban = null)
	{
		$this->load->view('view_login', $ban);
	}

	public function registrar($idpapa)
	{
		$result['pais'] = $this->model_login->traerPais();
		$result['perfil'] = $this->model_login->cargar_datosReferencia($idpapa);
		if (count($result['perfil']) == 1) {
			$this->load->view('view_registro', $result);
		} else {
			$intruso = array(

				'id_usuario' => 0,

				'texto' => 'registro comercio',

				'fecha_registro' => date("Y-m-d H:i:s"),

			);

			$this->model_errorpage->insertIntruso($intruso);
			redirect("" . base_url() . "errorpage/error");
		}
	}

	public function getCiudad()
	{
		$id = $this->input->post("id");
		$ciudad = $this->model_login->getCiudad($id);
		echo json_encode($ciudad);
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
				$this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Contraseña no coinciden</label></div>');
				redirect(base_url() . "login/registrar/".$idpapa);
			} else {
				$result = $this->model_login->consultaregistro($user, $cedula, $correo);

				if ($result->contar == 1) { // no se puede registrar

					$this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name" style="color:black;"> Registro invalido, ya existen las credenciales</label></div>');

					redirect(base_url() . "login/registrar/".$idpapa);
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
								$this->model_login->ModificarDerecha($data, $izquierda->id);
								$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
								redirect(base_url() . "ingreso", "refresh");
							} else if (count($izquierda) > 1) {
								do {
									if ($izquierda->id_izquierda == 0) {
										$data = array(
											"id_izquierda" => $id,
										);
										$this->model_login->ModificarDerecha($data, $izquierda->id);
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
								$this->model_login->ModificarDerecha($data, $derecha->id);
								$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
								redirect(base_url() . "ingreso", "refresh");
							} else {
								do {
									if ($derecha->id_derecha == 0) {
										$data = array(
											"id_derecha" => $id,
										);
										$this->model_login->ModificarDerecha($data, $derecha->id);
										$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
										redirect(base_url() . "ingreso", "refresh");
									}
									$derecha = $this->model_login->cargar_datosReferencia($derecha->id_derecha);
								} while ($derecha->id_derecha != null);
							}
						}
						$this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
						redirect(base_url() . "ingreso", "refresh");
					} else {
						$this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Un error al guardar intente nuevamente</div>');
						redirect(base_url() . "login/registrar/".$idpapa, "refresh");
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

	// public function actualiza_contra()
	// {
	// 	$code = $this->input->post('code');
	// 	$pdw1 = $this->input->post('pwd1');
	// 	$pwd2 = $this->input->post('pwd2');

	// 	$result = $this->model_login->verifica_code($code);
	// 	if (count($result) >= 1) {
	// 		$fecha_caduca = $result->fecha_caduda_cod;
	// 		$fecha_actual = date("Y-m-d H:i:s");

	// 		$date1 = new DateTime($fecha_caduca);
	// 		$date2 = new DateTime($fecha_actual);
	// 		$diff = $date1->diff($date2);

	// 		if ($diff->hours <= 30) {
	// 			$acMasterUser = array(
	// 				"contrasena"		=> md5($pwd2),
	// 			);
	// 			$id_trans = $this->model_login->actuliza_pass($acMasterUser, $result->id);
	// 			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">se cambió la contraseña correctamente</div>');
	// 			redirect(base_url() . "login/");
	// 		} else {
	// 			$this->session->set_flashdata('reco', '<div class="alert alert-danger text-center">verifica tu código</div>');
	// 			redirect(base_url() . "login/cambio_contra");
	// 		}
	// 	}
	// }

	// public function cambio_contra()
	// {
	// 	$this->load->view('view_cambio_contrasena');
	// }

	// public function recupera_contra()
	// {
	// 	$this->load->view('view_olvide_contrasena');
	// }
	// public function valida_recuperar()
	// {

	// 	$user = $this->input->post('user');
	// 	$result = $this->model_login->consultaSolouser($user);

	// 	if (count($result) >= 1) {

	// 		$codseguridad = $this->generateRandomString(6);
	// 		$fecha_vence = date("Y-m-d H:i:s");
	// 		$fecha_vence = strtotime('+30 minute', strtotime($fecha_vence));

	// 		$acMasterUser = array(
	// 			"cod_Cambio"						=> $codseguridad,
	// 			"fecha_caduca_cod"			=> date('Y-m-d H:i:s', $fecha_vence),
	// 		);
	// 		$id_trans = $this->model_login->actuliza_cod($acMasterUser, $result->id);
	// 		$this->model_email->correo_cambio_contra($result->correo, $codseguridad);
	// 		$this->model_email->envio_correos_pendientes_bd();
	// 		$this->session->set_flashdata('reco', '<div class="alert alert-success text-center">Ingresa a tu e-email, en máximo 5 minutos llegará un correo con el código para poder cambiar</div>');
	// 		redirect(base_url() . "login/cambio_contra");
	// 	} else {
	// 		//en caso contrario mostramos el error de usuario o contraseña invalido
	// 		$this->session->set_flashdata('reco', '<div class="alert alert-danger text-center">usuario o email no existe</div>');
	// 		redirect(base_url() . "login/recupera_contra");
	// 	}
	// }

	// public function valida_rechaso()
	// {

	// 	$user = $this->input->post('user');
	// 	$result = $this->model_login->consultaSolouser($user);

	// 	if (count($result) >= 1) {

	// 		$codseguridad = $this->generateRandomString(6);
	// 		$fecha_vence = date("Y-m-d H:i:s");
	// 		$fecha_vence = strtotime('+30 minute', strtotime($fecha_vence));

	// 		$acMasterUser = array(
	// 			"cod_Cambio"						=> $codseguridad,
	// 			"fecha_caduca_cod"			=> date('Y-m-d H:i:s', $fecha_vence),
	// 		);
	// 		$id_trans = $this->model_login->actuliza_cod($acMasterUser, $result->id);
	// 		$this->model_email->correo_cambio_contra($result->correo, $codseguridad);
	// 		$this->model_email->envio_correos_pendientes_bd();
	// 		$this->session->set_flashdata('reco', '<div class="alert alert-success text-center">Ingresa a tu e-email, en máximo 5 minutos llegará un correo con el código para poder cambiar</div>');
	// 		redirect(base_url() . "login/cambio_contra");
	// 	} else {
	// 		//en caso contrario mostramos el error de usuario o contraseña invalido
	// 		$this->session->set_flashdata('reco', '<div class="alert alert-danger text-center">usuario o email no existe</div>');
	// 		redirect(base_url() . "login/recupera_contra");
	// 	}
	// }


	public function validaAcceso()
	{

		$user = $this->input->post('user');
		$pass = md5($this->input->post('pass'));

		$result = $this->model_login->consultaUser($user, $pass);

		if (
			$result->contar == 1
		) {
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
					redirect("" . base_url() . "MCM");
				}
			}

			//

		} else {
			//en caso contrario mostramos el error de usuario o contraseña invalido
			$this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Usuario/Contraseña Invalido</div>');
			redirect("" . base_url() . "ingreso");
		}
	}

	public function session_dest()
	{
		$session = array(
			'logueado' => FALSE
		);
		$this->session->set_userdata($session);
		$this->session->sess_destroy();
		redirect(base_url());
	}


	public function validarCorreo()
	{
		$email = $this->input->post('email');

		$consulta = $this->model_errorpage->verificarEmail($email);

		if ($consulta->contar == 1) {
			echo "Correo ya usado, elige otro";
		} else {
			echo "";
		}
	}
	public function validarUser()
	{
		$usuario = $this->input->post('usuario');

		$consulta = $this->model_errorpage->verificarUsuario($usuario);

		if ($consulta->contar == 1) {
			echo "Usuario ya usado, elige otro";
		} else {
			echo "";
		}
	}
}
