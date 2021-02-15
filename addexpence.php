<?php
	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	require_once "database.php";
	if (isset($_POST['submit'])){
		$all_OK = true;
		$expence_category_id = filter_input(INPUT_POST, 'expense_category_id');
		$payment_method_id = filter_input(INPUT_POST, 'payment_method_id');
		$amount= filter_input(INPUT_POST, 'amount');
		$dateExpence = filter_input(INPUT_POST, 'date');
		$expenceComment = filter_input(INPUT_POST, 'comment');
		if($amount <= 0) {
			$all_OK = false;
			$_SESSION['e_amount'] = "Provide amount bigger then 0!";
		}
		if($all_OK){
			$query = $db->prepare("INSERT INTO expenses VALUES(NULL,:user_loggedin_id,:expence_category_id,:payment_method_id,:amount,:dateExpence,:expenceComment)");
			$query->bindValue(':user_loggedin_id',$user_loggedin_id,PDO::PARAM_INT);
			$query->bindValue(':expence_category_id',$expence_category_id ,PDO::PARAM_INT);
			$query->bindValue(':payment_method_id',$payment_method_id ,PDO::PARAM_INT);
			$query->bindValue(':amount',$amount ,PDO::PARAM_INT);
			$query->bindValue(':dateExpence',$dateExpence ,PDO::PARAM_STR);
			$query->bindValue(':expenceComment',$expenceComment ,PDO::PARAM_STR);
		}
		if($query->execute()){
			//set session variable and then display it 
			$_SESSION['addedExpence'] = "A new expence has been added succesfuly to your account.";
		}
	}
	header('location:expence.php');
?>