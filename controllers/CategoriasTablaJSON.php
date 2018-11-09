<?php

extract($_POST);

require_once('../models/Categorias.php');
$categoria = new Categorias();
$resultado = $categoria->AllCategorias();
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