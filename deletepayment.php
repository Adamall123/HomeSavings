<?php
	require_once "connect.php";
 	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	$payment_id=$_GET['id'];
	
	
	$connection = new mysqli($host, $db_user,$db_password,$db_name);
 
	mysqli_query($connection,"DELETE FROM payment_methods_assigned_to_users WHERE user_id='$user_loggedin_id' AND id= '$payment_id'");
	header('location:settings.php');
 
?>