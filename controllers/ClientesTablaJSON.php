<?php

extract($_POST);

require_once('../models/Clientes.php');
$clientes = new Clientes();
$resultado = $clientes->AllClientes();
if ($resultado == TRUE) 
	{	
	
		echo json_encode($resultado);
			
		exit;
	}
else
	{
		echo 0;
		exit;
		}
?>