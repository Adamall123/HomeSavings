<?php
 	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	require_once "database.php";
	if(isset($_POST['editincome'])){
	$all_OK=true; 
	$income_id=$_GET['id'];
	$edit_income=$_POST['editincome'];
	$result = $db->query("SELECT name FROM incomes_category_assigned_to_users WHERE name='$edit_income' AND user_id = '$user_loggedin_id'");
	$amount_of_category_income = $result->rowCount();
	if($amount_of_category_income > 0){
		$all_OK = false;
		echo '<script type="text/javascript">alert("The written category exists in your app!");</script>';
	}
	if($all_OK){
		if($db->query("UPDATE incomes_category_assigned_to_users SET name='$edit_income' WHERE user_id='$user_loggedin_id' AND id= '$income_id'")){
			//set session variable and than display it 
		}
		unset($_POST['editincome']);	
	}	
	}
	if(isset($_POST['editexpence'])){
	$all_OK=true;
	$expence_id=$_GET['id'];
	$edit_expence=$_POST['editexpence'];
	$result = $db->query("SELECT name FROM expenses_category_assigned_to_users WHERE name='$edit_expence' AND user_id = '$user_loggedin_id'");
	if(!$result) throw new Exception($db->error);
	$amount_of_category_income = $result->rowCount();
	if($amount_of_category_income > 0){
		$all_OK = false;
		echo '<script type="text/javascript">alert("The written category exists in your app!");</script>';
	}
	if($all_OK){
		if($db->query("UPDATE expenses_category_assigned_to_users SET name='$edit_expence' WHERE user_id='$user_loggedin_id' AND id= '$expence_id'")){
			//set session variable and than display it 
		}
		unset($_POST['editexpence']);	
	}
	}
	if(isset($_POST['editpayment'])){
	$all_OK = true;
	$payment_id=$_GET['id'];
	$edit_payment_method=$_POST['editpayment'];

	//find if edit_payment_method exists and if not than update
	$result = $db->query("SELECT name FROM payment_methods_assigned_to_users WHERE name='$edit_payment_method' AND user_id = '$user_loggedin_id'");
	if(!$result) throw new Exception($db->error);
	$amount_of_category_income = $result->rowCount();
	if($amount_of_category_income > 0){
		$all_OK = false;
		echo '<script type="text/javascript">alert("The written category exists in your app!");</script>';
	}

	if($all_OK){
		echo $edit_payment_method;
		if($db->query("UPDATE payment_methods_assigned_to_users SET name='$edit_payment_method' WHERE user_id='$user_loggedin_id' AND id= '$payment_id'")){
			//set session variable and than display it 
		}
		unset($_POST['editpayment']);	
	}				
	}
	header('location:settings.php');
 
?>