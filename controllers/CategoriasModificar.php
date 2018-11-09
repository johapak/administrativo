<?php

extract($_POST);

require_once('../models/Categorias.php');
$categorias = new Categorias();
if ($nombre != NULL AND $descripcion != NULL AND $condicion != NULL) 
	{
		
		if ($categorias->UpdateCategorias($idcategoria, $nombre, $descripcion, $condicion)  == TRUE) 
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