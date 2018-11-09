<?php

extract($_POST);

if ($nombre != NULL AND $email != NULL AND  $rol != NULL AND $condicion != NULL) 
	{
		require_once('../models/Usuario.php');
		$usuario = new Usuario();

		$nombre = mb_strtoupper($nombre);
		$email = mb_strtoupper($email);

		$resultado = $usuario->UpdateUsuario($idusuario, $nombre, $email, $rol, $condicion);
		var_dump($resultado);

	}
else
	{

	}

?>