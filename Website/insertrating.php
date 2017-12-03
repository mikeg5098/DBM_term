<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$result = $db_handle->executeUpdate("call setRating('" . $_POST["car_id"] . "','" . $_POST["rating"] . "','" . $_POST["comment"] . "');");;
?>