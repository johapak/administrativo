<?php
require_once('ConnectMaster.php');

class Clientes
{
	
	public function __construct()		
	{
		$this->con = new ConnectMaster();
	}

	private function CheckUsedClienteDocumento($idcliente)
	{
		try{
		        $query = $this->con->prepare('SELECT idcliente FROM ventas WHERE idcliente = ?;');
		        $query->bindParam(1, $idcliente);
		        $query->execute();
		        $this->con->close_con();
		        return $query->rowCount();        
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}

	private function CheckClienteByDocumentoYTipo($tipo, $cedula)
	{
		try{
		        $query = $this->con->prepare('SELECT idcliente FROM cliente WHERE tipo = ? AND cedula = ?;');
		        $query->bindParam(1, $tipo);
		        $query->bindParam(2, $cedula);
		        $query->execute();
		        $this->con->close_con();
		        return $query->rowCount();        
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}

	private function CheckClienteByID($idcliente)
	{
		try{
		        $query = $this->con->prepare('SELECT idcliente FROM cliente WHERE idcliente = ?;');
		        $query->bindParam(1, $idcliente);
		        $query->execute();
		        $this->con->close_con();
		        return $query->rowCount();        
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}

	public function AllClientes()
	{

		try{
		        $query = $this->con->prepare('SELECT idcliente, tipo, cedula, nombre, direccion, telefono, email FROM cliente ORDER BY idcliente;');
		        $query->execute();
		        $this->con->close_con();
		        return $query->fetchAll(PDO::FETCH_ASSOC);        
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}

	public function CreateClientes($tipo, $cedula, $nombre, $direccion, $telefono, $email)
	{

		try{
				
			if (Clientes::CheckClienteByDocumentoYTipo($tipo, $cedula)==FALSE) 
				{
					$query = $this->con->prepare('INSERT INTO cliente (tipo, cedula, nombre, direccion, telefono, email) VALUES (?, ?, ?, ?, ?, ?);');
			        $query->bindParam(1,$tipo);
			        $query->bindParam(2,$cedula);
			        $query->bindParam(3,$nombre);
			        $query->bindParam(4,$direccion);
			        $query->bindParam(5,$telefono);
			        $query->bindParam(6,$email);
			        $query->execute();
			        $this->con->close_con();
			        return $query->rowCount(); 
				}
			else
				{
					return FALSE;
				}
		               
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}

	public function LoadClientesDocumento($documento)
	{
		try{
		        $query = $this->con->prepare('SELECT idcliente, tipo, cedula, nombre, telefono, email FROM cliente WHERE cedula = ?;');
		        $query->bindParam(1,$documento);
		        $query->execute();
		        $this->con->close_con();
		        return $query->fetchAll(PDO::FETCH_ASSOC);        
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}

	public function UpdateCliente($idcliente, $nombre, $tipo, $cedula, $telefono, $email, $direccion)
	{
		if (Clientes::CheckClienteByID($idcliente) == TRUE) 
			{
				if (Clientes::CheckUsedClienteDocumento($idcliente) == FALSE) 
					{
						try{
							  	$query = $this->con->prepare("UPDATE cliente SET tipo = ?, cedula = ?, nombre = ?, direccion = ?, telefono = ?, email = ? WHERE idcliente = ?");
						        $query->bindParam(1,$tipo);
						        $query->bindParam(2,$cedula);
						        $query->bindParam(3,$nombre);
						        $query->bindParam(4,$direccion);
						        $query->bindParam(5,$telefono);
						        $query->bindParam(6,$email);
						        $query->bindParam(7,$idcliente);
						        $query->execute();
						        $this->con->close_con();
						        return $query->rowCount(); 
							} catch(PDOException $e) {
		    
		    					echo  $e->getMessage(); 
							}
					}
				else
					{
						return FALSE;
					} 
			}
		else
			{
				return FALSE;
			}          
	}


	public function ModalClientes($idcliente)
	{
		try{
		        $query = $this->con->prepare('SELECT idcliente, tipo, cedula, nombre, telefono, email, direccion FROM cliente WHERE idcliente = ?;');
		        $query->bindParam(1,$idcliente);
		        $query->execute();
		        $this->con->close_con();
		        return $query->fetchAll(PDO::FETCH_ASSOC);        
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}

	public function DeleteCliente($idcliente)
	{
		try{
				if (Clientes::CheckClienteByID($idcliente) == TRUE) 
					{
						if (Clientes::CheckUsedClienteDocumento($idcliente) == FALSE) 
							{
								$query = $this->con->prepare('DELETE FROM cliente WHERE idcliente = ? ;');
						        $query->bindParam(1,$idcliente);
						        $query->execute();
						        $this->con->close_con();
						        return $query->rowCount();
							}
						else
							{
								return FALSE;
							}
					}
				else
					{

					}
		                
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}

	public function SearchClientes($documento)
	{
		try{
		        $query = $this->con->prepare('SELECT cedula, nombre FROM cliente WHERE cedula LIKE ?"%" OR nombre LIKE ?"%";');
		        $query->bindParam(1,$documento);
		        $query->bindParam(2,$documento);
		        $query->execute();
		        $this->con->close_con();
		        return $query->fetchAll(PDO::FETCH_ASSOC);        
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}

}
?>