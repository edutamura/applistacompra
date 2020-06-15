CREATE PROCEDURE 
    loginUsuario(IN _usuario VARCHAR(200), IN _senha VARCHAR(32))
select
	usuario
from
	usuario
where
	usuario = _usuario