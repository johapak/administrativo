<?php

extract($_POST);

require_once('../models/Clientes.php');
$cliente = new Clientes();
if (@$idcliente != NULL) 
	{
		$resultado = $cliente->ModalClientes($idcliente);
		if ($resultado == TRUE) 
			{	
				echo json_encode($resultado[0]);
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