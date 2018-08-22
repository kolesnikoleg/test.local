<?php
require_once 'config_class.php';
class DataBase {
		private $config;
		private $mysqli;
		private $valid;
		
		public function __construct () {
			$this->config = new Config;
			$this->mysqli = new mysqli ($this->config->host, $this->config->user, $this->config->password, $this->config->db);
			$this->mysqli->query("SET NAMES 'utf8'");
		}
		
		private function query ($query) {
			return $this->mysqli->query($query);	
		}





		public function isNoExistUser( $login )
		{
			$sql = "SELECT login FROM `users` WHERE login = '" . $login . "'";

			$result_set = $this->query( $sql );

			if ( $result_set->num_rows === 0 ) {
				return true;
			} else {
				return false;
			}
		}

		public function regNewUser( $login, $password )
		{



			$sql = "INSERT INTO `users` (`login`, `password`) VALUES ('" . $login . "', '" . $password . "')";

			$result_set = $this->query( $sql );

			if ( !$result_set ) {
				return false;
			} else {
				return true;
			}
		}

        		
		
		public function __destruct () {
			if ($this->mysqli) $this->mysqli->close ();	
		}
	
}

session_start ();