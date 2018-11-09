<?php

extract($_POST);

require_once('../models/Proveedor.php');
$proveedor = new Proveedor();
if ($nombre != NULL AND $tipo != NULL AND $documento != NULL AND $direccion != NULL AND $email != NULL AND $telefono != NULL) 
	{
		
		if ($proveedor->CreateProveedor($nombre, $tipo, $documento, $direccion, $email, $telefono)  == TRUE) 
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