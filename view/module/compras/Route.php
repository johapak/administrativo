<?php
switch (@$_GET['funcion']) 
	{
		case 'ingreso_compras':
				require_once('IngresoCompras.php');
			break;

		case 'tabla_proveedor':
				require_once('TablaProveedor.php');
			break;

		case 'tabla_compras':
				require_once('TablaCompras.php');
			break;
		
		default:
			# code...
			break;
	}	
?>