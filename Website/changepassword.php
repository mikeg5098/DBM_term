<?php
require("session.php");
require_once("dbcontroller.php");
$db_handle = new DBController();
$result = $db_handle->executeUpdate("UPDATE login SET password = '" . $_POST["password"] . "' WHERE id = '" . $_POST["user_id"] . "';");;
?>
