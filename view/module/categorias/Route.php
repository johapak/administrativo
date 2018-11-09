<?php
switch (@$_GET['funcion']) 
	{
		case 'tabla_categorias':
				require_once('TablaCategorias.php');
			break;

		case 'crear_categorias':
				require_once('CrearCategorias.php');
			break;
		
		default:
			# code...
			break;
	}	
?>