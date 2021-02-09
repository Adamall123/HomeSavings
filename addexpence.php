<?php
	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	require_once "connect.php";
	
	try{
		$connection = new mysqli($host, $db_user,$db_password,$db_name);
		if($connection->connect_errno!=0){
				throw new Exception(mysqli_connect_errno());
		}else{
			if (isset($_POST['submit'])){
				$expence_category_id = $_POST['expense_category_id'];
				$payment_method_id = $_POST['payment_method_id'];
				$amount= $_POST['amount']; //check if bigger than 0
				$dateExpence = $_POST['date']; //check if filled
				$expenceComment = $_POST['comment'];
			
					
				if($connection->query("INSERT INTO expenses VALUES(NULL,'$user_loggedin_id','$expence_category_id','$payment_method_id','$amount','$dateExpence','$expenceComment')")){
					//set session variable and then display it 
					$_SESSION['addedExpence'] = "A new expence has been added succesfuly to your account.";
				}
				
			}
		}
	}catch(Exception $e){
		
	}
	
	header('location:expence.php');
?>