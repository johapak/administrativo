<?php
switch (@$_GET['funcion']) 
	{
		case 'tabla_usuario':
				require_once('TablaUsuario.php');
			break;

		case 'crear_usuario':
				require_once('CrearUsuario.php');
			break;
		
		default:
			# code...
			break;
	}	
?>