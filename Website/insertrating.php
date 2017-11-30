<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$result = $db_handle->executeUpdate("INSERT INTO DBM_ratings (car_id, rating) values ('" . $_POST["car_id"] . "','" . $_POST["rating"] . "');");;
?>