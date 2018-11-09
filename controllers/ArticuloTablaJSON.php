<?php

extract($_POST);

require_once('../models/Articulo.php');
$articulo = new Articulo();
$resultado = $articulo->AllArticulo();
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