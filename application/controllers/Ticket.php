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
            } else {
                if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin') {
                    $result['perfil'] = $this->model_login->cargar_datos();
                    $result['ticket'] = $this->model_reporte->cargar_ticket();
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
        $departamento = $this->input->post('departamento');
        $servicio = $this->input->post('servicio');
        $mensaje = $this->input->post('mensaje');
        $prioridad = $this->input->post('prioridad');

        $arre = array(
            "estado" => "en proceso",
            "pregunta" => $motivo,
            "usuario_id" => $this->session->userdata('ID'),
            "empresa_id" => 6,
            "departamento_id" => $departamento,
            "servicio_id" => $servicio,
            "prioridad" => $prioridad
        );
        if ($this->model_reporte->insertTicket($arre) == 1) {
            $id = $this->model_reporte->lastID();
            $miarchivo = 'video';
            $config['upload_path'] = './ticket/video/';
            $config['allowed_types'] = 'mp4|avi|mov|jpg|png|jpeg|web|gif|pdf|mpeg4';
            $this->load->library('upload',$config);

            if (!$this->upload->do_upload($miarchivo)) {
                // Si hay algún error en la subida, muestra un mensaje de error
                $error = array('error' => $this->upload->display_errors());
                $data2 = array(
                    "ticket_id" => $id,
                    "persona_id" => $this->session->userdata('ID'),
                    "empresa_id" => 6,
                    "mensaje" => $mensaje,
                    "tipo" => "emisor",
                );
                $this->model_reporte->detalleInsert($data2);
                $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Mensaje enviado</div>');
                redirect(base_url() . "Ticket/detalle/".$id, "refresh");
            } else {
                // Si la subida fue exitosa, obtén información sobre el archivo subido
                $data = array("upload_data" => $this->upload->data());
                $video = $data['upload_data']['file_name'];

                $data2 = array(
                    "ticket_id" => $id,
                    "persona_id" => $this->session->userdata('ID'),
                    "empresa_id" => 6,
                    "mensaje" => $mensaje,
                    "tipo" => "emisor",
                    "adjunto" => $video
                );
                $this->model_reporte->detalleInsert($data2);
                $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Mensaje enviado</div>');
                redirect(base_url() . "Ticket/detalle/".$id, "refresh");
            }
        }
    }

    public function detalle($id)
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
                    $result['detalle'] = $this->model_reporte->detalle($id);
                    $result['perfil'] = $this->model_login->cargar_datos();
                    $result['ticket'] = $this->model_reporte->cargar_ticket();
                    $result['id'] = $id;
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
                    $this->load->view('ticket/view_detalle');
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

        // echo json_encode($detalle);
    }

    public function inserDetalle($id)
    {
        $miarchivo = 'video';
        $config['upload_path'] = './ticket/video/';
        $config['allowed_types'] = 'mp4|avi|mov|jpg|png|jpeg|web|gif|pdf|mpeg4';
        
        $this->load->library('upload',$config);
        if (!$this->upload->do_upload($miarchivo)) {
            // Si hay algún error en la subida, muestra un mensaje de error

            $error = array('error' => $this->upload->display_errors());
            $data2 = array(
                "ticket_id" => $id,
                "persona_id" => $this->session->userdata('ID'),
                "empresa_id" => 6,
                "mensaje" => $this->input->post('mensaje'),
                "tipo" => "emisor",
            );
            $this->model_reporte->detalleInsert($data2);
            $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Mensaje enviado</div>');
            redirect(base_url() . "Ticket/detalle/".$id, "refresh");
        } else {
            // Si la subida fue exitosa, obtén información sobre el archivo subido
            $data = array("upload_data" => $this->upload->data());
            $video = $data['upload_data']['file_name'];

            $data2 = array(
                "ticket_id" => $id,
                "persona_id" => $this->session->userdata('ID'),
                "empresa_id" => 6,
                "mensaje" => $this->input->post('mensaje'),
                "tipo" => "emisor",
                "adjunto" => $video
            );
            $this->model_reporte->detalleInsert($data2);
            $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Mensaje enviado</div>');
            redirect(base_url() . "Ticket/detalle/".$id, "refresh");
        }
    }
    public function inserDetalleEmpresa($id)
    {
        $ticket = $this->model_reporte->traer_ticket($id);
        $perfil = $this->model_reporte->traer_usuario($ticket->usuario_id);

        $miarchivo = 'video';
        $config['upload_path'] = './ticket/video/';
        $config['allowed_types'] = 'mp4|avi|mov|jpg|png|jpeg|web|gif|pdf|mpeg4';
        $this->load->library('upload',$config);
        if (!$this->upload->do_upload($miarchivo)) {
            // Si hay algún error en la subida, muestra un mensaje de error
            $data2 = array(
                "ticket_id" => $id,
                "persona_id" => $ticket->usuario_id,
                "empresa_id" => 6,
                "mensaje" => $this->input->post('mensaje'),
                "tipo" => "receptor",
            );
            $this->model_reporte->detalleInsert($data2);
            // $this->model_email2->respuesta_ticket($perfil->correo, $id);
            // $this->model_email2->envio_correos_pendientes_bd();
            $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Mensaje enviado</div>');
            redirect(base_url() . "Ticket/detalle/".$id, "refresh");
        } else {
            // Si la subida fue exitosa, obtén información sobre el archivo subido
            $data = array("upload_data" => $this->upload->data());
            $video = $data['upload_data']['file_name'];

            $data2 = array(
                "ticket_id" => $id,
                "persona_id" => $ticket->usuario_id,
                "empresa_id" => 6,
                "mensaje" => $this->input->post('mensaje'),
                "tipo" => "receptor",
                "adjunto" => $video
            );
            $this->model_reporte->detalleInsert($data2);
            // $this->model_email2->respuesta_ticket($perfil->correo, $id);
            // $this->model_email2->envio_correos_pendientes_bd();
            $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Mensaje enviado</div>');
            redirect(base_url() . "Ticket/detalle/".$id, "refresh");
        }
    }

    public function empresa()
    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Ultra') {
                $result['perfil'] = $this->model_login->cargar_datos();
                $result['ticket'] = $this->model_reporte->cargar_ticket_empresa();
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

    public function nuevo()
    {
        $result['perfil'] = $this->model_login->cargar_datos();
        $result['servicios'] = $this->model_reporte->traer_servicios();
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
        $this->load->view('ticket/view_nuevo2');
    }
    public function nuevoDetalle($id)
    {
        $result['perfil'] = $this->model_login->cargar_datos();
        $result['id'] = $id;
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
        $this->load->view('ticket/view_nuevo');
    }
}
