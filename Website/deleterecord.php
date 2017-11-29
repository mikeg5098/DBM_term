<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$result = $db_handle->executeUpdate("DELETE FROM database_testing WHERE car_id =" . $_POST["car_id"]);;
?>