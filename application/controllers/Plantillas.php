<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Plantillas extends CI_Controller
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

    public function envioMensaje($ban = null)
    {
        
    }

}
