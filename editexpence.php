<?php
	require_once "connect.php";
 	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	$expence_id=$_GET['id'];
	
	$edit_expence=$_POST['editexpence'];
	
	$connection = new mysqli($host, $db_user,$db_password,$db_name);
 
	mysqli_query($connection,"UPDATE expenses_category_assigned_to_users SET name='$edit_expence' WHERE user_id='$user_loggedin_id' AND id= '$expence_id'");
	header('location:settings.php');
 
?>