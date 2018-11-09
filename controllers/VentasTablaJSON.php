<?php

extract($_POST);

require_once('../models/Ventas.php');
$ventas = new Ventas();
$resultado = $ventas->AllVentas();
if ($resultado == TRUE) 
	{	
		echo json_encode($resultado);
		exit;
	}
else
	{
		echo "<div class='alert alert-danger'>Error al eliminar los datos.</div>";
		exit;
	}
?>