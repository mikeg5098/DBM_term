<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "root", "");
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
// Selecting Database
$db = mysql_select_db("company", $connection);
// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from login where password='$password' AND username='$username'", $connection);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
header("location: profile.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysql_close($connection); // Closing Connection
}
}

if (isset($_POST['register'])){
if (empty($_POST['username']) || empty($_POST['password'])){
	$error = "Cannot have blank fields";
}
else
{
	$username=$_POST['username'];
	$password=$_POST['password'];
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];	

	$connection = mysql_connect("localhost", "root", "");
	$db = mysql_select_db("company", $connection);

	$query = mysql_query("INSERT INTO `login`(`id`, `username`, `password`, `fname`, `lname`) VALUES ('','$username','$password','$fname','$lname')", $connection);
	header("location: profile.php");
	mysql_close($connection);
}
}


?>