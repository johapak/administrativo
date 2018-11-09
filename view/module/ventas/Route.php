<?php
switch (@$_GET['funcion']) 
	{
		case 'tabla_ventas':
				require_once('TablaVentas.php');
			break;

		case 'crear_venta':
				require_once('CrearVentas.php');
			break;

		case 'tabla_clientes':
				require_once('TablaClientes.php');
			break;
		
		default:
			# code...
			break;
	}	
?>