<?php
	require_once "connect.php";
 	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	
	try{
		$connection = new mysqli($host, $db_user,$db_password,$db_name);
		if($connection->connect_errno!=0){
				throw new Exception(mysqli_connect_errno());
		}else{
			if(isset($_POST['editincome'])){
			$income_id=$_GET['id'];
			$edit_income=$_POST['editincome'];
			//find if edit_income exists and if not than update 
			mysqli_query($connection,"update incomes_category_assigned_to_users set name='$edit_income' where user_id='$user_loggedin_id' AND id= '$income_id'");
			unset($_POST['editincome']);		
			}
			if(isset($_POST['editexpence'])){
			$expence_id=$_GET['id'];
			$edit_expence=$_POST['editexpence'];
			//find if edit_expence exists and if not than update 
			mysqli_query($connection,"UPDATE expenses_category_assigned_to_users SET name='$edit_expence' WHERE user_id='$user_loggedin_id' AND id= '$expence_id'");
			unset($_POST['editexpence']);		
			}
			if(isset($_POST['editpayment'])){
			$payment_id=$_GET['id'];
			$edit_payment_method=$_POST['editpayment'];
			//find if edit_payment_method exists and if not than update 
			mysqli_query($connection,"UPDATE payment_methods_assigned_to_users SET name='$edit_payment_method' WHERE user_id='$user_loggedin_id' AND id= '$payment_id'");
			unset($_POST['editpayment']);		
			}
		}
	}catch(Exception $e){
		
	}
	header('location:settings.php');
 
?>