<?php

extract($_POST);

require_once('../models/Usuario.php');
$usuario = new Usuario();

if (@$idusuario != NULL) 
	{
		$resultados = $usuario->DeleteUsuario($idusuario);
		if ($resultados['execute'] == 1 AND $resultados['comprobar'] == 1) 
			{
				echo 1;
				exit;
			}
		if ($resultados['execute'] == 0 AND $resultados['comprobar'] == 1) 
			{
				echo 2;
				exit;
			}
		elseif ($resultados['comprobar'] == 0) 
			{
				echo 3;
				exit;
			}
		else
			{
				
			}
	}
else
	{
		echo 0;
		exit;
	}
?>