<?php

extract($_POST);

if ($email != NULL AND $password != NULL) 
	{
		require_once('../models/Usuario.php');
		$usuario = new Usuario();
		
		$email = mb_strtoupper($email);
		$password = utf8_decode($password);
		$resultado = $usuario->LoginUsuario($email, $password);
		if ($resultado[0] == TRUE AND $resultado[1] == TRUE AND $resultado[2] == TRUE ) 
			{
				echo 1;
				exit;
			}
		else
			{
				echo "<div class='alert alert-danger'>Usuario no existe contarseña es incorrecta.</div>";
				exit;
			}
	}
else
	{
		echo "<div class='alert alert-danger'>Campos vacios.</div>";
		exit;
	}
?>