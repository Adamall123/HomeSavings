<?php
	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	require_once "database.php";
	
	
	if (isset($_POST['submit'])){
		$all_OK=true;
		//$income_category_id = $_POST['income_category_id'];
		//$amount= $_POST['amount']; //check if bigger than 0
		//$dateIncome = $_POST['date']; //check if filled
		//$incomeComment = $_POST['comment'];
		$income_category_id = filter_input(INPUT_POST, 'income_category_id');
		$amount= filter_input(INPUT_POST, 'amount');
		$dateIncome = filter_input(INPUT_POST, 'date');
		$incomeComment = filter_input(INPUT_POST, 'comment');
		if($amount <= 0) {
			$all_OK = false;
			$_SESSION['e_amount'] = "Provide amount bigger then 0!";
		}
		if($all_OK){
			$query = $db->prepare("INSERT INTO incomes VALUES(NULL, :user_loggedin_id, :income_category_id,:amount,:dateIncome,:incomeComment)");
			$query->bindValue(':user_loggedin_id',$user_loggedin_id,PDO::PARAM_INT);
			$query->bindValue(':income_category_id',$income_category_id ,PDO::PARAM_INT);
			$query->bindValue(':amount',$amount ,PDO::PARAM_INT);
			$query->bindValue(':dateIncome',$dateIncome ,PDO::PARAM_STR);
			$query->bindValue(':incomeComment',$incomeComment ,PDO::PARAM_STR);
			if($query->execute()){
				$_SESSION['addedIncome'] = "A new income has been added succesfuly to your account.";
				//set session variable and then display it 
			}
		}
	}
	header('location:income.php');
?>