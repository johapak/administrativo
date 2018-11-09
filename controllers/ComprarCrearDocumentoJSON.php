<?php

require("../models/Compras.php");
$compras= new Compras();

$result = $compras->GenerarCompra();

if ($result == TRUE) 
	{
		echo $result;
	}
else
	{
		echo 0;
	}
	

?>