create database colegiomedicos;
use colegiomedicos;

CREATE TABLE usuarios (id_usuario INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nombre_usuario text, apellido_usuario text, email_usuario text, password_usuario text, 
    tel_usuario text, cel_usuario text, cedula_usuario text, titulo_usuario text, nacimiento_usuario text, 
    estatus_usuario integer, isAdmin integer, fecha_registro text, fecha_actualizacion text, avatar_usuario text);
    
select * from usuarios;
UPDATE usuarios SET nombre_usuario = %s, apellido_usuario = %s, email_usuario = %s, tel_usuario = %s, cedula_usuario = %s, titulo_usuario = %s, nacimiento_usuario = %s WHERE id_usuario = %s;