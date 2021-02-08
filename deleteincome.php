<?php
	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	require_once "connect.php";
	error_reporting(0);
	$connection = new mysqli($host, $db_user,$db_password,$db_name);
	$income_id = $_GET['rn']; //read about it 
	
	$query = "DELETE FROM incomes_category_assigned_to_users WHERE id = '$income_id' AND user_id = '$user_loggedin_id'";

	$data_income = mysqli_query($connection, $query);
	
	if($data_income){
		header('Location: settings.php');
		//on settings page check session variable if removed and display info :) 
	}else {
		header('Location: settings.php');
	}
?>