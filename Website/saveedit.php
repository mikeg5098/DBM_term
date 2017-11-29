<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$result = $db_handle->executeUpdate("UPDATE database_testing set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  car_id=".$_POST["car_id"]);;
?>