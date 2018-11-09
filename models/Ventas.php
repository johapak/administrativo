<?php
require_once('ConnectMaster.php');

class Ventas
{
	
	public function __construct()		
	{
		$this->con = new ConnectMaster();
	}

	public function GenerarVenta()
	{
		try{
		        $query = $this->con->prepare('INSERT INTO ventas (fecha, hora) VALUES (NOW(), NOW());');
		        $query->execute();
		        $this->con->close_con();
		        return $this->con->lastInsertId();      
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		}
	}

	public function AllVentas()
	{
		try{
		        $query = $this->con->prepare('	SELECT ventas.idconfirmacion, cliente.nombre, ventas.cantidad, ventas.total_iva, ventas.sub_total, ventas.total, ventas.fecha
												FROM ventas
												INNER JOIN cliente ON ventas.idcliente = cliente.idcliente
												WHERE ventas.estado = 1;');
		        $query->execute();
		        $this->con->close_con();
		        return $query->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		}
	}

	public function GuardarVenta($iddocumento, $idcliente)
	{
		try{
		        $query = $this->con->prepare('SELECT estado FROM ventas WHERE idventa = ? AND estado = 1;');
		        $query->bindParam(1,$iddocumento);
		        $query->execute();
		        $this->con->close_con();
		        $result = $query->rowCount();
		        if ($result == FALSE) 
		        	{
		        		$query = $this->con->prepare('SELECT idventa FROM ventas WHERE idventa = ?;');
				        $query->bindParam(1,$iddocumento);
				        $query->execute();
				        $this->con->close_con();
				        $result = $query->rowCount();
				        if ($result == TRUE) 
				        	{
				        		unset($result);
				        		$query = $this->con->prepare('SELECT SUM(cantidad), SUM(total_iva), SUM(sub_total), SUM(total) FROM reng_ventas WHERE idventas = ?;');
						        $query->bindParam(1,$iddocumento);
						        $query->execute();
						        $this->con->close_con();
						        $result = $query->fetchAll();

				        		$query = $this->con->prepare('SELECT COUNT(idconfirmacion) FROM ventas WHERE estado = 1;');
						        $query->execute();
						        $this->con->close_con();
						        $contador = $query->fetchAll();
						        $contador[0][0] = $contador[0][0] + 1;

						        $query = $this->con->prepare('UPDATE ventas	SET idconfirmacion= ?, idcliente= ?, cantidad = ?, total_iva= ?, sub_total= ?, total= ?, estado = 1, fecha=NOW(), hora=NOW() WHERE idventa = ? ');
						        $query->bindParam(1,$contador[0][0]);
						        $query->bindParam(2,$idcliente);
						        $query->bindParam(3,$result[0][0]);
						        $query->bindParam(4,$result[0][1]);
						        $query->bindParam(5,$result[0][2]);
						        $query->bindParam(6,$result[0][3]);
						        $query->bindParam(7,$iddocumento);
						        $query->execute();
						        $this->con->close_con();
						        $result = $query->fetchAll();

						        Ventas::CargarStock($iddocumento);
						        return 1;
				        	}
				        else
				        	{

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
		        $query = $this->con->prepare('INSERT INTO reng_ventas (idventas, idarticulo, cantidad, precio, alicuota, total_iva, sub_total, total, fecha, hora)	VALUES (?, ?, ?, ?, ?, ?, ?,  ?, NOW(), NOW())');
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
		        $query = $this->con->prepare('SELECT idarticulo, cantidad FROM reng_ventas WHERE idventas = ?;');
				$query->bindParam(1,$iddocumento);
				$query->execute();
				$this->con->close_con();
				$resultado = $query->fetchAll(); 
				foreach ($resultado as $key) 
					{
						$query = $this->con->prepare('UPDATE articulo SET stock = stock - ?  WHERE idarticulo = ?;');
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