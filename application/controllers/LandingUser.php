<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class LandingUser extends CI_Controller
{

    //metodo contructor 

    function __construct()
    {
        parent::__construct();
        $this->load->model('Model_login');
        $this->load->model('model_servicio');
        $this->load->model('Model_email');
        $this->load->model('Model_linkTree');
        $this->load->model('model_proceso');
        $this->load->model('model_banco');
        $this->load->model('Model_landingu');
        $this->load->model('model_email2');
    }
    //vistas intefaz de usuario
    public function home()
    {
        $result['perfil'] = $this->Model_login->cargar_datos();
        $result['campana'] = $this->Model_landingu->GetCampaña();
        $result['paquetes'] = $this->Model_landingu->GetpaquetesNofree();
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
        $fechaActual = date('Y-m-d');
        $result['fechaActual'] = $fechaActual;
        $this->load->view('header_socio', $result);
        $this->load->view('landingxuser/home', $result);
        $this->load->view('footer_socio', $result);
    }
    public function setemb()
    {

        $this->load->helper('cookie');
        if (get_cookie('mi_cookie_1') == NULL || get_cookie('mi_cookie_2') == NULL) {
            $valor_cookie1 = 0;
            $valor_cookie2 = 0;
        } else {
            $valor_cookie1 = get_cookie('mi_cookie_1');
            $valor_cookie2 = get_cookie('mi_cookie_2');
        }
        //declarar variables.
        $result['DaCamp'] = $this->Model_landingu->infoUser($valor_cookie1);
        $result['perfil'] = $this->Model_login->cargar_datos();
        $list = $this->Model_landingu->ListembudoUsers($valor_cookie1);
        $msjem = $this->Model_landingu->Listembudo($valor_cookie1);
        $resultados = [];

        foreach ($list as $fecha_obj) {
            $fecha = new DateTime($fecha_obj->fecha);
            $hoy = new DateTime();
            $diferencia = $fecha->diff($hoy)->days;

            $resultados[] = [
                'fecha' => $fecha->format('Y-m-d'),
                'diferencia' => $diferencia,
                'email' => $fecha_obj->email,
            ];
            foreach ($msjem as $m) {
                $dia = $m->dia;
                $msj = $m->msj;
                if ($dia == $diferencia) {
                    $day = $this->Model_landingu->GetDay($diferencia, $fecha_obj->email);
                    if ($day->contar == 0) {
                        $this->model_email2->notificacionMsj($fecha_obj->email, $msj);
                        $this->model_email2->envio_correos_pendientes_bd();
                        $ari = array(
                            'idCamp' => $valor_cookie1,
                            'correo' => $fecha_obj->email,
                            'mensaje' => $msj,
                            'dia' => $diferencia,
                        );
                        $this->Model_landingu->SaveRegistro($ari);
                    }
                } else {
                }
            }
        }
        $result['ListUsers'] = $resultados;
        $result['ListEmbu'] = $msjem;

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
        $this->load->view('landingxuser/embudo', $result);
        $this->load->view('footer_socio', $result);
    }
    public function make()
    {

        $result['perfil'] = $this->Model_login->cargar_datos();
        $id = $result['perfil']->id;
        $info = $this->Model_landingu->infoUser($id);
        $result['tools'] = $this->Model_landingu->tools($info->id);

        $this->load->view('landingxuser/make', $result);
    }
    public function analisis()
    {

        $this->load->helper('cookie');
        if (get_cookie('mi_cookie_1') == NULL || get_cookie('mi_cookie_2') == NULL) {
            $valor_cookie1 = 0;
            $valor_cookie2 = 0;
        } else {
            $valor_cookie1 = get_cookie('mi_cookie_1');
            $valor_cookie2 = get_cookie('mi_cookie_2');
        }
        //declarar variables.
        $result['DaCamp'] = $this->Model_landingu->infoUser2($valor_cookie1);
        $result['perfil'] = $this->Model_login->cargar_datos();
        $list = $this->Model_landingu->ListembudoUsers($valor_cookie1);
        $msjem = $this->Model_landingu->Listembudo($valor_cookie1);
        $resultados = [];

        $result['general'] = $this->Model_landingu->InfoPais($valor_cookie1);
        $result['ListUsers'] = $resultados;
        $result['ListEmbu'] = $msjem;

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
        $this->load->view('landingxuser/analisis', $result);
        $this->load->view('footer_socio', $result);
    }
    public function plantilla($idCam)
    {
        $result['perfil'] = $this->Model_login->cargar_datos();
        $idxuser = $this->model_servicio->reportesxuser();
        $id = $result['perfil']->id;
        $result['idCam'] = $idCam;
        $result['plantillas'] = $this->Model_landingu->GetPlantillas();
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
        $this->load->view('landingxuser/choose', $result);
        $this->load->view('footer_socio', $result);
    }

    public function Sett($ole, $idCam)
    {

        $result['perfil'] = $this->Model_login->cargar_datos();
        $id = $result['perfil']->id;
        $result['id_plant'] = $ole;
        $result['tools'] = $this->Model_landingu->tools($idCam);
        $result['cards'] = $this->Model_landingu->cards($idCam);
        $result['DaCamp'] = $this->Model_landingu->infoUser($idCam);

        $result['paquetes'] = $this->Model_landingu->Getpaquetes();
        $ar = array("idPlant" => $ole);
        $this->Model_landingu->UpdatePlanti($ar, $idCam);

        $edicion = true;

        $result['edicion'] = $edicion;

        if ($ole == 1) {
            $this->load->view('view_principal/landing_page', $result);
        }
        if ($ole == 2) {
            $this->load->view('view_principal/landing_page2', $result);
        }
        if ($ole == 3) {
            $this->load->view('view_principal/landing_page3', $result);
        }
        if ($ole == 4) {
            $this->load->view('view_principal/landing_page4', $result);
        }
        if ($ole == 5) {
            $this->load->view('view_principal/landing_page_prin', $result);
        }
        //uso de cookies

        $this->load->helper('cookie');
        $cookie_1 = array(
            'name' => 'mi_cookie_1',
            'value' => $idCam,
            'expire' => 86400,
        );
        $cookie_2 = array(
            'name' => 'mi_cookie_2',
            'value' => $ole,
            'expire' => 86400,
        );
        set_cookie($cookie_1);
        set_cookie($cookie_2);
    }
    public function MakeView()
    {
        $this->load->view('landingxuser/plantilla');
    }

    //////views propias de la campaña//////////////////////
    public function view($nombreCampa)
    {
        $infoCampa = $this->Model_landingu->infoCam($nombreCampa);
        $result['perfil'] = $this->Model_login->cargar_datos();
        $result['id_plant'] = $infoCampa->idPlant;
        $result['tools'] = $this->Model_landingu->tools($infoCampa->id);
        $result['cards'] = $this->Model_landingu->cards($infoCampa->id);
        $result['DaCamp'] = $this->Model_landingu->infoUser($infoCampa->id);

        $fechaActual = date('Y-m-d');
        if ($fechaActual <= $infoCampa->fechaVence) {
            $edicion = false;
            $this->visita($infoCampa->id);
            $ari = array(
                "contador" => $infoCampa->contador + 1,
            );
            $this->Model_landingu->UpdatePlanti($ari, $infoCampa->id);
            $result['edicion'] = $edicion;

            $result['paquetes'] = $this->Model_landingu->Getpaquetes();
            $ole = $infoCampa->idPlant;

            if ($ole == 1) {
                $this->load->view('view_principal/landing_page', $result);
            }
            if ($ole == 2) {
                $this->load->view('view_principal/landing_page2', $result);
            }
            if ($ole == 3) {
                $this->load->view('view_principal/landing_page3', $result);
            }
            if ($ole == 4) {
                $this->load->view('view_principal/landing_page4', $result);
            }
            if ($ole == 5) {
                $this->load->view('view_principal/landing_page_prin', $result);
            }
        } else {
            echo ("Pagina no disponible");
        }

    }
    public function Agra($nombreCampa)
    {
        $infoCampa = $this->Model_landingu->infoCam($nombreCampa);
        $result['perfil'] = $this->Model_login->cargar_datos();
        $result['id_plant'] = $infoCampa->idPlant;
        $result['tools'] = $this->Model_landingu->tools($infoCampa->id);
        $result['DaCamp'] = $this->Model_landingu->infoUser($infoCampa->id);

        $edicion = false;

        $result['edicion'] = $edicion;

        $result['paquetes'] = $this->Model_landingu->Getpaquetes();
        $ole = $infoCampa->idPlant;


        if ($infoCampa->estado == 1) {
            if ($ole == 1) {
                $this->load->view('view_principal/agradecimiento2', $result);
            }
            if ($ole == 2) {
                $this->load->view('view_principal/agradecimiento3', $result);
            }
            if ($ole == 3) {
                $this->load->view('view_principal/agradecimiento4', $result);
            }
            if ($ole == 4) {
                $this->load->view('view_principal/agradecimiento5', $result);
            }
            if ($ole == 5) {
                $this->load->view('view_principal/agradecimiento', $result);
            }
        } else {
            echo "Campaña no disponible";
        }
        //uso de cookies
    }
    public function Settag($idCam)
    {
        $data = $this->Model_landingu->infoUser($idCam);
        $result['perfil'] = $this->Model_login->cargar_datos();
        $result['id_plant'] = $idCam;
        $result['tools'] = $this->Model_landingu->tools($idCam);
        $result['DaCamp'] = $this->Model_landingu->infoUser($idCam);

        $edicion = true;

        $result['edicion'] = $edicion;

        $result['paquetes'] = $this->Model_landingu->Getpaquetes();
        $ole = $data->idPlant;

        if ($ole == 1) {
            $this->load->view('view_principal/agradecimiento2', $result);
        }
        if ($ole == 2) {
            $this->load->view('view_principal/agradecimiento3', $result);
        }
        if ($ole == 3) {
            $this->load->view('view_principal/agradecimiento4', $result);
        }
        if ($ole == 4) {
            $this->load->view('view_principal/agradecimiento5', $result);
        }
        if ($ole == 5) {
            $this->load->view('view_principal/agradecimiento', $result);
        }
        //uso de cookies
    }



    //funciones operativas

    public function SendEmail($nombreCampa)
    {
        $correo = $this->input->post('email');
        $infoCampa = $this->Model_landingu->infoCam($nombreCampa);

        $msj = $this->Model_landingu->Searchmsj(0, $infoCampa->id);

        if ($msj != false || $msj != null) {
            $this->model_email2->notificacionMsj($correo, $msj->msj);
            $this->model_email2->envio_correos_pendientes_bd();
            $ari = array(
                'idCamp' => $infoCampa->id,
                'correo' => $correo,
                'mensaje' => $msj->msj,
                'dia' => 0,
            );
            $this->Model_landingu->SaveRegistro($ari);
        }
        $are = array(
            'email' => $correo,
            'id_user' => $infoCampa->id,
        );
        $this->Model_landingu->insertEmail($are);
        redirect(base_url() . 'LandingUser/Agra/' . $nombreCampa, 'refresh');
    }
    public function visita($id)
    {

        $ubicacion = (unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $_SERVER['REMOTE_ADDR'])));
        // print_r($ubicacion);
        $arre = array(
            "idCamp" => $id,
            "pais" => $ubicacion["geoplugin_countryName"],
            "departamento" => $ubicacion["geoplugin_regionName"],
            "latitud" => $ubicacion["geoplugin_latitude"],
            "longitud" => $ubicacion["geoplugin_longitude"],
            "ip" => $ubicacion["geoplugin_request"],
            "ciudad" => $ubicacion["geoplugin_city"],
        );

        $this->Model_landingu->insertvisita($arre);
    }
    public function replace_spaces($input_text)
    {
        return str_replace(' ', '_', $input_text);
    }
    public function campana()
    {
        $campana = $this->input->post('campana');
        $name2 = $this->replace_spaces($campana);
        $perfil = $this->Model_login->cargar_datos();
        $arr = array(
            'idUser' => $perfil->id,
            'campana' => $campana,
            'ulrname' => $name2,
        );
        $registro = $this->Model_landingu->insertData($arr);
        $ari = array(
            'idPrin' => $registro,
        );
        $this->Model_landingu->insertDataTools($ari);

        //uso de cookies
        $this->load->helper('cookie');
        $cookie_1 = array(
            'name' => 'mi_cookie_1',
            'value' => $registro,
            'expire' => 86400,
        );
        set_cookie($cookie_1);
        redirect(base_url() . 'LandingUser/plantilla/' . $registro, 'refresh');
    }
    public function saveData($id_plant)
    {
        $perfil = $this->Model_login->cargar_datos();
        $info = $this->Model_landingu->infoUser($perfil->id);

        $t1 = $this->input->post('t1');
        $t2 = $this->input->post('t2');
        $t3 = $this->input->post('t3');
        $t4 = $this->input->post('t4');
        $t5 = $this->input->post('t5');
        $d1 = $this->input->post('d1');
        $d2 = $this->input->post('d2');
        $d3 = $this->input->post('d3');
        $branding = $this->input->post('branding');
        $loops = $this->input->post('loops');
        $descripcion = $this->input->post('descripcion');

        if ($t1 != null) {
            $arr = array(
                't1' => $t1,
            );
        }
        if ($t2 != null) {
            $arr = array(
                't2' => $t2,
            );
        }
        if ($t3 != null) {
            $arr = array(
                't3' => $t3,
            );
        }
        if ($t4 != null) {
            $arr = array(
                't4' => $t4,
            );
        }
        if ($d1 != null) {
            $arr = array(
                'd1' => $d1,
            );
        }
        if ($d2 != null) {
            $arr = array(
                'd2' => $d2,
            );
        }
        if ($d3 != null) {
            $arr = array(
                'd3' => $d3,
            );
        }
        if ($descripcion != null) {
            $arr = array(
                'descripcion' => $descripcion,
            );
        }
        if ($t5 != null) {
            $arr = array(
                't5' => $t5,
            );
        }
        if ($branding != null) {
            $arr = array(
                'branding' => $branding,
            );
        }
        if ($loops != null) {
            $arr = array(
                'loops' => $loops,
            );
        }

        //traer cookies
        $this->load->helper('cookie');
        if (get_cookie('mi_cookie_1') == NULL) {
            $valor_cookie1 = 0;
        } else {
            $valor_cookie1 = get_cookie('mi_cookie_1');
        }
        $this->Model_landingu->UpdateTools($arr, $valor_cookie1);

        redirect(base_url() . 'LandingUser/Sett/' . $id_plant . '/' . $valor_cookie1, 'refresh');
    }
    public function saveDataagr($idCamp)
    {
        $perfil = $this->Model_login->cargar_datos();

        $t1a = $this->input->post('t1a');
        $t2a = $this->input->post('t2a');
        $d1a = $this->input->post('d1a');
        $d2a = $this->input->post('d2a');


        if ($t1a != null) {
            $arr = array(
                't1a' => $t1a,
            );
        }
        if ($t2a != null) {
            $arr = array(
                't2a' => $t2a,
            );
        }
        if ($d2a != null) {
            $arr = array(
                'd2a' => $d2a,
            );
        }
        if ($d1a != null) {
            $arr = array(
                'd1a' => $d1a,
            );
        }
        $this->Model_landingu->UpdateTools($arr, $idCamp);
        redirect(base_url() . 'LandingUser/Settag/' . $idCamp, 'refresh');
    }

    public function saveCard($id_plant)
    {
        $this->load->helper('cookie');
        if (get_cookie('mi_cookie_1') == NULL) {
            $valor_cookie1 = 0;
        } else {
            $valor_cookie1 = get_cookie('mi_cookie_1');
        }
        $info = $this->Model_landingu->infoUser($valor_cookie1);

        $titulo = $this->input->post('titulo');
        $descripcion = $this->input->post('descri');
        $link = $this->input->post('link');
        $fecha = $this->input->post('fecha');
        $info = $this->Model_landingu->infoUser($valor_cookie1);

        $mi_archivo = 'img';
        $config['upload_path'] = './assets/img/landing/Cards/';
        $config['allowed_types'] = "jpg|png|jpeg|pdf|jfif|svg|webp";
        $config['maintain_ratio'] = TRUE;
        $config['create_thumb'] = FALSE;
        $config['width'] = 800;
        $config['height'] = 800;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($mi_archivo)) {
            // redirect(base_url() . "LandingUser/viewUser", "refresh");
            echo $this->upload->display_errors();
            $this->session->set_flashdata('error', ' <center><div class="alert alert-danger align-items-center d-flex" style="width: 1000px;"> Error al subir La imagen </div></center> ');
        } else {
            $data = array("upload_data" => $this->upload->data());
            $imagen = $data['upload_data']['file_name'];
            $arre = array(
                'idUser' => $info->id,
                'tittle' => $titulo,
                'descripcion' => $descripcion,
                'img' => $imagen,
                'link' => $link,
                'fecha' => $fecha,
            );
            $this->Model_landingu->insertCard($arre);

            redirect(base_url() . 'LandingUser/Sett/' . $id_plant . '/' . $valor_cookie1, 'refresh');
        }
    }
    public function Setimg($idCamp)
    {
        $this->load->helper('cookie');
        if (get_cookie('mi_cookie_1') == NULL) {
            $valor_cookie1 = 0;
        } else {
            $valor_cookie1 = get_cookie('mi_cookie_1');
        }
        $info = $this->Model_landingu->infoUser($valor_cookie1);

        $op = $this->input->post('op');


        // Obtener información del archivo
        $archivo = $_FILES['img'];
        $nombre = $archivo['name'];
        $tipo = $archivo['type'];

        // Verificar si es una imagen
        $es_imagen = strpos($tipo, 'image') !== false;
        // Verificar si es un video
        $es_video = strpos($tipo, 'video') !== false;

        if ($es_imagen) {
            $mi_archivo = 'img';
            $config['upload_path'] = './assets/img/landing/Pics/';
            $config['allowed_types'] = "jpg|png|jpeg|pdf|jfif|svg|webp";
            $config['maintain_ratio'] = TRUE;
            $config['create_thumb'] = FALSE;
            $config['width'] = 800;
            $config['height'] = 800;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($mi_archivo)) {
                // redirect(base_url() . "LandingUser/viewUser", "refresh");
                echo $this->upload->display_errors();
                $this->session->set_flashdata('error', ' <center><div class="alert alert-danger align-items-center d-flex" style="width: 1000px;"> Error al subir La imagen </div></center> ');
            } else {
                $data = array("upload_data" => $this->upload->data());
                $imagen = $data['upload_data']['file_name'];
                if ($op == 1) {
                    $arre = array(
                        'logo' => $imagen,
                    );
                }
                if ($op == 2) {
                    $arre = array(
                        'img2' => $imagen,
                    );
                }
                if ($op == 3) {
                    $arre = array(
                        'img3' => $imagen,
                    );
                }
                if ($op == 4) {
                    $arre = array(
                        'imgag' => $imagen,
                        'stateid' => 1,
                    );
                }
                $this->Model_landingu->UpdateTools($arre, $info->id);
                if ($op != 4) {
                    redirect(base_url() . 'LandingUser/Sett/' . $info->idPlant . '/' . $valor_cookie1, 'refresh');
                } else {
                    redirect(base_url() . 'LandingUser/Settag/' . $idCamp, 'refresh');
                }
            }
        } elseif ($es_video) {
            // video
            // Configuración de carga de archivos
            $config['upload_path'] = './assets/img/landing/Pics/'; // Ruta a la carpeta de destino
            $config['allowed_types'] = 'mp4|avi|mov'; // Tipos de archivo permitidos
            $config['max_size'] = 10240; // Tamaño máximo del archivo en kilobytes (10MB)

            // Cargar la librería de carga
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('img')) {
                // Error al subir el archivo
                $error = $this->upload->display_errors();
                echo $error;
            } else {
                // Archivo subido correctamente
                $datos_archivo = $this->upload->data();
                $nombre_archivo = $datos_archivo['file_name'];

                $arre = array(
                    'imgag' => $nombre_archivo,
                    'stateid' => 2,
                );
                $this->Model_landingu->UpdateTools($arre, $info->id);
                echo 'Es un video';
                redirect(base_url() . 'LandingUser/Settag/' . $idCamp, 'refresh');
            }
        } else {
            // Archivo no es ni imagen ni video
            // ...
        }
    }
    function generateRandomString($length)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }
    public function Upnmae($id)
    {
        $name = $this->input->post('campana');
        $are = array(
            'campana' => $name
        );
        $this->Model_landingu->UpdatePlanti($are, $id);
        redirect(base_url() . 'LandingUser/home', 'refresh');
    }

    ///funcion para  embudo
    public function embudo($nombreCampa)
    {
        $correo = $this->input->post('email');
        $infoCampa = $this->Model_landingu->infoUser($nombreCampa);

        $msj = $this->Model_landingu->Searchmsj(0, $infoCampa->id);

        if ($msj != false || $msj != null) {
            $this->model_email2->notificacionMsj($correo, $msj->msj);
            $this->model_email2->envio_correos_pendientes_bd();
            $ari = array(
                'idCamp' => $infoCampa->id,
                'correo' => $correo,
                'mensaje' => $msj->msj,
                'dia' => 0,
            );
            $this->Model_landingu->SaveRegistro($ari);
        }
        $are = array(
            'email' => $correo,
            'id_user' => $infoCampa->id,
        );
        $this->Model_landingu->insertEmail($are);


        redirect(base_url() . 'LandingUser/Sett/' . $infoCampa->idPlant . '/' . $infoCampa->id, 'refresh');
    }

    public function SaveEnbudo()
    {
        $this->load->helper('cookie');
        if (get_cookie('mi_cookie_1') == NULL || get_cookie('mi_cookie_2') == NULL) {
            $valor_cookie1 = 0;
            $valor_cookie2 = 0;
        } else {
            $valor_cookie1 = get_cookie('mi_cookie_1');
            $valor_cookie2 = get_cookie('mi_cookie_2');
        }
        $dia = $this->input->post('dia');
        $msj = $this->input->post('msj');

        $infoCampa = $this->Model_landingu->infoUser($valor_cookie1);
        $contar = $this->Model_landingu->Countmsj($infoCampa->id);

        //condicionales
        if ($infoCampa->idPaquete == 1 || $infoCampa->idPaquete == null) {
            if ($contar->contar < 1) {
                $are = array(
                    'dia' => $dia,
                    'idCam' => $valor_cookie1,
                    'msj' => $msj,
                );
                $this->Model_landingu->insertSettEmbu($are);
            } else {
                $this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex  " style="width: 50%;"> Maximo de Notificacion Superado</div></center>');
            }
        } else if ($infoCampa->idPaquete == 2) {
            if ($contar->contar < 5) {
                $are = array(
                    'dia' => $dia,
                    'idCam' => $valor_cookie1,
                    'msj' => $msj,
                );
                $this->Model_landingu->insertSettEmbu($are);
            } else {
                $this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex  " style="width: 50%;"> Maximo de Notificacion Superado</div></center>');
            }
        } else if ($infoCampa->idPaquete == 3) {
            if ($contar->contar < 15) {
                $are = array(
                    'dia' => $dia,
                    'idCam' => $valor_cookie1,
                    'msj' => $msj,
                );
                $this->Model_landingu->insertSettEmbu($are);
            } else {
                $this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex  " style="width: 50%;"> Maximo de Notificacion Superado</div></center>');
            }
        } else if ($infoCampa->idPaquete == 4) {
            $are = array(
                'dia' => $dia,
                'idCam' => $valor_cookie1,
                'msj' => $msj,
            );
            $this->Model_landingu->insertSettEmbu($are);
        }
        redirect(base_url() . 'LandingUser/setemb/', 'refresh');
    }
    public function PayLanding($idPaquete)
    {
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        if (get_cookie('mi_cookie_1') == NULL || get_cookie('mi_cookie_2') == NULL) {
            $valor_cookie1 = 0;
            $valor_cookie2 = 0;
        } else {
            $valor_cookie1 = get_cookie('mi_cookie_1');
            $valor_cookie2 = get_cookie('mi_cookie_2');
        }
        //variables
        $perfil = $this->Model_login->cargar_datos();
        $billetera = $this->model_banco->billetera($perfil->token);
        $paquete = $this->Model_landingu->infoPaquete($idPaquete);
        $info = $this->Model_landingu->infoUser($valor_cookie1);
        $name = $info->campana;

        // Obtiene la fecha actual
        $fechaActual = new DateTime();

        // Clona el objeto para mantener la fecha actual intacta
        $fechaMasUnMes = clone $fechaActual;
        $fechaMas15Dias = clone $fechaActual;
        // Suma un mes a la fecha actual
        $fechaMasUnMes->modify('+1 month');

        // Suma 15 días a la fecha actual
        $fechaMas15Dias->modify('+15 days');
        $fechaMasUnMesStr = $fechaMasUnMes->format('Y-m-d');
        $fechaMas15DiasStr = $fechaMas15Dias->format('Y-m-d');

        if ($idPaquete == 1) {
            // Reemplazar espacios en blanco con guiones bajos en el campo de texto
            $name2 = $this->replace_spaces($name);

            $url2 = "www.myconnectmind.com/LandingUser/view/" . $name2;
            $are = array(
                'idPaquete' => $idPaquete,
                'idCamp' => $valor_cookie1,
            );
            $this->Model_landingu->insertPay($are);
            $ari = array(
                'url' => $url2,
                'ulrname' => $name2,
                'estado' => 1,
                'idPaquete' => $idPaquete,
                'fechaVence' => $fechaMas15DiasStr,
            );
            $this->Model_landingu->UpdatePlanti($ari, $info->id);
            redirect(base_url() . 'LandingUser/Settag/' . $info->id, 'refresh');
        } else {
            if ($billetera->cuenta_compra >= $paquete->precio) {

                $restar = $billetera->cuenta_compra - $paquete->precio;
                $data = array(
                    "cuenta_compra" => $restar
                );
                $this->model_banco->updBilletera($perfil->token, $data) == 1;

                $proceso = $this->ProcesoDistribucion($paquete->precio);

                if ($proceso == true) {
                    // Reemplazar espacios en blanco con guiones bajos en el campo de texto
                    $name2 = $this->replace_spaces($name);

                    $url2 = "www.myconnectmind.com/LandingUser/view/" . $name2;

                    $are = array(
                        'idPaquete' => $idPaquete,
                        'idCamp' => $valor_cookie1,
                    );
                    $this->Model_landingu->insertPay($are);

                    $ari = array(
                        'url' => $url2,
                        'ulrname' => $name2,
                        'estado' => 1,
                        'idPaquete' => $idPaquete,
                        'fechaVence' => $fechaMasUnMesStr,
                    );
                    $this->Model_landingu->UpdatePlanti($ari, $info->id);

                    redirect(base_url() . 'LandingUser/Settag/' . $info->id, 'refresh');
                } else {
                    echo "error";
                }
            } else {
                $this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex  " style="width: 50%;"> Fondos insuficientes</div></center>');
                redirect(base_url() . 'LandingUser/Settag/' . $info->id, 'refresh');
            }
        }
    }
    public function PayLandingNofree($idPaquete, $idCamp)
    {
        $perfil = $this->Model_login->cargar_datos();
        $billetera = $this->model_banco->billetera($perfil->token);
        $paquete = $this->Model_landingu->infoPaquete($idPaquete);
        $info = $this->Model_landingu->infoUser($idCamp);
        $name = $info->campana;

        // Obtiene la fecha actual
        $fechaActual = new DateTime();

        // Clona el objeto para mantener la fecha actual intacta
        $fechaMasUnMes = clone $fechaActual;
        $fechaMas15Dias = clone $fechaActual;
        // Suma un mes a la fecha actual
        $fechaMasUnMes->modify('+1 month');

        // Suma 15 días a la fecha actual
        $fechaMas15Dias->modify('+15 days');
        $fechaMasUnMesStr = $fechaMasUnMes->format('Y-m-d');
        $fechaMas15DiasStr = $fechaMas15Dias->format('Y-m-d');


        if ($billetera->cuenta_compra >= $paquete->precio) {

            $restar = $billetera->cuenta_compra - $paquete->precio;
            $data = array(
                "cuenta_compra" => $restar
            );
            $this->model_banco->updBilletera($perfil->token, $data) == 1;

            $proceso = $this->ProcesoDistribucion($paquete->precio);

            if ($proceso == true) {
                // Reemplazar espacios en blanco con guiones bajos en el campo de texto
                $name2 = $this->replace_spaces($name);

                $url2 = "www.myconnectmind.com/LandingUser/view/" . $name2;

                $are = array(
                    'idPaquete' => $idPaquete,
                    'idCamp' => $idCamp,
                );
                $this->Model_landingu->insertPay($are);

                $ari = array(
                    'url' => $url2,
                    'ulrname' => $name2,
                    'estado' => 1,
                    'idPaquete' => $idPaquete,
                    'fechaVence' => $fechaMasUnMesStr,
                );
                $this->Model_landingu->UpdatePlanti($ari, $info->id);

                $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex  " style="width: 50%;"> Compra exitosa</div></center>');
                redirect(base_url() . 'LandingUser/home', 'refresh');
            } else {
                echo "error";
            }
        } else {
            $this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex  " style="width: 50%;"> Fondos insuficientes</div></center>');
            redirect(base_url() . 'LandingUser/home', 'refresh');

        }
    }
    //// proceso de pago
    public function ProcesoDistribucion($precio)
    {
        //traer Data
        $Parapapa = $this->Model_landingu->DataParametro(1); //papa
        $Paraabue = $this->Model_landingu->DataParametro(2); //abuelo	
        $Parabisa = $this->Model_landingu->DataParametro(3); //Bis

        //operaciones:
        $Gpapa = ($precio * $Parapapa->porcentaje) / 100;
        $Gabue = ($precio * $Paraabue->porcentaje) / 100;
        $Gbisa = ($precio * $Parabisa->porcentaje) / 100;

        //Trae data Usuario
        $perfil = $this->Model_login->cargar_datos();
        $billetera = $this->model_banco->billetera($perfil->token);

        //Trae data empresa
        $empresa = $this->model_proceso->consultar_referido_niveles(6);
        $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);

        //Trae data papa
        $papa = $this->model_proceso->consultar_referido_niveles($perfil->id_papa_pago);

        if ($papa == null) {
            $data1 = array(
                "cuenta_landing" => $billetera_empresa->cuenta_landing + $precio
            );
            $this->model_proceso->actualizar_wallet_empresa2($data1, $empresa->token);
        } else {
            $billeteraPapa = $this->model_banco->billetera($papa->token);
            $data1 = array(
                "cuenta_comision" => $billeteraPapa->cuenta_comision + $Gpapa
            );
            $this->model_banco->updBilletera($papa->token, $data1) == 1;

            //Trae data abuelo
            $abuelo = $this->model_proceso->consultar_referido_niveles($papa->id_papa_pago);
            if ($abuelo == null) {
                $data2 = array(
                    "cuenta_landing" => $billetera_empresa->cuenta_landing + ($precio - $Gpapa)
                );
                $this->model_proceso->actualizar_wallet_empresa2($data2, $empresa->token);
            } else {

                $billeteraAbuelo = $this->model_banco->billetera($abuelo->token);
                $data2 = array(
                    "cuenta_comision" => $billeteraAbuelo->cuenta_comision + $Gabue
                );
                $this->model_banco->updBilletera($abuelo->token, $data2) == 1;

                //Trae data bisabuelo
                $bisabuelo = $this->model_proceso->consultar_referido_niveles($abuelo->id_papa_pago);
                if ($bisabuelo == null) {
                    $data3 = array(
                        "cuenta_landing" => $billetera_empresa->cuenta_landing + ($precio - $Gpapa - $Gabue)
                    );
                    $this->model_proceso->actualizar_wallet_empresa2($data3, $empresa->token);
                } else {
                    $billeteraBisabuelo = $this->model_banco->billetera($bisabuelo->token);
                    $data3 = array(
                        "cuenta_comision" => $billeteraBisabuelo->cuenta_comision + $Gbisa
                    );
                    $this->model_banco->updBilletera($bisabuelo->token, $data3) == 1;

                    $data4 = array(
                        "cuenta_landing" => $billetera_empresa->cuenta_landing + ($precio - $Gpapa - $Gabue - $Gbisa)
                    );
                    $this->model_proceso->actualizar_wallet_empresa2($data4, $empresa->token);

                    return true;
                }
            }
        }
    }
    public function infoCiudad()
    {
        $ciudad = $this->input->post('id');
        $idCamp = $this->input->post('idCamp');
        $infoTemplate = $this->Model_landingu->InfoDetailFull($idCamp, $ciudad);
        echo json_encode($infoTemplate);
    }
    public function prueba()
    {
        $datos = $this->Model_landingu->TraerMsj();
        foreach ($datos as $d) {
            $list = $this->Model_landingu->ListembudoUsers($d->id_user);
            $msjem = $this->Model_landingu->Listembudo($d->id_user);
            foreach ($list as $fecha_obj) {
                $fecha = new DateTime($fecha_obj->fecha);
                $hoy = new DateTime();
                $diferencia = $fecha->diff($hoy)->days;
                foreach ($msjem as $m) {
                    $dia = $m->dia;
                    $msj = $m->msj;
                    if ($dia == $diferencia) {
                        $day = $this->Model_landingu->GetDay($diferencia, $fecha_obj->email);
                        if ($day->contar == 0) {
                            $this->model_email2->notificacionMsj($fecha_obj->email, $msj);
                            $this->model_email2->envio_correos_pendientes_bd();
                            $ari = array(
                                'idCamp' => $d->id_user,
                                'correo' => $fecha_obj->email,
                                'mensaje' => $msj,
                                'dia' => $diferencia,
                            );
                            $this->Model_landingu->SaveRegistro($ari);
                        }
                    }
                }
            }
        }
    }
}