<?php

defined('BASEPATH') or exit('No direct script access allowed');
use GuzzleHttp\Client;

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
      $this->sendMensage($pais->celular, $perfil->celular, $codigo, $perfil->nombre);
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
      $this->sendMensage($pais->celular, $perfil->celular, $codigo, $perfil->nombre);
    }

  }


  public function Alternativa()
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
      //  $this->prueba2($pais->celular, $perfil->celular, $codigo, $perfil->nombre);
      $this->sendMensage2($pais->celular, $perfil->celular, $codigo, $perfil->nombre);

    }
  }

  public function sendMensage2($pais, $celular, $codigo, $nombre)
  {
    $this->load->library('curl');

    $url = "https://graph.facebook.com/v16.0/109906238696085/messages";
    // $access_token = "EAAIXHbrbkkUBABGoHq1wUCBjSZBRbyd3BM5dAZCnsOsRUdNG5qvvZCrNAHwdw2JgREQwZBcepPgO4ZCVV1KtNOOzHy7OXsdwaRhP3WLyqqPvUVeR1gpYIsL5xqAZBL83ohkGh17J13l8BICbkKjxVK8vRRLcOfgVSaEpJyPurSLUEW6SurS42Xm7yCwyJJUZCAiTjMrbJaZCjwZDZD";
    $access_token = "EAAIXHbrbkkUBAOZAxVnWlAxCCk8d52ukukXg2thhg3wYMvgGOaxYw2FdktdKAApBRbZBBZCxBSpAZAYonPcZBjbyTcfFKXPfw9kabZA3qwYxJsw9iSOdGtXo6WNvXFlmZAPfb9BHEqxNzvdwSfZBQAaiwAAZBVZBot4gMZAwh3NXSWBXCqtryD0BMx6fZAKVtbYssgWZCon8JCG1tAG6pUE922n8ZA4vze8ODHZB5MZD";

    $celularenvio = "" . $pais . "" . $celular;
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
        echo $response;
      } else {
        echo '<p style="color:green">Corecto, revisa tu Whatsapp tienes 3 minutos<p>';
      }
    }

  }


  public function sendMensage($pais, $celular, $codigo, $nombre)
  {
    $this->load->library('curl');

    $url = "https://graph.facebook.com/v16.0/112265295197281/messages";
    $access_token = "EAAIXHbrbkkUBAF8GUGG2Uy3ax2eK7YrMg6BIEJEOLZBDff8TJYM8FtcbqXPHTNSJemkcFL4aL38tNyuPcqmO4YUzwnMYzh1cBB9MiwMrttkk3mIxP8o5hiVDEoqASSezVNYhGKj5ssJTf8lsZAmc1xVh0VQ8EXMgA7TN52pydjpUN00mcA";
    $celularenvio = "" . $pais . "" . $celular;
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
          array(
            'type' => 'button',
            'sub_type' => 'url',
            'index' => 0,
            'parameters' => array(
              array(
                'type' => 'text',
                'text' => 'www',
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
        echo $response;
      } else {
        echo $response;
      }
    }

  }
  // Carga la biblioteca de Guzzle en tu controlador

  public function send_whatsapp_message()
  {
    // Configuración de Twilio
    $account_sid = 'ACb488697890bf676d9bc44922353149fc';
    $auth_token = '6bdc7db575d6f5c3d4db13e9e0e38ad2';
    $twilio_phone_number = 'whatsapp:+14155238886';
    $recipient_phone_number = 'whatsapp:+573054648486';
    $message_text = 'hola su código es : 456415560';

    // Crea una instancia del cliente de Guzzle
    $client = new Client([
      'base_uri' => 'https://api.twilio.com/2010-04-01/Accounts/' . $account_sid . '/',
      'auth' => [$account_sid, $auth_token]
    ]);

    // Envía el mensaje de WhatsApp utilizando Guzzle
    $response = $client->post('Messages.json', [
      'form_params' => [
        'To' => $recipient_phone_number,
        'From' => $twilio_phone_number,
        'Body' => $message_text
      ]
    ]);

    // Verifica si el mensaje se envió correctamente
    if ($response->getStatusCode() == 201) {
      echo "<p style='color: green;'>Codigo de seguridad enviado, revisa tu WhatsApp. Tienes un limite de 3 minutos</p>";
    } else {
      echo 'Error al enviar el mensaje de WhatsApp: ' . $response->getBody();
    }
  }


  public function send_sms_message()
  {
    // Configuración de Twilio
    $account_sid = 'ACb488697890bf676d9bc44922353149fc';
    $auth_token = '6bdc7db575d6f5c3d4db13e9e0e38ad2';
    $twilio_phone_number = '+12707479302';
    $recipient_phone_number = '+573154552434';
    $message_text = 'hola rosario';

    // Inicializa cURL
    $ch = curl_init('https://api.twilio.com/2010-04-01/Accounts/' . $account_sid . '/Messages.json');

    // Configura las opciones de cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
      'To' => $recipient_phone_number,
      'From' => $twilio_phone_number,
      'Body' => $message_text
    ]));
    curl_setopt($ch, CURLOPT_USERPWD, $account_sid . ':' . $auth_token);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Content-Type: application/x-www-form-urlencoded'
    ]);

    // Ejecuta la solicitud cURL
    $response = curl_exec($ch);

    // Verifica si el mensaje se envió correctamente
    if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 201) {
      echo 'Mensaje SMS enviado con éxito';
    } else {
      echo 'Error al enviar el mensaje SMS: ' . $response;
    }

    // Cierra la sesión cURL
    curl_close($ch);
  }




  public function envioMsj($pais, $celular, $codigo, $nombre)
  {
    // Configuración de Twilio
    $account_sid = 'ACb488697890bf676d9bc44922353149fc';
    $auth_token = '6bdc7db575d6f5c3d4db13e9e0e38ad2';
    $twilio_phone_number = 'whatsapp:+14155238886';
    $recipient_phone_number = 'whatsapp:' . $pais . '' . $celular . '';
    $message_text = 'hola ' . $nombre . ' su código es : ' . $codigo . '';

    // Inicializa cURL
    $ch = curl_init('https://api.twilio.com/2010-04-01/Accounts/' . $account_sid . '/Messages.json');

    // Configura las opciones de cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
      'To' => $recipient_phone_number,
      'From' => $twilio_phone_number,
      'Body' => $message_text
    ]));
    curl_setopt($ch, CURLOPT_USERPWD, $account_sid . ':' . $auth_token);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Content-Type: application/x-www-form-urlencoded'
    ]);

    // Ejecuta la solicitud cURL
    $response = curl_exec($ch);

    // Verifica si el mensaje se envió correctamente
    if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 201) {
      echo "<p style='color: green;'>Codigo de seguridad enviado, numero " . $pais . "" . $celular . "</p>";
    } else {
      echo 'Error al enviar el mensaje de WhatsApp: ' . $response;
    }
    // Cierra la sesión cURL
    curl_close($ch);
  }


  public function send_sms_message2()
  {
    // Configuración de Nexmo
    $api_key = '4ab843a9';
    $api_secret = 'epIUl1RF5IstCymi';
    $nexmo_phone_number = 'Vonage APIs';
    $recipient_phone_number = '573054648486';
    $message_text = 'holaaaa diego';

    // Construye la URL de la API de Nexmo
    $api_url = 'https://rest.nexmo.com/sms/json';

    // Inicializa cURL
    $ch = curl_init($api_url);

    // Configura las opciones de cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
      'api_key' => $api_key,
      'api_secret' => $api_secret,
      'from' => $nexmo_phone_number,
      'to' => $recipient_phone_number,
      'text' => $message_text
    ]));

    // Ejecuta la solicitud cURL
    $response = curl_exec($ch);

    // Verifica si el mensaje se envió correctamente
    $response_data = json_decode($response, true);
    if (isset($response_data['messages'][0]['status']) && $response_data['messages'][0]['status'] == 0) {
      echo 'Mensaje SMS enviado con éxito';
    } else {
      echo 'Error al enviar el mensaje SMS: ' . $response;
    }

    // Cierra la sesión cURL
    curl_close($ch);
  }



  public function prueba()
  {

    $this->load->library('curl');

    //TOKEN QUE NOS DA FACEBOOK
    $token = 'EAADrKgxwsScBAJrZBuX89TRm6YfaT1vOlYyDOdambQTrARye2IOUZBJQ3lzSRUgzVhL3eSYN8ZB6awKUiG9oCEtVrWzZA9UOZBCgWrCRtpBZBS7gwYOZBSerZA5egNtD5c1mzdwAqIp5x42RFOTFSO8149efpbWZCCMXRuuwQrJ3VIujZCEm7pHXb8dxZClhvfZBV4we5RQO3n28TwZDZD';
    //NUESTRO TELEFONO
    $telefono = '573054648486';
    //URL A DONDE SE MANDARA EL MENSAJE
    $url = 'https://graph.facebook.com/v16.0/112265295197281/messages';

    //MENSAJE
    $msj = "que onda pss mis prros";

    //CONFIGURACION DEL MENSAJE
    $mensaje = ''
      . '{'
      . '  "messaging_product": "whatsapp", '
      . '  "to": "' . $telefono . '", '
      . '  "type": "template", '
      . '  "template": {'
      . '    "name": "hello_world",'
      . '    "language": { "code": "en_US" },'
      . '    "components": ['
      . '      { "type": "body", "parameters": ['
      . '        { "type": "text", "text": "' . $msj . '" }'
      . '      ] }'
      . '    ]'
      . '  }'
      . '}';
    //DECLARAMOS LAS CABECERAS
    $header = array("Authorization: Bearer " . $token, "Content-Type: application/json", );
    //INICIAMOS EL CURL
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //OBTENEMOS LA RESPUESTA DEL ENVIO DE INFORMACION
    $response = json_decode(curl_exec($curl), true);
    //IMPRIMIMOS LA RESPUESTA 
    print_r($response);
    //OBTENEMOS EL CODIGO DE LA RESPUESTA
    $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    //CERRAMOS EL CURL
    curl_close($curl);
  }



  public function prueba2($pais, $telefono, $codigo, $nombre)
  {
    $this->load->library('curl');
    $url = "https://graph.facebook.com/v16.0/109906238696085/messages";
    $access_token = "EAAIXHbrbkkUBAF8GUGG2Uy3ax2eK7YrMg6BIEJEOLZBDff8TJYM8FtcbqXPHTNSJemkcFL4aL38tNyuPcqmO4YUzwnMYzh1cBB9MiwMrttkk3mIxP8o5hiVDEoqASSezVNYhGKj5ssJTf8lsZAmc1xVh0VQ8EXMgA7TN52pydjpUN00mcA";
    $celularenvio = "" . $pais . "" . $telefono;
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
                'text' => 'wwwww'
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

    if (!$response) {
      echo 'Error: ' . curl_error($curl);
    } else {
      $json = json_decode($response);
      if (isset($json->error)) {
        echo $response;
      } else {
        echo $response;
      }
    }

  }

  public function generateRandomString($length)
  {
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
  }

}