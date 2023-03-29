<?php

defined('BASEPATH') or exit('No direct script access allowed');

class whatsapp extends CI_Controller
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
    }

    public function sendMensage()
    {
        $this->load->library('curl');

        $url = "https://graph.facebook.com/v15.0/109906238696085/messages";
        $access_token = "EAAIXHbrbkkUBAOkwgmbjoCtpuRmyEFah7YtsT7TrTzCDKa2vMppicdQBbdnddh7uumTwCBq8nPhCW4lAjPJZB8GxvJQ6xdZALLg6wlscZAo1nsncUR6sZA16jQuh0ogCwZACZAH87HZA4SXPNZAH9BZBiOYwO2qqwMFj0CuuosjCFo4J5pZCnrZBprfC2aBGFqSplRjpP1s1UDNFwZDZD";

        $data = array(
          'messaging_product' => 'whatsapp',
          'to' => '573194780042',
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
                    'text' => 'Leonardo'
                  ),
                  array(
                    'type' => 'text',
                    'text' => '1234' 
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
                    'text' => 'MCM'
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
            echo 'API Error: ' . $json->error->message;
          } else {
            echo 'Message Sent';
          }
        }

    }

    public function enviar()
    {
        $this->sendMensage();
    }
}
