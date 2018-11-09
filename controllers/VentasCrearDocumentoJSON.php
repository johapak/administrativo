<?php

require("../models/Ventas.php");
$ventas= new Ventas();

$result = $ventas->GenerarVenta();

if ($result == TRUE) 
	{
		echo $result;
	}
else
	{
		echo 0;
	}
	

?>