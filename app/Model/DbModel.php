<?php 
class Db{
	private $selectDriver = null;
	private $driver = null;
	private $host = null;
	private $dbName =null;
	private $user = null;
	private $pass = null;

	
	public function __construct($selectDriver, $host, $dbName, $user, $pass)
	{
		$this->selectDriver = $selectDriver;
		$this->dbName = $dbName;
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
	}
	public function init(){
		if ( $this->selectDriver === 'PDO'){
			$this->driver = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName.';charset=utf8', $this->user, $this->pass);
		}
	}
	public function select($column, $table, $cond=""){
		$column = strip_tags($column);
		$table = strip_tags($table);
		if (preg_match('/[£$*()}{#~?¬]/', $cond)){
			return false;
		}

		if ( $this->selectDriver === 'PDO'){
			$query ="SELECT $column FROM $table $cond ";
			
			$result = $this->driver->query($query);
			if($result !== false){
				$result = $result->fetchAll();
			}
			return $result;
			
		}
	}
	public function insert($table, $column, $values, $cond="", $strict=true){
		if($strict){
			for ($i=0; $i <count($values) ; $i++) { 
				$values[$i] = strip_tags($values[$i]);
			}
			
		}

		$table = strip_tags($table);
		$column = preg_replace('/\s+/', '', strip_tags($column));
		$bind = explode(',', $column);
		


		if ( $this->selectDriver === 'PDO'){
			$bindy ="";
			for($i=0; $i<count($bind); $i++){
				if($i== count($bind)-1){
					$bindy .= ':'.$bind[$i];
					break;
				}
				$bindy .= ':'.$bind[$i].', ';
			}
			$query ="INSERT INTO $table ($column) VALUES ($bindy) $cond";
			$stmt = $this->driver->prepare($query);
			for($i=0; $i<count($bind); $i++){
				$values[$i] = addslashes(trim($values[$i]));
				$stmt->bindParam(':'.$bind[$i], $values[$i]);
			}
			$stmt->execute();
			return $this->driver->lastInsertId();	
		}
	}
	public function update($table, $column, $value, $cond=""){
		$column = strip_tags($column);
		$table = strip_tags($table);
		$column = explode(',', $column);
		;
		$bindy="";
		if (preg_match('/[£$*()}{#~?¬]/', $cond)){
			return false;
		}
		if ( $this->selectDriver === 'PDO'){
			
			for($i=0; $i<count($value); $i++){
				$value[$i] = addslashes(trim($value[$i]));
				$column[$i] = trim($column[$i]);
				if($i == count($value)-1){
					$bindy .= $column[$i]."='".$value[$i]."'";
					break;
				}

				$bindy .= $column[$i]."='".$value[$i]."', ";
			}
			$query ="UPDATE  $table SET $bindy $cond ";
			var_dump($query);
			$this->driver->query($query);
			return;
		}
	}
	
}