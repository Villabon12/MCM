<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Ticket extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_login');
        $this->load->model('model_reporte');
        $this->load->model('model_servicio');
        $this->load->model('model_proceso');
        $this->load->model('model_email2');
        $this->load->model('model_errorpage');
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

                if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin') {
                    $result['perfil'] = $this->model_login->cargar_datos();
                    $result['ticket'] = $this->model_reporte->cargar_ticket();

                    $this->load->view('header_socio', $result);
                    $this->load->view('ticket/view_inicio', $result);
                } else {
                    $intruso = array(
                        'id_usuario' => $this->session->userdata('ID'),
                        'texto' => 'vista ticket',
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

    public function add()
    {
        $motivo = $this->input->post('motivo');

        $arre = array(
            "estado" => "en proceso",
            "pregunta" => $motivo,
            "usuario_id" => $this->session->userdata('ID'),
            "empresa_id" => 6
        );
        if ($this->model_reporte->insertTicket($arre) == 1) {
            $id = $this->model_reporte->lastID();

            $data = array(
                "ticket_id" => $id,
                "persona_id" => $this->session->userdata('ID'),
                "empresa_id" => 6,
                "mensaje" => $motivo,
                "tipo" => "emisor"
            );
            $this->model_reporte->detalleInsert($data);
            $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Ticket creado, muy pronto estaremos en contacto</div>');
            redirect(base_url() . "Ticket", "refresh");
        } else {
            $this->session->set_flashdata('exito', '<div class="alert alert-danger text-center">Ocurrio un error, revisa tu conexión a internet</div>');
            redirect(base_url() . "Ticket", "refresh");
        }
    }

    public function detalle()
    {
        $id = $this->input->post('id');

        $detalle = $this->model_reporte->detalle($id);

        echo json_encode($detalle);
    }

    public function inserDetalle()
    {
        $data = array(
            "ticket_id" => $this->input->post('id'),
            "persona_id" => $this->session->userdata('ID'),
            "empresa_id" => 6,
            "mensaje" => $this->input->post('motivo'),
            "tipo" => "emisor"
        );
        $this->model_reporte->detalleInsert($data);
        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Mensaje enviado</div>');
        redirect(base_url() . "Ticket", "refresh");
    }
    public function inserDetalleEmpresa()
    {
        $id = $this->input->post('id');
        $ticket = $this->model_reporte->traer_ticket($id);
        $perfil = $this->model_reporte->traer_usuario($ticket->usuario_id);
        $data = array(
            "ticket_id" => $id,
            "persona_id" => $this->input->post('usuario'),
            "empresa_id" => 6,
            "mensaje" => $this->input->post('motivo'),
            "tipo" => "receptor"
        );
        $this->model_reporte->detalleInsert($data);
        $this->model_email2->respuesta_ticket($perfil->correo, $id);
        $this->model_email2->envio_correos_pendientes_bd();
        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Mensaje enviado</div>');
        redirect(base_url() . "Ticket/empresa", "refresh");
    }

    public function empresa()
    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Ultra') {
                $result['perfil'] = $this->model_login->cargar_datos();
                $result['ticket'] = $this->model_reporte->cargar_ticket_empresa();

                $this->load->view('header_socio', $result);
                $this->load->view('ticket/view_empresa', $result);
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

    public function cambiarEstado($id)
    {
        $data = array(
            "estado" => "terminado"
        );

        $this->model_proceso->cambiarEstado($data, $id);
        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Ticket cerrado</div>');
        redirect(base_url() . "Ticket/empresa", "refresh");
    }
}
