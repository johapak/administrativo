<?php
require_once('ConnectMaster.php');

class Usuario
{
	
	public function __construct()		
	{
		$this->con = new ConnectMaster();
	}

	private function CheckUsuarioByEmail($email)
	{
		try{
		        $query = $this->con->prepare('SELECT email FROM usuario WHERE email = ? ;');
		        $query->bindParam(1,$email);
		        $query->execute();
		        $this->con->close_con();  
		        if ($query->rowCount() == TRUE) 
		        	{
		        		return TRUE;
		        	}
		        else
		        	{
		        		return FALSE;
		        	}

		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 
		} 
	}

	private function CheckUsuarioById($idusuario)
	{
		try{
		        $query = $this->con->prepare('SELECT id FROM usuario WHERE id = ? ;');
		        $query->bindParam(1,$idusuario);
		        $query->execute();
		        $this->con->close_con();  
		        if ($query->rowCount() == TRUE) 
		        	{
		        		return TRUE;
		        	}
		        else
		        	{
		        		return FALSE;
		        	}

		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 
		} 
	}

	private function EncriptarPassword($password)
	{
		try{
		        return $password_encrypted = sha1(md5($password));

		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 
		} 
	}

	private function CargarSesion($email)
	{
		try{
		        return TRUE;

		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 
		} 
	}

	public function AllUsuario()
	{
		 try{
		        $query = $this->con->prepare('SELECT id, nombres, email, rol, condicion, fecha_creado FROM usuario ORDER BY id;');
		        $query->execute();
		        $this->con->close_con();
		        return $query->fetchAll(PDO::FETCH_ASSOC);       
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}

	public function CreateUsuario($nombre, $email, $password, $rol, $condicion)
	{
		 try{
		        if (Usuario::CheckUsuarioByEmail($email) == FALSE) 
		        	{
		        		$password = Usuario::EncriptarPassword($password);
		        		$query = $this->con->prepare('INSERT INTO usuario (nombres, email, password, rol, condicion, fecha_creado) VALUES (?, ?, ?, ?, ?, NOW());');
				        $query->bindParam(1,$nombre);
				        $query->bindParam(2,$email);
				        $query->bindParam(3,$password);
				        $query->bindParam(4,$rol);
				        $query->bindParam(5,$condicion);
				        $query->execute();
				        $this->con->close_con();
				        if ($query->rowCount() == TRUE) 
				        	{
				        		@$resultado[1] = 1; 
				        		@$resultado[0] = 1;
				        	}
				        else
				        	{
				        		@$resultado[1] = 0; 
				        		@$resultado[0] = 0;
				        	}  
		        	}
		        else
			        {
			        	@$resultado[0] = 0;
			        	@$resultado[1] = 0; 
			        }

			    return $resultado;
		             
		} catch(PDOException $e) {
		    
		    return $e->getMessage();

		} 
	}

	public function LoadUsuario($idusuario)
	{
		 try{
		        if (Usuario::CheckUsuarioById($idusuario) == TRUE ) 
		        	{
		        		$query = $this->con->prepare('SELECT id, nombres, email, rol, condicion, fecha_creado FROM usuario WHERE id = ?;');
		        		$query->bindparam(1,$idusuario);
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

	public function UpdateUsuario($idusuario, $nombre, $email, $rol, $condicion)
	{
		 try{
		        if (Usuario::CheckUsuarioById($idusuario) == TRUE ) 
		        	{
		        		$query = $this->con->prepare('UPDATE usuario SET nombres = ?, email= ?, rol= ?, condicion= ? WHERE id = ?;');
				        $query->bindParam(1,$nombre);
				        $query->bindParam(2,$email);
				        $query->bindParam(3,$rol);
				        $query->bindParam(4,$condicion);
				        $query->bindParam(5,$idusuario);
				        $query->execute();
				        $this->con->close_con();
				        return $query->rowCount();  
				        echo 1;  
		        	}
		        else
			        {
			        	return FALSE;
			        } 
		               
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
	}

	public function DeleteUsuario($idusuario)
	{
		 try{
		        if (Usuario::CheckUsuarioById($idusuario) == TRUE ) 
		        	{
		        		$resultados['comprobar'] = 1;
		        		$query = $this->con->prepare('DELETE FROM usuario WHERE id = ?;');
		        		$query->bindParam(1,$idusuario);
				        $query->execute();
				        $this->con->close_con();
				        if ($query->rowCount() == TRUE) 
				        	{
				         		$resultados['execute'] = 1;
				         	} 
				        else
				        	{
				        		$resultados['execute'] = 0;
				        	}
		        	}
		        else
			        {
			        	$resultados['execute'] = 0;
			        	$resultados['comprobar'] = 0;
			        }
			        
			    return $resultados;
		             
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage(); 

		} 
		        
	}

	public function LoginUsuario($email, $password)
	{
		 try{
		        if (Usuario::CheckUsuarioByEmail($email) == TRUE) 
		        	{
		        		$password = Usuario::EncriptarPassword($password);
		        		$query = $this->con->prepare('SELECT nombres, email FROM usuario WHERE email = ? AND password = ?;');
				        $query->bindParam(1,$email);
				        $query->bindParam(2,$password);
				        $query->execute();
				        $this->con->close_con();
				        if ($query->rowCount() == TRUE) 
				        	{
				        		if (Usuario::CargarSesion($email) == TRUE) 
		        					{
		        						$resultado[0] = 1;
		        						$resultado[1] = 1;
		        						$resultado[2] = 1; 
		        					} 
		        				else
		        					{
		        						$resultado[0] = 0;
		        						$resultado[1] = 0;
		        						$resultado[2] = 0; 
		        					}
				        	}
				        else
				        	{
				        		$resultado[0] = 0;
		        				$resultado[1] = 0;
		        				$resultado[2] = 0;
				        	}
		        	}
		        else
			        {
			        	$resultado[0] = 0;
		        		$resultado[1] = 0;
		        		$resultado[2] = 0;
			        }

			    return $resultado;
		             
		} catch(PDOException $e) {
		    
		    echo  $e->getMessage();

		} 
	}
}
?>