<?php
 	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	$income_id=$_GET['id'];
	require_once "database.php";
	$sql = $db->query("SELECT id FROM incomes_category_assigned_to_users WHERE user_id='$user_loggedin_id' AND name = 'Another'");
	$result = $sql->fetch(); 
	$id_of_another_category = $result['id'];
	$db->query("UPDATE incomes SET income_category_assigned_to_user_id= '$id_of_another_category' WHERE user_id='$user_loggedin_id' AND income_category_assigned_to_user_id= '$income_id'");
	if($db->query("DELETE FROM incomes_category_assigned_to_users WHERE user_id='$user_loggedin_id' AND id= '$income_id'")){
		$_SESSION['info'] = "A category name has beed deleted.";
	}
	header('location:settings.php');
	//set sesion to true and display comunication about deleting sucesfully
?>

