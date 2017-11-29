<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$result = $db_handle->executeUpdate("INSERT INTO database_testing (model,make,year) values ('" . $_POST["model"] . "','" . $_POST["make"] . "','" . $_POST["year"] . "');");;
?>