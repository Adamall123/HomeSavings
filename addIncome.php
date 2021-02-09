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
				$all_OK=true;
				$income_category_id = $_POST['income_category_id'];
				$amount= $_POST['amount']; //check if bigger than 0
				$dateIncome = $_POST['date']; //check if filled
				$incomeComment = $_POST['comment'];
				if($amount <= 0) {
					$all_OK = false;
					$_SESSION['e_amount'] = "Provide amount bigger then 0!";
				}
				if($all_OK){
					
					if($connection->query("INSERT INTO incomes VALUES(NULL,'$user_loggedin_id','$income_category_id','$amount','$dateIncome','$incomeComment')")){
						echo '<script type="text/javascript">alert("The new income has been created");</script>';
						$_SESSION['addedIncome'] = "A new income has been added succesfuly to your account.";
						
						//set session variable and then display it 
					}
				}
			}
		}
	}catch(Exception $e){
		
	}
	
	header('location:income.php');
?>