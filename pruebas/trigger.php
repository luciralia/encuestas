CREATE OR REPLACE FUNCTION respuestalter() RETURNS TRIGGER AS $$
    BEGIN
     
        IF (TG_OP = 'DELETE') THEN
            DELETE FROM respuesta WHERE id_respuesta = OLD.id_respuesta;
            IF NOT FOUND THEN RETURN NULL; END IF;

            OLD.last_updated = now();
            INSERT INTO enc_audit VALUES('D', user, OLD.*);
            RETURN OLD;
            
            ELSIF (TG_OP = 'UPDATE') THEN
            UPDATE respuesta SET resp_abierta = NEW.resp_abierta WHERE id_respuesta = OLD.id_respuesta;
            IF NOT FOUND THEN RETURN NULL; END IF;

            NEW.last_updated = now();
            INSERT INTO enc_audit VALUES('U', user, NEW.*);
            RETURN NEW;
        ELSIF (TG_OP = 'INSERT') THEN
            INSERT INTO respuesta VALUES(NEW.id_respuesta, NEW.resp_abierta);

            NEW.last_updated = now();
            INSERT INTO enc_audit VALUES('I', user, NEW.*);
            RETURN NEW;
        END IF;
    END;
$$ LANGUAGE plpgsql;


    
CREATE TRIGGER enc_auditoria
BEFORE INSERT OR UPDATE OF resp_abierta ON "respuesta"
FOR each ROW
EXECUTE PROCEDURE respuestalter();