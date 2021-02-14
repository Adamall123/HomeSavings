<?php
	session_start();
	
	
	/*if((!isset($_POST['login'])) || (!isset($_POST['password']))){
		header('Location: index.php');
		exit(); 
	}*/
	if(empty($_POST['login']) || empty($_POST['password'])){
		header('Location: login.php');
		exit();
	}

	
	/*
	$login = $_POST['login'];
	$password = $_POST['password'];
	
	//encje html'a 
	$login = htmlentities($login, ENT_QUOTES, "UTF-8");

	if ($result = @$polaczenie->query(
	sprintf("SELECT * FROM users WHERE username = '%s'",
	mysqli_real_escape_string($polaczenie,$login))))
	{
		$amount_of_users = $result->num_rows;
		if($amount_of_users > 0){
			
			$row = $result->fetch_assoc();
			
			if(password_verify($password,$row['password']))
			{
				$_SESSION['loggedin'] = true;
				$_SESSION['id'] = $row['id'];
				$_SESSION['user']= $row['username'];
				unset($_SESSION['mistake']); //delete variable from session when logged in 
				$result->close(); //remove from ram not needed anymore row of result
				header('Location: mainPage.php');
			}
			else {
				$_SESSION['mistake'] = '<span style="color:red"> Wrong login or password! </span>';
				header('Location: login.php');
			}
		} else {
			$_SESSION['mistake'] = '<span style="color:red"> Wrong login or password! </span>';
			header('Location: login.php');
		}
	}
	*/
		
	
	

?>
