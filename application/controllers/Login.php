<?php

defined('BASEPATH') or exit('No direct script access allowed');

class login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_login');
        $this->load->model('model_errorpage');
        $this->load->model('model_reporte');
        $this->load->model('model_modulo');
        $this->load->model('model_ultra');
    }

    public function index($ban = null)
    {
        $result['usuario'] = $this->model_login->agrupar();
        $result['ganancia'] = $this->model_login->cuentasGanancia();
        $result['eventos'] = $this->model_modulo->cargar_eventos();

        $this->load->view('view_tiindo', $result);
    }

    public function nuestros_servicios()
    {
        $result['usuario'] = $this->model_login->agrupar();
        $result['ganancia'] = $this->model_login->cuentasGanancia();
        $result['eventos'] = $this->model_modulo->cargar_eventos();

        $this->load->view('nuestros_servicios', $result);
    }

    public function ingreso($ban = null)
    {
        $this->load->view('view_login', $ban);
    }

    public function registrar($idpapa)
    {
        $result['pais'] = $this->model_login->traerPais();
        $result['perfil'] = $this->model_login->cargar_datosReferencia($idpapa);
        if ($result['perfil']->contar == 1) {
            $this->load->view('view_registro', $result);
        } else {
            $intruso = array(

                'id_usuario' => 0,

                'texto' => 'registro comercio',

                'fecha_registro' => date("Y-m-d H:i:s"),

            );

            $this->model_errorpage->insertIntruso($intruso);
            redirect("" . base_url() . "errorpage/error");
        }
    }

    public function getCiudad()
    {
        $id = $this->input->post("id");
        $ciudad = $this->model_login->getCiudad($id);
        echo json_encode($ciudad);
    }

    public function registrarNew($idpapa)
    {
        $contrasena = $this->input->post('contrasena');
        $contrasena1 = $this->input->post('contrasena1');
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido1');
        $correo = $this->input->post('correo');
        $celular = $this->input->post('celular');
        $user = $this->input->post('user');
        $cedula = $this->input->post('cedula');
        // if (
        // 	//comprobar que no tengan caracter especial
        // 	preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $nombre) && preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $apellido)
        // 	&& preg_match('/^[0-9a-zA-Z]+$/', $user) && preg_match('/^[0-9]+$/', $idpapa)
        // ) {
        if ($contrasena != $contrasena1) {
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name">Contraseña no coinciden</label></div>');
            redirect(base_url() . "login/registrar/" . $idpapa);
        } else {
            $result = $this->model_login->consultaregistro($user, $cedula, $correo);

            if ($result->contar == 1) { // no se puede registrar
                $this->session->set_flashdata('error', '<div class="alert alert-danger text-center"><label class="login__input name" style="color:black;"> Registro invalido, ya existen las credenciales</label></div>');

                redirect(base_url() . "login/registrar/" . $idpapa);
            } else { // si se puede registrar
                $token = md5($nombre . "+" . $correo);
                $arre = array(
                    "token" => $token,
                    "nombre" => $nombre,
                    "apellido1" => $apellido,
                    "correo" => $correo,
                    "celular" => $celular,
                    "user" => $user,
                    "id_papa_pago" => $idpapa,
                    "tipo" => "Socio",
                    "contrasena" => md5($contrasena),
                    "pais_id" => $this->input->post('pais'),
                    "ciudad_id" => $this->input->post('ciudad'),
                    "cedula" => $cedula,
                );
                if ($this->model_login->registrar($arre) == 1) {
                    $datos = array(
                        "token" => $this->generateRandomString(25),
                        "token_usuario" => $token
                    );
                    $id = $this->model_login->lastID();
                    $this->model_login->insertWallet($datos);

                    //aqui buscamos para elegir pierna
                    $izquierda = $this->model_login->cargar_datosReferencia($idpapa);
                    $estado = $this->model_login->cargar_datosReferencia($idpapa);
                    $derecha = $this->model_login->cargar_datosReferencia($idpapa);
                    if ($estado->ubicacion == "izquierda") {
                        if ($izquierda->id_izquierda == 0) {
                            $data = array(
                                "id_izquierda" => $id,
                            );
                            $data2 = array(
                                "posicion" => "Izquierda"
                            );
                            $this->model_login->ModificarDerecha($data, $izquierda->id);
                            $this->model_login->ModificarDerecha($data2, $id);
                            $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                            redirect(base_url() . "ingreso", "refresh");
                        } elseif ($izquierda->contar > 1) {
                            do {
                                if ($izquierda->id_izquierda == 0) {
                                    $data = array(
                                        "id_izquierda" => $id,
                                    );
                                    $data2 = array(
                                        "posicion" => "Izquierda"
                                    );
                                    $this->model_login->ModificarDerecha($data, $izquierda->id);
                                    $this->model_login->ModificarDerecha($data2, $id);
                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                                    redirect(base_url() . "ingreso", "refresh");
                                }
                                $izquierda = $this->model_login->cargar_datosReferencia($izquierda->id_izquierda);
                            } while ($izquierda->id_izquierda != null);
                        }
                    } else {
                        if ($derecha->id_derecha == 0) {
                            $data = array(
                                "id_derecha" => $id,
                            );
                            $data2 = array(
                                "posicion" => "Derecha"
                            );
                            $this->model_login->ModificarDerecha($data, $derecha->id);
                            $this->model_login->ModificarDerecha($data2, $id);
                            $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                            redirect(base_url() . "ingreso", "refresh");
                        } else {
                            do {
                                if ($derecha->id_derecha == 0) {
                                    $data = array(
                                        "id_derecha" => $id,
                                    );
                                    $data2 = array(
                                        "posicion" => "Derecha"
                                    );
                                    $this->model_login->ModificarDerecha($data, $derecha->id);
                                    $this->model_login->ModificarDerecha($data2, $id);
                                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                                    redirect(base_url() . "ingreso", "refresh");
                                }
                                $derecha = $this->model_login->cargar_datosReferencia($derecha->id_derecha);
                            } while ($derecha->id_derecha != null);
                        }
                    }
                    $this->session->set_flashdata('exito', '<div class="alert alert-success text-center">Registro exitoso</div>');
                    redirect(base_url() . "ingreso", "refresh");
                } else {
                    $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Un error al guardar intente nuevamente</div>');
                    redirect(base_url() . "login/registrar/" . $idpapa, "refresh");
                }
            }
        }
        // } else {
        // 	$this->session->set_flashdata('error', '<div class="alert alert-danger text-center">No se admiten caracteres especiales</div>');
        // 	redirect(base_url() . "login/registrar/".$idpapa, "refresh");
        // }
    }

    public function olvidarClave($cedula)
    {
        $consulta = $this->model_errorpage->verificarCedula($cedula);
        if ($consulta->contar == 1) {
            $date = new DateTime();
            $date->modify('+3 minute');
            $codigo = $this->generateRandomString(6);

            $data = array(
                "cod_cambio" => $codigo,
                "fecha_caduca_cod" => $date->format('Y-m-d H:i:s')
            );
            if (($this->model_errorpage->update($data, $cedula) == 1)) {
                $datos = $this->model_errorpage->traerDatos($cedula);
                $pais = $this->model_ultra->traer_pais($datos->pais_id);
                $enlace = 'Login/procesoCambio/' . $datos->token;

                $this->sendMensage($pais->celular, $datos->celular, $codigo, $datos->nombre, $enlace);
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Revisa tu conexion a internet</div>');
                redirect(base_url() . "Login/recuperar");
            }
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Cedula no encontrada</div>');
            redirect(base_url() . "Login/recuperar");
        }
    }

    public function sendMensage($pais, $celular, $codigo, $nombre, $enlace)
    {
        $this->load->library('curl');

        $url = "https://graph.facebook.com/v15.0/109906238696085/messages";
        $access_token = "EAAIXHbrbkkUBAF8GUGG2Uy3ax2eK7YrMg6BIEJEOLZBDff8TJYM8FtcbqXPHTNSJemkcFL4aL38tNyuPcqmO4YUzwnMYzh1cBB9MiwMrttkk3mIxP8o5hiVDEoqASSezVNYhGKj5ssJTf8lsZAmc1xVh0VQ8EXMgA7TN52pydjpUN00mcA";
        $celularenvio = "" . $pais . "" . $celular;
        $data = array(
            'messaging_product' => 'whatsapp',
            'to' => $celularenvio,
            'type' => 'template',
            'template' => array(
                'name' => 'codigo_seguridad',
                'language' => array(
                    'code' => 'es_MX'
                ),
                'components' => array(
                    array(
                        'type' => 'body',
                        'parameters' => array(
                            array(
                                'type' => 'text',
                                'text' => $nombre
                            ),
                            array(
                                'type' => 'text',
                                'text' => $codigo
                            )
                        )
                    ),
                    array(
                        'type' => 'button',
                        'sub_type' => 'url',
                        'index' => 0,
                        'parameters' => array(
                            array(
                                'type' => 'text',
                                'text' => $enlace
                            )
                        )
                    )
                )
            )
        );

        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $access_token,
                'Content-Type: application/json'
            )
        );

        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);
        curl_close($curl);

        // handle response
        if (!$response) {
            echo 'Error: ' . curl_error($curl);
        } else {
            $json = json_decode($response);
            if (isset($json->error)) {
                $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Comprueba si tienes bien tu número de celular</div>');
                redirect(base_url() . "Login/recuperar");
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-success text-center">Se ha enviado el paso a seguir a Whatsapp</div>');
                redirect(base_url() . "Login/recuperar");
            }
        }
    }

    public function generateRandomString($length)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    public function validaAcceso()
    {
        $this->load->helper('cookie');

        $user = $this->input->post('user');
        $pass = md5($this->input->post('pass'));

        $perfil = $this->model_login->trae_user_codigo($user);
        $codigo = $this->input->post('codigo');
        $date = new DateTime();

        if ($perfil->fecha_caduca_cod >= $date->format('Y-m-d H:i:s')) {
            if ($codigo == $perfil->codigo_seguridad) {
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
                        redirect(base_url() . "Investor");
                    }
                } else {
                    //en caso contrario mostramos el error de usuario o contraseña invalido
                    $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Usuario/Contraseña Invalido</div>');
                    redirect("" . base_url() . "ingreso");
                }
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Codigo de seguridad no son iguales</div>');
                redirect(base_url() . "ingreso", "refresh");
            }
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Vuelve a solicitar codigo, ya pasó 3 minutos</div>');
            redirect(base_url() . "ingreso", "refresh");
        }
    }

    public function session_dest()
    {
        $session = array(
            'logueado' => false
        );
        $this->session->set_userdata($session);
        $this->session->sess_destroy();
        redirect(base_url());
    }


    public function validarCorreo()
    {
        $email = $this->input->post('email');

        $consulta = $this->model_errorpage->verificarEmail($email);

        if ($consulta->contar == 1) {
            echo "Correo ya usado, elige otro";
        } else {
            echo "";
        }
    }
    public function validarUser()
    {
        $usuario = $this->input->post('usuario');

        $consulta = $this->model_errorpage->verificarUsuario($usuario);

        if ($consulta->contar == 1) {
            echo "Usuario ya usado, elige otro";
        } else {
            echo "";
        }
    }

    public function prueba3()
    {
        $this->load->view('prueba');
    }

    public function prueba()
    {
        $texto = $this->input->post('texto');
        $curl = curl_init();
        $api = "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";
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.openai.com/v1/completions",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode(array(
                'prompt' => $texto,
                'model' => 'text-davinci-002',
                'temperature' => 0.5,
                'max_tokens' => 100,
                'top_p' => 1,
                'frequency_penalty' => 0,
                'presence_penalty' => 0
            )),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer " . $api
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $result = json_decode($response, true);
            echo $result['choices'][0]['text'];
        }
        //
    }

    public function prueba4()
    {
        $texto = $this->input->post('texto');
        $curl = curl_init();

        $api = "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";

        $data = array(
            'model' => 'image-alpha-001',
            'prompt' => $texto,
            'num_images' => 1,
            'size' => '512x512',
            'response_format' => 'url'
        );

        $data_string = json_encode($data);

        $ch = curl_init('https://api.openai.com/v1/images/generations');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'Authorization: Bearer ' . $api
            )
        );

        $response = curl_exec($ch);

        curl_close($ch);

        echo $response;
    }
    public function prueba2()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://mandrillapp.com/api/1.0/users/ping');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array('key' => 'md-H4_txbJm9OK66OXSU4FdRg')));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $result = curl_exec($ch);
        curl_close($ch);

        var_dump($result);
    }
    public function prueba20()
    {
        $api = "pat-na1-e2ab90f5-23a5-4db2-8336-cb3f6341f266";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.hubapi.com/crm/v3/objects/contacts?limit=10&archived=false');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $api));

        $result = curl_exec($ch);
        curl_close($ch);

        var_dump($result);
    }

    public function calcular()
    {
        $principal = $this->input->post('balance');
        $tiempo = $this->input->post('periodo');
        $tasa_interes = ($this->input->post('ganancia') / 100);
        $principio = $principal;


        for ($i = 1; $i <= $tiempo; $i++) {
            $principal = $principal * (1 + $tasa_interes);
            echo '<tr>';
            echo '<th scope="row">' . $i . '</th>';
            echo '<td>' . $principio . '</td>';
            echo '<td>' . number_format($principal, 2) . '</td>';
            echo '<td>' . number_format(($principal - $principio), 2) . '</td>';
            echo '<td>' . number_format((($principal - $principio) * 100) / ($principio), 2) . '%</td> ';
            echo '</tr>';
        }
    }

    public function recuperar()
    {
        $this->load->view('olvidar');
    }

    public function procesoCambio($token)
    {
        $result['usuario'] = $token;
        $this->load->view('proceso', $result);
    }

    public function CambiarClave()
    {
        $user = $this->input->post('user');
        $contra = md5($this->input->post('pass'));
        $contra2 = md5($this->input->post('pass2'));
        $date = new DateTime();

        $datos = $this->model_errorpage->traerDatosUser($user);

        if ($datos->fecha_caduca_cod >= $date->format('Y-m-d H:i:s')) {
            if ($contra == $contra2) {
                $data = array(
                    "contrasena" => $contra
                );
                $this->model_errorpage->update($data, $datos->cedula);
                $this->session->set_flashdata('error', '<div class="alert alert-success text-center">Cambio realizado</div>');
                redirect(base_url() . "Login/ingreso");
            } else {
                $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Contraseñas no coinciden</div>');
                redirect(base_url() . "Login/procesoCambio/$user");
            }
        } else {
            $this->session->set_flashdata('error', '<div class="alert alert-danger text-center">Ya pasaron 3 minutos, vuelve a solicitar el codigo</div>');
            redirect(base_url() . "Login/recuperar");
        }
    }

    public function probarProbabilidad($valor)
    {
        $data = array('valor' => $valor);

        $this->model_reporte->insertPrueba($data);
    }
}
