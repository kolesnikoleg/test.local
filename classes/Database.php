<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/autoload.php';
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


	public function select ($table_name, $fields, $where = '', $order = '', $up = true, $limit_1 = '', $limit_2 = '') {
		$sql = 'SELECT ';

		if (!is_array ($fields))
		{
			$sql .= $fields.' ';	
		}
		else
		{
			$fields_str = '';
			foreach ($fields as $value) 
			{
				$fields_str .= $value.',';	
			}
			$fields_str = substr($fields_str, 0, -1).' ';
			$sql .= $fields_str;
		}

		$sql .= 'FROM '.$table_name.' ';

		if ($where)
		{
			$sql .= 'WHERE '.$where.' ';	
		}

		if ($order)
		{
			$sql .= 'ORDER BY '.$order.' ';	

			if ($up)
			{
				$sql .= 'DESC ';		
			}
		}

		if (($limit_1 != '' AND $limit_1 !== false) OR $limit_1 === 0) 
		{
			if (($limit_2 != '' AND $limit_2 !== false) OR $limit_2 === 0)
			{
				$sql .= 'LIMIT '.$limit_1.', '.$limit_2;	
			}
			else
			{
				$sql .= 'LIMIT '.$limit_1;	
			}
		}

		$result_set = $this->query($sql);
		if (!$result_set) return false;
		$i = 0;
		while ($row = $result_set->fetch_assoc ()) {
			$data[$i] = $row;
			$i++;	
		}
		$result_set->close ();
		if (count ($data) > 0)
		{
			return $data;
		}
		else
		{
			return false;	
		}
	}

	public function update ($table_name, $upd_fields, $where) {
		$query = 'UPDATE '.$table_name.' SET ';	
		foreach ($upd_fields as $field => $value) {
			$query .= '`'.$field.'` = \''.addslashes ($value).'\',';
		}
		$query = substr ($query, 0, -1);
		if ($where) {
			$query .= ' WHERE '.$where;
			return $this->query($query);	
		}
		else
		{
			return false;	
		}
	}

	public function insert ($table_name, $new_values) {
		$query = 'INSERT INTO '.$table_name.' (';
		foreach ($new_values as $field => $value) {
			$query .= '`'.$field.'`,';
		}
		$query = substr ($query, 0, -1);
		$query .= ') VALUES (';
		foreach ($new_values as $value) {
			$query .= '\''.addslashes ($value).'\',';
		}
		$query = substr ($query, 0, -1);
		$query .= ')';

		return $this->query($query);
	}

	public function delete ($table_name, $where = '') {
		if ($where) {
			$query = 'DELETE FROM '.$table_name.' WHERE '.$where;
			return $this->query($query);
		}
		else
		{
			return false;	
		}
	}

	public function __destruct () {
		if ($this->mysqli) $this->mysqli->close ();	
	}
	
}

