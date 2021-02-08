<?php
	require_once "connect.php";
 	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	$connection = new mysqli($host, $db_user,$db_password,$db_name);
	if(isset($_POST['income'])){
		$new_income=$_POST['income'];
		mysqli_query($connection,"INSERT INTO incomes_category_assigned_to_users VALUES(NULL,'$user_loggedin_id','$new_income')");
		unset($_POST['income']);		
	}
				
	if(isset($_POST['expence'])){
		$new_expence=$_POST['expence'];
		mysqli_query($connection,"INSERT INTO expenses_category_assigned_to_users VALUES(NULL,'$user_loggedin_id','$new_expence')");	
		unset($_POST['expence']);		
	}
	
	if(isset($_POST['payment'])){
		$new_payment_method=$_POST['payment'];
		mysqli_query($connection,"INSERT INTO payment_methods_assigned_to_users VALUES(NULL,'$user_loggedin_id','$new_payment_method')");	
		unset($_POST['payment']);		
	}
	
	header('location:settings.php');
 
?>
