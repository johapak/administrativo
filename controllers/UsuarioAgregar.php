<?php

extract($_POST);

if ($nombre != NULL AND $email != NULL AND $password_1 != NULL AND $password_2 != NULL AND  $rol != NULL AND $condicion != NULL) 
	{
		require_once('../models/Usuario.php');
		$usuario = new Usuario();

		$nombre = mb_strtoupper($nombre);
		$email = mb_strtoupper($email);

		if ($password_1 == $password_2) 
			{
				$password = utf8_decode($password_1);
				$resultado = $usuario->CreateUsuario($nombre, $email, $password, $rol, $condicion);
				if ($resultado[0]  == TRUE AND $resultado[1]  == TRUE) 
					{
						echo "<div class='alert alert-success'>Datos guardados de manera exitosa.</div>";
						exit;
					}
				elseif ($resultado[0]  == FALSE ) 
					{
						echo "<div class='alert alert-danger'>Usuario ya existe, intenta con otro correo.</div>";
						exit;
					}
				elseif ($resultado[1]  == FALSE) 
					{
						echo "<div class='alert alert-danger'>Error al encriptar contraseña, intentalo nuevamente.</div>";
						exit;
					}
				else
					{
						echo "<div class='alert alert-danger'>".$resultado.".</div>";
						exit;
					}
			}
		else
			{
				echo "<div class='alert alert-danger'>Campos vacios.</div>";
				exit;
			}
	}
else
	{

	}

?>