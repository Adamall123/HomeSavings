<?php
 	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	$payment_id=$_GET['id'];
	require_once "database.php";
	if($db->query("DELETE FROM payment_methods_assigned_to_users WHERE user_id='$user_loggedin_id' AND id= '$payment_id'")){
		$_SESSION['info'] = "A category name has beed deleted.";
	}
	header('location:settings.php');
?>