<?php


extract($_POST);

if ($iddocumento != NULL AND $idproveedor != NULL) 
	{
		require_once("../models/Compras.php");
		$compras = new Compras();
		$result = $compras->GuardarCompras($iddocumento, $idproveedor, $nro_factura, $nro_control); 
		echo $result;
	}
else
	{
		echo "Campos Vacios";
	}

?>



