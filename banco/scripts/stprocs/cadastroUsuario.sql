use listacompras;

CREATE PROCEDURE 
	cadastrarUsuario(
		IN _usuario VARCHAR(200)
		, IN _senha VARCHAR(32)
        , IN _email VARCHAR(200)
        )
insert into
	usuario
set
    usuario = _usuario
    ,senha = _senha
    ,email = _email
    ;