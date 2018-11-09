<?php
class ConnectMaster extends PDO
	{
		private $dbh;
		public function __construct()
			{
				try {

					$this->dbh = parent::__construct("mysql:host=localhost;dbname=administrativo;port=3306", "root", "1234");

				} catch(PDOException $e) {
					echo $e->getMessage();
				}
			}

		public function close_con()
			
			{
				$this->dbh = null;
			}
	}
?>