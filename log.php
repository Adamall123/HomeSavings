<?php
	session_start();
	require_once "connect.php";
	
	//PDO_MySQL
	
	if((!isset($_POST['login'])) || (!isset($_POST['password']))){
		header('Location: index.php');
		exit(); 
	}
	
	$polaczenie = @new mysqli($host, $db_user,$db_password,$db_name);
	
	if($polaczenie->connect_errno!=0){
		echo "Error ".$polaczenie->connect_errno;
	}
	else {
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		//encje html'a 
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$login = htmlentities($password, ENT_QUOTES, "UTF-8");
		
		if ($result = @$polaczenie->query(
		sprintf("SELECT * FROM users WHERE username = '%s' AND password = '%s'",
		mysqli_real_escape_string($polaczenie,$login),
		mysqli_real_escape_string($polaczenie,$password))))
		{
			$amount_of_users = $result->num_rows;
			if($amount_of_users > 0){
				
				$_SESSION['loggedin'] = true;
				
				$row = $result->fetch_assoc();
				$_SESSION['id'] = $row['id'];
				$_SESSION['user']= $row['username'];
				
				unset($_SESSION['mistake']); //delete variable from session when logged in 
				$result->close(); //remove from ram not needed anymore row of result
				
				header('Location: mainPage.php');
				
			} else {
				
				$_SESSION['mistake'] = '<span style="color:red"> Wrong login or password! </span>';
				header('Location: login.php');
			}
		}
		
		$polaczenie->close();
	}

?>
