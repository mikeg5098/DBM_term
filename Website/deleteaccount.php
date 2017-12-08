<?php
require("session.php");
require_once("dbcontroller.php");
$db_handle = new DBController();
$result = $db_handle->executeUpdate("call deleteAccount('" . $_POST["user_id"] . "');");;
?>
