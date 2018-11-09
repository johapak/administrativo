<?php
require_once('ConnectMaster.php');
class Categorias
{
	
	public function __construct()		
	{
		$this->con = new ConnectMaster();
	}

	private function CheckCategorias($idcategoria)
	{
		try{
		        $query = $this->con->prepare('SELECT idcategoria FROM categoria WHERE idcategoria = ? ;');
		        $query->bindParam(1,$idcategoria);
		        $query->execute();
		        $this->con->close_con();
		        return $query->rowCount(); 

		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 
		} 
	}

	private function CheckUsoEnArticulo($idcategoria)
	{
		try{
		        $query = $this->con->prepare('SELECT idcategoria FROM articulo WHERE idcategoria = ? ;');
		        $query->bindParam(1,$idcategoria);
		        $query->execute();
		        $this->con->close_con();
		        return $query->rowCount(); 

		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 
		} 
	}

	public function AllCategorias()
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

	public function CreateCategorias($nombre, $descripcion, $condicion)
	{
		 try{
		        $query = $this->con->prepare('INSERT INTO categoria (nombre, descripcion, condicion) VALUES ( ?, ?, ?);');
		        $query->bindParam(1,$nombre);
		        $query->bindParam(2,$descripcion);
		        $query->bindParam(3,$condicion);
		        $query->execute();
		        $this->con->close_con();
		        return $query->rowCount();       
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage();

		} 
	}

	public function ModalCategorias($idcategoria)
	{
		 try{
		       	if (Categorias::CheckCategorias($idcategoria) == TRUE) 
		       		{
		       			$query = $this->con->prepare('SELECT idcategoria, nombre, descripcion, condicion FROM categoria WHERE idcategoria = ?  ;');
		       			$query->bindParam(1,$idcategoria);
				        $query->execute();
				        $this->con->close_con();
				        return $query->fetchAll(PDO::FETCH_ASSOC); 
		       		}
		       	else
		       		{
		       			return FALSE;
		       		}
		              
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}

	public function UpdateCategorias($idcategoria, $nombre, $descripcion, $condicion)
	{
		 try{
		        if (Categorias::CheckCategorias($idcategoria)) 
		        	{
		        		$query = $this->con->prepare('UPDATE categoria SET nombre = ?, descripcion = ?, condicion = ? WHERE idcategoria = ?;');
				        $query->bindParam(1, $nombre);
				        $query->bindParam(2, $descripcion);
				        $query->bindParam(3, $condicion);
				        $query->bindParam(4, $idcategoria);
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

	public function DeleteCategorias($idcategoria)
	{
		 try{
		        if (Categorias::CheckCategorias($idcategoria) == TRUE ) 
		        	{
		        		if (Categorias::CheckUsoEnArticulo($idcategoria) == FALSE) 
		        			{
		        				$query = $this->con->prepare('DELETE FROM categoria WHERE idcategoria = ?;');
				        		$query->bindParam(1,$idcategoria);
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
			        	return FALSE;
			        }
		             
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
		        
	}
}
?>