<?php
 	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	$expence_id=$_GET['id'];
	require_once "database.php";
	$sql = $db->query("SELECT id FROM expenses_category_assigned_to_users WHERE user_id='$user_loggedin_id' AND name = 'Another'");
	$result = $sql->fetch();
	$id_of_another_category = $result['id'];
	$db->query("UPDATE expenses SET expense_category_assigned_to_user_id= '$id_of_another_category' WHERE user_id='$user_loggedin_id' AND expense_category_assigned_to_user_id= '$expence_id'");
	if($db->query("DELETE FROM expenses_category_assigned_to_users WHERE user_id='$user_loggedin_id' AND id= '$expence_id'")){
		$_SESSION['info'] = "A category name has beed deleted.";
	}
	header('location:settings.php');
?>

