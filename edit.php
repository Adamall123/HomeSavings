<?php
 	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	require_once "database.php";
	if(isset($_POST['editincome'])){
	$all_OK=true; 
	$income_id=$_GET['id'];
	$edit_income=$_POST['editincome'];
	$result = $db->prepare("SELECT name FROM incomes_category_assigned_to_users WHERE name=:edit_income AND user_id = :user_loggedin_id");
	$result->bindValue(':edit_income',$edit_income,PDO::PARAM_STR);
	$result->bindValue(':user_loggedin_id',$user_loggedin_id,PDO::PARAM_INT);
	$result->execute();
	$amount_of_category_income = $result->rowCount();
	if($amount_of_category_income > 0){
		$all_OK = false;
		$_SESSION['info'] = "A category name exists.";
	}
	if($all_OK){
		$query = $db->prepare("UPDATE incomes_category_assigned_to_users SET name=:edit_income WHERE user_id=:user_loggedin_id AND id= :income_id");
		$query->bindValue(':edit_income',$edit_income,PDO::PARAM_STR);
		$query->bindValue(':user_loggedin_id',$user_loggedin_id,PDO::PARAM_INT);
		$query->bindValue(':income_id',$income_id,PDO::PARAM_INT);
		if($query->execute()){
			$_SESSION['addInfoOK'] = "A category has beed updated.";
		}
		unset($_POST['editincome']);	
	}	
	}
	if(isset($_POST['editexpence'])){
	$all_OK=true;
	$expence_id=$_GET['id'];
	$edit_expence=$_POST['editexpence'];
	$result = $db->prepare("SELECT name FROM expenses_category_assigned_to_users WHERE name=:edit_expence AND user_id = :user_loggedin_id");
	$result->bindValue(':edit_expence',$edit_expence,PDO::PARAM_STR);
	$result->bindValue(':user_loggedin_id',$user_loggedin_id,PDO::PARAM_INT);
	$result->execute();
	if(!$result) throw new Exception($db->error);
	$amount_of_category_expense = $result->rowCount();
	if($amount_of_category_expense > 0){
		$all_OK = false;
		$_SESSION['info'] = "A category name exists.";
	}
	if($all_OK){
		$query = $db->prepare("UPDATE expenses_category_assigned_to_users SET name=:edit_expence WHERE user_id=:user_loggedin_id AND id= :expence_id");
		$query->bindValue(':edit_expence',$edit_expence,PDO::PARAM_STR);
		$query->bindValue(':user_loggedin_id',$user_loggedin_id,PDO::PARAM_INT);
		$query->bindValue(':expence_id',$expence_id,PDO::PARAM_INT);
		if($query->execute()){
			$_SESSION['addInfoOK'] = "A category has beed updated.";
		}
		unset($_POST['editexpence']);	
	}
	}
	if(isset($_POST['editpayment'])){
	$all_OK = true;
	$payment_id=$_GET['id'];
	$edit_payment_method=$_POST['editpayment'];
	$result = $db->prepare("SELECT name FROM payment_methods_assigned_to_users WHERE name=:edit_payment_method AND user_id = :user_loggedin_id");
	$result->bindValue(':edit_payment_method',$edit_payment_method,PDO::PARAM_STR);
	$result->bindValue(':user_loggedin_id',$user_loggedin_id,PDO::PARAM_INT);
	$result->execute();
	if(!$result) throw new Exception($db->error);
	$amount_of_category_income = $result->rowCount();
	if($amount_of_category_income > 0){
		$all_OK = false;
		$_SESSION['info'] = "A category name exists.";
	}
	if($all_OK){
		$query = $db->prepare("UPDATE payment_methods_assigned_to_users SET name=:edit_payment_method WHERE user_id=:user_loggedin_id AND id= :payment_id");
		$query->bindValue(':edit_payment_method',$edit_payment_method,PDO::PARAM_STR);
		$query->bindValue(':user_loggedin_id',$user_loggedin_id,PDO::PARAM_INT);
		$query->bindValue(':payment_id',$payment_id,PDO::PARAM_INT);
		if($query->execute()){
			//set session variable and than display it 
			$_SESSION['addInfoOK'] = "A category has beed updated.";
		}
		unset($_POST['editpayment']);	
	}				
	}
	header('location:settings.php');
 
?>