<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Banco extends CI_Controller
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
        $this->load->model('model_email2');
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
                    $result['perfil'] = $this->model_login->cargar_datos();
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

                    $this->load->view('header_socio', $result);

                    $this->load->view('banco/view_inicio', $result);

                    $this->load->view('footer_socio', $result);
                } else {
                    $intruso = array(

                        'id_usuario' => $this->session->userdata('ID'),

                        'texto' => 'Banco/inicio',

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

    public function consignar($usuario)
    {
        $mi_archivo = 'img';
        $config['upload_path'] = './assets/img/fotosPerfil/';
        $config['allowed_types'] = "jpg|png|jpeg";
        $config['maintain_ratio'] = true;
        $config['create_thumb'] = false;
        $config['width'] = 800;
        $config['height'] = 800;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($mi_archivo)) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Error con la imagen</label></div>');
            redirect(base_url() . "Banco", "refresh");

        } else {
            $data = array("upload_data" => $this->upload->data());
            $imagen = $data['upload_data']['file_name'];
            $hash = $this->input->post('hash');
            $result = $this->model_banco->comprobar($hash);
            if (count($result) != 1) {
                $arre = array(
                    "usuario_token" => $usuario,
                    "imagen" => $imagen,
                    "hash" => trim($hash),
                    "valor_inversion" => $this->input->post('recarga')
                );
                if ($this->model_banco->insertar($arre)) {
                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center"><label class="login__input name">Consignacion subida Esperar minimo 24H</label></div>');
                    redirect(base_url() . "Banco", "refresh");
                } else {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Error a actualizar</label></div>');
                    redirect(base_url() . "Banco", "refresh");
                }
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Hash no se puede repetir</label></div>');
                redirect(base_url() . "Banco", "refresh");
            }
        }
    }

    public function consignaciones_user()
    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Ultra') {
                $result['perfil'] = $this->model_login->cargar_datos();
                $result['consigna'] = $this->model_banco->cargar();

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

                $this->load->view('banco/view_table', $result);

                $this->load->view('footer_socio', $result);
            } else {
                $intruso = array(

                    'id_usuario' => $this->session->userdata('ID'),

                    'texto' => 'Banco/consignaciones',

                    'fecha_registro' => date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("" . base_url() . "errorpage/error");
            }
        } else {
            redirect("" . base_url() . "login/");
        }
    }

    public function historialConsigna()
    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Socio' || $this->session->userdata('ROL') == 'SocioAdmin' || $this->session->userdata('ROL') == 'Ultra') {
                $result['perfil'] = $this->model_login->cargar_datos();
                $result['consigna'] = $this->model_banco->cargarHistorial();
                $result['retira'] = $this->model_banco->cargarHistorialRetiro();
                $result['disponibilidad'] = $this->model_servicio->consultarCampos();

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

                $this->load->view('banco/historialConsig', $result);

                $this->load->view('footer_socio', $result);
            } else {
                $intruso = array(

                    'id_usuario' => $this->session->userdata('ID'),

                    'texto' => 'Banco/historialConsignaciones',

                    'fecha_registro' => date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("" . base_url() . "errorpage/error");
            }
        } else {
            redirect("" . base_url() . "login/");
        }
    }

    public function aprobacionWallet($hash)
    {
        $datos = $this->model_banco->comprobar($hash);
        if ($datos->validar == 0) {
            $data = array(
                "usuario_id" => $datos->id,
                "valor" => $datos->valor_inversion,
                "servicio" => "aprobar wallet"
            );
            $this->model_banco->insertHistorial($data);

            $billetera = $this->model_banco->billetera($datos->usuario_token);
            $data2 = array(
                "cuenta_compra" => $billetera->cuenta_compra + $datos->valor_inversion
            );
            $this->model_banco->updBilletera($billetera->token_usuario, $data2);

            $data3 = array(
                "validar" => 1,
                "motivo" => "Si se aprobó la consignacion, sin inconveniente"
            );
            $this->model_banco->updConsigna($hash, $data3);
            $this->session->set_flashdata('exito', '<div class="alert alert-success text-center"><label class="login__input name">Consignacion paga</label></div>');
            redirect(base_url() . "Banco/consignaciones_user", "refresh");
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Ya fue pagado</label></div>');
            redirect(base_url() . "Banco/consignaciones_user", "refresh");
        }
    }

    public function cancelarConsigna($hash)
    {
        $motivo = $this->input->post('motivo');

        $data = array(
            "motivo" => $motivo,
            "validar" => 1
        );

        $this->model_banco->updConsigna($hash, $data);
        $this->session->set_flashdata('exito', '<div class="alert alert-success text-center"><label class="login__input name">Consignacion cancelada</label></div>');
        redirect(base_url() . "Banco/consignaciones_user", "refresh");
    }

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

                    $this->load->view('banco/view_retiros', $result);
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

    // public function codigoSeguridad()
    // {
    // 	if ($this->input->post('data') == '1') {
    // 		$codigo = $this->generateRandomString(6);
    // 		$perfil = $this->model_login->cargar_datos();
    // 		$date = new DateTime();
    // 		$date->modify('+3 minute');

    // 		$data = array(
    // 			"codigo_seguridad" => $codigo,
    // 			"fecha_caduca_cod" => $date->format('Y-m-d H:i:s')
    // 		);
    // 		if ($this->model_servicio->codigo($perfil->id, $data) == 1) {
    // 			$this->model_email2->codigo_seguridad($perfil->correo, $codigo);
    // 			$this->model_email2->envio_correos_pendientes_bd();
    // 			echo "<p style='color: green;'>Codigo de seguridad enviado, revisa el correo registrado</p>";
    // 		}
    // 	} else {
    // 		echo "<p style='color: red;'>Revisar si tiene registrado correo electronico</p>";
    // 	}
    // }

    // public function codigoSeguridad2()
    // {
    // 	if ($this->input->post('data') == '1') {
    // 		$codigo = $this->generateRandomString(6);
    // 		$perfil = $this->model_login->cargar_datos();
    // 		$date = new DateTime();
    // 		$date->modify('+3 minute');

    // 		$data = array(
    // 			"codigo_seguridad" => $codigo,
    // 			"fecha_caduca_cod" => $date->format('Y-m-d H:i:s')
    // 		);
    // 		if ($this->model_servicio->codigo($perfil->id, $data) == 1) {
    // 			$this->model_email2->codigo_seguridad2($perfil->correo, $codigo);
    // 			$this->model_email2->envio_correos_pendientes_bd();
    // 			echo "<p style='color: green;'>Codigo de seguridad enviado, revisa el correo registrado</p>";
    // 		}
    // 	} else {
    // 		echo "<p style='color: red;'>Revisar si tiene registrado correo electronico</p>";
    // 	}
    // }
    // public function codigoSeguridad3()
    // {
    // 	if ($this->input->post('data') == '1') {
    // 		$codigo = $this->generateRandomString(6);
    // 		$perfil = $this->model_login->cargar_datos();
    // 		$date = new DateTime();
    // 		$date->modify('+3 minute');

    // 		$data = array(
    // 			"codigo_seguridad" => $codigo,
    // 			"fecha_caduca_cod" => $date->format('Y-m-d H:i:s')
    // 		);
    // 		if ($this->model_servicio->codigo($perfil->id, $data) == 1) {
    // 			$this->model_email2->codigo_seguridad3($perfil->correo, $codigo);
    // 			$this->model_email2->envio_correos_pendientes_bd();
    // 			echo "<p style='color: green;'>Codigo de seguridad enviado, revisa el correo registrado</p>";
    // 		}
    // 	} else {
    // 		echo "<p style='color: red;'>Revisar si tiene registrado correo electronico</p>";
    // 	}
    // }

    public function retirosGeneral()
    {
        $perfil = $this->model_login->cargar_datos();
        $billeteraPersonal = $this->model_proceso->cargar_billetera($perfil->token);
        $retiro = $this->input->post('retiro');

        $tipo_billetera = $this->input->post('billetera');

        if ($tipo_billetera == 1) {
            // $codigo = $this->input->post('codigo');
            // $date = new DateTime();

            // if ($perfil->fecha_caduca_cod >= $date->format('Y-m-d H:i:s')) {

            // 	if ($codigo == $perfil->codigo_seguridad) {
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

                    //pago persona

                    $arre2 = array(
                        "cuenta_compra" => $billeteraPersonal->cuenta_compra + $retiro - $restar
                    );

                    $this->model_proceso->actualizar_wallet($arre2, $billeteraPersonal->token);

                    $papa = $this->model_proceso->consultar_referido_niveles($perfil->id_papa_pago);
                    $activo_papa = $this->model_proceso->revisar_activo($perfil->id_papa_pago);


                    //Consultar si tiene papa y compró el servicio del robot y pagar
                    if (count($papa) == 1 && count($activo_papa) == 1) {
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
                        if (count($abuelo) == 1 && count($activo_abuelo) == 1) {
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
                            if (count($bisabuelo) == 1 && count($activo_bisabuelo) == 1) {
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
                        } elseif (count($abuelo) == 1 && count($activo_abuelo) == 0) {
                            $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                            $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                            // Consultar si tiene bisabuelo y pagar
                            if (count($bisabuelo) == 1 && count($activo_bisabuelo) == 1) {
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
                    } elseif (count($papa) == 1 && count($activo_papa) == 0) {
                        $abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);
                        $activo_abuelo = $this->model_proceso->revisar_activo($papa->id_papa_pago);


                        //Consultar si tiene abuelo y pagar
                        if (count($abuelo) == 1 && count($activo_abuelo) == 1) {
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
                            if (count($bisabuelo) == 1 && count($activo_bisabuelo) == 1) {
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
                        } elseif (count($abuelo) == 1 && count($activo_abuelo) == 0) {
                            $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                            $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                            // Consultar si tiene bisabuelo y pagar
                            if (count($bisabuelo) == 1 && count($activo_bisabuelo) == 1) {
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
                // } else {
                // 	$this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Codigo de seguridad no son iguales</label></div>');
                // 	redirect(base_url() . "Retiros", "refresh");
                // }
                // } else {
                // 	$this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Vuelve a solicitar codigo, ya pasó 3 minutos</label></div>');
                // 	redirect(base_url() . "Retiros", "refresh");
                // }
            }
        } elseif ($tipo_billetera == 2) {
            // $codigo = $this->input->post('codigo');
            // $date = new DateTime();
            // if ($perfil->fecha_caduca_cod >= $date->format('Y-m-d H:i:s')) {

            // if ($codigo == $perfil->codigo_seguridad) {
            if ($retiro <= $billeteraPersonal->cuenta_comision) {
                $arre = array(
                    "cuenta_comision" => $billeteraPersonal->cuenta_comision - $retiro
                );
                $this->model_proceso->actualizar_wallet($arre, $billeteraPersonal->token);
                $porc = $this->model_proceso->traer_parametro(19);
                $restar = $retiro * $porc->valor;

                //pago persona

                $arre2 = array(
                    "cuenta_compra" => $billeteraPersonal->cuenta_compra + $retiro - $restar
                );

                $this->model_proceso->actualizar_wallet($arre2, $billeteraPersonal->token);

                $papa = $this->model_proceso->consultar_referido_niveles($perfil->id_papa_pago);
                $activo_papa = $this->model_proceso->revisar_activo($perfil->id_papa_pago);
                //Consultar si tiene papa y compró el servicio del robot y pagar
                if (count($papa) == 1 && count($activo_papa) == 1) {
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
                    if (count($abuelo) == 1 && count($activo_abuelo) == 1) {
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
                        if (count($bisabuelo) == 1 && count($activo_bisabuelo) == 1) {
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
                    } elseif (count($abuelo) == 1 && count($activo_abuelo) == 0) {
                        // No compró el servicio de robot, pasa al siguiente
                        $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                        $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                        // Consultar si tiene bisabuelo y compró el servicio del robot y pagar
                        if (count($bisabuelo) == 1 && count($activo_bisabuelo) == 1) {
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
                } elseif (count($papa) == 1 && count($activo_papa) == 0) {
                    //no tiene comprado el servicio del robot pasa el siguiente
                    $abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);
                    $activo_abuelo = $this->model_proceso->revisar_activo($papa->id_papa_pago);

                    //Consultar si tiene abuelo y pagar
                    if (count($abuelo) == 1 && count($activo_abuelo) == 1) {
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
                        if (count($bisabuelo) == 1 && count($activo_bisabuelo) == 1) {
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
                    } elseif (count($abuelo) == 1 && count($activo_abuelo) == 0) {
                        $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                        $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                        // Consultar si tiene bisabuelo y pagar
                        if (count($bisabuelo) == 1 && count($activo_bisabuelo) == 1) {
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
        // 	} else {
        // 		$this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Codigo de seguridad no son iguales</label></div>');
        // 		redirect(base_url() . "Retiros", "refresh");
        // 	}
        // } else {
        // 	$this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Vuelve a solicitar codigo, ya pasó 3 minutos</label></div>');
        // 	redirect(base_url() . "Retiros", "refresh");
        // }
        } else {
            // $codigo = $this->input->post('codigo');
            // $date = new DateTime();
            // if ($perfil->fecha_caduca_cod >= $date->format('Y-m-d H:i:s')) {

            // if ($codigo == $perfil->codigo_seguridad) {
            if ($retiro <= $billeteraPersonal->cuenta_juego) {
                $arre = array(
                    "cuenta_juego" => $billeteraPersonal->cuenta_juego - $retiro
                );
                $this->model_proceso->actualizar_wallet($arre, $billeteraPersonal->token);
                $porc = $this->model_proceso->traer_parametro(23);
                $restar = $retiro * $porc->valor;

                //pago persona

                $arre2 = array(
                    "cuenta_compra" => $billeteraPersonal->cuenta_compra + $retiro - $restar
                );

                $this->model_proceso->actualizar_wallet($arre2, $billeteraPersonal->token);

                $papa = $this->model_proceso->consultar_referido_niveles($perfil->id_papa_pago);
                $activo_papa = $this->model_proceso->revisar_activo($perfil->id_papa_pago);
                //Consultar si tiene papa y compró el servicio del robot y pagar
                if (count($papa) == 1 && count($activo_papa) == 1) {
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
                    if (count($abuelo) == 1 && count($activo_abuelo) == 1) {
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
                        if (count($bisabuelo) == 1 && count($activo_bisabuelo) == 1) {
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
                    } elseif (count($abuelo) == 1 && count($activo_abuelo) == 0) {
                        // No compró el servicio de robot, pasa al siguiente
                        $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                        $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                        // Consultar si tiene bisabuelo y compró el servicio del robot y pagar
                        if (count($bisabuelo) == 1 && count($activo_bisabuelo) == 1) {
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
                } elseif (count($papa) == 1 && count($activo_papa) == 0) {
                    //no tiene comprado el servicio del robot pasa el siguiente
                    $abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);
                    $activo_abuelo = $this->model_proceso->revisar_activo($papa->id_papa_pago);

                    //Consultar si tiene abuelo y pagar
                    if (count($abuelo) == 1 && count($activo_abuelo) == 1) {
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
                        if (count($bisabuelo) == 1 && count($activo_bisabuelo) == 1) {
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
                    } elseif (count($abuelo) == 1 && count($activo_abuelo) == 0) {
                        $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                        $activo_bisabuelo = $this->model_proceso->revisar_activo($abuelo->id_papa_pago);


                        // Consultar si tiene bisabuelo y pagar
                        if (count($bisabuelo) == 1 && count($activo_bisabuelo) == 1) {
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
            // 	} else {
            // 		$this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Codigo de seguridad no son iguales</label></div>');
            // 		redirect(base_url() . "Retiros", "refresh");
            // 	}
            // } else {
            // 	$this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Vuelve a solicitar codigo, ya pasó 3 minutos</label></div>');
            // 	redirect(base_url() . "Retiros", "refresh");
            // }
        }
    }

    public function realizarRetiroWallet()
    {
        // $codigo = $this->input->post('codigo');
        $perfil = $this->model_login->cargar_datos();
        $billeteraPersonal = $this->model_proceso->cargar_billetera($perfil->token);
        $retiro = $this->input->post('retiro');
        $wallet = $this->input->post('wallet');
        // $date = new DateTime();

        // if ($perfil->fecha_caduca_cod >= $date->format('Y-m-d H:i:s')) {

        // if ($codigo == $perfil->codigo_seguridad) {
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
                    "detalle" => "retiro billetera principal"
                );

                $this->model_banco->insertRetiro($arre2);
                $this->model_proceso->historialRetiro($historial2);
                $this->session->set_flashdata('exito', '<div class="alert alert-success text-center"><label class="login__input name">Retiro exitoso, esperar min 72H</label></div>');
                redirect(base_url() . "Retiros", "refresh");
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Valor insuficiente en la inversion</label></div>');
                redirect(base_url() . "Retiros", "refresh");
            }
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Monto mayores a 50</label></div>');
            redirect(base_url() . "Retiros", "refresh");
        }
        // 	} else {
        // 		$this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Codigo de seguridad no son iguales</label></div>');
        // 		redirect(base_url() . "Retiros", "refresh");
        // 	}
        // } else {
        // 	$this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Vuelve a solicitar codigo, ya pasó 3 minutos</label></div>');
        // 	redirect(base_url() . "Retiros", "refresh");
        // }
    }

    public function generateRandomString($length)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    public function transferencia()
    {
        if ($this->session->userdata('is_logged_in')) {
            if ($this->session->userdata('ROL') == 'Ultra') {
                $result['perfil'] = $this->model_login->cargar_datos();
                $result['historial'] = $this->model_banco->cargarHistorialTransferencia();
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
                $this->load->view('banco/view_transferencia', $result);
                $this->load->view('footer_socio', $result);
            } else {
                $intruso = array(

                    'id_usuario' => $this->session->userdata('ID'),

                    'texto' => 'Banco/transferencia',

                    'fecha_registro' => date("Y-m-d H:i:s"),

                );

                $this->model_errorpage->insertIntruso($intruso);

                redirect("" . base_url() . "errorpage/error");
            }
        } else {
            redirect("" . base_url() . "login/");
        }
    }

    public function traer_usuario()
    {
        $cedula = $this->input->post('cedula');

        $resultado = $this->model_banco->traerCedula($cedula);

        echo $resultado->nombre . " " . $resultado->apellido1;
    }

    public function transferenciaPersona($token)
    {
        $persona = $this->input->post('usuario');
        $valor = $this->input->post('transferir');
        $resultado = $this->model_banco->traerCedula($persona);

        $billeteraPersonal = $this->model_proceso->cargar_billetera($token);
        $billeteraOtra = $this->model_proceso->cargar_billetera($resultado->token);

        if ($billeteraPersonal->cuenta_compra >= $valor) {
            $data = array(
                "cuenta_compra" => $billeteraPersonal->cuenta_compra - $valor,
            );
            $this->model_proceso->actualizar_wallet($data, $billeteraPersonal->token);

            $data2 = array(
                "cuenta_compra" => $billeteraOtra->cuenta_compra + $valor
            );

            $this->model_proceso->actualizar_wallet($data2, $billeteraOtra->token);
            $data3 = array(
                "usuario_token" => $billeteraPersonal->token_usuario,
                "persona_token" => $billeteraOtra->token_usuario,
                "valor" => $valor
            );
            $this->model_proceso->insertHistorial($data3);
            $this->session->set_flashdata('exito', '<div class="alert alert-success text-center"><label class="login__input name">Transferencia exitosa</label></div>');
            redirect(base_url() . "Transferencia", "refresh");
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">No tiene dinero</label></div>');
            redirect(base_url() . "Transferencia", "refresh");
        }
    }

    public function cheque($id)
    {
        $result['retiro'] = $this->model_banco->cargarHistorialRetiroUnidad($id);

        $this->load->view('banco/cheque',$result);
    }
}
