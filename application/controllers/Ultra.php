<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Ultra extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_login');
        $this->load->model('model_reporte');
        $this->load->model('model_servicio');
        $this->load->model('model_ultra');
        $this->load->model('model_proceso');
        $this->load->model('model_errorpage');
    }

    public function servicio_binaria($ban = null)
    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Ultra') {
                $result['perfil'] = $this->model_login->cargar_datos();
                $result['binaria'] = $this->model_ultra->traer_usuarios('binaria');
                $result['servicio'] = $this->model_servicio->costos_robot('binaria');
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
                $this->load->view('servicio/activar_binaria', $result);
                $this->load->view('footer_socio', $result);
            } else {
                $intruso = array(
                    'id_usuario' => $this->session->userdata('ID'),
                    'texto' => 'Activacion Robot Binaria',
                    'fecha_registro' => date("Y-m-d H:i:s"),
                );
                $this->model_errorpage->insertIntruso($intruso);
                redirect("" . base_url() . "errorpage/error");
            }
        } else {
            redirect("" . base_url() . "login/");
        }
    }

    public function activar()
    {
        $servicio = $this->input->post('servicio');
        $servicio = $this->model_proceso->datosTraer($servicio);

        //Activacion del servicio
        $fecha_actual = date("Y-m-d");
        $data5 = array(
            "usuario_id" => $this->input->post('id'),
            "servicio" => $servicio->robot,
            "fecha_compra" => $fecha_actual,
            "activo" => 1,
            "fecha_termina" => date("Y-m-d", strtotime($fecha_actual . " + " . $servicio->dias . " days"))
        );
        $this->model_proceso->activar_servicio($data5);
        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Activacion exitosa</div>');
        redirect(base_url() . "Ultra/servicio_binaria", "refresh");
    }

    public function insertReporte()
    {
        $senal = $this->input->post('senal');
        $mercado = $this->input->post('mercado');
        $saldo_inicial = $this->input->post('saldo_inicial');
        $saldo_final = $this->input->post('saldo_final');
        $porcentaje = $this->input->post('porcentaje');
        $precio_entrada = $this->input->post('precio_entrada');
        $precio_salida = $this->input->post('precio_salida');
        $porcentaje_a = $this->input->post('porcentaje_a');
        $tipo = $this->input->post('tipo');
        $estado = $this->input->post('estado');

        $data = array(
            "señal" => $senal,
            "mercado" => $mercado,
            "saldo_inicial" => $saldo_inicial,
            "saldo_final" => $saldo_final,
            "porcentajeregistrado" => $porcentaje,
            "precio_entrada" => $precio_entrada,
            "precio_salida" => $precio_salida,
            "porcentaje_apostado" => $porcentaje_a,
            "tipo" => $tipo,
            "estado" => $estado,
        );

        $this->model_ultra->insertReporte($data);
        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Insercion exitosa</div>');
        redirect(base_url() . "Binaria/reportesRobot", "refresh");
    }

    public function servicio_arbitraje($ban = null)
    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Ultra') {
                $result['perfil'] = $this->model_login->cargar_datos();
                $result['arbitraje'] = $this->model_ultra->traer_usuarios('arbitraje');
                $result['servicio'] = $this->model_servicio->costos_robot('arbitraje');
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
                $this->load->view('servicio/activar_arbitraje', $result);
                $this->load->view('footer_socio', $result);
            } else {
                $intruso = array(
                    'id_usuario' => $this->session->userdata('ID'),
                    'texto' => 'Activacion Robot Arbitraje',
                    'fecha_registro' => date("Y-m-d H:i:s"),
                );
                $this->model_errorpage->insertIntruso($intruso);
                redirect("" . base_url() . "errorpage/error");
            }
        } else {
            redirect("" . base_url() . "login/");
        }
    }

    public function activar_arbitraje()
    {
        $servicio = $this->model_proceso->datosTraer(14);

        //Activacion del servicio
        $fecha_actual = date("Y-m-d");
        $data5 = array(
            "usuario_id" => $this->input->post('id'),
            "servicio" => $servicio->robot,
            "fecha_compra" => $fecha_actual,
            "activo" => 1,
            "fecha_termina" => date("Y-m-d", strtotime($fecha_actual . " + " . $servicio->dias . " days"))
        );
        $this->model_proceso->activar_servicio($data5);
        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Activacion exitosa</div>');
        redirect(base_url() . "Ultra/servicio_arbitraje", "refresh");
    }

    public function desactivar()
    {
        $usuarios = $this->model_ultra->usuariosActivos();
        $contar = $this->model_ultra->contar_usuariosActivos();

        for ($i=0; $i < $contar->contar ; $i++) {
            if ($usuarios[$i]->fecha_termina < date("Y-m-d")) {
                $data = array(
                    "activo" => 0
                );
                $data2 = array(
                    "consignado" => 0
                );
                $this->model_ultra->updateActivo($data, $usuarios[$i]->id);
                if ($usuarios[$i]->servicio == "binaria") {
                    $this->model_ultra->desactivar_inversion($data2, $usuarios[$i]->usuario_id);
                } elseif ($usuarios[$i]->servicio == "arbitraje") {
                    $this->model_ultra->desactivar_inversion_arbitraje($data, $usuarios[$i]->usuario_id);
                } else {
                }
            }
        }
    }

    public function Login($ban = null)
    {
        $this->load->view('view_login_ultra', $ban);
    }

    public function validaAcceso()
    {
        $this->load->helper('cookie');

        $user = $this->input->post('user');
        $pass = md5($this->input->post('pass'));
        $result = $this->model_login->consultaUser($user, $pass);
        $result2 = $this->model_login->consultarInvestor($user, $pass);

        if ($result->contar == 1) {
            $cookie_4 = array(
                'name'   => 'mi_cookie_4',
                'value'  => '',
                'expire' => 86400,
            );

            set_cookie($cookie_4);
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
                'is_logged_in' => true,
            );
            $this->session->set_userdata($session);


            if ($datos_user->tipo == 'Socio' || $datos_user->tipo == 'SocioAdmin' || $datos_user->tipo == 'Ultra') {
                if ($this->session->userdata('is_logged_in')) {
                    redirect("" . base_url() . "MCM");
                }
            }
            if ($datos_user->tipo == 'Editor') {
                if ($this->session->userdata('is_logged_in')) {
                    redirect(base_url() . "Modulo/Administracion");
                }
            }


            //
        } elseif ($result2->contar == 1) {
            $cookie_4 = array(
                'name'   => 'mi_cookie_4',
                'value'  => 'investor',
                'expire' => 86400,
            );

            set_cookie($cookie_4);
            $datos_user = $this->model_login->trae_userInvestor($user, $pass);
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
                'is_logged_in' => true,
            );
            $this->session->set_userdata($session);


            if ($datos_user->rol_investor == 'investor') {
                redirect(base_url()."Investor");
            }
        } else {
            //en caso contrario mostramos el error de usuario o contraseña invalido
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Usuario/Contraseña Invalido</div>');
            redirect("" . base_url() . "ingreso");
        }
    }
}
