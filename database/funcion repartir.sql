DELIMITER $$

USE `tiindo_myconnect`$$

DROP PROCEDURE IF EXISTS `repartir_dinero`$$

CREATE DEFINER=`leonardo_tiindo`@`%.%.%.%` PROCEDURE `repartir_dinero`(IN ganancia FLOAT, IN saldo FLOAT, IN porcentaje_apostado VARCHAR(45), IN porcentaje_registrado FLOAT)
BEGIN
   DECLARE montoInversion FLOAT;
   DECLARE contar INT;
   DECLARE nInversion INT;
   DECLARE finalizado INT DEFAULT FALSE;
   DECLARE valorMul FLOAT;
   DECLARE division FLOAT;
   DECLARE confirmar INT;
   DECLARE calcular FLOAT;
   DECLARE porc FLOAT;
   DECLARE listadoRepartir CURSOR FOR SELECT r_inversion_robot.id, r_inversion_robot.inversion FROM r_inversion_robot WHERE r_inversion_robot.consignado=1;
   DECLARE CONTINUE HANDLER FOR NOT FOUND SET finalizado = TRUE;
   

   SELECT POSITION('%' IN porcentaje_apostado) INTO confirmar;
   SELECT COUNT(*) INTO contar FROM r_inversion_robot WHERE r_inversion_robot.consignado=1;
   SELECT parametros_general.valor INTO division FROM parametros_general WHERE id = 14;
   
   OPEN listadoRepartir;

   recorriendoLista: LOOP
      FETCH listadoRepartir INTO nInversion, montoInversion;
      IF contar > 0 THEN
         IF ganancia = 0 THEN
           LEAVE recorriendoLista;
         END IF;

         IF ganancia > 0 THEN
            IF confirmar > 0 THEN
		SELECT TRIM(BOTH '%' FROM porcentaje_apostado/100) INTO valorMul;
		INSERT INTO historial_inversion(usuario_id, valor_antiguo, ganancia, porcentaje, porcentaje_apostar,tipo,robot) VALUES(nInversion,montoInversion, (((montoInversion*valorMul)*(porcentaje_registrado/100))*division), valorMul, porcentaje_registrado, 'ganancia','binarias');
                UPDATE r_inversion_robot SET r_inversion_robot.inversion = (((montoInversion*valorMul)*(porcentaje_registrado/100))*division)+montoInversion WHERE r_inversion_robot.id = nInversion AND r_inversion_robot.consignado=1;
                SET contar = contar-1;
                
	    ELSE
		SELECT TRIM(BOTH '$' FROM porcentaje_apostado) INTO valorMul;
		SET porc = valorMul/saldo;
		INSERT INTO historial_inversion(usuario_id, valor_antiguo, ganancia, porcentaje, porcentaje_apostar,tipo,robot) VALUES(nInversion,montoInversion, (((montoInversion*porc)*(porcentaje_registrado/100))*division), porc, porcentaje_registrado,'ganancia','binarias');
                UPDATE r_inversion_robot SET r_inversion_robot.inversion = (((montoInversion*porc)*(porcentaje_registrado/100))*division)+montoInversion WHERE r_inversion_robot.id = nInversion AND r_inversion_robot.consignado=1;
                SET contar = contar-1;
	    END IF;
            
            IF contar = 0 THEN 
              LEAVE recorriendoLista;
            END IF;
         ELSE
            IF confirmar > 0 THEN
		SELECT TRIM(BOTH '%' FROM porcentaje_apostado/100) INTO valorMul;
		SET calcular = (montoInversion*valorMul);
		INSERT INTO historial_inversion(usuario_id, valor_antiguo, ganancia, porcentaje, porcentaje_apostar, tipo,robot) VALUES(nInversion,montoInversion, ((montoInversion*valorMul)*(porcentaje_registrado/100)), valorMul, porcentaje_registrado,'perdida','binarias');
                UPDATE r_inversion_robot SET r_inversion_robot.inversion = montoInversion-calcular WHERE r_inversion_robot.id = nInversion AND r_inversion_robot.consignado=1;
                SET contar = contar-1;
	    ELSE
		SELECT TRIM(BOTH '$' FROM porcentaje_apostado)INTO valorMul;
		SET porc = valorMul/saldo;
		SET calcular = (montoInversion*porc);
		INSERT INTO historial_inversion(usuario_id, valor_antiguo, ganancia, porcentaje, porcentaje_apostar, tipo,robot) VALUES(nInversion,montoInversion, ((montoInversion*porc)*(porcentaje_registrado/100)), porc, porcentaje_registrado,'perdida','binarias');
                UPDATE r_inversion_robot SET r_inversion_robot.inversion = montoInversion-calcular WHERE r_inversion_robot.id = nInversion AND r_inversion_robot.consignado=1;
                SET contar = contar-1;
	    END IF;
            IF contar = 0 THEN 
              LEAVE recorriendoLista;
            END IF;
         END IF;
      ELSE 
         LEAVE recorriendoLista;
      END IF;
   END LOOP;
END$$

DELIMITER ;