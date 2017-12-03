<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$sql = "SELECT car_id FROM database_testing";
$faq = $db_handle->runQuery($sql);

		  foreach($faq as $k=>$v) {
			
			$db = mysqli_connect("db1.cs.uakron.edu:3306", "jsy15", "termProjJacob17");
			//$db = mysqli_connect("db1.cs.uakron.edu:3306", "xiaotest", "wpdb","xiaotest");

			// Select the database
			$er = mysqli_select_db($db,"ISP_jsy15");

			$temp = "0";
			$query = "call setRating('" . $faq[$k]["car_id"] . "','" . $temp . "','');"; 

			$result = mysqli_query($db,$query);
			
		}
?>