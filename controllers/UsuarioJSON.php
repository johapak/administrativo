<?php

extract($_POST);

require_once('../models/Usuario.php');
$usuario = new Usuario();
if (@$idusuario != NULL) 
	{
		$resultado = $usuario->LoadUsuario($idusuario);
		if ($resultado == TRUE) 
			{
				echo json_encode($resultado[0]);
				unset($resultado, $codigo);
				exit;
			}
		else
			{
				echo "<div class='alert alert-danger'>Error al eliminar los datos.</div>";
				exit;
			}
	}
else
	{
		echo "<div class='alert alert-danger'>Campos vacios.</div>";
		exit;
	}
?>