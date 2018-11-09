<?php


extract($_POST);

if ($iddocumento != NULL AND $idcliente != NULL) 
	{
		require_once("../models/Ventas.php");
		$ventas = new Ventas();
		$result = $ventas->GuardarVenta($iddocumento, $idcliente); 
		echo $result;
	}
else
	{
		echo "Campos Vacios";
	}

?>



