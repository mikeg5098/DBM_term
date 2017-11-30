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
$connection = mysqli_connect("db1.cs.uakron.edu:3306", "jsy15", "termProjJacob17");

// Selecting Database
$db = mysqli_select_db($connection,"ISP_jsy15");
// SQL query to fetch information of registerd users and finds user match.
$query = mysqli_query($connection, "select * from login where password='$password' AND username='$username'");
$rows = mysqli_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
header("location: profile.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysqli_close($connection); // Closing Connection
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

	$connection = mysqli_connect("db1.cs.uakron.edu:3306", "jsy15", "termProjJacob17");
	$db = mysqli_select_db($connection,"ISP_jsy15");

	$query = mysqli_query($connection, "INSERT INTO `login`(`id`, `username`, `password`, `fname`, `lname`) VALUES ('','$username','$password','$fname','$lname')");
	header("location: profile.php");
	mysqli_close($connection);
}
}


?>