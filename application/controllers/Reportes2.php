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
    }
    //vistas intefaz de usuario
    public function home()
    {
        $result['perfil'] = $this->Model_login->cargar_datos();
        $result['campana'] = $this->Model_landingu->GetCampaña();
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
        $this->load->view('header_socio', $result);
        $this->load->view('reportes2/reporte', $result);
        $this->load->view('footer_socio', $result);
    }
}