<?php

extract($_POST);

require_once('../models/Compras.php');
$compras = new Compras();
$resultado = $compras->AllCompras();
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