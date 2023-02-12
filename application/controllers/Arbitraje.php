<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Arbitraje extends CI_Controller
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

                    $inversion = $this->model_servicio->cargarCapital_arbitrajexid();
                    $year = $this->model_reporte->anoHoy();
                    $mes = $this->model_reporte->mesHoy();
                    $idxuser = $this->model_servicio->reportesxuser();
                    $result['perfil'] = $this->model_login->cargar_datos();
                    $robot = "arbitraje";
                    $activacion = $this->model_servicio->activo_servicio($robot);
                    $result['servicio'] = $this->model_servicio->costos_robot($robot);
                    $result['inversion'] = $this->model_servicio->cargarCapital_arbitraje();
                    $result['billetera'] = $this->model_proceso->cargar_billetera($token);
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
                    // if (count($idxuser) == 1) {
                    //     $result['reportes'] = $this->model_servicio->reportes();
                    //     $result['ganancia'] = $this->model_wallet->gananciasHoy($idxuser->idxuser);
                    //     $result['perdida'] = $this->model_wallet->perdidasHoy($idxuser->idxuser);
                    //     $result['porcentaje'] = $this->model_reporte->porcMeses($year->ano, $inversion->id);
                    //     $result['porcentajehoyG'] = $this->model_wallet->porcentajeHoyG($idxuser->idxuser);
                    //     $result['porcentajehoyP'] = $this->model_wallet->porcentajeHoyP($idxuser->idxuser);
                    //     $mesInicial = $this->model_reporte->inicialMes($idxuser->idxuser, $mes->mes, $year->ano);
                    //     $result['mesInicial'] =$mesInicial;
                    //     $result['gananciaMes'] = $this->model_reporte->gananciaMes($idxuser->idxuser, $mes->mes, $year->ano);
                    //     $result['perdidaMes'] = $this->model_reporte->perdidaMes($idxuser->idxuser, $mes->mes, $year->ano);
                    // } else {
                    //     $result['ganancia'] = 0;
                    //     $result['perdida'] = 0;
                    //     $result['reportes'] =  0;
                    //     $result['porcentaje'] = 0;
                    //     $result['porcentajehoyG'] = 0;
                    //     $result['mesInicial'] =0;
                    //     $result['gananciaMes'] = 0;
                    //     $result['perdidaMes'] = 0;
                    // }
                    $result['reportes'] = $this->model_servicio->reportes();
                    $result['retiro'] = $this->model_wallet->retiro();
                    $result['deposito'] = $this->model_wallet->deposito();
                    $result['disponibilidad'] = $this->model_servicio->consultarCampos();
                    $result['requisito'] = $this->model_scalping->requisito();
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
                            $this->model_proceso->desactivar($data,$robot);
                            $this->model_proceso->desactivar_inversion_arbitraje($data2);
                        }
                    } else {
                        $result['activo'] = 0;
                    }


                    $this->load->view('header_socio', $result);

                    $this->load->view('arbitraje/view_inicio', $result);
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

    public function parametroArbitraje()
    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin') {
                $result['perfil'] = $this->model_login->cargar_datos();
                $result['parametro'] = $this->model_socios->parametro();
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

                $this->load->view('socio/parametro_robot', $result);

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

    public function reportesRobot()
    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin') {
                $year = $this->model_reporte->anoHoy();
                $mes = $this->model_reporte->mesHoy();
                $result['balanceTotalMes'] = $this->model_reporte->balanceTotalMes($mes->mes, $year->ano);
                $result['balanceMensualRepartido'] = $this->model_reporte->balanceMensualRepartido($mes->mes, $year->ano);
                $result['perfil'] = $this->model_login->cargar_datos();
                $result['reportes'] = $this->model_socios->reportes();
                $result['Encender'] = $this->model_socios->traerFuncion();
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

                $this->load->view('socio/reporteRobot', $result);

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

    public function disponibilidadArbitraje()
    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Ultra' || $this->session->userdata('ROL') == 'SocioAdmin') {
                $result['perfil'] = $this->model_login->cargar_datos();
                $result['estado'] = $this->model_socios->estado();
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

                $this->load->view('socio/disponibilidad_arbitraje', $result);

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

    public function comprarArbitraje($token)
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
                $nivel1 = $this->model_proceso->traer_parametro_arbitraje(1);
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
                    "detalle" => "compra Arbitraje"
                );
                $this->model_proceso->historialComisiones($pagar);

                $this->model_proceso->actualizar_wallet($data1, $billetera_papa->token);

                $abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);
                $activo_abuelo = $this->model_proceso->revisar_activo($papa->id_papa_pago);


                //Consultar si tiene abuelo y pagar
                if (count($abuelo) == 1 && count($activo_abuelo) == 1) {
                    $nivel2 = $this->model_proceso->traer_parametro_arbitraje(2);
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
                        "detalle" => "compra Arbitraje"
                    );
                    $this->model_proceso->historialComisiones($pagar2);

                    $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                    $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                    // Consultar si tiene bisabuelo y pagar
                    if (count($bisabuelo) == 1  && count($activo_bisabuelo) == 1) {
                        $nivel3 = $this->model_proceso->traer_parametro_arbitraje(3);
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
                            "detalle" => "compra Arbitraje"
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
                        redirect(base_url() . "Arbitraje", "refresh");
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
                        redirect(base_url() . "Arbitraje", "refresh");
                    }
                } elseif (count($abuelo) == 1 && count($activo_abuelo) == 0) {
                    $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                    $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                    // Consultar si tiene bisabuelo y pagar
                    if (count($bisabuelo) == 1  && count($activo_bisabuelo) == 1) {
                        $nivel3 = $this->model_proceso->traer_parametro_arbitraje(3);
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
                            "detalle" => "compra Arbitraje"
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
                        redirect(base_url() . "Arbitraje", "refresh");
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
                        redirect(base_url() . "Arbitraje", "refresh");
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
                    redirect(base_url() . "Arbitraje", "refresh");
                }
            //No tiene paga directo la empresa
            } elseif (count($papa) == 1 && count($activo_papa) == 0) {
                $abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);
                $activo_abuelo = $this->model_proceso->revisar_activo($papa->id_papa_pago);


                //Consultar si tiene abuelo y pagar
                if (count($abuelo) == 1 && count($activo_abuelo) == 1) {
                    $nivel2 = $this->model_proceso->traer_parametro_arbitraje(2);
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
                        "detalle" => "compra Arbitraje"
                    );
                    $this->model_proceso->historialComisiones($pagar2);

                    $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                    $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                    // Consultar si tiene bisabuelo y pagar
                    if (count($bisabuelo) == 1  && count($activo_bisabuelo) == 1) {
                        $nivel3 = $this->model_proceso->traer_parametro_arbitraje(3);
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
                            "detalle" => "compra Arbitraje"
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
                        redirect(base_url() . "Arbitraje", "refresh");
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
                        redirect(base_url() . "Arbitraje", "refresh");
                    }
                } elseif (count($abuelo) == 1 && count($activo_abuelo) == 0) {
                    $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                    $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                    // Consultar si tiene bisabuelo y pagar
                    if (count($bisabuelo) == 1  && count($activo_bisabuelo) == 1) {
                        $nivel3 = $this->model_proceso->traer_parametro_arbitraje(3);
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
                            "detalle" => "compra Arbitraje"
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
                        redirect(base_url() . "Arbitraje", "refresh");
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
                        redirect(base_url() . "Arbitraje", "refresh");
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
                    redirect(base_url() . "Arbitraje", "refresh");
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
                redirect(base_url() . "Arbitraje", "refresh");
            }
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">No tiene dinero suficiente</div>');
            redirect(base_url() . "Arbitraje", "refresh");
        }
    }

    public function invertirArbitraje($token)
    {
        $billetera = $this->model_banco->billetera($token);
        $valor = $this->input->post('inversion');
        $datosPersona = $this->model_proceso->consultar_referido($token);
        $empresa = $this->model_proceso->consultar_referido_niveles(6);

        //Consultar si hay plata
        if ($valor >= 100) {
            if ($billetera->cuenta_compra >= $valor) {
                $restar = $billetera->cuenta_compra - $valor;
                $data = array(
                    "cuenta_compra" => $restar
                );

                if ($this->model_banco->updBilletera($token, $data) == 1) {
                    $datosInversion = $this->model_proceso->cargarCapital_arbitraje();
                    if (count($datosInversion) == 1) {
                        $data2 = array(
                            "valor" => $valor + $datosInversion->inversion,
                        );
                        $historial = array(
                            "usuario_id" => $datosPersona->id,
                            "valor" => $valor,
                            "robot" => 'arbitraje'
                        );

                        $terminos = array(
                            "usuario_id" => $this->input->post('terminos'),
                            "acepta" => "Estoy de acuerdo",
                            "nota" => "fondeo arbitraje"
                        );

                        $this->model_terminos->insertTerminos($terminos);
                        $this->model_proceso->actualizarInversion_arbitraje($datosInversion->id, $data2);
                        $this->model_proceso->deposito($historial);
                        //Consultar si tiene papá
                        $papa = $this->model_proceso->consultar_referido_niveles($datosPersona->id_papa_pago);
                        if (count($papa) == 1) {
                            $nivel1 = $this->model_proceso->traer_parametro_arbitraje(4);
                            $resultado = $valor * $nivel1->valor;

                            $billetera_papa = $this->model_proceso->cargar_billetera($papa->token);
                            $data1 = array(
                                "cuenta_comision" => $billetera_papa->cuenta_comision + $resultado,
                            );
                            //historial de comisiones
                            $pagar = array(
                                "usuario_id" => $datosPersona->id,
                                "beneficio_id" => $papa->id,
                                "valor" => $resultado,
                                "servicio" => "Arbitraje",
                                "detalle" => "invertir Arbitraje"
                            );
                            $this->model_proceso->historialComisiones($pagar);

                            $this->model_proceso->actualizar_wallet($data1, $billetera_papa->token);
                            $abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);
                            if (count($abuelo) == 1) {
                                $nivel2 = $this->model_proceso->traer_parametro_arbitraje(5);
                                $resultado2 = $valor * $nivel2->valor;

                                $billetera_abuelo = $this->model_proceso->cargar_billetera($abuelo->token);
                                $data2 = array(
                                    "cuenta_comision" => $billetera_abuelo->cuenta_comision + $resultado2,
                                );
                                //historial de comisiones
                                $pagar2 = array(
                                    "usuario_id" => $papa->id,
                                    "beneficio_id" => $abuelo->id,
                                    "valor" => $resultado2,
                                    "servicio" => "arbitraje",
                                    "detalle" => "invertir Arbitraje"
                                );
                                $this->model_proceso->historialComisiones($pagar2);

                                $this->model_proceso->actualizar_wallet($data2, $billetera_abuelo->token);
                                $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                                //Verificar pago bisabuelo
                                if (count($bisabuelo) == 1) {
                                    $nivel3 = $this->model_proceso->traer_parametro_arbitraje(6);
                                    $resultado3 = $valor * $nivel3->valor;

                                    $billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
                                    $data3 = array(
                                        "cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
                                    );
                                    //historial de comisiones
                                    $pagar3 = array(
                                        "usuario_id" => $abuelo->id,
                                        "beneficio_id" => $bisabuelo->id,
                                        "valor" => $resultado3,
                                        "servicio" => "arbitraje",
                                        "detalle" => "invertir Arbitraje"
                                    );
                                    $this->model_proceso->historialComisiones($pagar3);

                                    $this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);
                                    //empresa
                                    $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                                    $data4 = array(
                                        "cuenta_arbitraje" => $billetera_empresa->cuenta_arbitraje + $valor - $resultado - $resultado2 - $resultado3,
                                    );
                                    $this->model_proceso->actualizar_wallet_empresa($data4, $billetera_empresa->token);
                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Inversion exitosa Esperar a confirmación (24H)</div>');
                                    redirect(base_url() . "Arbitraje", "refresh");
                                } else {
                                    //No tiene paga directamente
                                    $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                                    $data1 = array(
                                        "cuenta_arbitraje" => $billetera_empresa->cuenta_arbitraje + $valor - $resultado - $resultado2,
                                    );
                                    $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Inversion exitosa Esperar a confirmación (24H)</div>');
                                    redirect(base_url() . "Arbitraje", "refresh");
                                }
                            } else {
                                //No tiene paga directamente
                                $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                                $data1 = array(
                                    "cuenta_arbitraje" => $billetera_empresa->cuenta_arbitraje + $valor - $resultado,
                                );
                                $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Inversion exitosa Esperar a confirmación (24H)</div>');
                                redirect(base_url() . "Arbitraje", "refresh");
                            }
                        } else {
                            //No tiene paga directamente
                            $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                            $data1 = array(
                                "cuenta_arbitraje" => $billetera_empresa->cuenta_compra + $valor,
                            );
                            $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                            $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Inversion exitosa Esperar a confirmación (24H)</div>');
                            redirect(base_url() . "Arbitraje", "refresh");
                        }
                    } else {
                        $data2 = array(
                            "valor" => $valor,
                            "usuario_id" => $datosPersona->id,
                            "servicio" => "arbitraje",
                            "activo" => 1
                        );

                        $historial = array(
                            "usuario_id" => $datosPersona->id,
                            "valor" => $valor,
                            "robot" => 'arbitraje'
                        );
                        $this->model_proceso->deposito($historial);

                        $this->model_servicio->insertInversion($data2);

                        //Consultar si tiene papá
                        $papa = $this->model_proceso->consultar_referido_niveles($datosPersona->id_papa_pago);
                        if (count($papa) == 1) {
                            $nivel1 = $this->model_proceso->traer_parametro_arbitraje(4);
                            $resultado = $valor * $nivel1->valor;

                            $billetera_papa = $this->model_proceso->cargar_billetera($papa->token);
                            $data1 = array(
                                "cuenta_comision" => $billetera_papa->cuenta_comision + $resultado,
                            );
                            //historial de comisiones
                            $pagar = array(
                                "usuario_id" => $datosPersona->id,
                                "beneficio_id" => $papa->id,
                                "valor" => $resultado,
                                "servicio" => "arbitraje",
                                "detalle" => "invertir Arbitraje"
                            );
                            $this->model_proceso->historialComisiones($pagar);

                            $this->model_proceso->actualizar_wallet($data1, $billetera_papa->token);
                            $abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);
                            if (count($abuelo) == 1) {
                                $nivel2 = $this->model_proceso->traer_parametro_arbitraje(5);
                                $resultado2 = $valor * $nivel2->valor;

                                $billetera_abuelo = $this->model_proceso->cargar_billetera($abuelo->token);
                                $data2 = array(
                                    "cuenta_comision" => $billetera_abuelo->cuenta_comision + $resultado2,
                                );
                                //historial de comisiones
                                $pagar2 = array(
                                    "usuario_id" => $papa->id,
                                    "beneficio_id" => $abuelo->id,
                                    "valor" => $resultado2,
                                    "servicio" => "arbitraje",
                                    "detalle" => "invertir Arbitraje"
                                );
                                $this->model_proceso->historialComisiones($pagar2);

                                $this->model_proceso->actualizar_wallet($data2, $billetera_abuelo->token);
                                $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                                //Verificar pago bisabuelo
                                if (count($bisabuelo) == 1) {
                                    $nivel3 = $this->model_proceso->traer_parametro_arbitraje(6);
                                    $resultado3 = $valor * $nivel3->valor;

                                    $billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
                                    $data3 = array(
                                        "cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
                                    );
                                    //historial de comisiones
                                    $pagar3 = array(
                                        "usuario_id" => $abuelo->id,
                                        "beneficio_id" => $bisabuelo->id,
                                        "valor" => $resultado3,
                                        "servicio" => "arbitraje",
                                        "detalle" => "invertir Arbitraje"
                                    );
                                    $this->model_proceso->historialComisiones($pagar3);

                                    $this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);
                                    //empresa
                                    $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                                    $data4 = array(
                                        "cuenta_arbitraje" => $billetera_empresa->cuenta_arbitraje + $valor - $resultado - $resultado2 - $resultado3,
                                    );
                                    $this->model_proceso->actualizar_wallet_empresa($data4, $billetera_empresa->token);
                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Inversion exitosa Esperar a confirmación (24H)</div>');
                                    redirect(base_url() . "Arbitraje", "refresh");
                                } else {
                                    //No tiene paga directamente
                                    $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                                    $data1 = array(
                                        "cuenta_arbitraje" => $billetera_empresa->cuenta_arbitraje + $valor - $resultado - $resultado2,
                                    );
                                    $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Inversion exitosa Esperar a confirmación (24H)</div>');
                                    redirect(base_url() . "Arbitraje", "refresh");
                                }
                            } else {
                                //No tiene paga directamente
                                $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                                $data1 = array(
                                    "cuenta_arbitraje" => $billetera_empresa->cuenta_arbitraje + $valor - $resultado,
                                );
                                $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Inversion exitosa Esperar a confirmación (24H)</div>');
                                redirect(base_url() . "Arbitraje", "refresh");
                            }
                        } else {
                            //No tiene paga directamente
                            $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
                            $data1 = array(
                                "cuenta_arbitraje" => $billetera_empresa->cuenta_arbitraje + $valor,
                            );
                            $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                            $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Inversion exitosa Esperar a confirmación (24H)</div>');
                            redirect(base_url() . "Arbitraje", "refresh");
                        }
                    }
                } else {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Error al descontar</div>');
                    redirect(base_url() . "Arbitraje", "refresh");
                }
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">No tiene dinero suficiente</div>');
                redirect(base_url() . "Arbitraje", "refresh");
            }
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">La inversion debe ser mayor a 100</div>');
            redirect(base_url() . "Arbitraje", "refresh");
        }
    }

    public function updParametros($id)
    {
        $data = array(
            "porcen_deseado" => $this->input->post('porcentaje'),
            "h_inicio_no_operar" => $this->input->post('hora_inicio'),
            "h_fin_no_operar" => $this->input->post('hora_fin')
        );

        $this->model_socios->updParametrosArbitraje($data, $id);
        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Cambio Realizados</div>');
        redirect(base_url() . "Arbitraje/parametroArbitraje", "refresh");
    }

    public function inversionValidar()
    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Ultra') {
                $result['perfil'] = $this->model_login->cargar_datos();
                $result['consigna'] = $this->model_banco->cargar_inversion();
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

                $this->load->view('binarios/view_table', $result);

                $this->load->view('footer_socio', $result);
            } else {
                $intruso = array(

                    'id_usuario' => $this->session->userdata('ID'),

                    'texto' => 'Arbitraje/consignaciones',

                    'fecha_registro' => date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("" . base_url() . "errorpage/error");
            }
        } else {
            redirect("" . base_url() . "login/");
        }
    }

    public function aprobacionInversion($id)
    {
        $update = array(
            "consignado" => 1
        );
        $this->model_servicio->inversion($id, $update);

        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center"><label class="login__input name">Inversion subida</label></div>');
        redirect(base_url() . "Arbitraje/inversionValidar", "refresh");
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

    public function configuracion($valor)
    {
        $data = array(
            'valor' => 1,
            'valor2' => $valor
        );

        $this->model_socios->updateFuncion($data);

        redirect(base_url()."Arbitraje/reportesRobot");
    }
}
