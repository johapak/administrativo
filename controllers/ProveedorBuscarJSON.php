<?php

extract($_POST);

require_once('../models/Proveedor.php');
$proveedor = new Proveedor();
$resultado = $proveedor->SearchProveedor($documento);

	echo json_encode($resultado);
	exit;
	
?>