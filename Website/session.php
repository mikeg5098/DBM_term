<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysqli_connect("db1.cs.uakron.edu:3306", "jsy15", "termProjJacob17");
// Selecting Database
$db = mysqli_select_db($connection,"ISP_jsy15");
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query($connection, "select id, username, fname from login where username='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$id_session =$row['id'];
$login_session =$row['username'];
$fname_session =$row['fname'];
if(!isset($login_session)){
mysqli_close($connection); // Closing Connection
header('Location: login_index.php'); // Redirecting To Home Page
}
?>