<?php

extract($_POST);

require_once('../models/Clientes.php');
$cliente = new Clientes();
if (@$documento != NULL) 
	{
		$resultado = $cliente->LoadClientesDocumento($documento);
		if ($resultado == TRUE) 
			{	
				
				echo json_encode($resultado[0]);
				exit;
			}
		else
			{
				$resultado["nombre"] = "ERROR";
				$resultado["telefono"] = "ERROR";
				$resultado["email"] = "ERROR";
				echo json_encode($resultado);
				exit;
			}
	}
else
	{
		echo "<div class='alert alert-danger'>Campos vacios.</div>";
		exit;
	}
?>