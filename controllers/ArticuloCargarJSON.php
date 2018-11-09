<?php

extract($_POST);

require_once('../models/Articulo.php');
$articulo = new Articulo();
if (@$codigo != NULL) 
	{
		$resultado = $articulo->CargarArticulo($codigo);
		if ($resultado == TRUE) 
			{	
				echo json_encode($resultado[0]);
				exit;
			}
		else
			{
				
				exit;
			}
	}
else
	{
		echo "<div class='alert alert-danger'>Campos vacios.</div>";
		exit;
	}
?>