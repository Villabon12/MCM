DELIMITER $$

USE `tiindo_myconnect`$$

DROP TRIGGER /*!50032 IF EXISTS */ `tabla_profit`$$

CREATE
    /*!50017 DEFINER = 'leonardo_tiindo'@'%.%.%.%' */
    TRIGGER `tabla_profit` BEFORE INSERT ON `reportes_robot` 
    FOR EACH ROW 
BEGIN
DECLARE inversionT FLOAT;

SELECT SUM(r_inversion_robot.inversion) INTO inversionT FROM r_inversion_robot WHERE r_inversion_robot.consignado=1;

INSERT INTO hisotrial_broker_mcm(valor) VALUES (inversionT);
  CALL repartir_dinero((new.saldo_final-new.saldo_inicial),new.saldo_inicial,new.porcentaje_apostado,new.porcentajeregistrado);

  INSERT INTO resultado_inversion_b(saldo_entra, saldo_sale, ganancia, mercado,senal,saldo_inicial,saldo_final) VALUES(new.precio_entrada,new.precio_salida,(new.saldo_final-new.saldo_inicial),new.mercado,new.señal,new.saldo_inicial,new.saldo_final);

END;
$$

DELIMITER ;