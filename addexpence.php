<?php
	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	require_once "database.php";
	if (isset($_POST['submit'])){
		$expence_category_id = $_POST['expense_category_id'];
		$payment_method_id = $_POST['payment_method_id'];
		$amount= $_POST['amount']; //check if bigger than 0
		$dateExpence = $_POST['date']; //check if filled
		$expenceComment = $_POST['comment'];

		if($db->query("INSERT INTO expenses VALUES(NULL,'$user_loggedin_id','$expence_category_id','$payment_method_id','$amount','$dateExpence','$expenceComment')")){
			//set session variable and then display it 
			$_SESSION['addedExpence'] = "A new expence has been added succesfuly to your account.";
		}
	}

	header('location:expence.php');
?>