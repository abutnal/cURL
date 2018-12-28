<?php
class Database{
	public $con;
	public function __construct(){
		$this->con = mysqli_connect("localhost", "root", "", "curl");
		if (!$this->con) {
			die("Failed to connect DB").mysqli_error();
		}
	}
}
$obj = new Database;