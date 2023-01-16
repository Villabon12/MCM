<?php

defined('BASEPATH') or exit('No direct script access allowed');

class model_socios extends CI_Model
{
    public function __construct()
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
        $this->db->join('estrategia e', 'e.id = r.tipo');
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
    public function parametroEstrategia()
    {
        $this->db->select('*');
        $resultado = $this->db->get('estrategia');

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

    public function updParametrosPuzzle($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('parametro_puzzle', $data);
    }

    public function updCosto($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('costo_servicio', $data);
    }

    public function updPuzzle($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('puzzle_fichas', $data);
    }

    public function encender()
    {
        $sql = "
 
CREATE
TRIGGER `tabla_profit` BEFORE INSERT ON `reportes_robot` 
FOR EACH ROW 
BEGIN
DECLARE inversionT FLOAT;
DECLARE lotaje FLOAT;
DECLARE restante FLOAT;
DECLARE confirmar INT;
DECLARE valorMul FLOAT;
DECLARE demas FLOAT;
DECLARE porcRestante FLOAT;
   IF new.estado = 1 THEN
     SELECT SUM(r_inversion_robot.inversion) INTO inversionT FROM r_inversion_robot WHERE r_inversion_robot.consignado=1;
     SELECT estrategia.lotaje INTO lotaje FROM estrategia WHERE estrategia.id = new.tipo;
     SELECT POSITION('%' IN new.porcentaje_apostado) INTO confirmar;
	IF confirmar > 0 THEN
	    SELECT TRIM(BOTH '%' FROM new.porcentaje_apostado/100) INTO valorMul;
	    SET restante = valorMul * lotaje;
	    SET demas = valorMul - restante;
	    SET porcRestante = 1 - lotaje;
	    INSERT INTO hisotrial_broker_mcm(valor) VALUES (inversionT);
	    CALL repartir_dinero((new.saldo_final-new.saldo_inicial),new.saldo_inicial,new.porcentaje_apostado,new.porcentajeregistrado, new.tipo, restante);
      INSERT INTO resultado_inversion_b(saldo_entra, saldo_sale, ganancia, mercado,senal,saldo_inicial,saldo_final) VALUES(new.precio_entrada,new.precio_salida,(new.saldo_final-new.saldo_inicial),new.mercado,new.señal,new.saldo_inicial,new.saldo_final);
	
	ELSE
	    SELECT TRIM(BOTH '$' FROM new.porcentaje_apostado) INTO valorMul;
	    SET restante = valorMul * lotaje;
	    SET demas = valorMul - restante;	    
	    INSERT INTO hisotrial_broker_mcm(valor) VALUES (inversionT);
	    CALL repartir_dinero((new.saldo_final-new.saldo_inicial),new.saldo_inicial,new.porcentaje_apostado,new.porcentajeregistrado, new.tipo, restante);
      INSERT INTO resultado_inversion_b(saldo_entra, saldo_sale, ganancia, mercado,senal,saldo_inicial,saldo_final) VALUES(new.precio_entrada,new.precio_salida,(new.saldo_final-new.saldo_inicial),new.mercado,new.señal,new.saldo_inicial,new.saldo_final);
	
	END IF;     
    
   END IF;
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
    public function cargarBinaria()
    {
        $this->db->select('c.*, r.nombre, r.apellido1');
        $this->db->from('retiros_inversion c');
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
        $this->db->where('estrategia', 1);
        $this->db->select('*');
        $resultado = $this->db->get('diasemana');

        return $resultado->result();
    }
    public function automatico()
    {
        $this->db->where('estrategia', 2);
        $this->db->select('*');
        $resultado = $this->db->get('diasemana');

        return $resultado->result();
    }
    public function telegram()
    {
        $this->db->where('estrategia', 3);
        $this->db->select('*');
        $resultado = $this->db->get('diasemana');

        return $resultado->result();
    }
    public function quotex()
    {
        $this->db->where('estrategia', 4);
        $this->db->select('*');
        $resultado = $this->db->get('diasemana');

        return $resultado->result();
    }
    public function iq()
    {
        $this->db->where('estrategia', 5);
        $this->db->select('*');
        $resultado = $this->db->get('diasemana');

        return $resultado->result();
    }


    public function actualizarDia($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('diasemana', $data);
    }

    public function updEstrategia($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('estrategia', $data);
    }

    public function dia()
    {
        $this->db->select('d.*, e.estrategia as restrategia');
        $this->db->from('diasemana d');
        $this->db->join('estrategia e', 'd.estrategia = e.id');
        $resultado = $this->db->get();

        return $resultado->result();
    }

    public function comisiones()
    {
        $id = $this->session->userdata('ID');

        $sql = "SELECT hc.fecha, hc.servicio, hc.detalle, u.user, hc.valor FROM historial_comisiones hc
    JOIN r_master_usuarios u ON hc.usuario_id = u.id WHERE hc.beneficio_id = ? AND hc.valor != 0";

        $query = $this->db->query($sql, [$id]);

        return $query->result();
    }
}
