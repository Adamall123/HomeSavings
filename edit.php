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
			$all_OK=true; 
			$income_id=$_GET['id'];
			$edit_income=$_POST['editincome'];
			$result = $connection->query("SELECT name FROM incomes_category_assigned_to_users WHERE name='$edit_income' AND user_id = '$user_loggedin_id'");
			if(!$result) throw new Exception($connection->error);
			$amount_of_category_income = $result->num_rows;
			if($amount_of_category_income > 0){
				$all_OK = false;
				echo '<script type="text/javascript">alert("The written category exists in your app!");</script>';
			}
			if($all_OK){
				if($connection->query("UPDATE incomes_category_assigned_to_users SET name='$edit_income' WHERE user_id='$user_loggedin_id' AND id= '$income_id'")){
					echo '<script type="text/javascript">alert("The new income has been changed");</script>';
					//set session variable and than display it 
				}
				unset($_POST['editincome']);	
			}	
			}
			if(isset($_POST['editexpence'])){
			$all_OK=true;
			$expence_id=$_GET['id'];
			$edit_expence=$_POST['editexpence'];
			$result = $connection->query("SELECT name FROM expenses_category_assigned_to_users WHERE name='$edit_expence' AND user_id = '$user_loggedin_id'");
			if(!$result) throw new Exception($connection->error);
			$amount_of_category_income = $result->num_rows;
			if($amount_of_category_income > 0){
				$all_OK = false;
				echo '<script type="text/javascript">alert("The written category exists in your app!");</script>';
			}
			if($all_OK){
				if($connection->query("UPDATE expenses_category_assigned_to_users SET name='$edit_expence' WHERE user_id='$user_loggedin_id' AND id= '$expence_id'")){
					echo '<script type="text/javascript">alert("The new income has been changed");</script>';
					//set session variable and than display it 
				}
				unset($_POST['editexpence']);	
			}
			}
			if(isset($_POST['editpayment'])){
			$payment_id=$_GET['id'];
			$edit_payment_method=$_POST['editpayment'];
			//find if edit_payment_method exists and if not than update
			$result = $connection->query("SELECT name FROM payment_methods_assigned_to_users WHERE name='$edit_payment_method' AND user_id = '$user_loggedin_id'");
			if(!$result) throw new Exception($connection->error);
			$amount_of_category_income = $result->num_rows;
			if($amount_of_category_income > 0){
				$all_OK = false;
				echo '<script type="text/javascript">alert("The written category exists in your app!");</script>';
			}
			if($all_OK){
				if($connection->query("UPDATE payment_methods_assigned_to_users SET name='$edit_payment_method' WHERE user_id='$user_loggedin_id' AND id= '$payment_id'")){
					echo '<script type="text/javascript">alert("The new income has been changed");</script>';
					//set session variable and than display it 
				}
				unset($_POST['editpayment']);	
			}				
			}
			$connection->close();
		}
	}catch(Exception $e){
		
	}
	header('location:settings.php');
 
?>