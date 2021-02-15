<?php
	require_once "database.php";
 	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	
	if(isset($_POST['income'])){
	$all_OK = true;	
	$new_income=$_POST['income'];
	$result = $db->prepare("SELECT name FROM incomes_category_assigned_to_users WHERE name=:new_income AND user_id = :user_loggedin_id");
	$result->bindValue(':new_income',$new_income,PDO::PARAM_STR);
	$result->bindValue(':user_loggedin_id',$user_loggedin_id,PDO::PARAM_INT);
	$result->execute();
	if(!$result) throw new Exception($db->error);
	$amount_of_category_income = $result->rowCount();
	if($amount_of_category_income > 0){
		$all_OK = false;
		$_SESSION['info'] = "A category name exists.";
	}
	if(strlen($new_income) > 20 || strlen($new_income) < 3){
		$all_OK = false;
		$_SESSION['info'] = "A category name must have characters between 3 and 20.";
	}
	if($all_OK){
		$query = $db->prepare("INSERT INTO incomes_category_assigned_to_users VALUES(NULL,:user_loggedin_id,:new_income)");
		$query->bindValue(':user_loggedin_id',$user_loggedin_id,PDO::PARAM_INT);
		$query->bindValue(':new_income',$new_income,PDO::PARAM_STR);
		if($query->execute()){
			echo '<script type="text/javascript">alert("The new income has been created");</script>';
			$_SESSION['addInfoOK'] = "A new income category ".$new_income." has been added succesfuly to your account.";
		}
		unset($_POST['income']);	
	}	
	}
	if(isset($_POST['expence'])){
	$all_OK = true;	
	$new_expence=$_POST['expence'];
	//find if new_income exists and if not than insert into 
	$result = $db->prepare("SELECT name FROM expenses_category_assigned_to_users WHERE name=:new_expence AND user_id = :user_loggedin_id");
	$result->bindValue(':new_expence',$new_expence,PDO::PARAM_STR);
	$result->bindValue(':user_loggedin_id',$user_loggedin_id,PDO::PARAM_INT);
	$result->execute();
	if(!$result) throw new Exception($db->error);
	$amount_of_category_expense = $result->rowCount();
	if($amount_of_category_expense > 0){
		$all_OK = false;
		$_SESSION['info'] = "A category name exists.";
	}
	if(strlen($new_expence) > 20 || strlen($new_expence) < 3){
		$all_OK = false;
		$_SESSION['info'] = "A category name must have characters between 3 and 20";
	}
	if($all_OK){
		$query = $db->prepare("INSERT INTO expenses_category_assigned_to_users VALUES(NULL,:user_loggedin_id,:new_expence)");
		$query->bindValue(':new_expence',$new_expence,PDO::PARAM_STR);
		$query->bindValue(':user_loggedin_id',$user_loggedin_id,PDO::PARAM_INT);
		if($query->execute()){
			//echo '<script type="text/javascript">alert("The new income has been created");</script>';
			//set session variable and than display it 
			$_SESSION['addInfoOK'] = "A new expense category ".$new_expence." has been added succesfuly to your account.";
		}
		unset($_POST['expence']);	
	}	
	}
	if(isset($_POST['payment'])){
	$all_OK = true;
	$new_payment_method=$_POST['payment'];
	//find if new_income exists and if not than insert into 
	$result = $db->prepare("SELECT name FROM payment_methods_assigned_to_users WHERE name=:new_payment_method AND user_id = :user_loggedin_id");
	$result->bindValue(':new_payment_method',$new_payment_method,PDO::PARAM_STR);
	$result->bindValue(':user_loggedin_id',$user_loggedin_id,PDO::PARAM_INT);
	$result->execute();
	if(!$result) throw new Exception($db->error);
	$amount_of_category_payment_methods = $result->rowCount();
	
	if($amount_of_category_payment_methods > 0){
		$all_OK = false;
		$_SESSION['info'] = "A category name exists.";
	}
		if(strlen($new_payment_method) > 20 || strlen($new_payment_method) < 3){
		$all_OK = false;
		$_SESSION['info'] = "A category name must have characters between 3 and 20";
	}
	if($all_OK){
		$query = $db->prepare("INSERT INTO payment_methods_assigned_to_users VALUES(NULL,:user_loggedin_id,:new_payment_method)");
		$query->bindValue(':new_payment_method',$new_payment_method,PDO::PARAM_STR);
		$query->bindValue(':user_loggedin_id',$user_loggedin_id,PDO::PARAM_INT);
		if($query->execute()){
			//echo '<script type="text/javascript">alert("The new income has been created");</script>';
			//set session variable and than display it 
			$_SESSION['addInfoOK'] = "A new payment method ".$new_payment_method." category has been added succesfuly to your account.";
		}
		unset($_POST['payment']);	
	}		
	}
	header('location:settings.php');
 
?>
