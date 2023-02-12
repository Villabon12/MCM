<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Reportes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_login');
        $this->load->model('model_reporte');
        $this->load->model('model_servicio');
    }

    public function index($ban = null)
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
                if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin') {
                    $result['perfil'] = $this->model_login->cargar_datos();
                    $result['inversion'] = $this->model_reporte->cargarInversion();
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
                    $this->load->view('reportes/view_inicio', $result);
                } else {
                    $intruso = array(
                        'id_usuario' => $this->session->userdata('ID'),
                        'texto' => 'view_socios',
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

    public function getData($id)
    {
        $year = $this->input->post('year');
        $resultados = $this->model_reporte->montosMeses($year, $id);
        echo json_encode($resultados);
    }
}
