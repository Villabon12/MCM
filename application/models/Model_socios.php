<?php
defined('BASEPATH') or exit('No direct script access allowed');

class model_socios extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

  public function verficarCuenta()
  {
    $this->db->select('*');
    $this->db->where('verificarCuenta', 0);
    $resultado = $this->db->get('r_master_usuarios');

    return $resultado->result();
  }

  public function reportes()
  {
    $this->db->select('r.*, e.estrategia');
    $this->db->from('reportes_robot r');
    $this->db->join('estrategia e','e.id = r.tipo');
    $resultado = $this->db->get();

    return $resultado->result();
  }

  public function parametro()
  {
    $this->db->select('*');
    $resultado = $this->db->get('parametros_binarias');

    return $resultado->result();
  }
  public function parametroGeneral()
  {
    $this->db->select('*');
    $resultado = $this->db->get('parametros_general');

    return $resultado->result();
  }
  public function costosServicios()
  {
    $this->db->select('*');
    $resultado = $this->db->get('costo_servicio');

    return $resultado->result();
  }

  public function estado()
  {
    $this->db->select('*');
    $resultado = $this->db->get('reporte_estado_binario');

    return $resultado->result();
  }

  public function verficarBanco()
  {
    $this->db->select('*');
    $this->db->where('verificarBanco', 0);
    $resultado = $this->db->get('r_master_usuarios');

    return $resultado->result();
  }

  public function aprobarUser($id, $data)
  {
    $this->db->where('id', $id);
    $sql = $this->db->update('r_master_usuarios', $data);
    return $sql;
  }

  public function cargar_equipo()
  {
    $id = $this->session->userdata('ID');

    $this->db->select('*');
    $this->db->where('id_papa_pago', $id);

    $resultado = $this->db->get('r_master_usuarios');

    return $resultado->result();
  }

  public function updParametrosBinaria($data, $id)
  {
    $this->db->where('id', $id);
    $this->db->update('parametros_binarias', $data);
  }

  public function updParametrosGeneral($data, $id)
  {
    $this->db->where('id', $id);
    $this->db->update('parametros_general', $data);
  }
  public function updCosto($data, $id)
  {
    $this->db->where('id', $id);
    $this->db->update('costo_servicio', $data);
  }

  public function encender()
  {
    $sql = "
 
CREATE
TRIGGER `tabla_profit` BEFORE INSERT ON `reportes_robot` 
FOR EACH ROW 
BEGIN
DECLARE inversionT FLOAT;

SELECT SUM(r_inversion_robot.inversion) INTO inversionT FROM r_inversion_robot WHERE r_inversion_robot.consignado=1;

INSERT INTO hisotrial_broker_mcm(valor) VALUES (inversionT);
CALL repartir_dinero((new.saldo_final-new.saldo_inicial),new.saldo_inicial,new.porcentaje_apostado,new.porcentajeregistrado, new.tipo, new.estado);
INSERT INTO resultado_inversion_b(saldo_entra, saldo_sale, ganancia, mercado,senal,saldo_inicial,saldo_final) VALUES(new.precio_entrada,new.precio_salida,(new.saldo_final-new.saldo_inicial),new.mercado,new.señal,new.saldo_inicial,new.saldo_final);

END;

   ";

    $query = $this->db->query($sql);
    return 1;
  }

  public function apagar()
  {
    $sql = "DROP TRIGGER /*!50032 IF EXISTS */ `tabla_profit`
   ";

    $query = $this->db->query($sql);
    return 1;
  }

  public function cargar()
  {
    $this->db->select('c.*, r.nombre, r.apellido1');
    $this->db->from('retiros c');
    $this->db->join('r_master_usuarios r', 'r.id = c.usuario_id');
    $resultado = $this->db->get();

    return $resultado->result();
  }

  public function updRetiros($data, $id)
  {
    $this->db->where('id', $id);
    $this->db->update('retiros', $data);
  }

  public function manual()
  {
    $this->db->where('estrategia',1);
    $this->db->select('*');
    $resultado = $this->db->get('diasemana');

    return $resultado->result();
  }
  public function automatico()
  {
    $this->db->where('estrategia',2);
    $this->db->select('*');
    $resultado = $this->db->get('diasemana');

    return $resultado->result();
  }
  public function telegram()
  {
    $this->db->where('estrategia',3);
    $this->db->select('*');
    $resultado = $this->db->get('diasemana');

    return $resultado->result();
  }


  public function actualizarDia($data,$id)
  {
    $this->db->where('id',$id);
    $this->db->update('diasemana',$data);
  }
}
