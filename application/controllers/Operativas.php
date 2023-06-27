<?php
use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
class Operativas extends CI_Controller
{

    //metodo contructor

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_login');
        $this->load->model('model_servicio');
        $this->load->model('Model_email');
        $this->load->model('Model_linkTree');
        $this->load->model('model_proceso');
        $this->load->model('model_banco');
        $this->load->model('Model_landingu');
        $this->load->model('model_email2');
        $this->load->model('model_binarias');
        $this->load->model('Model_operativa');
    }
    //vistas intefaz de usuario
    public function binarias()
    {
        $this->load->helper('cookie');

        if ($this->session->userdata('is_logged_in')) {
            $cookie = get_cookie('mi_cookie_4');

            if ($cookie == 'investor') {
                $intruso = array(

                    'id_usuario' => $this->session->userdata('ID'),

                    'texto' => 'Ingreso cuenta Investor Inicio',

                    'fecha_registro' => date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("" . base_url() . "errorpage/error");
            } else {
                if ($this->session->userdata('ROL') == 'Ultra') {
                    $token = $this->session->userdata('token');

                    $result['perfil'] = $this->model_login->cargar_datos();
                    $result['data'] = $this->Model_operativa->traerDataBinarias();

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

                    $this->load->view('operativas/binaria_table', $result);

                    $this->load->view('footer_socio', $result);
                } else {
                    $intruso = array(

                        'id_usuario' => $this->session->userdata('ID'),

                        'texto' => 'Banco/retiros',

                        'fecha_registro' => date("Y-m-d H:i:s"),

                    );

                    $this->model_errorpage->insertIntruso($intruso);

                    redirect("" . base_url() . "errorpage/error");
                }
            }
        } else {
            redirect("" . base_url() . "login/");
        }
    }
    public function forex()
    {
        $this->load->helper('cookie');

        if ($this->session->userdata('is_logged_in')) {
            $cookie = get_cookie('mi_cookie_4');

            if ($cookie == 'investor') {
                $intruso = array(

                    'id_usuario' => $this->session->userdata('ID'),

                    'texto' => 'Ingreso cuenta Investor Inicio',

                    'fecha_registro' => date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("" . base_url() . "errorpage/error");
            } else {
                if ($this->session->userdata('ROL') == 'Ultra') {
                    $token = $this->session->userdata('token');

                    $result['perfil'] = $this->model_login->cargar_datos();
                    $result['data'] = $this->Model_operativa->traerDataForex();

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

                    $this->load->view('operativas/forex_table', $result);

                    $this->load->view('footer_socio', $result);
                } else {
                    $intruso = array(

                        'id_usuario' => $this->session->userdata('ID'),

                        'texto' => 'Banco/retiros',

                        'fecha_registro' => date("Y-m-d H:i:s"),

                    );

                    $this->model_errorpage->insertIntruso($intruso);

                    redirect("" . base_url() . "errorpage/error");
                }
            }
        } else {
            redirect("" . base_url() . "login/");
        }
    }

    public function SaveLink($id)
    {
        $link =$this->input->post('link');
        $servicio =$this->input->post('servicio');

        $data=array(
            'link'=>$link,
        );
        $this->Model_operativa->updateLink($data,$id);

        $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex  " style="width: 50%;">Proceso Exitoso ,cambios guardados</div></center>');
        if ($servicio==1) {
            redirect(base_url() . 'Operativas/binarias', 'refresh');
        }else {
            redirect(base_url() . 'Operativas/forex', 'refresh');
        }
       
    }

    public function ingreso($ban = null)
    {
        $this->load->view('prueba/prueba', $ban);
        // $this->load->view('view_login_ultra', $ban);
    }
}