<?php
	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	require_once "connect.php";
	
	try{
		$connection = new mysqli($host, $db_user,$db_password,$db_name);
		if($connection->connect_errno!=0){
				throw new Exception(mysqli_connect_errno());
		}else{
			exit();
			
		}
	}catch(Exception $e){
		
	}
	
	header('location:expence.php');
?>