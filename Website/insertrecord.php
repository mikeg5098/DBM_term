<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$result = $db_handle->executeUpdate("call insertCar('" . $_POST["model"] . "','" . $_POST["make"] . "','" . $_POST["year"] . "');");;	
?>