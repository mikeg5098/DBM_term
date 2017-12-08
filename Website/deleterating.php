<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$result = $db_handle->executeUpdate("DELETE FROM DBM_ratings WHERE rating_id ='" . $_POST["rating_id"] . "';");;
?>
