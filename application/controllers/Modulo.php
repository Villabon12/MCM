<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Modulo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_login');
        $this->load->model('model_socios');
        $this->load->model('model_errorpage');
        $this->load->model('model_servicio');
        $this->load->model('model_modulo');
    }

    public function index()
    {
        $this->load->helper('cookie');

        if ($this->session->userdata('is_logged_in')) {
            $cookie = get_cookie('mi_cookie_4');

            if ($cookie != 'investor') {
                if ($this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Socio') {
                    $result['perfil'] = $this->model_login->cargar_datos();
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
                    $result['modulo'] = $this->model_modulo->cargar();
                    $result['disponibilidad'] = $this->model_servicio->consultarCampos();

                    $this->load->view('header_socio', $result);

                    $this->load->view('modulo/view_inicio', $result);
                } else {
                    $intruso = array(

                        'id_usuario' => $this->session->userdata('ID'),

                        'texto' => 'modulo/videos',

                        'fecha_registro' => date("Y-m-d H:i:s"),

                    );

                    $this->model_errorpage->insertIntruso($intruso);

                    redirect("" . base_url() . "errorpage/error");
                }
            } else {
                $intruso = array(

                    'id_usuario' => $this->session->userdata('ID'),

                    'texto' => 'Equipo/Inicio',

                    'fecha_registro' => date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("" . base_url() . "errorpage/error");
            }
        } else {
            redirect("" . base_url() . "login/");
        }
    }

    public function Secciones($id)
    {
        $this->load->helper('cookie');

        if ($this->session->userdata('is_logged_in')) {
            $cookie = get_cookie('mi_cookie_4');

            if ($cookie != 'investor') {
                if ($this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Socio') {
                    $result['perfil'] = $this->model_login->cargar_datos();
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
                    $result['modulo'] = $this->model_modulo->detalle_modulo($id);
                    $this->load->view('header_socio', $result);

                    $this->load->view('modulo/view_seccion', $result);
                } else {
                    $intruso = array(

                        'id_usuario' => $this->session->userdata('ID'),

                        'texto' => 'modulo/videos',

                        'fecha_registro' => date("Y-m-d H:i:s"),

                    );

                    $this->model_errorpage->insertIntruso($intruso);

                    redirect("" . base_url() . "errorpage/error");
                }
            } else {
                $intruso = array(

                    'id_usuario' => $this->session->userdata('ID'),

                    'texto' => 'Equipo/Inicio',

                    'fecha_registro' => date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("" . base_url() . "errorpage/error");
            }
        } else {
            redirect("" . base_url() . "login/");
        }
    }

    public function Videos($id)
    {
        $this->load->helper('cookie');

        if ($this->session->userdata('is_logged_in')) {
            $cookie = get_cookie('mi_cookie_4');

            if ($cookie != 'investor') {
                if ($this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Socio') {
                    $result['perfil'] = $this->model_login->cargar_datos();
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
                    $result['modulo'] = $this->model_modulo->muestra_modulo($id);
                    $result['detalle'] = $this->model_modulo->detalle_modulo($result['modulo']->modulo_id);

                    $this->load->view('header_socio', $result);

                    $this->load->view('modulo/view_video', $result);
                } else {
                    $intruso = array(

                        'id_usuario' => $this->session->userdata('ID'),

                        'texto' => 'modulo/videos',

                        'fecha_registro' => date("Y-m-d H:i:s"),

                    );

                    $this->model_errorpage->insertIntruso($intruso);

                    redirect("" . base_url() . "errorpage/error");
                }
            } else {
                $intruso = array(

                    'id_usuario' => $this->session->userdata('ID'),

                    'texto' => 'Equipo/Inicio',

                    'fecha_registro' => date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("" . base_url() . "errorpage/error");
            }
        } else {
            redirect("" . base_url() . "login/");
        }
    }

    public function Administracion()
    {
        $this->load->helper('cookie');

        if ($this->session->userdata('is_logged_in')) {
            $cookie = get_cookie('mi_cookie_4');

            if ($cookie != 'investor') {
                if ($this->session->userdata('ROL') == 'Ultra') {
                    $result['perfil'] = $this->model_login->cargar_datos();
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
                    $result['modulo'] = $this->model_modulo->cargar();
                    $result['detalle'] = $this->model_modulo->cargar_detalle();
                    $this->load->view('header_socio', $result);

                    $this->load->view('modulo/view_table', $result);
                } else {
                    $intruso = array(

                        'id_usuario' => $this->session->userdata('ID'),

                        'texto' => 'modulo/videos',

                        'fecha_registro' => date("Y-m-d H:i:s"),

                    );

                    $this->model_errorpage->insertIntruso($intruso);

                    redirect("" . base_url() . "errorpage/error");
                }
            } else {
                $intruso = array(

                    'id_usuario' => $this->session->userdata('ID'),

                    'texto' => 'Equipo/Inicio',

                    'fecha_registro' => date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("" . base_url() . "errorpage/error");
            }
        } else {
            redirect("" . base_url() . "login/");
        }
    }

    public function crearModulo()
    {
        $mi_archivo = 'foto';
        $config['upload_path'] = './modulo/imagen/';
        $config['allowed_types'] = "jpg|png|jpeg";
        $config['maintain_ratio'] = true;
        $config['create_thumb'] = false;
        $config['width'] = 800;
        $config['height'] = 800;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($mi_archivo)) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Error con la imagen</label></div>');
            redirect(base_url()."Modulo/Administracion");
        } else {
            $data = array("upload_data" => $this->upload->data());
            $imagen = $data['upload_data']['file_name'];

            $data2 = array(
                "titulo" => $this->input->post('titulo'),
                "descripcion" => $this->input->post('descripcion'),
                "image_portada" => $imagen
            );

            $this->model_modulo->crear_modulo($data2);
            $this->session->set_flashdata('error', '<div class="alert alert-success text-center"><label class="login__input name">Modulo creado</label></div>');
            redirect(base_url()."Modulo/Administracion");
        }
    }

    public function crearDetalle($id)
    {
        $html = $this->input->post('video');
        preg_match('/src="([^"]+)"/', $html, $match);
        $src = $match[1];
        $data2 = array(
            "video" => $src,
            "titulo" => $this->input->post('titulo'),
            "descripcion" => $this->input->post('descripcion'),
            "modulo_id" => $id
        );

        $this->model_modulo->crear_detalle($data2);
        $this->session->set_flashdata('error', '<div class="alert alert-success text-center"><label class="login__input name">Modulo creado</label></div>');
        redirect(base_url()."Modulo/Administracion");
    }

    public function documentoSubir($id)
    {
        $mi_archivo = 'foto';
        $config['upload_path'] = './modulo/documento/';
        $config['allowed_types'] = "*";
        $config['max_size'] = '2048';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($mi_archivo)) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Error con el archivo</label></div>');
            redirect(base_url()."Modulo/Administracion");
        } else {
            $data = array("upload_data" => $this->upload->data());
            $imagen = $data['upload_data']['file_name'];
            $data2=array(
                "pdf" => $imagen
            );
            $this->model_modulo->update_detalle($data2, $id);

            $this->session->set_flashdata('error', '<div class="alert alert-success text-center"><label class="login__input name">Adjunto subido</label></div>');
            redirect(base_url()."Modulo/Administracion");
        }
    }

    public function updateDatos($id)
    {
        $data2=array(
            "video" => $this->input->post('video'),
            "titulo" => $this->input->post('titulo'),
            "descripcion" => $this->input->post('descripcion'),
        );
        $this->model_modulo->update_detalle($data2, $id);

        $this->session->set_flashdata('error', '<div class="alert alert-success text-center"><label class="login__input name">Adjunto subido</label></div>');
        redirect(base_url()."Modulo/Administracion");
    }
}
