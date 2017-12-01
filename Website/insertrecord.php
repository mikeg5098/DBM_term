<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$result = $db_handle->executeUpdate("INSERT INTO database_testing (Model,Make,Year) values ('" . $_POST["model"] . "','" . $_POST["make"] . "','" . $_POST["year"] . "');");;
	
$sql = "SELECT car_id FROM database_testing WHERE Model = '" . $_POST["model"] . "' AND Make = '" . $_POST["make"] . "' AND Year = '" . $_POST["year"] . "'";
$faq = $db_handle->runQuery($sql);
$db = mysqli_connect("db1.cs.uakron.edu:3306", "jsy15", "termProjJacob17");
$er = mysqli_select_db($db,"ISP_jsy15");
foreach($faq as $k=>$v) {
	
						$query = "INSERT INTO DBM_ratings (rating, car_id) VALUES ('0','".$faq[$k]["car_id"]."')"; 
						//echo $faq[$k]["car_id"] . "<br>" . $query . "<br>";

						$result = mysqli_query($db,$query);
}
	
?>