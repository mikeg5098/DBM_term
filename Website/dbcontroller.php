<?php
class DBController {
	private $host = "db1.cs.uakron.edu:3306";
	private $user = "jsy15";
	private $password = "termProjJacob17";
	private $database = "ISP_jsy15";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
	function executeUpdate($query) {
        $result = mysqli_query($this->conn,$query);        
		return $result;		
    }
}
?>