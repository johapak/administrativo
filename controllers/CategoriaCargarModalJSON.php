<?php

extract($_POST);

require_once('../models/Categorias.php');
$categoria = new Categorias();
if (@$idcategoria != NULL) 
	{
		$resultado = $categoria->ModalCategorias($idcategoria);
		if ($resultado == TRUE) 
			{	
				echo json_encode($resultado[0]);
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