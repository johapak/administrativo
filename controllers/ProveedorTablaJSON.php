<?php

extract($_POST);

require_once('../models/Proveedor.php');
$proveedor = new Proveedor();
$resultado = $proveedor->AllProveedor();
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