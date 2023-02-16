<?php

defined('BASEPATH') or exit('No direct script access allowed');



class LandingxUser extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_login');
        $this->load->model('model_errorpage');
        $this->load->model('model_landing');
    }

    public function landing($id)
    {
        $result['perfil'] = $this->model_login->cargar_datosReferencia($id);
        $result['contenido'] = $this->model_landing->cargarContenido($id);

        if (count($result['perfil']) == 1) {
            $this->load->view('landingxuser/cargar', $result);
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

    public function plantilla()
    {
        $this->load->view('landingxuser/plantilla');
    }

    public function plantilla2()
    {
        $this->load->view('landingxuser/plantilla2');
    }

    public function edit()
    {
        $this->load->helper('cookie');

        if ($this->session->userdata('is_logged_in')) {
            $cookie = get_cookie('mi_cookie_4');
            if ($cookie != 'investor') {
                if ($this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Socio') {
                    $result['perfil'] = $this->model_login->cargar_datos();
                    $result['contenido'] = $this->model_landing->cargarContenido($result['perfil']->id);

                    if (count($result['perfil']) == 1) {
                        $this->load->view('landingxuser/template', $result);
                    } else {
                        $intruso = array(

                            'id_usuario' => 0,

                            'texto' => 'Landing puzzle',

                            'fecha_registro' => date("Y-m-d H:i:s"),

                        );

                        $this->model_errorpage->insertIntruso($intruso);
                        redirect("" . base_url() . "errorpage/error");
                    }
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

    public function save()
    {
        $id = $this->input->post('id');
        $contenidoNuevo = $this->input->post('content');
        $contenidoViejo = $this->model_landing->cargarContenido($id);

        if ($contenidoViejo == false) {
            $data = array(
                "contenido" => $contenidoNuevo,
                "usuario_id" => $id
            );
            $this->model_landing->insertarContenido($data);
            echo "cambio realizado";
        } else {
            $data = array(
                "contenido" => $contenidoNuevo,
            );
            $this->model_landing->actualizarContenido($data, $id);
            echo "cambio realizado";
        }
    }

    public function subirImagen()
    {
        $config['upload_path'] = './document/';
        $config['allowed_types'] = "*";
        $config['maintain_ratio'] = true;
        $config['create_thumb'] = false;
        $config['width'] = 800;
        $config['height'] = 800;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } else {
            $data = array("upload_data" => $this->upload->data());
            $imagen = $data['upload_data']['file_name'];
            $ruta_completa = base_url(). "document/" . $imagen;
            echo $ruta_completa;
        }
    }

    public function insertarDatos()
    {
        $data = array(
            "correo" => $this->input->post('email')
        );

        $this->model_landing->insertarUsuario($data);
        redirect(base_url()."LandingxUser/plantilla2");
    }
}
