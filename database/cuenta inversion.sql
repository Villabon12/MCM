DELIMITER $$

USE `tiindo_myconnect`$$

DROP TRIGGER /*!50032 IF EXISTS */ `cuenta_inversion`$$

CREATE
    /*!50017 DEFINER = 'leonardo_tiindo'@'%.%.%.%' */
    TRIGGER `cuenta_inversion` BEFORE INSERT ON `reportes_robot` 
    FOR EACH ROW 
BEGIN

INSERT INTO historial_broker(valor) VALUES(new.saldo_inicial);
UPDATE wallet_negocio SET cuenta_inversion = new.saldo_final WHERE token = 'lXPNr7cGdBT3kzOV2qo6Jsg0C';

END;
$$

DELIMITER ;