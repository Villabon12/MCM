<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Perfil extends CI_Controller

{
	function __construct()

	{

		parent::__construct();
		$this->load->model('model_login');
		$this->load->model('model_payments');
		$this->load->model('model_gastos');
	}


	//variable for storing error message
	private $error;
	//variable for storing success message
	private $success;

	//appends all error messages
	private function handle_error($err)
	{
		$this->error .= nl2br($err . "\n");
	}

	//appends all success messages
	private function handle_success($succ)
	{
		$this->success .= nl2br($succ . "\n");
	}

	public function index($ban = null)

	{

		if ($this->session->userdata('is_logged_in')) {

			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin') {

				$result['banco'] = $this->model_payments->bancos();
				$result['cuenta'] = $this->model_payments->tipo_cuenta();
				$result['perfil'] = $this->model_login->cargar_datos();
				$result['genero'] = $this->model_gastos->getGenero();
				$result['tipo_documento'] = $this->model_gastos->getTipo();

				$this->load->view('header_socio', $result);
				$this->load->view('perfil/view_perfil', $result);
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


	public function updatePerfil($token)
	{
		$nombre = $this->input->post('nombre');
		$apellido1 = $this->input->post('apellido1');
		$fecha_nacimiento = $this->input->post('fecha_nacimiento');
		$celular = $this->input->post('celular');

		$data = array(
			"nombre" => $nombre,
			"apellido1" => $apellido1,
			"fecha_nacimiento" => $fecha_nacimiento,
			"celular" => $celular
		);

		if ($this->model_login->updPerfil($data, $token)) {
			$this->session->set_flashdata("realizado", "Cambio realizado");
			redirect(base_url() . 'Perfil', 'refresh');
		} else {
			$this->session->set_flashdata("error", "No se pudo realizar cambios");
			redirect(base_url() . 'Perfil', 'refresh');
		};
	}

	public function actualizarFoto($token)
	{
		$mi_archivo = 'img';
		$config['upload_path'] = './assets/img/fotosPerfil/';
		$config['allowed_types'] = "jpg|png|jpeg";
		$config['maintain_ratio'] = TRUE;
		$config['create_thumb'] = FALSE;
		$config['width'] = 800;
		$config['height'] = 800;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($mi_archivo)) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('reco', '<div class="alert alert-danger text-center"><label class="login__input name">Error con la imagen</label></div>');
		} else {
			$data = array("upload_data" => $this->upload->data());
			$imagen = $data['upload_data']['file_name'];
			$arre = array(
				"img_perfil" => $imagen,
			);
			if ($this->model_login->updPerfil($arre, $token)) {
				redirect(base_url() . "Perfil");
			} else {
				$this->session->set_flashdata('reco', '<div class="alert alert-danger text-center"><label class="login__input name">Error a actualizar</label></div>');
				redirect(base_url() . "Perfil");
			}
		}
	}

	public function actualizarcontra($id)
	{
		$contra_actual = $this->input->post('contra_actual');
		$contra_nueva = $this->input->post('contra_nueva');
		$confir_contra = $this->input->post('confir_contra');
		$contra_ori = md5($contra_actual);



		$result = $this->model_login->validarcontra($id, $contra_ori);


		if ($result->contar == 1) {
			if ($contra_nueva == $confir_contra) {
				$arre = array(
					"contrasena" => md5($confir_contra),
				);
				$this->model_login->actualizarPerfil($arre, $id);
				$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex" style="width: 1000px;"> Contraseña actualizada exitosamente </div></center>');
				redirect(base_url() . 'Perfil', 'refresh');
			} else {
				$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex" style="width: 1000px;"> Las contraseñas no coinciden </div></center>');
				redirect(base_url() . 'Perfil', 'refresh');
			}
		} else {
			$this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex" style="width: 1000px;"> Contraseña actual Incorrecta </div></center>');
			redirect(base_url() . 'Perfil', 'refresh');
		}
	}

	public function updateCuenta($token)
	{
		if ($this->input->post('image_resize')) {
			//set preferences
			//file upload destination
			$upload_path = './asset/images/confirmacion/';
			$config['upload_path'] = $upload_path;
			//allowed file types. * means all types
			$config['allowed_types'] = 'jpg|png|gif|jpeg|web';
			//allowed max file size. 0 means unlimited file size
			$config['max_size'] = '0';
			//max file name size
			$config['max_filename'] = '255';

			//store image info once uploaded
			$image_data = array();
			//check for errors
			$is_file_error = FALSE;
			//check if file was selected for upload
			if (!$_FILES) {
				$is_file_error = TRUE;
				$this->handle_error('Selecciona una imagen');
			}

			//if file was selected then proceed to upload
			if (!$is_file_error) {
				//load the preferences
				$this->load->library('upload', $config);
				//check file successfully uploaded. 'image_name' is the name of the input
				if (!$this->upload->do_upload('image_name')) {
					//if file upload failed then catch the errors
					$this->handle_error($this->upload->display_errors());
					$is_file_error = TRUE;
				} else {
					//store the file info
					$image_data = $this->upload->data();
					$config['image_library'] = 'gd2';
					$config['source_image'] = $image_data['full_path']; //get original image
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 900;
					$config['height'] = 850;
					$this->load->library('image_lib', $config);
					$file = $image_data['file_name'];
					$data2 = array(
						"img_cedula_front" => $file
					);
					$this->model_login->updPerfil($data2, $token);
					$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Foto actualiza exitosamente</div></center>');
					if (!$this->image_lib->resize()) {
						$this->handle_error($this->image_lib->display_errors());
					}
				}
			}
			// There were errors, we have to delete the uploaded image
			if ($is_file_error) {
				if ($image_data) {
					$file = $upload_path . $image_data['file_name'];
					if (file_exists($file)) {
						unlink($file);
					}
				}
			} else {
				$data['resize_img'] = $upload_path . $image_data['file_name'];
				$this->handle_success('Image was successfully uploaded to direcoty <strong>' . $upload_path . '</strong> and resized.');
			}
		}

		//load the error and success messages
		if ($this->session->userdata('is_logged_in')) {
			$data['perfil'] = $this->model_login->cargar_datos();
			$data['errors'] = $this->error;
			$data['success'] = $this->success;
			//load the view along with data
			$this->load->view('perfil/up_imageC', $data);
		} else {
			redirect(base_url());
		}
	}
	public function updateCuenta2($token)
	{
		if ($this->input->post('image_resize')) {
			//set preferences
			//file upload destination
			$upload_path = './asset/images/confirmacion/';
			$config['upload_path'] = $upload_path;
			//allowed file types. * means all types
			$config['allowed_types'] = 'jpg|png|gif|jpeg|web';
			//allowed max file size. 0 means unlimited file size
			$config['max_size'] = '0';
			//max file name size
			$config['max_filename'] = '255';

			//store image info once uploaded
			$image_data = array();
			//check for errors
			$is_file_error = FALSE;
			//check if file was selected for upload
			if (!$_FILES) {
				$is_file_error = TRUE;
				$this->handle_error('Selecciona una imagen');
			}

			//if file was selected then proceed to upload
			if (!$is_file_error) {
				//load the preferences
				$this->load->library('upload', $config);
				//check file successfully uploaded. 'image_name' is the name of the input
				if (!$this->upload->do_upload('image_name')) {
					//if file upload failed then catch the errors
					$this->handle_error($this->upload->display_errors());
					$is_file_error = TRUE;
				} else {
					//store the file info
					$image_data = $this->upload->data();
					$config['image_library'] = 'gd2';
					$config['source_image'] = $image_data['full_path']; //get original image
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 900;
					$config['height'] = 850;
					$this->load->library('image_lib', $config);
					$file = $image_data['file_name'];
					$data2 = array(
						"img_cedula_back" => $file
					);
					$this->model_login->updPerfil($data2, $token);
					$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Foto actualiza exitosamente</div></center>');
					if (!$this->image_lib->resize()) {
						$this->handle_error($this->image_lib->display_errors());
					}
				}
			}
			// There were errors, we have to delete the uploaded image
			if ($is_file_error) {
				if ($image_data) {
					$file = $upload_path . $image_data['file_name'];
					if (file_exists($file)) {
						unlink($file);
					}
				}
			} else {
				$data['resize_img'] = $upload_path . $image_data['file_name'];
				$this->handle_success('Image was successfully uploaded to direcoty <strong>' . $upload_path . '</strong> and resized.');
			}
		}

		//load the error and success messages
		if ($this->session->userdata('is_logged_in')) {
			$data['perfil'] = $this->model_login->cargar_datos();
			$data['errors'] = $this->error;
			$data['success'] = $this->success;
			//load the view along with data
			$this->load->view('perfil/up_imageB', $data);
		} else {
			redirect(base_url());
		}
	}
	public function updateCuenta3($token)
	{
		if ($this->input->post('image_resize')) {
			//set preferences
			//file upload destination
			$upload_path = './asset/images/confirmacion/';
			$config['upload_path'] = $upload_path;
			//allowed file types. * means all types
			$config['allowed_types'] = 'jpg|png|gif|jpeg|web';
			//allowed max file size. 0 means unlimited file size
			$config['max_size'] = '0';
			//max file name size
			$config['max_filename'] = '255';

			//store image info once uploaded
			$image_data = array();
			//check for errors
			$is_file_error = FALSE;
			//check if file was selected for upload
			if (!$_FILES) {
				$is_file_error = TRUE;
				$this->handle_error('Selecciona una imagen');
			}

			//if file was selected then proceed to upload
			if (!$is_file_error) {
				//load the preferences
				$this->load->library('upload', $config);
				//check file successfully uploaded. 'image_name' is the name of the input
				if (!$this->upload->do_upload('image_name')) {
					//if file upload failed then catch the errors
					$this->handle_error($this->upload->display_errors());
					$is_file_error = TRUE;
				} else {
					//store the file info
					$image_data = $this->upload->data();
					$config['image_library'] = 'gd2';
					$config['source_image'] = $image_data['full_path']; //get original image
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 900;
					$config['height'] = 850;
					$this->load->library('image_lib', $config);
					$file = $image_data['file_name'];
					$data2 = array(
						"img_selfie" => $file
					);
					$this->model_login->updPerfil($data2, $token);
					$this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center  d-flex" style="width: 1000px;"> Foto actualiza exitosamente</div></center>');
					if (!$this->image_lib->resize()) {
						$this->handle_error($this->image_lib->display_errors());
					}
				}
			}
			// There were errors, we have to delete the uploaded image
			if ($is_file_error) {
				if ($image_data) {
					$file = $upload_path . $image_data['file_name'];
					if (file_exists($file)) {
						unlink($file);
					}
				}
			} else {
				$data['resize_img'] = $upload_path . $image_data['file_name'];
				$this->handle_success('Image was successfully uploaded to direcoty <strong>' . $upload_path . '</strong> and resized.');
			}
		}

		//load the error and success messages

		$data['perfil'] = $this->model_login->cargar_datos();
		$data['errors'] = $this->error;
		$data['success'] = $this->success;
		//load the view along with data
		$this->load->view('perfil/up_imageS', $data);
	}
}
