<?php

extract($_POST);

require_once('../models/Categorias.php');
$categorias = new Categorias();
if ($idcategoria != NULL) 
	{
		if ($categorias->DeleteCategorias($idcategoria)  == TRUE) 
			{
				echo 1;
				exit;
			}
		else
			{
				echo 2;
				exit;
			}
	}
else
	{
		echo 3;
		exit;
	}
?>