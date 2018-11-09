<?php

extract($_POST);

require_once('../models/Articulo.php');
$articulo = new Articulo();
if ($idarticulo != NULL) 
	{
		if ($articulo->DeleteArticulo($idarticulo)  == TRUE) 
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