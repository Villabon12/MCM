<?php
use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class LinkTree extends CI_Controller
{

	//metodo contructor 

	function __construct()
	{
		parent::__construct();
		$this->load->model('Model_login');
		$this->load->model('model_servicio');
		$this->load->model('Model_email');
		$this->load->model('Model_linkTree');
		$this->load->model('model_proceso');
		$this->load->model('model_banco');
	}
	public function choose()
	{
		$result['perfil'] = $this->Model_login->cargar_datos();
		$result['plantillas'] = $this->Model_linkTree->getTemplate();
		$idxuser = $this->model_servicio->reportesxuser();
		if ($idxuser != false) {
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
		$this->load->view('linkTree/home', $result);
		$this->load->view('footer_socio', $result);

	}

	function generateRandomString($length)
	{
		return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
	}



	///cargar vistas

	public function viewPlantilla($id)
	{
		if ($id == 1) {
			$this->load->view('plantillas/Cap1');
		} else if ($id == 2) {
			$this->load->view('plantillas/Cap2');
		} else if ($id == 3) {
			$this->load->view('plantillas/Cap3');
		} else if ($id == 4) {
			$this->load->view('plantillas/Cap4');
		} else {
			$this->load->view('plantillas/Cap5');
		}
	}

	public function making($id_pant)
	{
		$result['perfil'] = $this->Model_login->cargar_datos();
		$id = $result['perfil']->id;
		$result['contar'] = $this->Model_linkTree->conteoRedes($id);
		$result['links'] = $this->Model_linkTree->traerData($id);
		$result['id_plan'] = $id_pant;
		$result['sett'] = $this->Model_linkTree->personalizacion($id);
		$result['plantillas'] = $this->Model_linkTree->getTemplate();
		$result['get'] = $this->Model_linkTree->Getboton();
		$result['editar'] = true;

		if ($id_pant == 1) {
			$result['contenido'] = 'plantillasUser/Cap1';
		} else if ($id_pant == 2) {
			$result['contenido'] = 'plantillasUser/Cap2';
		} else if ($id_pant == 3) {
			$result['contenido'] = 'plantillasUser/Cap3';
		} else if ($id_pant == 4) {
			$result['contenido'] = 'plantillasUser/Cap4';
		} else if ($id_pant == 5) {
			$result['contenido'] = 'plantillasUser/Cap5';
		} else {
			$result['contenido'] = 'perfil2/perfil2';
		}

		$count = $this->Model_linkTree->countUser($id);
		if ($count->contar == 0) {
			$arre = array(
				"id_usuario" => $id,
			);
			$this->Model_linkTree->insertUser($arre);
			$result['sett'] = $this->Model_linkTree->personalizacion($id);
			$this->load->view('linkTree/make', $result);
		} else {
			$result['sett'] = $this->Model_linkTree->personalizacion($id);
			$this->load->view('linkTree/make', $result);
		}

	}
	public function apariencia($id_pant)
	{
		$result['perfil'] = $this->Model_login->cargar_datos();
		$id = $result['perfil']->id;
		$result['links'] = $this->Model_linkTree->traerData($id);
		$result['id_plan'] = $id_pant;
		$result['sett'] = $this->Model_linkTree->personalizacion($id);
		$result['plantillas'] = $this->Model_linkTree->getTemplate();
		$result['get'] = $this->Model_linkTree->Getboton();
		$result['editar'] = true;
		$dataTem = $this->Model_linkTree->infoTemplate($id_pant);

		if ($dataTem->type == 1) {
			$result['paquetes'] = $this->Model_linkTree->PaqueteFull();
		} else {
			$result['paquetes'] = $this->Model_linkTree->PaquetePro();
		}


		if ($id_pant == 1) {
			$result['contenido'] = 'plantillasUser/Cap1';
		} else if ($id_pant == 2) {
			$result['contenido'] = 'plantillasUser/Cap2';
		} else if ($id_pant == 3) {
			$result['contenido'] = 'plantillasUser/Cap3';
		} else if ($id_pant == 4) {
			$result['contenido'] = 'plantillasUser/Cap4';
		} else if ($id_pant == 5) {
			$result['contenido'] = 'plantillasUser/Cap5';
		} else {
			$result['contenido'] = 'perfil2/perfil2';
		}

		$count = $this->Model_linkTree->countUser($id);
		if ($count->contar == 0) {
			$arre = array(
				"id_usuario" => $id,
			);
			$this->Model_linkTree->insertUser($arre);
			$result['sett'] = $this->Model_linkTree->personalizacion($id);
			$this->load->view('linkTree/apariencia', $result);
		} else {
			$result['sett'] = $this->Model_linkTree->personalizacion($id);
			$this->load->view('linkTree/apariencia', $result);
		}

	}
	public function estadisticas($id_pant)
	{
		$result['perfil'] = $this->Model_login->cargar_datos();
		$result['id_plan'] = $id_pant;
		$result['sett'] = $this->Model_linkTree->personalizacion($result['perfil']->id);
		$result['sett2'] = $this->Model_linkTree->dataAnali($result['perfil']->id);
		$result['general'] = $this->Model_linkTree->InfoDetailGe($result['perfil']->id);
		$this->load->view('linkTree/analisis', $result);
	}

	public function saveData($id)
	{
		$red = $this->input->post('red');
		$perfil = $this->Model_login->cargar_datos();
		$link = $this->input->post('enlace');
		$infoBoton = $this->Model_linkTree->DataBoton($red);
		$nombreLink = $this->input->post('nombreLink');


		$consulta = $this->validaLink($red, $link);
		$contarLi = $this->Model_linkTree->conteoRedes($perfil->id);
		$infoUser = $this->Model_linkTree->personalizacion($perfil->id);

		if ($consulta == true) {
			if ($red == 4) {
				$enlace = "https://wa.me/57" . $link;
			} else {
				$enlace = $link;
			}
		} else {
			$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex  " style="width: 50%;"> Error al subir link,No coinciden con el tipo de link seleccionado</div></center>');
			redirect(base_url() . 'LinkTree/making/' . $id, 'refresh');
		}
		if ($infoUser->id_plan == null || $infoUser->id_plan == 1) {
			if ($contarLi->contar < 3) {
				if ($nombreLink == null) {
					$ar = array(
						"id_red" => $red,
						"enlace" => $enlace,
						"id_usuario" => $perfil->id,
						"nombreRed" => $infoBoton->nombre_boton,
						"tipo" => 2,
					);
				} else {
					$ar = array(
						"id_red" => $red,
						"enlace" => $enlace,
						"id_usuario" => $perfil->id,
						"nombreRed" => $nombreLink,
						"tipo" => 2,
					);
				}
				$this->Model_linkTree->insertData($ar);
				redirect(base_url() . 'LinkTree/making/' . $id, 'refresh');
			} else {
				$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex  " style="width: 50%;"> Error al subir link,Cupo maximo de links</div></center>');
				redirect(base_url() . 'LinkTree/making/' . $id, 'refresh');
			}
		} else if ($infoUser->id_plan == 2) {
			if ($contarLi->contar < 5) {
				if ($nombreLink == null) {
					$ar = array(
						"id_red" => $red,
						"enlace" => $enlace,
						"id_usuario" => $perfil->id,
						"nombreRed" => $infoBoton->nombre_boton,
						"tipo" => 2,
					);
				} else {
					$ar = array(
						"id_red" => $red,
						"enlace" => $enlace,
						"id_usuario" => $perfil->id,
						"nombreRed" => $nombreLink,
						"tipo" => 2,
					);
				}
				$this->Model_linkTree->insertData($ar);
				redirect(base_url() . 'LinkTree/making/' . $id, 'refresh');
			} else {
				$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex  " style="width: 50%;"> Error al subir link,Cupo maximo de links</div></center>');
				redirect(base_url() . 'LinkTree/making/' . $id, 'refresh');
			}
		} else {
			if ($nombreLink == null) {
				$ar = array(
					"id_red" => $red,
					"enlace" => $enlace,
					"id_usuario" => $perfil->id,
					"nombreRed" => $infoBoton->nombre_boton,
					"tipo" => 2,
				);
			} else {
				$ar = array(
					"id_red" => $red,
					"enlace" => $enlace,
					"id_usuario" => $perfil->id,
					"nombreRed" => $nombreLink,
					"tipo" => 2,
				);
			}
			$this->Model_linkTree->insertData($ar);
			redirect(base_url() . 'LinkTree/making/' . $id, 'refresh');
		}

	}

	public function validaLink($red, $link)
	{
		switch ($red) {
			case 1:
				if (preg_match('#https://www.instagram.com/#', $link)) {
					return true;
				} else {
					return false;
				}
				break;
			case 2:
				if (preg_match('#https://www.facebook.com/#', $link)) {
					return true;
				} else {
					return false;
				}
				break;
			case 3:
				if (preg_match('#https://twitter.com/#', $link)) {
					return true;
				} else {
					return false;
				}
				break;
			case 4:
				if (preg_match('/3/', $link)) {
					return true;
				} else {
					return false;
				}
				break;
			case 5:
				return true;
				break;
			case 6:
				if (preg_match('#https://vm.tiktok.com/#', $link)) {
					return true;
				} else {
					return false;
				}
				break;
			case 8:
				if (preg_match('#https://www.linkedin.com/in/#', $link)) {
					return true;
				} else {
					return false;
				}
				break;
			case 9:
				if (preg_match('#https://github.com/#', $link)) {
					return true;
				} else {
					return false;
				}
				break;
			case 10:
				return true;
				break;
			case 11:
				if (preg_match('#https://co.pinterest.com/#', $link)) {
					return true;
				} else {
					return false;
				}
				break;
			case 15:
				if (preg_match('#https://#', $link)) {
					return true;
				} else {
					return false;
				}
			default:
				echo "Tipo de link invalido";
				return false;
				break;
		}
	}
	public function savePhoto($id_plan)
	{
		$perfil = $this->Model_login->cargar_datos();
		$id = $perfil->id;
		$mi_archivo = 'img';
		$config['upload_path'] = './reTemplate/imagenes/';
		$config['allowed_types'] = "jpg|png|jpeg";
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = FALSE;
		$config['width'] = 800;
		$config['height'] = 800;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($mi_archivo)) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center  d-flex" style="width: 1000px;"> Error a subir foto</div></center>');
			redirect(base_url() . 'LinkTree/apariencia/' . $id_plan, 'refresh');
		} else {
			$data = array("upload_data" => $this->upload->data());
			$imagen = $data['upload_data']['file_name'];
			$aru = array(
				"img_perfil" => $imagen,
			);
			$this->Model_linkTree->UpdatePeronali($aru, $id);
			redirect(base_url() . 'LinkTree/apariencia/' . $id_plan, 'refresh');
		}
	}
	public function Updatedata($id_plan)
	{
		$descripcion = $this->input->post('descripcion');
		$profesion = $this->input->post('profesion');
		$datos = $this->Model_login->cargar_datos();
		$id = $datos->id;
		if ($descripcion != null) {
			$data = array(
				"descripcion" => $descripcion,
			);
		} else {
			$data = array(
				"profesion" => $profesion,
			);
		}
		$this->Model_linkTree->UpdatePeronali($data, $id);
		redirect(base_url() . 'LinkTree/making/' . $id_plan, 'refresh');

	}
	public function UpdateColor($id_plan)
	{
		$color = $this->input->post('color');
		$data = array(
			"colorBoton" => $color,
		);
		$datos = $this->Model_login->cargar_datos();
		$id = $datos->id;
		$this->Model_linkTree->UpdatePeronali($data, $id);
		redirect(base_url() . 'LinkTree/apariencia/' . $id_plan, 'refresh');
	}
	public function infoCiudad()
	{
		$ciudad = $this->input->post('id');
		$datos = $this->Model_login->cargar_datos();
		$infoTemplate = $this->Model_linkTree->InfoDetailFull($datos->id, $ciudad);
		echo json_encode($infoTemplate);
	}
	public function infoLink()
	{
		$id = $this->input->post('id');
		$infoTemplate = $this->Model_linkTree->infoLink($id);
		echo json_encode($infoTemplate);
	}

	//Funciones de compra de plantillas	
	public function PayTemplate($id_plan, $id_temple)
	{
		$result['perfil'] = $this->Model_login->cargar_datos();
		$countLink = $this->Model_linkTree->conteoRedes($result['perfil']->id);
		$vence = null;
		if ($id_plan != 1) {
			$this->CompraTemplate($id_plan, $id_temple);
		} else {
			if ($countLink->contar <= 3) {

				$url = "www.myconnectmind.com/MCMLink/" . $result['perfil']->user;
				//generacion codigo QR

				$qr = $this->generate_qrcode($url);
				$ari = array(
					"url" => $url,
					"id_template" => $id_temple,
					"estado" => 1,
					"id_plan" => $id_plan,
					"qr" => $qr['file'],
				);
				$this->Model_linkTree->UpdatePeronali($ari, $result['perfil']->id);
				$arre = array(
					"id_user" => $result['perfil']->id,
					"id_paquete" => $id_plan,
					"vence" => $vence,
					"id_template" => $id_temple
				);
				$this->Model_linkTree->Paytemplate($arre);
				$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex  " style="width: 50%;"> Compra exitosa</div></center>');
			} else {
				$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex  " style="width: 50%;"> Error, superas el limite de links para este paquete</div></center>');
			}

			redirect(base_url() . 'LinkTree/apariencia/' . $id_temple, 'refresh');
		}

	}
	public function CompraTemplate($idPaquete, $id_temple)
	{
		//data
		$perfil = $this->Model_login->cargar_datos();
		$datosPersona = $this->model_proceso->consultar_referido($perfil->token);
		$billetera = $this->model_banco->billetera($perfil->token);
		$infPaquete = $this->Model_linkTree->infoPaquete($idPaquete);
		$empresa = $this->model_proceso->consultar_referido_niveles(6);

		//ajuste de fechas 
		$fecha = new DateTime(); // Obtiene la fecha actual
		$fecha->modify('+1 month'); // Agrega 1 mes a la fecha actual
		$vence = $fecha->format('Y-m-d'); // Convierte la fecha a formato deseado

		if ($billetera->cuenta_compra >= $infPaquete->precio) {

			$restar = $billetera->cuenta_compra - $infPaquete->precio;
			$data = array(
				"cuenta_compra" => $restar
			);
			$this->model_banco->updBilletera($perfil->token, $data) == 1;

			$proceso = $this->ProcesoDistribucion($infPaquete->precio);

			if ($proceso == true) {
				$url = "www.myconnectmind.com/MCMLink/" . $perfil->user;
				//generacion codigo QR
				$qr = $this->generate_qrcode($url);
				$ari = array(
					"url" => $url,
					"id_template" => $id_temple,
					"estado" => 1,
					"id_plan" => $idPaquete,
					"qr" => $qr['file'],
				);
				$this->Model_linkTree->UpdatePeronali($ari, $perfil->id);
				$arre = array(
					"id_user" => $perfil->id,
					"id_paquete" => $idPaquete,
					"vence" => $vence,
					"id_template" => $id_temple
				);
				$this->Model_linkTree->Paytemplate($arre);
				$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex  " style="width: 50%;"> Compra exitosa</div></center>');
				 redirect(base_url() . 'LinkTree/apariencia/' . $id_temple, 'refresh');
			} else {
				echo "error";
			}


		} else {
			$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex  " style="width: 50%;"> Fondos insuficientes</div></center>');
			redirect(base_url() . 'LinkTree/apariencia/' . $id_temple, 'refresh');
		}

	}
	public function ProcesoDistribucion($precio)
	{
		//traer Data
		$Parapapa = $this->Model_linkTree->DataParametro(1); //papa
		$Paraabue = $this->Model_linkTree->DataParametro(2); //abuelo	
		$Parabisa = $this->Model_linkTree->DataParametro(3); //Bis

		//operaciones:
		$Gpapa = ($precio * $Parapapa->porcentaje) / 100;
		$Gabue = ($precio * $Paraabue->porcentaje) / 100;
		$Gbisa = ($precio * $Parabisa->porcentaje) / 100;

		//Trae data Usuario
		$perfil = $this->Model_login->cargar_datos();
		$billetera = $this->model_banco->billetera($perfil->token);

		//Trae data empresa
		$empresa = $this->model_proceso->consultar_referido_niveles(6);
		$billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);

		//Trae data papa
		$papa = $this->model_proceso->consultar_referido_niveles($perfil->id_papa_pago);

		if ($papa == null ) {

			$data1 = array(
				"cuenta_mcmlink" => $billetera_empresa->cuenta_mcmlink + $precio
			);
			$this->model_banco->actualizar_wallet_empresa($empresa->token, $data1);
		} else {
			$billeteraPapa = $this->model_banco->billetera($papa->token);
			$data1 = array(
				"cuenta_compra" => $billeteraPapa->cuenta_comision + $Gpapa
			);
			$this->model_banco->updBilletera($papa->token, $data1) == 1;

			//Trae data abuelo
			$abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);
			if ($abuelo == null ) {
				$data2 = array(
					"cuenta_mcmlink" => $billetera_empresa->cuenta_mcmlink - ($precio - $Gpapa)
				);
				$this->model_banco->actualizar_wallet_empresa($empresa->token, $data2);
			} else {

				$billeteraAbuelo = $this->model_banco->billetera($abuelo->token);
				$data2 = array(
					"cuenta_compra" => $billeteraAbuelo->cuenta_comision + $Gabue
				);
				$this->model_banco->updBilletera($abuelo->token, $data2) == 1;

				//Trae data bisabuelo
				$bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
				if ($bisabuelo == null ) {
					$data3 = array(
						"cuenta_mcmlink" => $billetera_empresa->cuenta_mcmlink - ($precio - $Gpapa - $Gabue)
					);
					$this->model_banco->actualizar_wallet_empresa($empresa->token, $data3);
				} else {
					$billeteraBisabuelo = $this->model_banco->billetera($bisabuelo->token);
					$data3 = array(
						"cuenta_compra" => $billeteraBisabuelo->cuenta_comision + $Gbisa
					);
					$this->model_banco->updBilletera($bisabuelo->token, $data3) == 1;

					$data4 = array(
						"cuenta_mcmlink" => $billetera_empresa->cuenta_mcmlink - ($precio - $Gpapa - $Gabue - $Gbisa)
					);
					$this->model_banco->actualizar_wallet_empresa($empresa->token, $data4);

					return true;
				}
			}
		}
	}
	public function Statues($id, $id_temple)
	{
		$perfil = $this->Model_login->cargar_datos();
		$ar = array(
			"estado" => 0
		);
		$this->Model_linkTree->UpdateStatues($ar, $id);
		redirect(base_url() . 'MCMLink/make/' . $id_temple, 'refresh');

	}
	public function analisis($url, $id)
	{

		$info = $this->Model_linkTree->InfoAnalisis($url);

		$visitas = $info->contador + 1;
		$data = array(
			"contador" => $visitas,
		);
		$ubicacion = (unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR'])));
		// print_r($ubicacion);
		$arre = array(
			"id_link" => $id,
			"pais" => $ubicacion["geoplugin_countryName"],
			"departamento" => $ubicacion["geoplugin_regionName"],
			"latitud" => $ubicacion["geoplugin_latitude"],
			"longitud" => $ubicacion["geoplugin_longitude"],
			"ip" => $ubicacion["geoplugin_request"],
			"ciudad" => $ubicacion["geoplugin_city"],
		);
		$this->Model_linkTree->UpdatePeronali($data, $id);
		$this->Model_linkTree->insertvisita($arre);
	}

	//// vista original///
	public function view($user)
	{
		$dataUser = $this->Model_linkTree->SearchUser($user);
		$template = $this->Model_linkTree->personalizacion($dataUser->id);
		$this->analisis($template->url, $dataUser->id);
		$result['id_plan'] = 0;

		$result['sett'] = $this->Model_linkTree->personalizacion($dataUser->id);
		$result['perfil'] = $this->Model_login->cargar_datosxuser($dataUser->id);
		$result['links'] = $this->Model_linkTree->traerData($dataUser->id);
		$result['editar'] = false;


		if ($template->id_template == 1) {
			$this->load->view('plantillasUser/Cap1', $result);
		} else if ($template->id_template == 2) {
			$this->load->view('plantillasUser/Cap2', $result);
		} else if ($template->id_template == 3) {
			$this->load->view('plantillasUser/Cap3', $result);
		} else if ($template->id_template == 4) {
			$this->load->view('plantillasUser/Cap4', $result);
		} else if ($template->id_template == 5) {
			$this->load->view('plantillasUser/Cap5', $result);
		} else {
			$this->load->view('plantillasUser/Cap6', $result);
		}
	}
	//funcion para QR
	function generate_qrcode($data)
	{
		/* Load QR Code Library */
		$this->load->library('ciqrcode');

		/* Data */
		$hex_data = bin2hex($data);
		$name = $this->generateRandomString(10);
		$save_name = $name . '.png';

		/* QR Code File Directory Initialize */
		$dir = 'assets/img/QR/';
		if (!file_exists($dir)) {
			mkdir($dir, 0775, true);
		}

		/* QR Configuration  */
		$config['cacheable'] = true;
		$config['imagedir'] = $dir;
		$config['quality'] = true;
		$config['size'] = '1024';
		$config['black'] = array(255, 255, 255);
		$config['white'] = array(255, 255, 255);
		$this->ciqrcode->initialize($config);

		/* QR Data  */
		$params['data'] = $data;
		$params['level'] = 'L';
		$params['size'] = 10;
		$params['savename'] = FCPATH . $config['imagedir'] . $save_name;

		$this->ciqrcode->generate($params);

		/* Return Data */
		$return = array(
			'content' => $data,
			'file' => $dir . $save_name
		);
		return $return;
	}
	public function MakeView()
	{
		$this->load->view('landingxuser/plantilla');
	}

}