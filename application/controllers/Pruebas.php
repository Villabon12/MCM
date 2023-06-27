<?php
use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
class Pruebas extends CI_Controller
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
    }
    //vistas intefaz de usuario
    public function retiros()
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
                if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Ultra') {
                    $token = $this->session->userdata('token');

                    $result['perfil'] = $this->model_login->cargar_datos();
                    $result['consigna'] = $this->model_banco->cargarHistorial();
                    $result['inversion'] = $this->model_servicio->cargarCapitalxid();
                    $result['binaria'] = $this->model_proceso->traer_parametro(18);
                    $result['equipo'] = $this->model_proceso->traer_parametro(19);
                    $result['juego'] = $this->model_proceso->traer_parametro(23);
                    $result['billetera'] = $this->model_proceso->cargar_billetera($token);
                    $result['disponibilidad'] = $this->model_servicio->consultarCampos();

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

                    $this->load->view('prueba/retiros', $result);
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
    public function retirosGeneral()
    {
        $perfil = $this->model_login->cargar_datos();
        $billeteraPersonal = $this->model_proceso->cargar_billetera($perfil->token);
        $retiro = $this->input->post('retiro');

        $tipo_billetera = $this->input->post('billetera');

        $walletBinance = $this->input->post('wallet');



        if ($tipo_billetera == 1) {
            $codigo = $this->input->post('codigo');
            $date = new DateTime();
            $NombreBilletera = "Binarias";
            if ($perfil->fecha_caduca_cod >= $date->format('Y-m-d H:i:s')) {
                if ($codigo == $perfil->codigo_seguridad) {
                    $datos = $this->model_proceso->cargarInversion($perfil->id);
                    if ($datos == false) {
                        $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Valor insuficiente en la inversion</label></div>');
                        redirect(base_url() . "Retiros", "refresh");
                    } else {
                        if ($retiro <= $datos->inversion) {
                            $arre = array(
                                "inversion" => $datos->inversion - $retiro
                            );

                            $historial = array(
                                "usuario_id" => $perfil->id,
                                "valor" => $retiro,
                                "robot" => 'binarias'
                            );
                            $this->model_proceso->retirosI($historial);
                            $this->model_proceso->actualizarInversion($datos->id, $arre);
                            $porc = $this->model_proceso->traer_parametro(18);
                            $restar = $retiro * $porc->valor;

                            $valor = $retiro - $restar;


                            //pago persona

                            $arre2 = array(
                                "cuenta_compra" => $billeteraPersonal->cuenta_compra + $retiro - $restar
                            );

                            $this->model_proceso->actualizar_wallet($arre2, $billeteraPersonal->token);

                            $papa = $this->model_proceso->consultar_referido_niveles($perfil->id_papa_pago);
                            $activo_papa = $this->model_proceso->revisar_activo($perfil->id_papa_pago);

                            //empieza proceso de pago
                            $this->realizarRetiroWallet($codigo, $valor, $walletBinance, $NombreBilletera);

                            //Consultar si tiene papa y compró el servicio del robot y pagar
                            if ($papa != false && $activo_papa != false) {
                                $nivel1 = $this->model_proceso->traer_parametro(15);
                                $resultado = $restar * $nivel1->valor;

                                $billetera_papa = $this->model_proceso->cargar_billetera($papa->token);
                                $data1 = array(
                                    "cuenta_comision" => $billetera_papa->cuenta_comision + $resultado,
                                );
                                //historial de comisiones
                                $pagar = array(
                                    "usuario_id" => $perfil->id,
                                    "beneficio_id" => $papa->id,
                                    "valor" => $resultado,
                                    "servicio" => "binaria",
                                    "detalle" => "retiro inversion binaria"
                                );
                                $this->model_proceso->historialComisiones($pagar);

                                $this->model_proceso->actualizar_wallet($data1, $billetera_papa->token);

                                $abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);
                                $activo_abuelo = $this->model_proceso->revisar_activo($papa->id_papa_pago);


                                //Consultar si tiene abuelo y pagar
                                if ($abuelo != false && $activo_abuelo != false) {
                                    $nivel2 = $this->model_proceso->traer_parametro(16);
                                    $resultado2 = $restar * $nivel2->valor;

                                    $billetera_abuelo = $this->model_proceso->cargar_billetera($abuelo->token);
                                    $data2 = array(
                                        "cuenta_comision" => $billetera_abuelo->cuenta_comision + $resultado2,
                                    );
                                    $this->model_proceso->actualizar_wallet($data2, $billetera_abuelo->token);
                                    //Historial de comisiones
                                    $pagar2 = array(
                                        "usuario_id" => $perfil->id,
                                        "beneficio_id" => $abuelo->id,
                                        "valor" => $resultado2,
                                        "servicio" => "binaria",
                                        "detalle" => "retiro inversion binaria"
                                    );
                                    $this->model_proceso->historialComisiones($pagar2);

                                    $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                                    $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                                    // Consultar si tiene bisabuelo y pagar
                                    if ($bisabuelo != false && $activo_bisabuelo != false) {
                                        $nivel3 = $this->model_proceso->traer_parametro(17);
                                        $resultado3 = $restar * $nivel3->valor;

                                        $billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
                                        $data3 = array(
                                            "cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
                                        );
                                        $this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);

                                        //historial de comisiones
                                        $pagar3 = array(
                                            "usuario_id" => $perfil->id,
                                            "beneficio_id" => $bisabuelo->id,
                                            "valor" => $resultado3,
                                            "servicio" => "binaria",
                                            "detalle" => "retiro inversion binaria"
                                        );
                                        $this->model_proceso->historialComisiones($pagar3);

                                        $historial2 = array(
                                            "usuario_id" => $perfil->id,
                                            "valor" => $retiro,
                                            "detalle" => "retiro inversion"
                                        );
                                        $this->model_proceso->historialRetiro($historial2);

                                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                        redirect(base_url() . "Retiros", "refresh");
                                    } else {
                                        //No tiene paga directo la empresa
                                        $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                        $data1 = array(
                                            "cuenta_global" => $billetera_empresa->cuenta_global + $restar - $resultado - $resultado2,
                                        );
                                        $historial2 = array(
                                            "usuario_id" => $perfil->id,
                                            "valor" => $retiro,
                                            "detalle" => "retiro inversion"
                                        );
                                        $this->model_proceso->historialRetiro($historial2);

                                        $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

                                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                        redirect(base_url() . "Retiros", "refresh");
                                    }
                                } elseif ($abuelo != false && $activo_abuelo == false) {
                                    $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                                    $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                                    // Consultar si tiene bisabuelo y pagar
                                    if ($bisabuelo != false && $activo_bisabuelo != false) {
                                        $nivel3 = $this->model_proceso->traer_parametro(17);
                                        $resultado3 = $restar * $nivel3->valor;

                                        $billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
                                        $data3 = array(
                                            "cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
                                        );
                                        $this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);

                                        //historial de comisiones
                                        $pagar3 = array(
                                            "usuario_id" => $perfil->id,
                                            "beneficio_id" => $bisabuelo->id,
                                            "valor" => $resultado3,
                                            "servicio" => "binaria",
                                            "detalle" => "retiro inversion binaria"
                                        );
                                        $this->model_proceso->historialComisiones($pagar3);
                                        $historial2 = array(
                                            "usuario_id" => $perfil->id,
                                            "valor" => $retiro,
                                            "detalle" => "retiro inversion"
                                        );
                                        $this->model_proceso->historialRetiro($historial2);


                                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                        redirect(base_url() . "Retiros", "refresh");
                                    } else {
                                        //No tiene paga directo la empresa
                                        $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                        $data1 = array(
                                            "cuenta_global" => $billetera_empresa->cuenta_global + $restar - $resultado,
                                        );
                                        $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                        $historial2 = array(
                                            "usuario_id" => $perfil->id,
                                            "valor" => $retiro,
                                            "detalle" => "retiro inversion"
                                        );
                                        $this->model_proceso->historialRetiro($historial2);

                                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                        redirect(base_url() . "Retiros", "refresh");
                                    }
                                } else {
                                    //No tiene paga directo la empresa
                                    $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                    $data1 = array(
                                        "cuenta_global" => $billetera_empresa->cuenta_global + $restar - $resultado,
                                    );
                                    $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                    $historial2 = array(
                                        "usuario_id" => $perfil->id,
                                        "valor" => $retiro,
                                        "detalle" => "retiro inversion"
                                    );
                                    $this->model_proceso->historialRetiro($historial2);

                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                    redirect(base_url() . "Retiros", "refresh");
                                }
                            } elseif ($papa != false && $activo_papa == false) {
                                $abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);
                                $activo_abuelo = $this->model_proceso->revisar_activo($papa->id_papa_pago);


                                //Consultar si tiene abuelo y pagar
                                if ($abuelo != false && $activo_abuelo != false) {
                                    $nivel2 = $this->model_proceso->traer_parametro(16);
                                    $resultado2 = $restar * $nivel2->valor;

                                    $billetera_abuelo = $this->model_proceso->cargar_billetera($abuelo->token);
                                    $data2 = array(
                                        "cuenta_comision" => $billetera_abuelo->cuenta_comision + $resultado2,
                                    );
                                    $this->model_proceso->actualizar_wallet($data2, $billetera_abuelo->token);
                                    //Historial de comisiones
                                    $pagar2 = array(
                                        "usuario_id" => $perfil->id,
                                        "beneficio_id" => $abuelo->id,
                                        "valor" => $resultado2,
                                        "servicio" => "binaria",
                                        "detalle" => "retiro inversion binaria"
                                    );
                                    $this->model_proceso->historialComisiones($pagar2);

                                    $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                                    $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                                    // Consultar si tiene bisabuelo y pagar
                                    if ($bisabuelo != false && $activo_bisabuelo != false) {
                                        $nivel3 = $this->model_proceso->traer_parametro(17);
                                        $resultado3 = $restar * $nivel3->valor;

                                        $billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
                                        $data3 = array(
                                            "cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
                                        );
                                        $this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);

                                        //historial de comisiones
                                        $pagar3 = array(
                                            "usuario_id" => $perfil->id,
                                            "beneficio_id" => $bisabuelo->id,
                                            "valor" => $resultado3,
                                            "servicio" => "binaria",
                                            "detalle" => "retiro inversion binaria"
                                        );
                                        $this->model_proceso->historialComisiones($pagar3);
                                        $historial2 = array(
                                            "usuario_id" => $perfil->id,
                                            "valor" => $retiro,
                                            "detalle" => "retiro inversion"
                                        );
                                        $this->model_proceso->historialRetiro($historial2);

                                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                        redirect(base_url() . "Retiros", "refresh");
                                    } else {
                                        //No tiene paga directo la empresa
                                        $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                        $data1 = array(
                                            "cuenta_global" => $billetera_empresa->cuenta_global + $restar - $resultado2,
                                        );
                                        $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                        $historial2 = array(
                                            "usuario_id" => $perfil->id,
                                            "valor" => $retiro,
                                            "detalle" => "retiro inversion"
                                        );
                                        $this->model_proceso->historialRetiro($historial2);

                                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                        redirect(base_url() . "Retiros", "refresh");
                                    }
                                } elseif ($abuelo != false && $activo_abuelo == false) {
                                    $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                                    $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                                    // Consultar si tiene bisabuelo y pagar
                                    if ($bisabuelo != false && $activo_bisabuelo != false) {
                                        $nivel3 = $this->model_proceso->traer_parametro(17);
                                        $resultado3 = $restar * $nivel3->valor;

                                        $billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
                                        $data3 = array(
                                            "cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
                                        );
                                        $this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);

                                        //historial de comisiones
                                        $pagar3 = array(
                                            "usuario_id" => $perfil->id,
                                            "beneficio_id" => $bisabuelo->id,
                                            "valor" => $resultado3,
                                            "servicio" => "binaria",
                                            "detalle" => "retiro inversion binaria"
                                        );
                                        $this->model_proceso->historialComisiones($pagar3);
                                        $historial2 = array(
                                            "usuario_id" => $perfil->id,
                                            "valor" => $retiro,
                                            "detalle" => "retiro inversion"
                                        );
                                        $this->model_proceso->historialRetiro($historial2);


                                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                        redirect(base_url() . "Retiros", "refresh");
                                    } else {
                                        //No tiene paga directo la empresa
                                        $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                        $data1 = array(
                                            "cuenta_global" => $billetera_empresa->cuenta_global + $restar,
                                        );
                                        $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

                                        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                        redirect(base_url() . "Retiros", "refresh");
                                    }
                                } else {
                                    //No tiene paga directo la empresa
                                    $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                    $data1 = array(
                                        "cuenta_global" => $billetera_empresa->cuenta_global + $restar,
                                    );
                                    $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                    $historial2 = array(
                                        "usuario_id" => $perfil->id,
                                        "valor" => $retiro,
                                        "detalle" => "retiro inversion"
                                    );
                                    $this->model_proceso->historialRetiro($historial2);

                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                    redirect(base_url() . "Retiros", "refresh");
                                }
                            } else {
                                //No tiene paga directo la empresa
                                $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                $data1 = array(
                                    "cuenta_global" => $billetera_empresa->cuenta_global + $restar,
                                );
                                $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                $historial2 = array(
                                    "usuario_id" => $perfil->id,
                                    "valor" => $retiro,
                                    "detalle" => "retiro inversion"
                                );
                                $this->model_proceso->historialRetiro($historial2);

                                $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                redirect(base_url() . "Retiros", "refresh");
                            }
                        } else {
                            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Valor insuficiente en la inversion</label></div>');
                            redirect(base_url() . "Retiros", "refresh");
                        }
                        ;
                    }
                } else {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Codigo de seguridad no son iguales</label></div>');
                    redirect(base_url() . "Retiros", "refresh");
                }
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Vuelve a solicitar codigo, ya pasó 3 minutos</label></div>');
                redirect(base_url() . "Retiros", "refresh");
            }
        } elseif ($tipo_billetera == 2) {
            $codigo = $this->input->post('codigo');
            $date = new DateTime();
            $NombreBilletera = "Comision";
            if ($perfil->fecha_caduca_cod >= $date->format('Y-m-d H:i:s')) {
                if ($codigo == $perfil->codigo_seguridad) {
                    if ($retiro <= $billeteraPersonal->cuenta_comision) {
                        $arre = array(
                            "cuenta_comision" => $billeteraPersonal->cuenta_comision - $retiro
                        );
                        $this->model_proceso->actualizar_wallet($arre, $billeteraPersonal->token);
                        $porc = $this->model_proceso->traer_parametro(19);
                        $restar = $retiro * $porc->valor;

                        $valor = $retiro - $restar;

                        //empieza proceso de pago
                        $this->realizarRetiroWallet($codigo, $valor, $walletBinance, $NombreBilletera);

                        //pago persona

                        $arre2 = array(
                            "cuenta_compra" => $billeteraPersonal->cuenta_compra + $retiro - $restar
                        );

                        $this->model_proceso->actualizar_wallet($arre2, $billeteraPersonal->token);

                        $papa = $this->model_proceso->consultar_referido_niveles($perfil->id_papa_pago);
                        $activo_papa = $this->model_proceso->revisar_activo($perfil->id_papa_pago);
                        //Consultar si tiene papa y compró el servicio del robot y pagar
                        if ($papa != false && $activo_papa != false) {
                            $nivel1 = $this->model_proceso->traer_parametro(20);
                            $resultado = $restar * $nivel1->valor;

                            $billetera_papa = $this->model_proceso->cargar_billetera($papa->token);
                            $data1 = array(
                                "cuenta_comision" => $billetera_papa->cuenta_comision + $resultado,
                            );
                            //historial de comisiones
                            $pagar = array(
                                "usuario_id" => $perfil->id,
                                "beneficio_id" => $papa->id,
                                "valor" => $resultado,
                                "servicio" => "binaria",
                                "detalle" => "retiro equipo comision"
                            );
                            $this->model_proceso->historialComisiones($pagar);

                            $this->model_proceso->actualizar_wallet($data1, $billetera_papa->token);

                            $abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);
                            $activo_abuelo = $this->model_proceso->revisar_activo($papa->id_papa_pago);

                            //Consultar si tiene abuelo y compró el servicio del robot y pagar
                            if ($abuelo != false && $activo_abuelo != false) {
                                $nivel2 = $this->model_proceso->traer_parametro(21);
                                $resultado2 = $restar * $nivel2->valor;

                                $billetera_abuelo = $this->model_proceso->cargar_billetera($abuelo->token);
                                $data2 = array(
                                    "cuenta_comision" => $billetera_abuelo->cuenta_comision + $resultado2,
                                );
                                $this->model_proceso->actualizar_wallet($data2, $billetera_abuelo->token);
                                //Historial de comisiones
                                $pagar2 = array(
                                    "usuario_id" => $perfil->id,
                                    "beneficio_id" => $abuelo->id,
                                    "valor" => $resultado2,
                                    "servicio" => "binaria",
                                    "detalle" => "retiro equipo comision"
                                );
                                $this->model_proceso->historialComisiones($pagar2);

                                $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                                $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                                // Consultar si tiene bisabuelo y compró el servicio del robot y pagar
                                if ($bisabuelo != false && $activo_bisabuelo != false) {
                                    $nivel3 = $this->model_proceso->traer_parametro(22);
                                    $resultado3 = $restar * $nivel3->valor;

                                    $billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
                                    $data3 = array(
                                        "cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
                                    );
                                    $this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);

                                    //historial de comisiones
                                    $pagar3 = array(
                                        "usuario_id" => $perfil->id,
                                        "beneficio_id" => $bisabuelo->id,
                                        "valor" => $resultado3,
                                        "servicio" => "binaria",
                                        "detalle" => "retiro equipo comision"
                                    );
                                    $this->model_proceso->historialComisiones($pagar3);

                                    $historial2 = array(
                                        "usuario_id" => $perfil->id,
                                        "valor" => $retiro,
                                        "detalle" => "retiro equipo"
                                    );
                                    $this->model_proceso->historialRetiro($historial2);

                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                    redirect(base_url() . "Retiros", "refresh");
                                } else {
                                    //No tiene paga directo la empresa
                                    $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                    $data1 = array(
                                        "cuenta_global" => $billetera_empresa->cuenta_global + $restar - $resultado - $resultado2,
                                    );
                                    $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

                                    $historial2 = array(
                                        "usuario_id" => $perfil->id,
                                        "valor" => $retiro,
                                        "detalle" => "retiro equipo"
                                    );
                                    $this->model_proceso->historialRetiro($historial2);

                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                    redirect(base_url() . "Retiros", "refresh");
                                }
                            } elseif ($abuelo != false && $activo_abuelo == false) {
                                // No compró el servicio de robot, pasa al siguiente
                                $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                                $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                                // Consultar si tiene bisabuelo y compró el servicio del robot y pagar
                                if ($bisabuelo != false && $activo_bisabuelo != false) {
                                    $nivel3 = $this->model_proceso->traer_parametro(22);
                                    $resultado3 = $restar * $nivel3->valor;

                                    $billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
                                    $data3 = array(
                                        "cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
                                    );
                                    $this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);

                                    //historial de comisiones
                                    $pagar3 = array(
                                        "usuario_id" => $perfil->id,
                                        "beneficio_id" => $bisabuelo->id,
                                        "valor" => $resultado3,
                                        "servicio" => "binaria",
                                        "detalle" => "retiro equipo comision"
                                    );
                                    $this->model_proceso->historialComisiones($pagar3);

                                    $historial2 = array(
                                        "usuario_id" => $perfil->id,
                                        "valor" => $retiro,
                                        "detalle" => "retiro equipo"
                                    );
                                    $this->model_proceso->historialRetiro($historial2);


                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                    redirect(base_url() . "Retiros", "refresh");
                                } else {
                                    //No tiene paga directo la empresa
                                    $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                    $data1 = array(
                                        "cuenta_global" => $billetera_empresa->cuenta_global + $restar - $resultado,
                                    );
                                    $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                    $historial2 = array(
                                        "usuario_id" => $perfil->id,
                                        "valor" => $retiro,
                                        "detalle" => "retiro equipo"
                                    );
                                    $this->model_proceso->historialRetiro($historial2);

                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                    redirect(base_url() . "Retiros", "refresh");
                                }
                            } else {
                                //No tiene paga directo la empresa
                                $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                $data1 = array(
                                    "cuenta_global" => $billetera_empresa->cuenta_global + $restar - $resultado,
                                );
                                $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                $historial2 = array(
                                    "usuario_id" => $perfil->id,
                                    "valor" => $retiro,
                                    "detalle" => "retiro equipo"
                                );
                                $this->model_proceso->historialRetiro($historial2);

                                $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                redirect(base_url() . "Retiros", "refresh");
                            }
                        } elseif ($papa != false && $activo_papa == false) {
                            //no tiene comprado el servicio del robot pasa el siguiente
                            $abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);
                            $activo_abuelo = $this->model_proceso->revisar_activo($papa->id_papa_pago);

                            //Consultar si tiene abuelo y pagar
                            if ($abuelo != false && $activo_abuelo != false) {
                                $nivel2 = $this->model_proceso->traer_parametro(21);
                                $resultado2 = $restar * $nivel2->valor;

                                $billetera_abuelo = $this->model_proceso->cargar_billetera($abuelo->token);
                                $data2 = array(
                                    "cuenta_comision" => $billetera_abuelo->cuenta_comision + $resultado2,
                                );
                                $this->model_proceso->actualizar_wallet($data2, $billetera_abuelo->token);
                                //Historial de comisiones
                                $pagar2 = array(
                                    "usuario_id" => $perfil->id,
                                    "beneficio_id" => $abuelo->id,
                                    "valor" => $resultado2,
                                    "servicio" => "binaria",
                                    "detalle" => "retiro equipo comision"
                                );
                                $this->model_proceso->historialComisiones($pagar2);

                                $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                                $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                                // Consultar si tiene bisabuelo y pagar
                                if ($bisabuelo != false && $activo_bisabuelo != false) {
                                    $nivel3 = $this->model_proceso->traer_parametro(22);
                                    $resultado3 = $restar * $nivel3->valor;

                                    $billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
                                    $data3 = array(
                                        "cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
                                    );
                                    $this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);

                                    //historial de comisiones
                                    $pagar3 = array(
                                        "usuario_id" => $perfil->id,
                                        "beneficio_id" => $bisabuelo->id,
                                        "valor" => $resultado3,
                                        "servicio" => "binaria",
                                        "detalle" => "retiro equipo comision"
                                    );
                                    $this->model_proceso->historialComisiones($pagar3);

                                    $historial2 = array(
                                        "usuario_id" => $perfil->id,
                                        "valor" => $retiro,
                                        "detalle" => "retiro equipo"
                                    );
                                    $this->model_proceso->historialRetiro($historial2);

                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                    redirect(base_url() . "Retiros", "refresh");
                                } else {
                                    //No tiene paga directo la empresa
                                    $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                    $data1 = array(
                                        "cuenta_global" => $billetera_empresa->cuenta_global + $restar - $resultado2,
                                    );
                                    $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                    $historial2 = array(
                                        "usuario_id" => $perfil->id,
                                        "valor" => $retiro,
                                        "detalle" => "retiro equipo"
                                    );
                                    $this->model_proceso->historialRetiro($historial2);

                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                    redirect(base_url() . "Retiros", "refresh");
                                }
                            } elseif ($abuelo != false && $activo_abuelo == false) {
                                $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                                $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                                // Consultar si tiene bisabuelo y pagar
                                if ($bisabuelo != false && $activo_bisabuelo != false) {
                                    $nivel3 = $this->model_proceso->traer_parametro(22);
                                    $resultado3 = $restar * $nivel3->valor;

                                    $billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
                                    $data3 = array(
                                        "cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
                                    );
                                    $this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);

                                    //historial de comisiones
                                    $pagar3 = array(
                                        "usuario_id" => $perfil->id,
                                        "beneficio_id" => $bisabuelo->id,
                                        "valor" => $resultado3,
                                        "servicio" => "binaria",
                                        "detalle" => "retiro equipo comision"
                                    );
                                    $this->model_proceso->historialComisiones($pagar3);
                                    $historial2 = array(
                                        "usuario_id" => $perfil->id,
                                        "valor" => $retiro,
                                        "detalle" => "retiro equipo"
                                    );
                                    $this->model_proceso->historialRetiro($historial2);


                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                    redirect(base_url() . "Retiros", "refresh");
                                } else {
                                    //No tiene paga directo la empresa
                                    $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                    $data1 = array(
                                        "cuenta_global" => $billetera_empresa->cuenta_global + $restar,
                                    );
                                    $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                    $historial2 = array(
                                        "usuario_id" => $perfil->id,
                                        "valor" => $retiro,
                                        "detalle" => "retiro equipo"
                                    );
                                    $this->model_proceso->historialRetiro($historial2);

                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                    redirect(base_url() . "Retiros", "refresh");
                                }
                            } else {
                                //No tiene paga directo la empresa
                                $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                $data1 = array(
                                    "cuenta_global" => $billetera_empresa->cuenta_global + $restar,
                                );
                                $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                $historial2 = array(
                                    "usuario_id" => $perfil->id,
                                    "valor" => $retiro,
                                    "detalle" => "retiro equipo"
                                );
                                $this->model_proceso->historialRetiro($historial2);

                                $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                redirect(base_url() . "Retiros", "refresh");
                            }
                        } else {
                            //No tiene paga directo la empresa
                            $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                            $data1 = array(
                                "cuenta_global" => $billetera_empresa->cuenta_global + $restar,
                            );
                            $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                            $historial2 = array(
                                "usuario_id" => $perfil->id,
                                "valor" => $retiro,
                                "detalle" => "retiro equipo"
                            );
                            $this->model_proceso->historialRetiro($historial2);

                            $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                            redirect(base_url() . "Retiros", "refresh");
                        }
                    } else {
                        $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Valor insuficiente en la inversion</label></div>');
                        redirect(base_url() . "Retiros", "refresh");
                    }
                } else {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Codigo de seguridad no son iguales</label></div>');
                    redirect(base_url() . "Retiros", "refresh");
                }
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Vuelve a solicitar codigo, ya pasó 3 minutos</label></div>');
                redirect(base_url() . "Retiros", "refresh");
            }
        } else {
            $codigo = $this->input->post('codigo');
            $date = new DateTime();
            $NombreBilletera = "Juego";
            if ($perfil->fecha_caduca_cod >= $date->format('Y-m-d H:i:s')) {
                if ($codigo == $perfil->codigo_seguridad) {
                    if ($retiro <= $billeteraPersonal->cuenta_juego) {
                        $arre = array(
                            "cuenta_juego" => $billeteraPersonal->cuenta_juego - $retiro
                        );
                        $this->model_proceso->actualizar_wallet($arre, $billeteraPersonal->token);
                        $porc = $this->model_proceso->traer_parametro(23);
                        $restar = $retiro * $porc->valor;

                        $valor = $retiro - $restar;
                        //empieza proceso de pago
                        $this->realizarRetiroWallet($codigo, $valor, $walletBinance, $NombreBilletera);


                        //pago persona

                        $arre2 = array(
                            "cuenta_compra" => $billeteraPersonal->cuenta_compra + $retiro - $restar
                        );

                        $this->model_proceso->actualizar_wallet($arre2, $billeteraPersonal->token);

                        $papa = $this->model_proceso->consultar_referido_niveles($perfil->id_papa_pago);
                        $activo_papa = $this->model_proceso->revisar_activo($perfil->id_papa_pago);
                        //Consultar si tiene papa y compró el servicio del robot y pagar
                        if ($papa != false && $activo_papa != false) {
                            $nivel1 = $this->model_proceso->traer_parametro(24);
                            $resultado = $restar * $nivel1->valor;

                            $billetera_papa = $this->model_proceso->cargar_billetera($papa->token);
                            $data1 = array(
                                "cuenta_comision" => $billetera_papa->cuenta_comision + $resultado,
                            );
                            //historial de comisiones
                            $pagar = array(
                                "usuario_id" => $perfil->id,
                                "beneficio_id" => $papa->id,
                                "valor" => $resultado,
                                "servicio" => "binaria",
                                "detalle" => "retiro inversion comision"
                            );
                            $this->model_proceso->historialComisiones($pagar);

                            $this->model_proceso->actualizar_wallet($data1, $billetera_papa->token);

                            $abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);
                            $activo_abuelo = $this->model_proceso->revisar_activo($papa->id_papa_pago);

                            //Consultar si tiene abuelo y compró el servicio del robot y pagar
                            if ($abuelo != false && $activo_abuelo != false) {
                                $nivel2 = $this->model_proceso->traer_parametro(25);
                                $resultado2 = $restar * $nivel2->valor;

                                $billetera_abuelo = $this->model_proceso->cargar_billetera($abuelo->token);
                                $data2 = array(
                                    "cuenta_comision" => $billetera_abuelo->cuenta_comision + $resultado2,
                                );
                                $this->model_proceso->actualizar_wallet($data2, $billetera_abuelo->token);
                                //Historial de comisiones
                                $pagar2 = array(
                                    "usuario_id" => $perfil->id,
                                    "beneficio_id" => $abuelo->id,
                                    "valor" => $resultado2,
                                    "servicio" => "binaria",
                                    "detalle" => "retiro juego comision"
                                );
                                $this->model_proceso->historialComisiones($pagar2);

                                $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                                $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                                // Consultar si tiene bisabuelo y compró el servicio del robot y pagar
                                if ($bisabuelo != false && $activo_bisabuelo != false) {
                                    $nivel3 = $this->model_proceso->traer_parametro(26);
                                    $resultado3 = $restar * $nivel3->valor;

                                    $billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
                                    $data3 = array(
                                        "cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
                                    );
                                    $this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);

                                    //historial de comisiones
                                    $pagar3 = array(
                                        "usuario_id" => $perfil->id,
                                        "beneficio_id" => $bisabuelo->id,
                                        "valor" => $resultado3,
                                        "servicio" => "binaria",
                                        "detalle" => "retiro juego comision"
                                    );
                                    $this->model_proceso->historialComisiones($pagar3);

                                    $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                    $data1 = array(
                                        "cuenta_global" => $billetera_empresa->cuenta_global + $restar - $resultado - $resultado2 - $resultado3,
                                    );
                                    $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

                                    $historial2 = array(
                                        "usuario_id" => $perfil->id,
                                        "valor" => $retiro,
                                        "detalle" => "retiro juego"
                                    );
                                    $this->model_proceso->historialRetiro($historial2);

                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                    redirect(base_url() . "Retiros", "refresh");
                                } else {
                                    //No tiene paga directo la empresa
                                    $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                    $data1 = array(
                                        "cuenta_global" => $billetera_empresa->cuenta_global + $restar - $resultado - $resultado2,
                                    );
                                    $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

                                    $historial2 = array(
                                        "usuario_id" => $perfil->id,
                                        "valor" => $retiro,
                                        "detalle" => "retiro juego"
                                    );
                                    $this->model_proceso->historialRetiro($historial2);

                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                    redirect(base_url() . "Retiros", "refresh");
                                }
                            } elseif ($abuelo != false && $activo_abuelo == false) {
                                // No compró el servicio de robot, pasa al siguiente
                                $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                                $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                                // Consultar si tiene bisabuelo y compró el servicio del robot y pagar
                                if ($bisabuelo != false && $activo_bisabuelo != false) {
                                    $nivel3 = $this->model_proceso->traer_parametro(26);
                                    $resultado3 = $restar * $nivel3->valor;

                                    $billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
                                    $data3 = array(
                                        "cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
                                    );
                                    $this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);

                                    //historial de comisiones
                                    $pagar3 = array(
                                        "usuario_id" => $perfil->id,
                                        "beneficio_id" => $bisabuelo->id,
                                        "valor" => $resultado3,
                                        "servicio" => "binaria",
                                        "detalle" => "retiro juego comision"
                                    );
                                    $this->model_proceso->historialComisiones($pagar3);

                                    $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                    $data1 = array(
                                        "cuenta_global" => $billetera_empresa->cuenta_global + $restar - $resultado - $resultado3,
                                    );
                                    $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

                                    $historial2 = array(
                                        "usuario_id" => $perfil->id,
                                        "valor" => $retiro,
                                        "detalle" => "retiro juego"
                                    );
                                    $this->model_proceso->historialRetiro($historial2);


                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                    redirect(base_url() . "Retiros", "refresh");
                                } else {
                                    //No tiene paga directo la empresa
                                    $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                    $data1 = array(
                                        "cuenta_global" => $billetera_empresa->cuenta_global + $restar - $resultado,
                                    );
                                    $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                    $historial2 = array(
                                        "usuario_id" => $perfil->id,
                                        "valor" => $retiro,
                                        "detalle" => "retiro juego"
                                    );
                                    $this->model_proceso->historialRetiro($historial2);

                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                    redirect(base_url() . "Retiros", "refresh");
                                }
                            } else {
                                //No tiene paga directo la empresa
                                $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                $data1 = array(
                                    "cuenta_global" => $billetera_empresa->cuenta_global + $restar - $resultado,
                                );
                                $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                $historial2 = array(
                                    "usuario_id" => $perfil->id,
                                    "valor" => $retiro,
                                    "detalle" => "retiro juego"
                                );
                                $this->model_proceso->historialRetiro($historial2);

                                $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                redirect(base_url() . "Retiros", "refresh");
                            }
                        } elseif ($papa != false && $activo_papa == false) {
                            //no tiene comprado el servicio del robot pasa el siguiente
                            $abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);
                            $activo_abuelo = $this->model_proceso->revisar_activo($papa->id_papa_pago);

                            //Consultar si tiene abuelo y pagar
                            if ($abuelo != false && $activo_abuelo != false) {
                                $nivel2 = $this->model_proceso->traer_parametro(25);
                                $resultado2 = $restar * $nivel2->valor;

                                $billetera_abuelo = $this->model_proceso->cargar_billetera($abuelo->token);
                                $data2 = array(
                                    "cuenta_comision" => $billetera_abuelo->cuenta_comision + $resultado2,
                                );
                                $this->model_proceso->actualizar_wallet($data2, $billetera_abuelo->token);
                                //Historial de comisiones
                                $pagar2 = array(
                                    "usuario_id" => $perfil->id,
                                    "beneficio_id" => $abuelo->id,
                                    "valor" => $resultado2,
                                    "servicio" => "binaria",
                                    "detalle" => "retiro juego comision"
                                );
                                $this->model_proceso->historialComisiones($pagar2);

                                $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                                $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                                // Consultar si tiene bisabuelo y pagar
                                if ($bisabuelo != false && $activo_bisabuelo != false) {
                                    $nivel3 = $this->model_proceso->traer_parametro(26);
                                    $resultado3 = $restar * $nivel3->valor;

                                    $billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
                                    $data3 = array(
                                        "cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
                                    );
                                    $this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);

                                    //historial de comisiones
                                    $pagar3 = array(
                                        "usuario_id" => $perfil->id,
                                        "beneficio_id" => $bisabuelo->id,
                                        "valor" => $resultado3,
                                        "servicio" => "binaria",
                                        "detalle" => "retiro juego comision"
                                    );
                                    $this->model_proceso->historialComisiones($pagar3);

                                    $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                    $data1 = array(
                                        "cuenta_global" => $billetera_empresa->cuenta_global + $restar - $resultado3 - $resultado2,
                                    );
                                    $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);

                                    $historial2 = array(
                                        "usuario_id" => $perfil->id,
                                        "valor" => $retiro,
                                        "detalle" => "retiro juego"
                                    );
                                    $this->model_proceso->historialRetiro($historial2);

                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                    redirect(base_url() . "Retiros", "refresh");
                                } else {
                                    //No tiene paga directo la empresa
                                    $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                    $data1 = array(
                                        "cuenta_global" => $billetera_empresa->cuenta_global + $restar - $resultado2,
                                    );
                                    $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                    $historial2 = array(
                                        "usuario_id" => $perfil->id,
                                        "valor" => $retiro,
                                        "detalle" => "retiro juego"
                                    );
                                    $this->model_proceso->historialRetiro($historial2);

                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                    redirect(base_url() . "Retiros", "refresh");
                                }
                            } elseif ($abuelo != false && $activo_abuelo == false) {
                                $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                                $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                                // Consultar si tiene bisabuelo y pagar
                                if ($bisabuelo != false && $activo_bisabuelo != false) {
                                    $nivel3 = $this->model_proceso->traer_parametro(26);
                                    $resultado3 = $restar * $nivel3->valor;

                                    $billetera_bisabuelo = $this->model_proceso->cargar_billetera($bisabuelo->token);
                                    $data3 = array(
                                        "cuenta_comision" => $billetera_bisabuelo->cuenta_comision + $resultado3,
                                    );
                                    $this->model_proceso->actualizar_wallet($data3, $billetera_bisabuelo->token);

                                    //historial de comisiones
                                    $pagar3 = array(
                                        "usuario_id" => $perfil->id,
                                        "beneficio_id" => $bisabuelo->id,
                                        "valor" => $resultado3,
                                        "servicio" => "binaria",
                                        "detalle" => "retiro juego comision"
                                    );
                                    $this->model_proceso->historialComisiones($pagar3);
                                    $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                    $data1 = array(
                                        "cuenta_global" => $billetera_empresa->cuenta_global + $restar - $resultado3,
                                    );
                                    $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                    $historial2 = array(
                                        "usuario_id" => $perfil->id,
                                        "valor" => $retiro,
                                        "detalle" => "retiro juego"
                                    );
                                    $this->model_proceso->historialRetiro($historial2);


                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                    redirect(base_url() . "Retiros", "refresh");
                                } else {
                                    //No tiene paga directo la empresa
                                    $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                    $data1 = array(
                                        "cuenta_global" => $billetera_empresa->cuenta_global + $restar,
                                    );
                                    $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                    $historial2 = array(
                                        "usuario_id" => $perfil->id,
                                        "valor" => $retiro,
                                        "detalle" => "retiro juego"
                                    );
                                    $this->model_proceso->historialRetiro($historial2);

                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                    redirect(base_url() . "Retiros", "refresh");
                                }
                            } else {
                                //No tiene paga directo la empresa
                                $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                                $data1 = array(
                                    "cuenta_global" => $billetera_empresa->cuenta_global + $restar,
                                );
                                $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                                $historial2 = array(
                                    "usuario_id" => $perfil->id,
                                    "valor" => $retiro,
                                    "detalle" => "retiro juego"
                                );
                                $this->model_proceso->historialRetiro($historial2);

                                $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                                redirect(base_url() . "Retiros", "refresh");
                            }
                        } else {
                            //No tiene paga directo la empresa
                            $billetera_empresa = $this->model_proceso->cargar_billetera_global('4e1adc6257178bd4a7dfddb99d4d8054');
                            $data1 = array(
                                "cuenta_global" => $billetera_empresa->cuenta_global + $restar,
                            );
                            $this->model_proceso->actualizar_wallet_empresa($data1, $billetera_empresa->token);
                            $historial2 = array(
                                "usuario_id" => $perfil->id,
                                "valor" => $retiro,
                                "detalle" => "retiro juego"
                            );
                            $this->model_proceso->historialRetiro($historial2);

                            $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Retiro exitoso</div>');
                            redirect(base_url() . "Retiros", "refresh");
                        }
                    } else {
                        $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Valor insuficiente en la inversion</label></div>');
                        redirect(base_url() . "Retiros", "refresh");
                    }
                } else {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Codigo de seguridad no son iguales</label></div>');
                    redirect(base_url() . "Retiros", "refresh");
                }
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Vuelve a solicitar codigo, ya pasó 3 minutos</label></div>');
                redirect(base_url() . "Retiros", "refresh");
            }
        }
    }


    public function realizarRetiroWallet($codigo, $retiro, $wallet, $NombreBilletera)
    {

        $perfil = $this->model_login->cargar_datos();

        $billeteraPersonal = $this->model_proceso->cargar_billetera($perfil->token);
        $date = new DateTime();

        if ($perfil->fecha_caduca_cod >= $date->format('Y-m-d H:i:s')) {
            if ($codigo == $perfil->codigo_seguridad) {
                if ($retiro >= 50) {
                    if ($retiro <= $billeteraPersonal->cuenta_compra) {
                        $arre = array(
                            "cuenta_compra" => $billeteraPersonal->cuenta_compra - $retiro
                        );
                        $this->model_proceso->actualizar_wallet($arre, $billeteraPersonal->token);

                        $arre2 = array(
                            "usuario_id" => $perfil->id,
                            "wallet_binance" => $wallet,
                            "valor" => $retiro,
                            "aprobar" => 0
                        );
                        $historial2 = array(
                            "usuario_id" => $perfil->id,
                            "valor" => $retiro,
                            "detalle" => $NombreBilletera
                        );

                        $this->model_banco->insertRetiro($arre2);
                        $this->model_proceso->historialRetiro($historial2);

                    } else {
                        $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Valor insuficiente en la inversion</label></div>');
                        redirect(base_url() . "Retiros", "refresh");
                    }
                } else {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Monto mayores a 50</label></div>');
                    redirect(base_url() . "Retiros", "refresh");
                }
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Codigo de seguridad no son iguales</label></div>');
                redirect(base_url() . "Retiros", "refresh");
            }
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Vuelve a solicitar codigo, ya pasó 3 minutos</label></div>');
            redirect(base_url() . "Retiros", "refresh");
        }
    }

    public function loginPruebas()
    {
    }
    public function envioMsj()
    {
        // Configuración de Twilio
        $account_sid = 'ACb488697890bf676d9bc44922353149fc';
        $auth_token = '6bdc7db575d6f5c3d4db13e9e0e38ad2';
        $twilio_phone_number = 'whatsapp:+14155238886';
        $recipient_phone_number = 'whatsapp:+573054648486';
        $message_text = 'hola su código es : 456415560';
    
        // Inicializa cURL
        $ch = curl_init('https://api.twilio.com/2010-04-01/Accounts/' . $account_sid . '/Messages.json');
    
        // Configura las opciones de cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'To' => $recipient_phone_number,
            'From' => $twilio_phone_number,
            'Body' => $message_text
        ]));
        curl_setopt($ch, CURLOPT_USERPWD, $account_sid . ':' . $auth_token);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded'
        ]);
    
        // Ejecuta la solicitud cURL
        $response = curl_exec($ch);
    
        // Verifica si el mensaje se envió correctamente
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 201) {
            echo 'Mensaje de WhatsApp enviado con éxito';
        } else {
            echo 'Error al enviar el mensaje de WhatsApp: ' . $response;
        }
        // Cierra la sesión cURL
        curl_close($ch);
    }
    

    public function ingreso($ban = null)
    {
        $this->load->view('prueba/prueba', $ban);
    }
    public function landing()
    {
        $this->load->view('nueva');
    }
}