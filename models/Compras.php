<?php
require_once('ConnectMaster.php');

class Compras
{
	
	public function __construct()		
	{
		$this->con = new ConnectMaster();
	}

	public function GenerarCompra()
	{
		try{
		        $query = $this->con->prepare('INSERT INTO compras (fecha, hora)	VALUES (NOW(), NOW());');
		        $query->execute();
		        $this->con->close_con();
		        return $this->con->lastInsertId();      
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		}
	}

	public function AllCompras()
	{
		try{
		        $query = $this->con->prepare("	SELECT compras.idconfirmacion, proveedor.nombre, compras.nro_factura, compras.nro_control, compras.cantidad, compras.total_iva, compras.sub_total, compras.total, compras.fecha
												FROM compras
												INNER JOIN proveedor ON compras.idproveedor = proveedor.idproveedor
												WHERE compras.estado = 1;");
		        $query->execute();
		        $this->con->close_con();
		        return $query->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		}
	}

	public function GuardarCompras($iddocumento, $idproveedor, $nro_factura, $nro_control)
	{
		try{
		        $query = $this->con->prepare('SELECT estado FROM compras WHERE idcompras = ? AND estado = 1;');
		        $query->bindParam(1,$iddocumento);
		        $query->execute();
		        $this->con->close_con();
		        $result = $query->rowCount();
		        if ($result == FALSE) 
		        	{
		        		$query = $this->con->prepare('SELECT idcompras FROM compras WHERE idcompras = ?;');
				        $query->bindParam(1,$iddocumento);
				        $query->execute();
				        $this->con->close_con();
				        $result = $query->rowCount();
				        if ($result == TRUE) 
				        	{
				        		unset($result);
				        		$query = $this->con->prepare('SELECT SUM(cantidad), SUM(total_iva), SUM(sub_total), SUM(total) FROM reng_compras WHERE idcompras = ?;');
						        $query->bindParam(1,$iddocumento);
						        $query->execute();
						        $this->con->close_con();
						        $result = $query->fetchAll();

				        		$query = $this->con->prepare('SELECT COUNT(idconfirmacion) FROM compras WHERE estado = 1;');
						        $query->execute();
						        $this->con->close_con();
						        $contador = $query->fetchAll();
						        $contador[0][0] = $contador[0][0] + 1;

						        $query = $this->con->prepare('UPDATE compras SET idconfirmacion= ?, idproveedor= ?, cantidad = ?, total_iva= ?, sub_total= ?, total= ?, estado = 1,  nro_factura = ?, nro_control = ?, fecha=NOW(), hora=NOW() WHERE idcompras = ? ');
						        $query->bindParam(1,$contador[0][0]);
						        $query->bindParam(2,$idproveedor);
						        $query->bindParam(3,$result[0][0]);
						        $query->bindParam(4,$result[0][1]);
						        $query->bindParam(5,$result[0][2]);
						        $query->bindParam(6,$result[0][3]);
						        $query->bindParam(7,$nro_factura);
						        $query->bindParam(8,$nro_control);
						       	$query->bindParam(9,$iddocumento);
						        $query->execute();
						        $this->con->close_con();
						        $query->rowCount();

						        Compras::CargarStock($iddocumento);
						        return 1;
				        	}
				        else
				        	{
				        		return 2;
				        	}
		        	}
		        else
		        	{
		        		
		        		return 9;
		        	}
		        
		            
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		}
	}
	
	public function AgregarRenglon($id_documento, $codigo_articulo_modal, $precio_modal, $alicuota_modal, $cantidad_modal, $sub_total_modal, $iva_modal, $total_modal)
	{
		try{
		        $query = $this->con->prepare('INSERT INTO reng_compras (idcompras, idarticulo, cantidad, precio, alicuota, total_iva, sub_total, total, fecha, hora) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())');
		        $query->bindParam(1,$id_documento);
		        $query->bindParam(2,$codigo_articulo_modal);
		        $query->bindParam(3,$cantidad_modal);
		        $query->bindParam(4,$precio_modal);
		        $query->bindParam(5,$alicuota_modal);
		        $query->bindParam(6,$iva_modal);
		        $query->bindParam(7,$sub_total_modal);
		        $query->bindParam(8,$total_modal);
		        $query->execute();
		        $this->con->close_con();
		        return $query->rowCount();        
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}

	private function CargarStock($iddocumento)
	{
		try{
		        $query = $this->con->prepare('SELECT idarticulo, cantidad FROM reng_compras WHERE idcompras = ?;');
				$query->bindParam(1,$iddocumento);
				$query->execute();
				$this->con->close_con();
				$resultado = $query->fetchAll(); 
				foreach ($resultado as $key) 
					{
						$query = $this->con->prepare('UPDATE articulo SET stock = stock + ?  WHERE idarticulo = ?;');
						$query->bindParam(1,$key[1]);
						$query->bindParam(2,$key[0]);
						$query->execute();
						$this->con->close_con();
					}

		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}
}
?>