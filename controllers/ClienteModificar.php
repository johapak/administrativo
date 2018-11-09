<?php

extract($_POST);

require_once('../models/Clientes.php');
$cliente = new Clientes();
if ($idcliente != NULL AND $nombre != NULL AND $tipo != NULL AND $cedula != NULL) 
	{
		
		if ($cliente->UpdateCliente($idcliente, $nombre, $tipo, $cedula, $telefono, $email, $direccion)  == TRUE) 
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