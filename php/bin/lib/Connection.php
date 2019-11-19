<?php
class Connection{
	private $conn;
	private $conf;
	public function __construct(){
		$this->conf=parse_ini_file('db_config.ini');
		$this->conn=new mysqli($this->conf['db_hostname'],$this->conf['db_user'],
		$this->conf['db_password']);
		if ($this->conn->connect_error)
		{
		die("Connection failed: ".$this->conn->connect_error);
		}
		$this->conn->select_db($this->conf['db_name']);
	}
	public function Query($query){
		$query=$this->conn->real_escape_string($query);
		$res=$this->conn->query($query);
		if($res&&$res->num_rows()>0){
			return $res;
		}
		else
			return false;
	}
}
