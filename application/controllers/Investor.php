<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Investor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_login');
        $this->load->model('model_socios');
        $this->load->model('model_errorpage');
        $this->load->model('model_servicio');
        $this->load->model('model_proceso');
        $this->load->model('model_banco');
        $this->load->model('model_wallet');
        $this->load->model('model_reporte');
        $this->load->model('model_terminos');
    }

    public function index()
    {
        $this->load->helper('cookie');

        if ($this->session->userdata('is_logged_in')) {
            $cookie = get_cookie('mi_cookie_4');

            if ($cookie == 'investor') {
                if ($this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Socio') {
                    $token = $this->session->userdata('token');

                    $inversion = $this->model_servicio->cargarCapitalxid();
                    $year = $this->model_reporte->anoHoy();
                    $mes = $this->model_reporte->mesHoy();
                    $idxuser = $this->model_servicio->reportesxuser();
                    $result['perfil'] = $this->model_login->cargar_datos();
                    $robot = "binaria";
                    $activacion = $this->model_servicio->activo_servicio($robot);
                    $result['servicio'] = $this->model_servicio->costos_robot($robot);
                    $result['inversion'] = $this->model_servicio->cargarCapital();
                    $result['billetera'] = $this->model_proceso->cargar_billetera($token);
                    if (count($idxuser) == 1) {
                        $result['reportes'] = $this->model_servicio->reportes();
                        $result['ganancia'] = $this->model_wallet->gananciasHoy($idxuser->idxuser);
                        $result['perdida'] = $this->model_wallet->perdidasHoy($idxuser->idxuser);
                        $result['porcentaje'] = $this->model_reporte->porcMeses($year->ano, $inversion->id);
                        $result['porcentajehoyG'] = $this->model_wallet->porcentajeHoyG($idxuser->idxuser);
                        $result['porcentajehoyP'] = $this->model_wallet->porcentajeHoyP($idxuser->idxuser);
                        $mesInicial = $this->model_reporte->inicialMes($idxuser->idxuser, $mes->mes, $year->ano);
                        $result['mesInicial'] =$mesInicial;
                        $result['gananciaMes'] = $this->model_reporte->gananciaMes($idxuser->idxuser, $mes->mes, $year->ano);
                        $result['perdidaMes'] = $this->model_reporte->perdidaMes($idxuser->idxuser, $mes->mes, $year->ano);
                    } else {
                        $result['ganancia'] = 0;
                        $result['perdida'] = 0;
                        $result['reportes'] =  0;
                        $result['porcentaje'] = 0;
                        $result['porcentajehoyG'] = 0;
                        $result['mesInicial'] =0;
                        $result['gananciaMes'] = 0;
                        $result['perdidaMes'] = 0;
                    }
                    $result['reportes'] = $this->model_servicio->reportes();
                    $result['retiro'] = $this->model_wallet->retiro();
                    $result['deposito'] = $this->model_wallet->deposito();

                    $result['total'] = $this->model_servicio->sumInversion();
                    if (count($activacion) == 1) {
                        $result['activo'] = 1;
                        if ($activacion->fecha_termina < date("Y-m-d")) {
                            $data = array(
                                "activo" => 0
                            );
                            $data2 = array(
                                "consignado" => 0
                            );
                            $this->model_proceso->desactivar($data);
                            $this->model_proceso->desactivar_inversion($data2);
                        }
                    } else {
                        $result['activo'] = 0;
                    }


                    $this->load->view('investor/header_socio', $result);

                    $this->load->view('investor/view_inicio', $result);
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
                echo "SEGURIDAAAAAAD";
            }
        } else {
            redirect("" . base_url() . "login/");
        }
    }

    public function jsonConsulta()
    {
        $inversion = $this->model_servicio->sumInversion();
        $idxuser = $this->model_servicio->reportesxuser();
        $fecha1 = $this->input->post('fecha');
        $fecha2 = $this->input->post('fecha2');

        $reporte = $this->model_servicio->consulta_reportes($fecha1, $fecha2);
        $ganancia = $this->model_wallet->gananciasConsulta($idxuser->idxuser, $fecha1, $fecha2);
        $perdida = $this->model_wallet->perdidaConsulta($idxuser->idxuser, $fecha1, $fecha2);

        $datos = array(
            "reporte" => $reporte,
            "ganancia" => $ganancia,
            "perdida" => $perdida,
            "inversion" => $inversion
        );
        echo json_encode($datos);
    }

    public function Comisiones()
    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Socio') {
                $perfil = $this->model_login->cargar_datos();


                $result['perfil'] = $perfil;
                $result['comision'] = $this->model_socios->comisiones();

                $this->load->view('investor/header_socio', $result);

                $this->load->view('equipo/historial', $result);

                $this->load->view('footer_socio', $result);
            } else {
                $intruso = array(

                    'id_usuario' => $this->session->userdata('ID'),

                    'texto' => 'Equipo/Comisiones',

                    'fecha_registro' => date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("" . base_url() . "errorpage/error");
            }
        } else {
            redirect("" . base_url() . "login/");
        }
    }

    public function reportes($ban = null)
	{
		if ($this->session->userdata('is_logged_in')) {

			if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin') {

				$result['perfil'] = $this->model_login->cargar_datos();
				$result['inversion'] = $this->model_reporte->cargarInversion();

				$this->load->view('investor/header_socio', $result);
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
		} else {
			redirect("" . base_url() . "login/");
		}
	}

    public function getData()
	{
		$year = $this->input->post('year');
        $id = $this->input->get('id');
		$resultados = $this->model_reporte->montosMeses($year ,$id);
		echo json_encode($resultados);
	}

    public function generarUsuario()
    {
        $perfil = $this->model_login->cargar_datos();

        $user = $perfil->user."Investor";
        $pass = $this->generateRandomString(8);

        $data = array(
            "userinvestor" => $user,
            "passinvestor" => md5($pass),
            "passInvestor2" => $pass
        );

        $this->model_login->actualizarUsuario($data,$perfil->id);

        redirect(base_url()."Binaria");
    }

    public function generateRandomString($length)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }
}
