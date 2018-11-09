<?php
switch (@$_GET['funcion']) 
	{
		case 'tabla_articulos':
				require_once('TablaArticulos.php');
			break;

		case 'crear_articulos':
				require_once('CrearArticulos.php');
			break;
		
		default:
			# code...
			break;
	}	
?>