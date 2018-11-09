<?php

extract($_POST);

require_once('../models/Clientes.php');
$cliente = new Clientes();
if ($idcliente != NULL) 
	{
		if ($cliente->DeleteCliente($idcliente)  == TRUE) 
			{
				echo "<div class='alert alert-success'>Datos eliminado de manera exitosa.</div>";
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