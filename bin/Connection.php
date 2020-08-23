<?php
class Connection{
	private $conn;
	private $conf;
	public function __construct(){
		$this->conf=parse_ini_file('./credential.ini');
		$this->conn=new mysqli($this->conf['hostname'],$this->conf['username'],
		$this->conf['password']);
		if ($this->conn->connect_error)
		{
		die("Connection failed: ".$this->conn->connect_errno
			.$this->conn->connect_error);
		}
		$this->conn->select_db($this->conf['db_name']);
	}
	public function __destruct()
	{
		$this->conn->close();
	}
	public function Query($query){
		$res=$this->conn->query($query);
		error_log('Executing query '.$query);
		if($res){
			return $res;
		}
		else
			error_log("Query failed: ".$this->conn->errno
				.$this->conn->error);
			return false;
	}
	public function escape($string){
		return $this->conn->real_escape_string($string);
	}
}
?>
