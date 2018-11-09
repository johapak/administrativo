<?php
require_once('ConnectMaster.php');

class Articulo
{
	
	public function __construct()		
	{
		$this->con = new ConnectMaster();
	}

	private function CheckArticuloByCode($codigo)
	{
		try{
		        $query = $this->con->prepare('SELECT codigo FROM articulo WHERE codigo = ? ;');
		        $query->bindParam(1,$codigo);
		        $query->execute();
		        $this->con->close_con();
		        return $query->rowCount(); 

		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 
		} 
	}

	private function CheckArticuloById($idarticulo)
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

	public function AllArticulo()
	{
		 try{
		        $query = $this->con->prepare('	SELECT articulo.idarticulo, categoria.nombre AS categoria, articulo.codigo, articulo.nombre, articulo.precio, articulo.stock, articulo.estado
												FROM articulo
												INNER JOIN categoria ON articulo.idcategoria=categoria.idcategoria
												ORDER BY articulo.idarticulo');
		        $query->execute();
		        $this->con->close_con();
		        return $query->fetchAll(PDO::FETCH_ASSOC);       
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}

	public function CreateArticulo($codigo, $nombre, $descripcion, $precio, $impuesto, $categoria, $imagen, $condicion)
	{
		 try{
		        if (Articulo::CheckArticuloByCode($codigo) == FALSE) 
		        	{
		        		$query = $this->con->prepare('INSERT INTO articulo (idcategoria, codigo, nombre, descripcion, precio, impuesto, imagen, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?);');
				        $query->bindParam(1,$categoria);
				        $query->bindParam(2,$codigo);
				        $query->bindParam(3,$nombre);
				        $query->bindParam(4,$descripcion);
				        $query->bindParam(5,$precio);
				        $query->bindParam(6,$impuesto);
				        $query->bindParam(7,$imagen);
				        $query->bindParam(8,$condicion);
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

	public function CargarArticulo($codigo)
	{
		 try{
		        $idarticulo = $codigo;
		        if (Articulo::CheckArticuloById($idarticulo) == TRUE) 
		        	{
		        		$query = $this->con->prepare("	SELECT articulo.idarticulo, categoria.nombre AS idcategoria, articulo.codigo, articulo.nombre, articulo.descripcion, articulo.precio, articulo.impuesto, articulo.estado
														FROM articulo
														INNER JOIN categoria ON articulo.idcategoria = categoria.idcategoria
														WHERE articulo.idarticulo =?");
		        		$query->bindParam(1,$codigo);
				        $query->execute();
				        $this->con->close_con();
				        return $query->fetchAll(PDO::FETCH_ASSOC);
		        	}
		               
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}

	public function UpdateCategorias()
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

	public function DeleteArticulo($idarticulo)
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

	public function SearchArticulo($codigo)
	{
		try{
		        $query = $this->con->prepare('SELECT codigo, nombre FROM articulo WHERE codigo LIKE ?"%" OR nombre LIKE ?"%";');
		        $query->bindParam(1,$codigo);
		        $query->bindParam(2,$codigo);
				$query->execute();
				$this->con->close_con();
				return $query->fetchAll(PDO::FETCH_ASSOC);  
		             
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}
}
?>