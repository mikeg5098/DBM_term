<?php
require_once("dbcontroller.php");
require_once("session.php");
$db_handle = new DBController();
$result = $db_handle->executeUpdate("call setRating('" . $_POST["car_id"] . "','" . $_POST["rating"] . "','" . $_POST["comment"] . "','" . $id_session . "');");;
?>
