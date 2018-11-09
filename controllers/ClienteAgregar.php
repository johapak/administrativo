<?php

extract($_POST);

require_once('../models/Clientes.php');
$clientes = new Clientes();
if ($nombre != NULL AND $tipo != NULL AND $cedula != NULL ) 
	{
		$result = $clientes->CreateClientes($tipo, $cedula, $nombre, $direccion, $telefono, $email);
		if ($result == 1) 
			{
				echo "<div class='alert alert-success'>Datos guardados de manera exitosa.</div>";
				exit;
			}
		else
			{
				echo "<div class='alert alert-danger'>Error al guardar los datos.</div>";
				exit;
			}
	}
else
	{
		echo "<div class='alert alert-danger'>Campos vacios.</div>";
		exit;
	}
?>
