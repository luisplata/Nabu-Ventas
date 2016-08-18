CREATE PROCEDURE `login` (
_user varchar(45),
_pass varchar(100)
)
/* Descripcion:
Sera el registro de inicio de session del usuario cualquiera.
buscara si esta, y si lo esta guardara en el log el inicio de session y devolera la key del usuario
la key del usuario, cambiara siempre que inicie session, por seguridad
*/

BEGIN
/*zona de variables*/
	declare _empresa_id int ;
	declare _sede_id int ;
	declare _id int ;
    
START TRANSACTION;
	if exists (select 1 from usuario where user LIKE _user and pass like SHA1(_pass)) then
		/*sacamos los datos necesarios*/
		set _empresa_id = (select empresa_id from usuario where user LIKE _user and pass like SHA1(_pass));
		set _sede_id = (select sede_id from usuario where user LIKE _user and pass like SHA1(_pass));
		set _id = (select id from usuario where user LIKE _user and pass like SHA1(_pass));
		/*Significa que si esta. guardamos en el log y buscamos la llave*/
		/*guardamos en log*/
		insert into log (accion, fecha, empresa_id, sede_id, usuario_id) 
		values(
		'Inicio de session',
		now(), 
		_empresa_id,
		_sede_id,
		_id
		);
		/*Cambiamos la llave del usuario*/
		update usuario set llave = sha1(CONCAT(now(),_empresa_id,_sede_id,_id)) where id = _id;
		select llave from usuario where id = _id;
	else
	select 1;
	end if;

COMMIT;
rollback;
END
