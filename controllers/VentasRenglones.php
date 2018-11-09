<?php
require_once("../models/Ventas.php");

$ventas = new Ventas();

extract($_POST);

if ($type == 1) 
	{
		$result = $ventas->AgregarRenglon($id_documento, $codigo_articulo_modal, $precio_modal, $alicuota_modal, $cantidad_modal, $sub_total_modal, $iva_modal, $total_modal); 
		if ($result== TRUE) 
			{
				echo "<div class='alert alert-success aler-sm'>Articulo agregado correctamente.</div>";
			}
	
	}
elseif ($type == 2) 
	{
		echo "error";
	}

?>



