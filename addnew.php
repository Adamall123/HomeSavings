<?php
	require_once "connect.php";
 	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	try{
		$connection = new mysqli($host, $db_user,$db_password,$db_name);
		if($connection->connect_errno!=0){
				throw new Exception(mysqli_connect_errno());
		}else{
			if(isset($_POST['income'])){
			$all_OK = true;	
			$new_income=$_POST['income'];
			$result = $connection->query("SELECT name FROM incomes_category_assigned_to_users WHERE name='$new_income' AND user_id = '$user_loggedin_id'");
			if(!$result) throw new Exception($connection->error);
			$amount_of_category_income = $result->num_rows;
			if($amount_of_category_income > 0){
				$all_OK = false;
				echo '<script type="text/javascript">alert("The written category exists in your app!");</script>';
			}
			if($all_OK){
				if($connection->query("INSERT INTO incomes_category_assigned_to_users VALUES(NULL,'$user_loggedin_id','$new_income')")){
					echo '<script type="text/javascript">alert("The new income has been created");</script>';
					//set session variable and than display it 
				}
				unset($_POST['income']);	
			}	
			}
			/*
			if button not pressed then this Exeption is working 
			what if button clicked and did not works
			else {
					throw new Exception($connection->error);
				}
			*/
			if(isset($_POST['expence'])){
			$all_OK = true;	
			$new_expence=$_POST['expence'];
			//find if new_income exists and if not than insert into 
			$result = $connection->query("SELECT name FROM expenses_category_assigned_to_users WHERE name='$new_expence' AND user_id = '$user_loggedin_id'");
			if(!$result) throw new Exception($connection->error);
			$amount_of_category_income = $result->num_rows;
			if($amount_of_category_income > 0){
				$all_OK = false;
				echo '<script type="text/javascript">alert("The written category exists in your app!");</script>';
			}
			if($all_OK){
				
				if($connection->query("INSERT INTO expenses_category_assigned_to_users VALUES(NULL,'$user_loggedin_id','$new_expence')")){
					echo '<script type="text/javascript">alert("The new income has been created");</script>';
					//set session variable and than display it 
				}
				unset($_POST['expence']);	
			}	
			}
			if(isset($_POST['payment'])){
			$all_OK = true;
			$new_payment_method=$_POST['payment'];
			//find if new_income exists and if not than insert into 
			$result = $connection->query("SELECT name FROM payment_methods_assigned_to_users WHERE name='$new_payment_method' AND user_id = '$user_loggedin_id'");
			if(!$result) throw new Exception($connection->error);
			$amount_of_category_income = $result->num_rows;
			if($amount_of_category_income > 0){
				$all_OK = false;
				echo '<script type="text/javascript">alert("The written category exists in your app!");</script>';
			}
			if($all_OK){
				
				if($connection->query("INSERT INTO payment_methods_assigned_to_users VALUES(NULL,'$user_loggedin_id','$new_payment_method')")){
					echo '<script type="text/javascript">alert("The new income has been created");</script>';
					//set session variable and than display it 
				}
				unset($_POST['payment']);	
			}		
			}
			$connection->close();
		}
	}catch(Exception $e){
		
	}
	
	header('location:settings.php');
 
?>
