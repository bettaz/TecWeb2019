<?php
require_once "./bin/lib/mainView.php";
require_once "./bin/lib/Connection.php";
class Index{
	private $conn;
	public function __construct(){
		$this->conn=new Connection();
	}
}
require_once "./bin/view/Index.php";
