<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'/libraries/phpToPDF.php';


class Socios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_login');
        $this->load->model('model_terminos');
        $this->load->model('model_socios');
        $this->load->model('model_proceso');
        $this->load->model('model_servicio');
        $this->load->model('model_errorpage');
        $this->load->model('model_terminos');
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
                    $token = $this->session->userdata('token');
                    $id = $this->session->userdata('ID');
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
                    $result['disponibilidad'] = $this->model_servicio->consultarCampos();
                    $result['perfil'] = $this->model_login->cargar_datos();
                    $result['billetera'] = $this->model_proceso->cargar_billetera($token);
                    $result['empresa'] = $this->model_proceso->cargar_billetera_global($token);
                    $result['validar'] = $this->model_proceso->traer_parametro(13);
                    $result['total'] = $this->model_servicio->sumInversion();
                    $result['total1'] = $this->model_servicio->sumInversionBilletera();
                    $result['terminos'] = $this->model_terminos->comprobar_registro($id);

                    $this->load->view('header_socio', $result);
                    $this->load->view('view_socios', $result);
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

    public function aceptar_terminos()
    {
        $data = array(
            "usuario_id" => $this->input->post('id'),
            "acepta" => "Estoy de acuerdo",
            "nota" => "registro"
        );

        $this->model_terminos->insertTerminos($data);
        redirect(base_url() . "MCM");
    }



    public function aprobarUser()
    {
        $id = $this->input->post('id');
        $verificar = 1;

        $data = array(
            "verificarCuenta" => $verificar
        );

        $this->model_socios->aprobarUser($id, $data);
    }

    public function aprobarBanco()
    {
        $id = $this->input->post('id');
        $verificar = 1;

        $data = array(
            "verificarBanco" => $verificar
        );

        $this->model_socios->aprobarUser($id, $data);
    }

    public function encenderRobot($id)
    {
        $data = array(
            "valor" => 1
        );

        $this->model_socios->encender();
        $this->model_socios->updParametrosGeneral($data, $id);

        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center"><label class="login__input name">Robot Encendido</label></div>');
        redirect(base_url() . "MCM");
    }

    public function apagarRobot($id)
    {
        $data = array(
            "valor" => 0
        );

        $this->model_socios->apagar();
        $this->model_socios->updParametrosGeneral($data, $id);

        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center"><label class="login__input name">Robot Apagado</label></div>');
        redirect(base_url() . "MCM");
    }

    public function parametros_general()
    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Ultra') {
                $result['perfil'] = $this->model_login->cargar_datos();
                $result['parametro'] = $this->model_socios->parametroGeneral();
                $result['servicios'] = $this->model_socios->costosServicios();
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

                $this->load->view('socio/parametro_general', $result);

                $this->load->view('footer_socio', $result);
            } else {
                $intruso = array(

                    'id_usuario' => $this->session->userdata('ID'),

                    'texto' => 'Parametros todos',

                    'fecha_registro' => date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("" . base_url() . "errorpage/error");
            }
        } else {
            redirect("" . base_url() . "login/");
        }
    }

    public function updGeneral($id)
    {
        $valor = $this->input->post('valor');

        $data = array(
            "valor" => $valor
        );

        $this->model_socios->updParametrosGeneral($data, $id);
        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center"><label class="login__input name">Modificacion Realizada</label></div>');
        redirect(base_url() . "Configuraciones");
    }

    public function updCostos($id)
    {
        $data = array(
            "precio" => $this->input->post('precio'),
            "dias" => $this->input->post('dias')
        );

        $this->model_socios->updCosto($data, $id);
        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center"><label class="login__input name">Modificacion Realizada</label></div>');
        redirect(base_url() . "Configuraciones");
    }

    public function validarRetiros()
    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Ultra') {
                $result['perfil'] = $this->model_login->cargar_datos();
                $result['retiros'] = $this->model_socios->cargar();
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

                $this->load->view('banco/view_table_r', $result);

                $this->load->view('footer_socio', $result);
            } else {
                $intruso = array(

                    'id_usuario' => $this->session->userdata('ID'),

                    'texto' => 'Retiros todos',

                    'fecha_registro' => date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("" . base_url() . "errorpage/error");
            }
        } else {
            redirect("" . base_url() . "login/");
        }
    }

    public function aprobarRetiros($id)
    {
        $mi_archivo = 'img';
        $config['upload_path'] = './asset/images/confirmacion/';
        $config['allowed_types'] = "jpg|png|jpeg";
        $config['maintain_ratio'] = true;
        $config['create_thumb'] = false;
        $config['width'] = 800;
        $config['height'] = 800;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($mi_archivo)) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Error con la imagen</label></div>');
        } else {
            $data = array("upload_data" => $this->upload->data());
            $imagen = $data['upload_data']['file_name'];
            $data = array(
                "aprobar" => 1,
                "motivos" => 'se realizó la consignación a la cuenta',
                "comprobante" => $imagen
            );
            $this->model_socios->updRetiros($data, $id);
            $this->session->set_flashdata('exito', '<div class="alert alert-success text-center"><label class="login__input name">Pago Realizado</label></div>');
            redirect(base_url() . "Socios/validarRetiros");
        }
    }

    public function cancelarRetiro($id)
    {
        $data = array(
            "aprobar" => 1,
            "motivos" => $this->input->post('motivo')
        );
        $this->model_socios->updRetiros($data, $id);
        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center"><label class="login__input name">Pago Realizado</label></div>');
        redirect(base_url() . "Socios/validarRetiros");
    }

    public function encenderDia($id)
    {
        $data = array(
            "estado" => 1
        );

        $this->model_socios->actualizarDia($data, $id);

        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center"><label class="login__input name">Dia Actualizado</label></div>');
        redirect(base_url() . "Estrategia");
    }

    public function apagarDia($id)
    {
        $data = array(
            "estado" => 0
        );

        $this->model_socios->actualizarDia($data, $id);

        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center"><label class="login__input name">Dia Actualizado</label></div>');
        redirect(base_url() . "Estrategia");
    }

    public function validarRetiroBinaria()
    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Ultra') {
                $result['perfil'] = $this->model_login->cargar_datos();
                $result['retiros'] = $this->model_socios->cargarBinaria();
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

                $this->load->view('binarios/view_table_r', $result);

                $this->load->view('footer_socio', $result);
            } else {
                $intruso = array(

                    'id_usuario' => $this->session->userdata('ID'),

                    'texto' => 'Retiros todos',

                    'fecha_registro' => date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("" . base_url() . "errorpage/error");
            }
        } else {
            redirect("" . base_url() . "login/");
        }
    }

    public function cheque($id)
    {
        $idxuser = $this->model_servicio->reportesxuser($id);
        if (count($idxuser) == 1) {
            $ganancia = $this->model_servicio->ganancia($idxuser->idxuser);
            $perdida = $this->model_servicio->perdida($idxuser->idxuser);
            $valor = $this->model_servicio->comisiones2($id);

            $result['valor'] = number_format($valor->valor + ($ganancia->ganancia - $perdida->perdida), 2);
        } else {
            $ganancia = 0;
            $perdida = 0;
            $valor = $this->model_servicio->comisiones2($id);

            $result['valor'] = number_format($valor->valor + ($ganancia - $perdida), 2);
        }
        $result['perfil'] = $this->model_login->cargar_datosxuser($id);

        $this->load->view('socio/cheque', $result);
    }

    public function generar_imagen($id)
    {
        // SET YOUR PDF OPTIONS -- FOR ALL AVAILABLE OPTIONS, VISIT HERE:  http://phptopdf.com/documentation/
        $pdf_options = array(
            "source_type" => 'url',
            "source" => 'https://www.myconnectmind.com/Socios/cheque/'.$id,
            "action" => 'download',
            "page_orientation" => 'landscape',
            "page_size" => 'A5',
            "file_name" => 'cheque.pdf');

        // CALL THE phpToPDF FUNCTION WITH THE OPTIONS SET ABOVE
        phptopdf($pdf_options);
    }
}
