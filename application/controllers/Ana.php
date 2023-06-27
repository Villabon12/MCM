<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Ana extends CI_Controller
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
        $this->load->view('prueba_copy');
    }

}
