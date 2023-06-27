<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Validacion extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_login');
        $this->load->model('model_socios');
        $this->load->model('model_proceso');
        $this->load->model('model_errorpage');
        $this->load->model('model_email2');
        $this->load->model('model_puzzle1');
        $this->load->model('model_reporte');
        $this->load->model('model_modulo');
        $this->load->model('model_ultra');
        $this->load->model('model_servicio');
        $this->load->model('model_template');
    }

    public function codigo_seguridad()
    {
        $codigo = $this->generateRandomString(6);
        $perfil = $this->model_login->cargar_datos();
    	$date = new DateTime();
    	$date->modify('+3 minute');
        $mensaje = $this->model_template->mensaje1($codigo);
    	$data = array(
    		"codigo_seguridad" => $codigo,
    		"fecha_caduca_cod" => $date->format('Y-m-d H:i:s')
    	);
    	if ($this->model_servicio->codigo($perfil->id, $data) == 1) {
    		$this->sendMensage($perfil->correo, $mensaje);
    		echo "<p style='color: green;'>Codigo de seguridad enviado, revisa tu Correo Electronico. ".$perfil->correo."</p>";
    	}
      
    }

    public function sendMensage($correo,$mensaje)
    {
        $data = array(
            'key' => 'md-H4_txbJm9OK66OXSU4FdRg',
            'message' => array(
                'from_email' => 'noresponder@myconnectmind.com',
                'subject' => '[MCM] Codigo seguridad',
                'text' => $mensaje,
                'to' => array(
                    array(
                    'email' => $correo,
                    'type' => 'to'
                )
                )
            ),
        );
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://mandrillapp.com/api/1.0/messages/send');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $result = curl_exec($ch);
        curl_close($ch);

        var_dump($result);
    }

    public function generateRandomString($length)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

}
