<?php

use LDAP\Result;



defined('BASEPATH') or exit('No direct script access allowed');



class Reportes2 extends CI_Controller
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

        $this->load->model('model_binarias');
    }

    //vistas intefaz de usuario

    public function home()
    {

        $result['perfil'] = $this->Model_login->cargar_datos();

        $result['campana'] = $this->Model_landingu->GetCampaña();

        $result['info'] = [];

        $info = $this->model_binarias->traerData($result['perfil']->id);

        $result['info'] = $info;



        $reporte = $this->model_servicio->GetReporte();

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

        foreach ($reporte as $fecha_obj) {

            $fecha = new DateTime($fecha_obj->fecha);

            $hoy = new DateTime();



            $diferencia = $fecha->diff($hoy);

            // Calcular la diferencia en minutos

            $diferenciaMinutos = $diferencia->days * 24 * 60 + $diferencia->h * 60 + $diferencia->i;



            $resultados[] = [

                'fecha' => $fecha->format('Y-m-d'),

                'diferencia' => $diferenciaMinutos,

                'par' => $fecha_obj->par,

                'senal' => $fecha_obj->senal,

                'precio' => $fecha_obj->precio

            ];
        }

        $result['reporte'] = $resultados;



        if ($info != null) {

            //proceso Dias Free

            $fechaCom = new DateTime($info->fechaAc);

            $hoydia = new DateTime();

            $diferencia2 = $fechaCom->diff($hoydia)->days;



            $result['diferencia'] = $diferencia2;



            $result['fecha_formateada'] = date('d-m-Y', strtotime($info->fechaVen));
        }



        $this->load->view('header_socio', $result);

        $this->load->view('reportes2/reporte', $result);

        $this->load->view('footer_socio', $result);
    }

    public function Admin()
    {

        $result['perfil'] = $this->Model_login->cargar_datos();

        $reporte = $this->model_servicio->GetReporte();

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

        $id = 0;

        foreach ($reporte as $fecha_obj) {

            $fecha = new DateTime($fecha_obj->fecha);

            $hoy = new DateTime();

            $id++; // Incrementa el valor de $id en cada iteración

            $diferencia = $fecha->diff($hoy);

            // Calcular la diferencia en minutos

            $diferenciaMinutos = $diferencia->days * 24 * 60 + $diferencia->h * 60 + $diferencia->i;



            $resultados[] = [

                'id' => $id,

                'fecha' => $fecha->format('Y-m-d'),

                'diferencia' => $diferenciaMinutos,

                'par' => $fecha_obj->par,

                'senal' => $fecha_obj->senal,

                'precio' => $fecha_obj->precio

            ];
        }

        $result['reporte'] = $resultados;



        $this->load->view('header_socio', $result);

        $this->load->view('reportes2/admin', $result);

        $this->load->view('footer_socio', $result);
    }

    public function SaveReport()
    {

        $par = $this->input->post('par');

        $senal = $this->input->post('senal');

        $precio = $this->input->post('precio');

        $fecha = $this->input->post('fecha');

        $data = array(

            'par' => $par,

            'senal' => $senal,

            'precio' => $precio,

            'fecha' => $fecha,

        );

        $this->model_binarias->InsertRegistro($data);

        $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex  " style="width: 50%;"> Proceso Exitoso , Señal guardada exitosamente</div></center>');

        redirect(base_url() . "Reportes2/Admin");
    }


    // Inicio Señales Binarias
    public function prueba()
    {

        $result['perfil'] = $this->Model_login->cargar_datos();

        $result['campana'] = $this->Model_landingu->GetCampaña();

        $result['info'] = [];

        $info = $this->model_binarias->traerData($result['perfil']->id);

        $result['info'] = $info;



        $reporte = $this->model_binarias->traerTodo();

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

        foreach ($reporte as $fecha_obj) {

            $fecha = new DateTime($fecha_obj->fecha);

            $hoy = new DateTime();



            $diferencia = $fecha->diff($hoy);

            // Calcular la diferencia en minutos

            $diferenciaMinutos = $diferencia->days * 24 * 60 + $diferencia->h * 60 + $diferencia->i;



            $resultados[] = [

                'fecha' => $fecha->format('Y-m-d'),

                'diferencia' => $diferenciaMinutos,

                'par' => $fecha_obj->par,

                'senal' => $fecha_obj->senal,

                'precio' => $fecha_obj->precio

            ];
        }

        $result['reporte'] = $resultados;



        if ($info != null) {

            //proceso Dias Free

            $fechaCom = new DateTime($info->fechaAc);

            $hoydia = new DateTime();

            $diferencia2 = $fechaCom->diff($hoydia)->days;



            $result['diferencia'] = $diferencia2;



            $result['fecha_formateada'] = date('d-m-Y', strtotime($info->fechaVen));
        }

        $this->load->view('header_socio', $result);

        $this->load->view('reportes2/prueba', $result);

        $this->load->view('footer_socio', $result);
    }

    public function resumen()
    {

        $result['perfil'] = $this->Model_login->cargar_datos();

        $result['campana'] = $this->Model_landingu->GetCampaña();

        $result['info'] = [];

        $info = $this->model_binarias->traerData($result['perfil']->id);

        $result['info'] = $info;



        $reporte = $this->model_binarias->traerTodo();

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
        $resultados = [];
        foreach ($reporte as $fecha_obj) {

            $fecha = new DateTime($fecha_obj->fecha);

            $hoy = new DateTime();



            $diferencia = $fecha->diff($hoy);

            // Calcular la diferencia en minutos

            $diferenciaMinutos = $diferencia->days * 24 * 60 + $diferencia->h * 60 + $diferencia->i;



            $resultados[] = [

                'fecha' => $fecha->format('Y-m-d'),

                'diferencia' => $diferenciaMinutos,

                'par' => $fecha_obj->par,

                'senal' => $fecha_obj->senal,

                'precio' => $fecha_obj->precio

            ];
        }

        $result['reporte'] = $resultados;



        if ($info != null) {

            //proceso Dias Free

            $fechaCom = new DateTime($info->fechaAc);

            $hoydia = new DateTime();

            $diferencia2 = $fechaCom->diff($hoydia)->days;



            $result['diferencia'] = $diferencia2;



            $result['fecha_formateada'] = date('d-m-Y', strtotime($info->fechaVen));
        }

        $this->load->view('header_socio', $result);

        $this->load->view('reportes2/resumen', $result);

        $this->load->view('footer_socio', $result);
    }


    public function getNuevosRegistrosResumen()
    {

        $reporte = $this->model_binarias->traerTodo();



        $html = '';

        foreach ($reporte as $registro) {

            $fecha = new DateTime($registro->fecha);

            $hoy = new DateTime();

            $diferencia = $fecha->diff($hoy);

            // Calcular la diferencia en minutos

            $diferenciaMinutos = $diferencia->days * 24 * 60 + $diferencia->h * 60 + $diferencia->i;



            $html .= '<div class="card" style="margin-bottom:2rem;">';

            if ($registro->senal == "compra" || $registro->senal == "Compra") {

                $html .= ' <div class="card-body" style="border: 4px solid green; border-radius: 25px;"> ';
            } else {

                $html .= ' <div class="card-body" style="border: 4px solid red; border-radius: 25px;"> ';
            }



            $html .= ' <div class="row  ">';

            $html .= ' <div class="col sm-6  ">';



            if ($registro->senal == "compra" || $registro->senal == "Compra") {

                $html .= ' <i class="bi bi-arrow-up-circle" style="font-size: xxx-large;color:green"></i> ';
            } else {

                $html .= '  <i class="bi bi-arrow-down-circle" style="font-size: xxx-large;color:red"></i> ';
            }

            $html .= ' </div>';

            $html .= '<div class="col-9 sm-6">';

            $html .= '<h3>';

            $html .= $registro->senal . '</br>';

            $html .= 'Precio Señal :' . $registro->precio . '</br>';

            $html .= 'UTC :' . $registro->fecha . '</br>';

            $html .= 'Hace :' . $diferenciaMinutos . ' Minutos</br>';

            $html .= 'Venta a  :' . $registro->tiempo . ' </br>';

            $html .= '</h3>';

            $html .= '</div>';

            $html .= '<div class="col sm-12">';

            $html .= ' <h2> ' . $registro->par . '</h2>';

            $html .= '</div>';

            $html .= '</div>';

            $html .= '</div>';

            $html .= '</div>';
        }

        echo $html;
    }

    public function getNuevosRegistrosIq()
    {

        $reporte = $this->model_binarias->traerTodoIq();
        $contador = 0;
        $html = '';
        foreach ($reporte as $registro) {
            $contador++;
            $fecha = new DateTime($registro->fecha);
            $hoy = new DateTime();
            $diferencia = $fecha->diff($hoy);
            // Calcular la diferencia en minutos
            $diferenciaMinutos = $diferencia->days * 24 * 60 + $diferencia->h * 60 + $diferencia->i;
            if ($contador % 2 == 0) {
                if ($registro->senal == "compra" || $registro->senal == "Compra") {
                    $html .= '<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">                        ';
                    $html .= '    <div class="carousel-inner">                        ';
                    $html .= '        <div class="carousel-item active" data-bs-interval="10000">                        ';
                    $html .= '              <img style="width:100%; height:100%;filter: blur(5px); margin-bottom:10px;"class="d-block w-100 "   src="https://www.myconnectmind.com/assets/img/landing/FotoSenal2.PNG">';
                    $html .= '            <div class="carousel-caption ">                        ';
                    $html .= '            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pay"> Señal VIP </button>                        ';
                    $html .= '            </div>                        ';
                    $html .= '        </div>';
                    $html .= '   </div>';
                    $html .= '</div>';
                } else {
                    $html .= '<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">                        ';
                    $html .= '    <div class="carousel-inner">                        ';
                    $html .= '        <div class="carousel-item active" data-bs-interval="10000">                        ';
                    $html .= '              <img style="width:100%; height:100%;filter: blur(5px); margin-bottom:10px;" class="d-block w-100 " src="https://www.myconnectmind.com/assets/img/landing/FotoSenal3.PNG">';
                    $html .= '            <div class="carousel-caption ">                        ';
                    $html .= '            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pay"> Señal VIP </button>                        ';
                    $html .= '            </div>                        ';
                    $html .= '        </div>';
                    $html .= '   </div>';
                    $html .= '</div>';
                }
                continue;
            } else {
                $html .= '<div class="card" style="margin-bottom:25px; height:30%;">';
                if ($registro->senal == "compra" || $registro->senal == "Compra") {
                    $html .= ' <div class="card-body" style="background-color: #D1FCCB; bosder-radius: 25px; padding:5px;"> ';
                } else {
                    $html .= ' <div class="card-body" style="background-color: #FEBFB6; border-radius: 25px; padding:5px;"> ';
                }
                $html .= ' <div class="row  ">';
                $html .= '<div class="col-8 sm-8">';
                $html .= ' <h2> ' . $registro->par . '</h2>';
                $html .= '<h5>';
                $html .= 'Hora :' . $registro->fecha . '</br>';
                if ($registro->senal == "compra" || $registro->senal == "Compra") {
                    $html .= 'Compra a  :' . $registro->tiempo . '</br>';
                } else {
                    $html .= 'Venta a  :' . $registro->tiempo . '</br>';
                }
                $html .= 'Precio :' . $registro->precio . '</br>';
                $html .= 'Hace :' . $diferenciaMinutos . ' minutos</br>';
                $html .= '</h5>';
                $html .= '</div>';
                $html .= '<div class="col-4 sm-4">';
                if ($registro->senal == "compra" || $registro->senal == "Compra") {
                    $html .= ' <i class="bi bi-arrow-up-circle" style="font-size: xxx-large;color:green"></i> ';
                } else {
                    $html .= '  <i class="bi bi-arrow-down-circle" style="font-size: xxx-large;color:red"></i> ';
                }
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
            }

        }

        echo $html;
    }
    public function getNuevosRegistrosIq2()
    {

        $reporte = $this->model_binarias->traerTodoIq();
        $html = '';
        foreach ($reporte as $registro) {
            $fecha = new DateTime($registro->fecha);
            $hoy = new DateTime();
            $diferencia = $fecha->diff($hoy);
            // Calcular la diferencia en minutos
            $diferenciaMinutos = $diferencia->days * 24 * 60 + $diferencia->h * 60 + $diferencia->i;

            $html .= '<div class="card" style="margin-bottom:25px; height:30%;">';
            if ($registro->senal == "compra" || $registro->senal == "Compra") {
                $html .= ' <div class="card-body" style="background-color: #D1FCCB; bosder-radius: 25px; padding:5px;"> ';
            } else {
                $html .= ' <div class="card-body" style="background-color: #FEBFB6; border-radius: 25px; padding:5px;"> ';
            }
            $html .= ' <div class="row  ">';
            $html .= '<div class="col-8 sm-8">';
            $html .= ' <h2> ' . $registro->par . '</h2>';
            $html .= '<h5>';
            $html .= 'Hora :' . $registro->fecha . '</br>';
            if ($registro->senal == "compra" || $registro->senal == "Compra") {
                $html .= 'Compra a  :' . $registro->tiempo . '</br>';
            } else {
                $html .= 'Venta a  :' . $registro->tiempo . '</br>';
            }
            $html .= 'Precio :' . $registro->precio . '</br>';
            $html .= 'Hace :' . $diferenciaMinutos . ' minutos</br>';
            $html .= '</h5>';
            $html .= '</div>';
            $html .= '<div class="col-4 sm-4">';
            if ($registro->senal == "compra" || $registro->senal == "Compra") {
                $html .= ' <i class="bi bi-arrow-up-circle" style="font-size: xxx-large;color:green"></i> ';
            } else {
                $html .= '  <i class="bi bi-arrow-down-circle" style="font-size: xxx-large;color:red"></i> ';
            }
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';


        }

        echo $html;
    }
    public function historial()
    {

        $result['perfil'] = $this->Model_login->cargar_datos();

        $result['campana'] = $this->Model_landingu->GetCampaña();

        $result['info'] = [];

        $info = $this->model_binarias->traerData($result['perfil']->id);

        $result['info'] = $info;

        $result['paquetes'] = $this->model_binarias->PaquetesBinarias();

        $reporte = $this->model_binarias->traerTodo();

        $idxuser = $this->model_servicio->reportesxuser();

        $fechaActual = date('Y-m-d');
        $result['fechaActual'] = $fechaActual;

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

        if ($info != null) {

            //proceso Dias Free

            $fechaCom = new DateTime($info->fechaAc);

            $hoydia = new DateTime();

            $diferencia2 = $fechaCom->diff($hoydia)->days;



            $result['diferencia'] = $diferencia2;



            $result['fecha_formateada'] = date('d-m-Y', strtotime($info->fechaVen));
        }


        $this->load->view('header_socio', $result);

        $this->load->view('reportes2/historial', $result);

        $this->load->view('footer_socio', $result);
    }

    public function getnuevosregistroshistorial()
    {
        $reporte = $this->model_binarias->traerTodoHistorial();

        $data = array();

        foreach ($reporte as $registro) {
            $fecha = new DateTime($registro->fecha);
            $hoy = new DateTime();
            $diferencia = $fecha->diff($hoy);
            $diferenciaMinutos = $diferencia->days * 24 * 60 + $diferencia->h * 60 + $diferencia->i;

            $card = array(
                'tiempo' => $registro->tiempo,
                'senal' => $registro->senal,
                'precio' => $registro->precio,
                'fecha' => $registro->fecha,
                'diferencia_minutos' => $diferenciaMinutos,
                'par' => $registro->par,
            );

            $card_html = '<div class="card">';
            $card_html .= '<div class="card-body">';
            $card_html .= '<h5 class="card-title">' . $card['senal'] . '</h5>';
            $card_html .= '<p class="card-text">' . $card['precio'] . '</p>';
            $card_html .= '</div>';
            $card_html .= '</div>';

            array_push($data, $card);
        }

        header('Content-Type: application/json');
        echo json_encode(array('data' => $data));
    }

    public function iq()
    {

        $result['perfil'] = $this->Model_login->cargar_datos();

        $result['campana'] = $this->Model_landingu->GetCampaña();

        $result['info'] = [];

        $result['paquetes'] = $this->model_binarias->PaquetesBinarias();

        $info = $this->model_binarias->traerData($result['perfil']->id);

        $result['info'] = $info;

        $fechaActual = date('Y-m-d');
        $result['fechaActual'] = $fechaActual;

        $reporte = $this->model_binarias->traerTodo();

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

        if ($info != null) {

            //proceso Dias Free

            $fechaCom = new DateTime($info->fechaAc);

            $hoydia = new DateTime();

            $diferencia2 = $fechaCom->diff($hoydia)->days;



            $result['diferencia'] = $diferencia2;



            $result['fecha_formateada'] = date('d-m-Y', strtotime($info->fechaVen));
        }

        $this->load->view('header_socio', $result);

        $this->load->view('reportes2/iq', $result);

        $this->load->view('footer_socio', $result);
    }

    // Fin Señales Binarias


    // Inicio Señales Forex

    public function resumen_forex()
    {

        $result['perfil'] = $this->Model_login->cargar_datos();

        $result['campana'] = $this->Model_landingu->GetCampaña();

        $result['info'] = [];

        $result['paquetes'] = $this->model_binarias->PaquetesForex();

        $info = $this->model_binarias->traerDataFo($result['perfil']->id);

        $result['info'] = $info;

        $fechaActual = date('Y-m-d');
        $result['fechaActual'] = $fechaActual;

        $reporte = $this->model_binarias->traerTodoForex();

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

        foreach ($reporte as $fecha_obj) {

            $fecha = new DateTime($fecha_obj->fecha);

            $hoy = new DateTime();



            $diferencia = $fecha->diff($hoy);

            // Calcular la diferencia en minutos

            $diferenciaMinutos = $diferencia->days * 24 * 60 + $diferencia->h * 60 + $diferencia->i;



            $resultados[] = [

                'fecha' => $fecha->format('Y-m-d'),

                'diferencia' => $diferenciaMinutos,

                'text' => $fecha_obj->text,

                'sl' => $fecha_obj->sl,

                'tp' => $fecha_obj->sl,

                'entrada' => $fecha_obj->entrada

            ];
        }

        $result['reporte'] = $resultados;



        if ($info != null) {

            //proceso Dias Free

            $fechaCom = new DateTime($info->fechaAc);

            $hoydia = new DateTime();

            $diferencia2 = $fechaCom->diff($hoydia)->days;



            $result['diferencia'] = $diferencia2;



            $result['fecha_formateada'] = date('d-m-Y', strtotime($info->fechaVen));
        }

        $this->load->view('header_socio', $result);

        $this->load->view('reportes2/resumen_forex', $result);

        $this->load->view('footer_socio', $result);
    }

    public function getNuevosRegistrosResumenForex()
    {
        $reporte = $this->model_binarias->traerTodoForex();
        $perfil = $this->Model_login->cargar_datos();
        $InfoStatus = $this->model_binarias->traerDataFo($perfil->id);
        $hoy = new DateTime();
        $contador = 0;
        $html = '';

        if ($InfoStatus->estado == 0 || $InfoStatus->estado == null) {
            //Esta me trae los datos de con manchas
            foreach ($reporte as $registro) {
                $contador++;
                $fecha = new DateTime($registro->fecha);
                $diferencia = $fecha->diff($hoy);
                // Calcular la diferencia en minutos
                $diferenciaMinutos = $diferencia->days * 24 * 60 + $diferencia->h * 60 + $diferencia->i;
                if ($contador % 2 == 0) {
                    $html .= '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4>';
                    if ($registro->senal == "compra" || $registro->senal == "Compra") {
                        $html .= '<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">                        ';
                        $html .= '    <div class="carousel-inner">                        ';
                        $html .= '        <div class="carousel-item active" data-bs-interval="10000">                        ';
                        $html .= '          <img style="width:100%; height:250px;filter: blur(5px); margin-bottom:10px;" class="d-block w-100 "  src="https://www.myconnectmind.com/assets/img/landing/FotoForex2.PNG">';
                        $html .= '            <div class="carousel-caption ">                        ';
                        $html .= '            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pay"> Señal VIP </button>                        ';
                        $html .= '            </div>                        ';
                        $html .= '        </div>';
                        $html .= '   </div>';
                        $html .= '</div>';
                    } else {
                        $html .= '<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">                        ';
                        $html .= '    <div class="carousel-inner">                        ';
                        $html .= '        <div class="carousel-item active" data-bs-interval="10000">                        ';
                        $html .= '          <img style="width:100%; height:250px;filter: blur(5px); margin-bottom:10px;" class="d-block w-100 "  src="https://www.myconnectmind.com/assets/img/landing/FotoForex1.PNG">';
                        $html .= '            <div class="carousel-caption ">                        ';
                        $html .= '            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pay"> Señal VIP </button>                        ';
                        $html .= '            </div>                        ';
                        $html .= '        </div>';
                        $html .= '   </div>';
                        $html .= '</div>';
                    }
                    $html .= '</div>';
                    continue;
                } else {
                    $html .= '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4>';
                    $html .= '<div class="card" style="margin-bottom:25px; height:80%;">';
                    if ($registro->senal == "buy" || $registro->senal == "BUY" || $registro->senal == "compra" || $registro->senal == "Compra") {
                        $html .= ' <div class="card-body" style="background-color: #D1FCCB; border-radius: 25px;"> ';
                    } else {
                        $html .= ' <div class="card-body" style="background-color: #FEBFB6; border-radius: 25px;"> ';
                    }
                    $html .= ' <div class="row  ">';
                    $html .= '<div class="col-8 sm-8">';
                    $html .= ' <h2> ' . $registro->senal . '</h2>';
                    $html .= '<h4>';
                    $html .= 'Moneda:' . $registro->mercado . '</br>';
                    $html .= '</h4>';
                    $html .= '<h5>';
                    $html .= 'Entrada:' . $registro->entrada . '</br>';
                    $html .= 'Fecha :' . $registro->fecha . '</br>';
                    $html .= '' . $registro->text . '</br>';
                    $html .= 'SL :' . $registro->sl . '</br>';
                    $html .= 'TP :' . $registro->tp . ' </br>';
                    $html .= 'TP3 :' . $registro->tp3 . ' </br>';
                    $html .= '</h5>';
                    $html .= '</div>';
                    $html .= '<div class="col-4 sm-4">';
                    if ($registro->senal == "buy" || $registro->senal == "BUY" || $registro->senal == "compra" || $registro->senal == "Compra") {
                        $html .= ' <i class="bi bi-arrow-up-circle" style="font-size: xxx-large;color:green"></i> ';
                    } else {
                        $html .= '  <i class="bi bi-arrow-down-circle" style="font-size: xxx-large;color:red"></i> ';
                    }
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                }

            }
            echo $html;
        } else {
            if ($InfoStatus->fechaVen > $hoy->format('Y-m-d')) {
                foreach ($reporte as $registro) {
                    $fecha = new DateTime($registro->fecha);
                    $hoy = new DateTime();
                    $diferencia = $fecha->diff($hoy);
                    // Calcular la diferencia en minutos
                    $diferenciaMinutos = $diferencia->days * 24 * 60 + $diferencia->h * 60 + $diferencia->i;
                    $html .= '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4>';
                    $html .= '<div class="card" style="margin-bottom:25px; height:80%;">';
                    if ($registro->senal == "compra" || $registro->senal == "Compra") {
                        $html .= ' <div class="card-body" style="background-color: #D1FCCB; border-radius: 25px;"> ';
                    } else {
                        $html .= ' <div class="card-body" style="background-color: #FEBFB6; border-radius: 25px;"> ';
                    }
                    $html .= ' <div class="row  ">';
                    $html .= '<div class="col-8 sm-8">';
                    $html .= ' <h2> ' . $registro->senal . '</h2>';
                    $html .= '<h4>';
                    $html .= 'Moneda:' . $registro->mercado . '</br>';
                    $html .= '</h4>';
                    $html .= '<h5>';
                    $html .= 'Entrada:' . $registro->entrada . '</br>';
                    $html .= 'Fecha :' . $registro->fecha . '</br>';
                    $html .= '' . $registro->text . '</br>';
                    $html .= 'SL :' . $registro->sl . '</br>';
                    $html .= 'TP :' . $registro->tp . ' </br>';
                    $html .= 'TP3 :' . $registro->tp3 . ' </br>';
                    $html .= '</h5>';
                    $html .= '</div>';
                    $html .= '<div class="col-4 sm-4">';
                    if ($registro->senal == "compra" || $registro->senal == "Compra") {
                        $html .= ' <i class="bi bi-arrow-up-circle" style="font-size: xxx-large;color:green"></i> ';
                    } else {
                        $html .= '  <i class="bi bi-arrow-down-circle" style="font-size: xxx-large;color:red"></i> ';
                    }
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                }
                echo $html;
            } else {
                foreach ($reporte as $registro) {
                    $fecha = new DateTime($registro->fecha);
                    $hoy = new DateTime();
                    $diferencia = $fecha->diff($hoy);
                    // Calcular la diferencia en minutos
                    $diferenciaMinutos = $diferencia->days * 24 * 60 + $diferencia->h * 60 + $diferencia->i;
                    $html .= '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4>';
                    $html .= '<div class="card" style="margin-bottom:25px; height:80%;">';
                    if ($registro->senal == "compra" || $registro->senal == "Compra") {
                        $html .= ' <div class="card-body" style="background-color: #D1FCCB; border-radius: 25px;"> ';
                    } else {
                        $html .= ' <div class="card-body" style="background-color: #FEBFB6; border-radius: 25px;"> ';
                    }
                    $html .= ' <div class="row  ">';
                    $html .= '<div class="col-8 sm-8">';
                    $html .= ' <h2> ' . $registro->senal . '</h2>';
                    $html .= '<h4>';
                    $html .= 'Moneda:' . $registro->mercado . '</br>';
                    $html .= '</h4>';
                    $html .= '<h5>';
                    $html .= 'Entrada:' . $registro->entrada . '</br>';
                    $html .= 'Fecha :' . $registro->fecha . '</br>';
                    $html .= '' . $registro->text . '</br>';
                    $html .= 'SL :' . $registro->sl . '</br>';
                    $html .= 'TP :' . $registro->tp . ' </br>';
                    $html .= 'TP3 :' . $registro->tp3 . ' </br>';
                    $html .= '</h5>';
                    $html .= '</div>';
                    $html .= '<div class="col-4 sm-4">';
                    if ($registro->senal == "compra" || $registro->senal == "Compra") {
                        $html .= ' <i class="bi bi-arrow-up-circle" style="font-size: xxx-large;color:green"></i> ';
                    } else {
                        $html .= '  <i class="bi bi-arrow-down-circle" style="font-size: xxx-large;color:red"></i> ';
                    }
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</div>';
                }
                echo $html;
            }
        }
    }

    public function historial_forex()
    {

        $result['perfil'] = $this->Model_login->cargar_datos();

        $result['campana'] = $this->Model_landingu->GetCampaña();

        $result['info'] = [];

        $info = $this->model_binarias->traerData($result['perfil']->id);

        $result['info'] = $info;



        $reporte = $this->model_binarias->traerTodo();

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

        foreach ($reporte as $fecha_obj) {

            $fecha = new DateTime($fecha_obj->fecha);

            $hoy = new DateTime();



            $diferencia = $fecha->diff($hoy);

            // Calcular la diferencia en minutos

            $diferenciaMinutos = $diferencia->days * 24 * 60 + $diferencia->h * 60 + $diferencia->i;



            $resultados[] = [

                'fecha' => $fecha->format('Y-m-d'),

                'diferencia' => $diferenciaMinutos,

                'par' => $fecha_obj->par,

                'senal' => $fecha_obj->senal,

                'precio' => $fecha_obj->precio

            ];
        }

        $result['reporte'] = $resultados;



        if ($info != null) {

            //proceso Dias Free

            $fechaCom = new DateTime($info->fechaAc);

            $hoydia = new DateTime();

            $diferencia2 = $fechaCom->diff($hoydia)->days;



            $result['diferencia'] = $diferencia2;



            $result['fecha_formateada'] = date('d-m-Y', strtotime($info->fechaVen));
        }

        $this->load->view('header_socio', $result);

        $this->load->view('reportes2/historial_forex', $result);

        $this->load->view('footer_socio', $result);
    }

    public function getnuevosregistroshistorialforex()
    {
        $reporte = $this->model_binarias->traerTodoHistorialForex();

        $data = array();

        foreach ($reporte as $registro) {
            $fecha = new DateTime($registro->fecha);
            $hoy = new DateTime();
            $diferencia = $fecha->diff($hoy);
            $diferenciaMinutos = $diferencia->days * 24 * 60 + $diferencia->h * 60 + $diferencia->i;

            $card = array(
                'senal' => $registro->senal,
                'entrada' => $registro->entrada,
                'text' => $registro->text,
                'sl' => $registro->sl,
                'tp' => $registro->tp,
                'fecha' => $registro->fecha,
                'diferencia_minutos' => $diferenciaMinutos
            );

            $card_html = '<div class="card">';
            $card_html .= '<div class="card-body">';
            $card_html .= '<h5 class="card-title">' . $card['senal'] . '</h5>';
            $card_html .= '<p class="card-text">' . $card['entrada'] . '</p>';
            $card_html .= '</div>';
            $card_html .= '</div>';

            array_push($data, $card);
        }

        header('Content-Type: application/json');
        echo json_encode(array('data' => $data));
    }

    public function iq_forex()
    {

        $result['perfil'] = $this->Model_login->cargar_datos();

        $result['campana'] = $this->Model_landingu->GetCampaña();

        $result['info'] = [];

        $info = $this->model_binarias->traerData($result['perfil']->id);

        $result['info'] = $info;



        $reporte = $this->model_binarias->traerTodo();

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


        if ($info != null) {

            //proceso Dias Free

            $fechaCom = new DateTime($info->fechaAc);

            $hoydia = new DateTime();

            $diferencia2 = $fechaCom->diff($hoydia)->days;



            $result['diferencia'] = $diferencia2;



            $result['fecha_formateada'] = date('d-m-Y', strtotime($info->fechaVen));
        }

        $this->load->view('header_socio', $result);

        $this->load->view('reportes2/iq_forex', $result);

        $this->load->view('footer_socio', $result);
    }

    // Fin Señales Forex


    public function getNuevosRegistros()
    {

        $reporte = $this->model_servicio->GetReporte();



        $html = '';

        foreach ($reporte as $registro) {

            $fecha = new DateTime($registro->fecha);

            $hoy = new DateTime();

            $diferencia = $fecha->diff($hoy);

            // Calcular la diferencia en minutos

            $diferenciaMinutos = $diferencia->days * 24 * 60 + $diferencia->h * 60 + $diferencia->i;



            $html .= '<div class="card" style="margin-bottom:2rem;">';

            if ($registro->senal == "compra" || $registro->senal == "Compra") {

                $html .= ' <div class="card-body" style="border: 4px solid green; border-radius: 25px;"> ';
            } else {

                $html .= ' <div class="card-body" style="border: 4px solid red; border-radius: 25px;"> ';
            }



            $html .= ' <div class="row  ">';

            $html .= ' <div class="col sm-6  ">';



            if ($registro->senal == "compra" || $registro->senal == "Compra") {

                $html .= ' <i class="bi bi-arrow-up-circle" style="font-size: xxx-large;color:green"></i> ';
            } else {

                $html .= '  <i class="bi bi-arrow-down-circle" style="font-size: xxx-large;color:red"></i> ';
            }

            $html .= ' </div>';

            $html .= '<div class="col-9 sm-6">';

            $html .= '<h3>';

            $html .= $registro->senal . '</br>';

            $html .= 'Precio Señal :' . $registro->precio . '</br>';

            $html .= 'UTC :' . $registro->fecha . '</br>';

            $html .= 'Hace :' . $diferenciaMinutos . ' Minutos</br>';

            $html .= '</h3>';

            $html .= '</div>';

            $html .= '<div class="col sm-12">';

            $html .= ' <h2> ' . $registro->par . '</h2>';

            $html .= '</div>';

            $html .= '</div>';

            $html .= '</div>';

            $html .= '</div>';
        }

        echo $html;
    }


    public function PayServicio()
    {

        $perfil = $this->Model_login->cargar_datos();

        $data = array(

            'idUser' => $perfil->id,

            'estado' => 0,

        );

        $this->model_binarias->insertData($data);

        $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex  " style="width: 50%;"> Proceso Exitoso , Disfruta de tus 15 dias de Señales de binarias gratis</div></center>');

        redirect(base_url() . "Binarias_resumen");
    }
    public function PayServicioFo()
    {

        $perfil = $this->Model_login->cargar_datos();

        $data = array(

            'idUser' => $perfil->id,

            'estado' => 0,

        );

        $this->model_binarias->insertDataFo($data);

        $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex  " style="width: 50%;"> Proceso Exitoso , Disfruta de tus 15 dias de Señales de binarias gratis</div></center>');

        redirect(base_url() . "Reportes2/resumen_forex");
    }


    public function PayServicioOF($idPaquete)
    {
        $precio = $this->model_binarias->PaquetesBinariasOne($idPaquete);

        $perfil = $this->Model_login->cargar_datos();

        $billetera = $this->model_banco->billetera($perfil->token);

        $data5 = array(

            'idUser' => $perfil->id,

            'estado' => 1,

        );

        $this->model_binarias->insertData($data5);

        $idUser = $this->model_binarias->lastID();

        $infoUser = $this->model_binarias->traerData($idUser);

        if ($billetera->cuenta_compra >= $precio->precio) {

            //Usuario
            $restar = $billetera->cuenta_compra - $precio->precio;
            $data = array(
                "cuenta_compra" => $restar
            );
            $this->model_banco->updBilletera($perfil->token, $data) == 1;
            //empresa
            $empresa = $this->model_proceso->consultar_referido_niveles(6);
            $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
            $sumar = $billetera_empresa->cuenta_senbi + $precio->precio;
            $data2 = array(
                "cuenta_senbi" => $sumar,
            );
            $this->model_proceso->actualizar_wallet_empresa2($data2, $empresa->token);


            // Obtiene la fecha actual
            $fechaActual = new DateTime();
            // Clona el objeto para mantener la fecha actual intacta
            $fechaMasUnMes = clone $fechaActual;
            if ($precio->id == 1) {
                $fechaMasUnMes->modify('+1 month');
            } else if ($precio->id == 2) {
                $fechaMasUnMes->modify('+4 month');
            } else if ($precio->id == 3) {
                $fechaMasUnMes->modify('+6 month');
            }
            $fechaMasUnMesStr = $fechaMasUnMes->format('Y-m-d');

            $data3 = array(
                'estado' => 1,
                'fechaVen' => $fechaMasUnMesStr,
            );
            $this->model_binarias->Updatedata($data3, $perfil->id);

            //Registro de transaccion

            $data4 = array(
                'idPrin' => $infoUser->id,
                'fechaVen' => $fechaMasUnMesStr,
            );



            $this->model_binarias->PayService($data4);

            $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex  " style="width: 50%;"> Proceso Exitoso , Compra exitosa</div></center>');

            redirect(base_url() . "Binarias_historial");

        } else {

            $this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex  " style="width: 50%;"> Saldo Insuficiente </div></center>');

            redirect(base_url() . "Binarias_historial");
        }
    }

    public function PayServicioOFFo($idPaquete)
    {
        $precio = $this->model_binarias->PaquetesBinariasOne($idPaquete);

        $perfil = $this->Model_login->cargar_datos();

        $billetera = $this->model_banco->billetera($perfil->token);

        $data6 = array(
            'idUser' => $perfil->id,
            'estado' => 1,
        );
        $this->model_binarias->insertDataFo($data6);

        $idUser = $this->model_binarias->lastID();
        $infoUser = $this->model_binarias->traerData($idUser);

        if ($billetera->cuenta_compra >= $precio->precio) {

            //Usuario
            $restar = $billetera->cuenta_compra - $precio->precio;
            $data = array(
                "cuenta_compra" => $restar
            );
            $this->model_banco->updBilletera($perfil->token, $data) == 1;
            //empresa
            $empresa = $this->model_proceso->consultar_referido_niveles(6);
            $billetera_empresa = $this->model_proceso->cargar_billetera_global($empresa->token);
            $sumar = $billetera_empresa->cuenta_senbi + $precio->precio;
            $data2 = array(
                "cuenta_senfo" => $sumar,
            );
            $this->model_proceso->actualizar_wallet_empresa2($data2, $empresa->token);


            // Obtiene la fecha actual
            $fechaActual = new DateTime();
            // Clona el objeto para mantener la fecha actual intacta
            $fechaMasUnMes = clone $fechaActual;
            if ($precio->id == 4) {
                $fechaMasUnMes->modify('+1 month');
            } else if ($precio->id == 5) {
                $fechaMasUnMes->modify('+4 month');
            } else if ($precio->id == 6) {
                $fechaMasUnMes->modify('+6 month');
            }
            $fechaMasUnMesStr = $fechaMasUnMes->format('Y-m-d');

            $data3 = array(
                'estado' => 1,
                'fechaVen' => $fechaMasUnMesStr,
            );
            $this->model_binarias->UpdatedataFo($data3, $perfil->id);

            //Registro de transaccion

            $data4 = array(
                'idPrin' => $infoUser->id,
                'fechaVen' => $fechaMasUnMesStr,
            );
            $this->model_binarias->PayServiceFo($data4);


            $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex  " style="width: 50%;"> Proceso Exitoso , Compra exitosa</div></center>');

            redirect(base_url() . "Reportes2/resumen_forex");
        } else {

            $this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex  " style="width: 50%;"> Saldo Insuficiente </div></center>');

            redirect(base_url() . "Reportes2/resumen_forex");
        }
    }

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





    //// procesos para Actualizacion de wallet binance



    public function codigo_seguridad()
    {

        $codigo = $this->generateRandomString(6);

        $perfil = $this->Model_login->cargar_datos();

        $date = new DateTime();

        $date->modify('+3 minute');

        $msm = "hola como estan todos?";

        $data = array(

            "codigo_seguridad" => $codigo,

            "fecha_caduca_cod" => $date->format('Y-m-d H:i:s')

        );

        if ($this->model_servicio->codigo($perfil->id, $data) == 1) {

            $this->model_email2->notificacionMsj($perfil->correo, $msm);

            $this->model_email2->envio_correos_pendientes_bd();

            print_r($perfil->correo);

            $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex  " style="width: 50%;"> Revisa el correo electronico para seguir con el proceso. </div></center>');

            redirect(base_url() . "Perfil");
        }
    }





    public function ChangeBinance()
    {

        $wallet = $this->input->post("wallet");

        $user = $this->input->post("user");

        $pass = $this->input->post("pass");

        $contra = md5($pass);

        $cedula = $this->input->post("cedula");



        $buscar = $this->model_binarias->searchUser($user, $contra, $cedula);

        if ($buscar->contar == 1) {

            $perfil = $this->Model_login->cargar_datos();

            $data = array(

                "wallet_binance" => $wallet

            );

            $this->model_binarias->UpdateMaster($data, $perfil->id) == 1;

            $this->session->set_flashdata('error', '  <center><div class="alert alert-success text-center d-flex  " style="width: 50%;"> Proceso Exitoso. </div></center>');
        } else {

            $this->session->set_flashdata('error', '  <center><div class="alert alert-danger text-center d-flex  " style="width: 50%;"> Credenciales incorrectas. </div></center>');
        }

        redirect(base_url() . "Perfil");
    }

    function generateRandomString($length)
    {

        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }



    public function borrar()
    {



        $buscar = $this->model_binarias->eliminar_registro_hpli();

        if ($buscar == 1) {

            echo "good";
        }
    }

    // Inicio En Vivo 

    public function envivo_binarias()
    {

        $result['perfil'] = $this->Model_login->cargar_datos();

        $result['campana'] = $this->Model_landingu->GetCampaña();

        $result['info'] = [];

        $info = $this->model_binarias->traerData($result['perfil']->id);

        $result['info'] = $info;



        $reporte = $this->model_binarias->traerTodo();

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


        if ($info != null) {

            //proceso Dias Free

            $fechaCom = new DateTime($info->fechaAc);

            $hoydia = new DateTime();

            $diferencia2 = $fechaCom->diff($hoydia)->days;



            $result['diferencia'] = $diferencia2;



            $result['fecha_formateada'] = date('d-m-Y', strtotime($info->fechaVen));
        }

        $this->load->view('header_socio', $result);

        $this->load->view('reportes2/envivo_binarias', $result);

        $this->load->view('footer_socio', $result);
    }

    public function envivo_forex()
    {

        $result['perfil'] = $this->Model_login->cargar_datos();

        $result['campana'] = $this->Model_landingu->GetCampaña();

        $result['info'] = [];

        $info = $this->model_binarias->traerData($result['perfil']->id);

        $result['info'] = $info;



        $reporte = $this->model_binarias->traerTodo();

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


        if ($info != null) {

            //proceso Dias Free

            $fechaCom = new DateTime($info->fechaAc);

            $hoydia = new DateTime();

            $diferencia2 = $fechaCom->diff($hoydia)->days;



            $result['diferencia'] = $diferencia2;



            $result['fecha_formateada'] = date('d-m-Y', strtotime($info->fechaVen));
        }

        $this->load->view('header_socio', $result);

        $this->load->view('reportes2/envivo_forex', $result);

        $this->load->view('footer_socio', $result);
    }

    public function for ()
    {
        $this->load->view('reportes2/for');
    }
    // Fin En Vivo
}