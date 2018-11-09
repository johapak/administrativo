<?php

extract($_POST);

require_once('../models/Clientes.php');
$clientes = new Clientes();
$resultado = $clientes->SearchClientes($documento);

	echo json_encode($resultado);
	exit;
	
?>