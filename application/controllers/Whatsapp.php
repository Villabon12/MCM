<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Whatsapp extends CI_Controller
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
    }

    public function codigo_seguridad()
    {
      $codigo = $this->generateRandomString(6);
    	$perfil = $this->model_login->cargar_datos();
      $pais = $this->model_ultra->traer_pais($perfil->pais_id);
    	$date = new DateTime();
    	$date->modify('+3 minute');

    	$data = array(
    		"codigo_seguridad" => $codigo,
    		"fecha_caduca_cod" => $date->format('Y-m-d H:i:s')
    	);
    	if ($this->model_servicio->codigo($perfil->id, $data) == 1) {
    		$this->sendMensage($pais->celular,$perfil->celular, $codigo, $perfil->nombre);
    	}
      
    }

    public function codigo_seguridad_inicio()
    {
      $user = $this->input->post('id');
      $codigo = $this->generateRandomString(6);
    	$perfil = $this->model_login->trae_user_codigo($user);
      $pais = $this->model_ultra->traer_pais($perfil->pais_id);
    	$date = new DateTime();
    	$date->modify('+3 minute');

    	$data = array(
    		"codigo_seguridad" => $codigo,
    		"fecha_caduca_cod" => $date->format('Y-m-d H:i:s')
    	);
    	if ($this->model_servicio->codigo($perfil->id, $data) == 1) {
    		$this->sendMensage($pais->celular,$perfil->celular, $codigo, $perfil->nombre);
    	}
      
    }

    public function sendMensage($pais,$celular,$codigo,$nombre)
    {
        $this->load->library('curl');

        $url = "https://graph.facebook.com/v15.0/109906238696085/messages";
        $access_token = "EAAIXHbrbkkUBAF8GUGG2Uy3ax2eK7YrMg6BIEJEOLZBDff8TJYM8FtcbqXPHTNSJemkcFL4aL38tNyuPcqmO4YUzwnMYzh1cBB9MiwMrttkk3mIxP8o5hiVDEoqASSezVNYhGKj5ssJTf8lsZAmc1xVh0VQ8EXMgA7TN52pydjpUN00mcA";
        $celularenvio = "".$pais."".$celular;
        $data = array(
          'messaging_product' => 'whatsapp',
          'to' => $celularenvio,
          'type' => 'template',
          'template' => array(
            'name' => 'codigo_seguridad_2',
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
              // array(
              //   'type' => 'button',
              //   'sub_type' => 'url',
              //   'index' => 0,
              //   'parameters' => array(
              //     array(
              //       'type' => 'text',
              //       'text' => $enlace
              //     )
              //   )
              // )
            )
          )
        );
        
        $options = array(
          CURLOPT_URL => $url,
          CURLOPT_POST => true,
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$access_token,
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
            echo 'Error con tu número, revisa si tienes numero de celular y país';
          } else {
            echo "<p style='color: green;'>Codigo de seguridad enviado, revisa tu WhatsApp. Tienes un limite de 3 minutos</p>";
          }
        }

    }

    public function generateRandomString($length)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

}
