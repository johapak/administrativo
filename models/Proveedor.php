<?php
require_once('ConnectMaster.php');

class Proveedor
{
	
	public function __construct()		
	{
		$this->con = new ConnectMaster();
	}

	private function CheckProveedorByRIF($documento)
	{
		try{
		        $query = $this->con->prepare('SELECT num_documento FROM proveedor WHERE num_documento = ?;');
		        $query->bindParam(1,$documento);
		        $query->execute();
		        $this->con->close_con();
		        return $query->rowCount(); 

		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 
		} 
	}

	private function CheckArticuloByID($idarticulo)
	{
		try{
		        $query = $this->con->prepare('SELECT idarticulo FROM articulo WHERE idarticulo = ? ;');
		        $query->bindParam(1,$idarticulo);
		        $query->execute();
		        $this->con->close_con();
		        return $query->rowCount(); 

		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 
		} 
	}

	public function AllProveedor()
	{
		 try{
		        $query = $this->con->prepare('SELECT idproveedor AS id, nombre, tipo_documento AS tipo, num_documento AS doc, direccion, telefono, email FROM proveedor ORDER BY idproveedor;');
		        $query->execute();
		        $this->con->close_con();
		        return $query->fetchAll(PDO::FETCH_ASSOC);       
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}

	public function CreateProveedor($nombre, $tipo, $documento, $direccion, $email, $telefono)
	{
		 try{
		        if (Proveedor::CheckProveedorByRIF($documento) == FALSE) 
		        	{
		        		$query = $this->con->prepare('INSERT INTO proveedor (nombre, tipo_documento, num_documento, direccion, telefono, email) VALUES ( ?, ?, ?, ?, ?, ?);');
				        $query->bindParam(1,$nombre);
				        $query->bindParam(2,$tipo);
				        $query->bindParam(3,$documento);
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

	public function ModalArticulo($codigo)
	{
		 try{
		        $idarticulo = $codigo;
		        if (Articulo::CheckArticuloById($idarticulo) == TRUE) 
		        	{
		        		$query = $this->con->prepare("SELECT idarticulo, nombre, precio, unidad_1, unidad_2, equi_1, equi_2 FROM articulo WHERE idarticulo = ?");
		        		$query->bindParam(1,$codigo);
				        $query->execute();
				        $this->con->close_con();
				        return $query->fetchAll(PDO::FETCH_ASSOC);
		        	}
		               
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}

	public function UpdateProveedor()
	{
		 try{
		        $query = $this->con->prepare('SELECT idcategoria, nombre, descripcion, condicion FROM categoria ORDER BY idcategoria;');
		        $query->execute();
		        $this->con->close_con();
		        return $query->fetchAll(PDO::FETCH_ASSOC);       
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}

	public function DeleteProveedor($idarticulo)
	{
		 try{
		        
		        if (Articulo::CheckArticuloById($idarticulo) == TRUE ) 
		        	{
		        		$query = $this->con->prepare('DELETE FROM articulo WHERE idarticulo = ?;');
		        		$query->bindParam(1,$idarticulo);
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

	public function SearchProveedor($documento)
	{
		 try{
		        $query = $this->con->prepare('SELECT num_documento, nombre FROM proveedor WHERE num_documento LIKE ?"%" OR nombre LIKE ?"%";');
		        $query->bindParam(1,$documento);
		        $query->bindParam(2,$documento);
				$query->execute();
				$this->con->close_con();
				return $query->fetchAll(PDO::FETCH_ASSOC);  
		             
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
		        
	}

	public function LoadProveedorDocumento($documento)
	{
		try{
		        $query = $this->con->prepare('SELECT idproveedor, tipo_documento, num_documento, nombre, telefono, email FROM proveedor WHERE num_documento = ?;');
		        $query->bindParam(1,$documento);
		        $query->execute();
		        $this->con->close_con();
		        return $query->fetchAll(PDO::FETCH_ASSOC);        
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}
}
?>
