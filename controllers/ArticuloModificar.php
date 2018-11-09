<?php

extract($_POST);

require_once('../models/Articulo.php');
$articulo = new Articulo();
if ($codigo != NULL AND $nombre != NULL AND $descripcion != NULL AND $categoria != NULL AND $condicion != NULL) 
	{
		
		if ($articulo->CreateArticulo($codigo, $codigo_barras, $nombre, $descripcion, $precio, $impuesto, $categoria, @$imagen, $condicion )  == TRUE) 
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
