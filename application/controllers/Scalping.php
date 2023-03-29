<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Scalping extends CI_Controller
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
        $this->load->model('model_scalping');
    }

    public function index()
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
                if ($this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Socio') {
                    $token = $this->session->userdata('token');
                    $idxuser = $this->model_servicio->reportesxuser();

                    $year = $this->model_reporte->anoHoy();
                    $mes = $this->model_reporte->mesHoy();
                    $result['perfil'] = $this->model_login->cargar_datos();
                    $robot = "scalping";
                    $activacion = $this->model_servicio->activo_servicio($robot);
                    $result['servicio'] = $this->model_servicio->costos_robot($robot);
                    $result['billetera'] = $this->model_proceso->cargar_billetera($token);
                    if (count($idxuser) == 1) {
                        $ganancia = $this->model_servicio->ganancia($idxuser->idxuser, $robot);
                        $perdida = $this->model_servicio->perdida($idxuser->idxuser, $robot);
                        $valor = $this->model_servicio->comisiones();

                        $result['valor'] = number_format($valor->valor + ($ganancia->ganancia - $perdida->perdida), 2);
                    } else {
                        $ganancia = 0;
                        $perdida = 0;
                        $valor = $this->model_servicio->comisiones();

                        $result['valor'] = number_format($valor->valor + ($ganancia - $perdida), 2);
                    }
                    $result['requisito'] = $this->model_scalping->requisito();
                    $result['reportes'] = $this->model_servicio->reportes();
                    $result['disponibilidad'] = $this->model_servicio->consultarCampos();

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


                    $this->load->view('header_socio', $result);

                    $this->load->view('scalping/view_inicio', $result);
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

    public function comprarScalping($token)
    {
        $id = $this->input->post('robot');
        $billetera_user = $this->model_proceso->cargar_billetera($token);
        $servicio = $this->model_proceso->datosTraer($id);
        $datosPersona = $this->model_proceso->consultar_referido($token);
        $empresa = $this->model_proceso->consultar_referido_niveles(6);

        // consultar si hay plata
        if ($billetera_user->cuenta_compra >= $servicio->precio) {
            $data = array(
                "cuenta_compra" => $billetera_user->cuenta_compra - $servicio->precio,
            );
            $this->model_proceso->actualizar_wallet($data, $billetera_user->token);

            $papa = $this->model_proceso->consultar_referido_niveles($datosPersona->id_papa_pago);
            $activo_papa = $this->model_proceso->revisar_activo($datosPersona->id_papa_pago);

            //Consultar si tiene papa y pagar
            if (count($papa) == 1 && count($activo_papa) == 1) {
                $nivel1 = $this->model_proceso->traer_parametro(2);
                $resultado = $servicio->precio * $nivel1->valor;

                $billetera_papa = $this->model_proceso->cargar_billetera($papa->token);
                $data1 = array(
                    "cuenta_comision" => $billetera_papa->cuenta_comision + $resultado,
                );
                //historial de comisiones
                $pagar = array(
                    "usuario_id" => $datosPersona->id,
                    "beneficio_id" => $papa->id,
                    "valor" => $resultado,
                    "servicio" => $servicio->robot,
                    "detalle" => "compra Scalping"
                );
                $this->model_proceso->historialComisiones($pagar);

                $this->model_proceso->actualizar_wallet($data1, $billetera_papa->token);

                $abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);
                $activo_abuelo = $this->model_proceso->revisar_activo($papa->id_papa_pago);


                //Consultar si tiene abuelo y pagar
                if (count($abuelo) == 1 && count($activo_abuelo) == 1) {
                    $nivel2 = $this->model_proceso->traer_parametro(7);
                    $resultado2 = $servicio->precio * $nivel2->valor;

                    $billetera_abuelo = $this->model_proceso->cargar_billetera($abuelo->token);
                    $data2 = array(
                        "cuenta_comision" => $billetera_abuelo->cuenta_comision + $resultado2,
                    );
                    $this->model_proceso->actualizar_wallet($data2, $billetera_abuelo->token);
                    //Historial de comisiones
                    $pagar2 = array(
                        "usuario_id" => $datosPersona->id,
                        "beneficio_id" => $abuelo->id,
                        "valor" => $resultado2,
                        "servicio" => $servicio->robot,
                        "detalle" => "compra Scalping"
                    );
                    $this->model_proceso->historialComisiones($pagar2);

                    $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                    $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                    // Consultar si tiene bisabuelo y pagar
                    if (count($bisabuelo) == 1  && count($activo_bisabuelo) == 1) {
                        $nivel3 = $this->model_proceso->traer_parametro(8);
                        $resultado3 = $servicio->precio * $nivel3->valor;

                        $billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
                        $data3 = array(
                            "cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
                        );
                        $this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);

                        //historial de comisiones
                        $pagar3 = array(
                            "usuario_id" => $datosPersona->id,
                            "beneficio_id" => $bisabuelo->id,
                            "valor" => $resultado3,
                            "servicio" => $servicio->robot,
                            "detalle" => "compra Scalping"
                        );
                        $this->model_proceso->historialComisiones($pagar3);

                        //pago empresa
                        //AQUI EMPIEZA EL ERRORRRRRS
                        $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                        $data4 = array(
                            "cuenta_global" => $billetera_empresa->cuenta_global + $servicio->precio - $resultado - $resultado2 - $resultado3,
                        );
                        $this->model_proceso->actualizar_wallet_empresa($data4, $billetera_empresa->token);

                        //Activacion del servicio
                        $fecha_actual = date("Y-m-d");
                        $data5 = array(
                            "usuario_id" => $datosPersona->id,
                            "servicio" => $servicio->robot,
                            "fecha_compra" => $fecha_actual,
                            "activo" => 1,
                            "plan_id" => $id,
                            "fecha_termina" => date("Y-m-d", strtotime($fecha_actual . " + " . $servicio->dias . " days"))
                        );
                        $this->model_proceso->activar_servicio($data5);
                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Compra exitosa</div>');
                        redirect(base_url() . "Scalping", "refresh");
                    } else {
                        //No tiene paga directo la empresa
                        $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                        $data1 = array(
                            "cuenta_global" => $billetera_empresa->cuenta_global + $servicio->precio - $resultado - $resultado2,
                        );
                        $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

                        //Activacion del servicio
                        $fecha_actual = date("Y-m-d");
                        $data5 = array(
                            "usuario_id" => $datosPersona->id,
                            "servicio" => $servicio->robot,
                            "fecha_compra" => $fecha_actual,
                            "activo" => 1,
                            "plan_id" => $id,
                            "fecha_termina" => date("Y-m-d", strtotime($fecha_actual . " + " . $servicio->dias . " days"))
                        );
                        $this->model_proceso->activar_servicio($data5);
                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Compra exitosa</div>');
                        redirect(base_url() . "Scalping", "refresh");
                    }
                } elseif (count($abuelo) == 1 && count($activo_abuelo) == 0) {
                    $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                    $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                    // Consultar si tiene bisabuelo y pagar
                    if (count($bisabuelo) == 1  && count($activo_bisabuelo) == 1) {
                        $nivel3 = $this->model_proceso->traer_parametro(8);
                        $resultado3 = $servicio->precio * $nivel3->valor;

                        $billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
                        $data3 = array(
                            "cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
                        );
                        $this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);

                        //historial de comisiones
                        $pagar3 = array(
                            "usuario_id" => $datosPersona->id,
                            "beneficio_id" => $bisabuelo->id,
                            "valor" => $resultado3,
                            "servicio" => $servicio->robot,
                            "detalle" => "compra Scalping"
                        );
                        $this->model_proceso->historialComisiones($pagar3);

                        //pago empresa
                        //AQUI EMPIEZA EL ERRORRRRRS
                        $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                        $data4 = array(
                            "cuenta_global" => $billetera_empresa->cuenta_global + $servicio->precio - $resultado - $resultado3,
                        );
                        $this->model_proceso->actualizar_wallet_empresa($data4, $billetera_empresa->token);

                        //Activacion del servicio
                        $fecha_actual = date("Y-m-d");
                        $data5 = array(
                            "usuario_id" => $datosPersona->id,
                            "servicio" => $servicio->robot,
                            "fecha_compra" => $fecha_actual,
                            "activo" => 1,
                            "plan_id" => $id,
                            "fecha_termina" => date("Y-m-d", strtotime($fecha_actual . " + " . $servicio->dias . " days"))
                        );
                        $this->model_proceso->activar_servicio($data5);
                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Compra exitosa</div>');
                        redirect(base_url() . "Scalping", "refresh");
                    } else {
                        //No tiene paga directo la empresa
                        $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                        $data1 = array(
                            "cuenta_global" => $billetera_empresa->cuenta_global + $servicio->precio - $resultado,
                        );
                        $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

                        //Activacion del servicio
                        $fecha_actual = date("Y-m-d");
                        $data5 = array(
                            "usuario_id" => $datosPersona->id,
                            "servicio" => $servicio->robot,
                            "fecha_compra" => $fecha_actual,
                            "activo" => 1,
                            "plan_id" => $id,
                            "fecha_termina" => date("Y-m-d", strtotime($fecha_actual . " + " . $servicio->dias . " days"))
                        );
                        $this->model_proceso->activar_servicio($data5);
                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Compra exitosa</div>');
                        redirect(base_url() . "Scalping", "refresh");
                    }
                } else {
                    //No tiene paga directo la empresa

                    $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                    $data1 = array(
                        "cuenta_global" => $billetera_empresa->cuenta_global + $servicio->precio - $resultado,
                    );
                    $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                    //Activacion del servicio
                    $fecha_actual = date("Y-m-d");
                    $data5 = array(
                        "usuario_id" => $datosPersona->id,
                        "servicio" => $servicio->robot,
                        "fecha_compra" => $fecha_actual,
                        "activo" => 1,
                        "plan_id" => $id,
                        "fecha_termina" => date("Y-m-d", strtotime($fecha_actual . " + " . $servicio->dias . " days"))
                    );
                    $this->model_proceso->activar_servicio($data5);
                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Compra exitosa</div>');
                    redirect(base_url() . "Scalping", "refresh");
                }
            //No tiene paga directo la empresa
            } elseif (count($papa) == 1 && count($activo_papa) == 0) {
                $abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);
                $activo_abuelo = $this->model_proceso->revisar_activo($papa->id_papa_pago);


                //Consultar si tiene abuelo y pagar
                if (count($abuelo) == 1 && count($activo_abuelo) == 1) {
                    $nivel2 = $this->model_proceso->traer_parametro(7);
                    $resultado2 = $servicio->precio * $nivel2->valor;

                    $billetera_abuelo = $this->model_proceso->cargar_billetera($abuelo->token);
                    $data2 = array(
                        "cuenta_comision" => $billetera_abuelo->cuenta_comision + $resultado2,
                    );
                    $this->model_proceso->actualizar_wallet($data2, $billetera_abuelo->token);
                    //Historial de comisiones
                    $pagar2 = array(
                        "usuario_id" => $datosPersona->id,
                        "beneficio_id" => $abuelo->id,
                        "valor" => $resultado2,
                        "servicio" => $servicio->robot,
                        "detalle" => "compra Scalping"
                    );
                    $this->model_proceso->historialComisiones($pagar2);

                    $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                    $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                    // Consultar si tiene bisabuelo y pagar
                    if (count($bisabuelo) == 1  && count($activo_bisabuelo) == 1) {
                        $nivel3 = $this->model_proceso->traer_parametro(8);
                        $resultado3 = $servicio->precio * $nivel3->valor;

                        $billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
                        $data3 = array(
                            "cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
                        );
                        $this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);

                        //historial de comisiones
                        $pagar3 = array(
                            "usuario_id" => $datosPersona->id,
                            "beneficio_id" => $bisabuelo->id,
                            "valor" => $resultado3,
                            "servicio" => $servicio->robot,
                            "detalle" => "compra Scalping"
                        );
                        $this->model_proceso->historialComisiones($pagar3);

                        //pago empresa
                        //AQUI EMPIEZA EL ERRORRRRRS
                        $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                        $data4 = array(
                            "cuenta_global" => $billetera_empresa->cuenta_global + $servicio->precio - $resultado2 - $resultado3,
                        );
                        $this->model_proceso->actualizar_wallet_empresa($data4, $billetera_empresa->token);

                        //Activacion del servicio
                        $fecha_actual = date("Y-m-d");
                        $data5 = array(
                            "usuario_id" => $datosPersona->id,
                            "servicio" => $servicio->robot,
                            "fecha_compra" => $fecha_actual,
                            "activo" => 1,
                            "plan_id" => $id,
                            "fecha_termina" => date("Y-m-d", strtotime($fecha_actual . " + " . $servicio->dias . " days"))
                        );
                        $this->model_proceso->activar_servicio($data5);
                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Compra exitosa</div>');
                        redirect(base_url() . "Scalping", "refresh");
                    } else {
                        //No tiene paga directo la empresa
                        $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                        $data1 = array(
                            "cuenta_global" => $billetera_empresa->cuenta_global + $servicio->precio - $resultado2,
                        );
                        $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

                        //Activacion del servicio
                        $fecha_actual = date("Y-m-d");
                        $data5 = array(
                            "usuario_id" => $datosPersona->id,
                            "servicio" => $servicio->robot,
                            "fecha_compra" => $fecha_actual,
                            "activo" => 1,
                            "plan_id" => $id,
                            "fecha_termina" => date("Y-m-d", strtotime($fecha_actual . " + " . $servicio->dias . " days"))
                        );
                        $this->model_proceso->activar_servicio($data5);
                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Compra exitosa</div>');
                        redirect(base_url() . "Scalping", "refresh");
                    }
                } elseif (count($abuelo) == 1 && count($activo_abuelo) == 0) {
                    $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                    $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                    // Consultar si tiene bisabuelo y pagar
                    if (count($bisabuelo) == 1  && count($activo_bisabuelo) == 1) {
                        $nivel3 = $this->model_proceso->traer_parametro(8);
                        $resultado3 = $servicio->precio * $nivel3->valor;

                        $billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
                        $data3 = array(
                            "cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
                        );
                        $this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);

                        //historial de comisiones
                        $pagar3 = array(
                            "usuario_id" => $datosPersona->id,
                            "beneficio_id" => $bisabuelo->id,
                            "valor" => $resultado3,
                            "servicio" => $servicio->robot,
                            "detalle" => "compra Scalping"
                        );
                        $this->model_proceso->historialComisiones($pagar3);

                        //pago empresa
                        //AQUI EMPIEZA EL ERRORRRRRS
                        $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                        $data4 = array(
                            "cuenta_global" => $billetera_empresa->cuenta_global + $servicio->precio - $resultado3,
                        );
                        $this->model_proceso->actualizar_wallet_empresa($data4, $billetera_empresa->token);

                        //Activacion del servicio
                        $fecha_actual = date("Y-m-d");
                        $data5 = array(
                            "usuario_id" => $datosPersona->id,
                            "servicio" => $servicio->robot,
                            "fecha_compra" => $fecha_actual,
                            "activo" => 1,
                            "plan_id" => $id,
                            "fecha_termina" => date("Y-m-d", strtotime($fecha_actual . " + " . $servicio->dias . " days"))
                        );
                        $this->model_proceso->activar_servicio($data5);
                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Compra exitosa</div>');
                        redirect(base_url() . "Scalping", "refresh");
                    } else {
                        //No tiene paga directo la empresa
                        $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                        $data1 = array(
                            "cuenta_global" => $billetera_empresa->cuenta_global + $servicio->precio,
                        );
                        $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

                        //Activacion del servicio
                        $fecha_actual = date("Y-m-d");
                        $data5 = array(
                            "usuario_id" => $datosPersona->id,
                            "servicio" => $servicio->robot,
                            "fecha_compra" => $fecha_actual,
                            "activo" => 1,
                            "plan_id" => $id,
                            "fecha_termina" => date("Y-m-d", strtotime($fecha_actual . " + " . $servicio->dias . " days"))
                        );
                        $this->model_proceso->activar_servicio($data5);
                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Compra exitosa</div>');
                        redirect(base_url() . "Scalping", "refresh");
                    }
                } else {
                    //No tiene paga directo la empresa

                    $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                    $data1 = array(
                        "cuenta_global" => $billetera_empresa->cuenta_global + $servicio->precio,
                    );
                    $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                    //Activacion del servicio
                    $fecha_actual = date("Y-m-d");
                    $data5 = array(
                        "usuario_id" => $datosPersona->id,
                        "servicio" => $servicio->robot,
                        "fecha_compra" => $fecha_actual,
                        "activo" => 1,
                        "plan_id" => $id,
                        "fecha_termina" => date("Y-m-d", strtotime($fecha_actual . " + " . $servicio->dias . " days"))
                    );
                    $this->model_proceso->activar_servicio($data5);
                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Compra exitosa</div>');
                    redirect(base_url() . "Scalping", "refresh");
                }
            //No tiene paga directo la empresa
            } else {
                $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                $data1 = array(
                    "cuenta_global" => $billetera_empresa->cuenta_global + $servicio->precio,
                );
                $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                //Activacion del servicio
                $fecha_actual = date("Y-m-d");
                $data5 = array(
                    "usuario_id" => $datosPersona->id,
                    "servicio" => $servicio->robot,
                    "fecha_compra" => $fecha_actual,
                    "activo" => 1,
                    "plan_id" => $id,
                    "fecha_termina" => date("Y-m-d", strtotime($fecha_actual . " + " . $servicio->dias . " days"))
                );
                $this->model_proceso->activar_servicio($data5);
                $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Compra exitosa</div>');
                redirect(base_url() . "Scalping", "refresh");
            }
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">No tiene dinero suficiente</div>');
            redirect(base_url() . "Scalping", "refresh");
        }
    }

    public function registrar()
    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Ultra') {
                $result['perfil'] = $this->model_login->cargar_datos();
                $result['reportes'] = $this->model_scalping->traerDatos();
                $result['usuarios']= $this->model_scalping->usuarios();
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

                $this->load->view('scalping/view_table', $result);

                $this->load->view('footer_socio', $result);
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

    public function fondoScalping()
    {
        $usuario = $this->input->post('usuario');
        $valor = $this->input->post('valor');
        $servicio = $this->input->post('servicio');

        $cargar = $this->model_login->cargar_datosxuser($usuario);

        $data = array(
            "usuario_id" => $usuario,
            "valor" => $valor,
            "papa_id" => $cargar->id_papa_pago,
            "servicio" => $servicio
        );

        $historial = array(
            "usuario_id" => $usuario,
            "valor" => $valor,
            "robot" => $servicio
        );

        $this->model_proceso->deposito($historial);
        $this->model_scalping->insertarDeposito($data);
        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Fondeo exitoso</div>');
        redirect(base_url() ."Scalping/registrar");
    }

    public function fondoWsport()
    {
        $usuario = $this->input->post('usuario');
        $valor = $this->input->post('valor');
        $User = $this->input->post('User');

        $data = array(
            "usuario_papa" => $usuario,
            "valor" => $valor,
            "usuario_registro" => $User,
            "servicio" => 'Wsport'
        );

        $this->model_scalping->insertarDepositoW($data);
        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Fondeo exitoso</div>');
        redirect(base_url() ."Scalping/registrar");
    }
}