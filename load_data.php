 <?php
	//send logged in id user?
	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	require_once "database.php";

	
	$id = $_POST['date_id'];
	$month = date('m');
	$year = date('Y');
	$numberOfDaysOfSelectedMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	
	 $output = ''; 


	 if(isset($_POST["date_id"]))  
	 {    
		  if($_POST["date_id"] == 1)  
		  {  
			   $sql = $db->query("SELECT name, SUM(amount) AS sum FROM incomes, incomes_category_assigned_to_users WHERE incomes_category_assigned_to_users.id = incomes.income_category_assigned_to_user_id AND incomes.user_id = '$user_loggedin_id' AND date_of_income >= '$year-$month-01' AND date_of_income <= '$year-$month-$numberOfDaysOfSelectedMonth' GROUP BY name"); 
		  } 
		  else if($_POST["date_id"] == 2)  
		  {  	
			   $lastmonth = date('m', strtotime("last month"));
			  $sql = $db->query("SELECT name, SUM(amount) AS sum FROM incomes, incomes_category_assigned_to_users WHERE incomes_category_assigned_to_users.id = incomes.income_category_assigned_to_user_id AND incomes.user_id = '$user_loggedin_id' AND date_of_income >= '$year-$lastmonth-01' AND date_of_income <= '$year-$lastmonth-$numberOfDaysOfSelectedMonth' GROUP BY name");
		  }  
		   else if($_POST["date_id"] == 3)  
		  { 
				$currentDay = date('d');
			   $sql = $db->query("SELECT name, SUM(amount) AS sum FROM incomes, incomes_category_assigned_to_users WHERE incomes_category_assigned_to_users.id = incomes.income_category_assigned_to_user_id AND incomes.user_id = '$user_loggedin_id' AND date_of_income >= '$year-01-01' AND date_of_income <= '$year-$month-$currentDay' GROUP BY name");
		  } 
		   else if($_POST["date_id"] == 4)  
		  {  
			  $sql = $db->query("SELECT name, SUM(amount) AS sum FROM incomes, incomes_category_assigned_to_users WHERE incomes_category_assigned_to_users.id = incomes.income_category_assigned_to_user_id AND incomes.user_id = '$user_loggedin_id'  GROUP BY name");
		  } 
		  $incomesResult = $sql->fetchAll();  
		  foreach($incomesResult as $incomeResult) 
		  {  
			   $output .= '<li><a>'.$incomeResult["name"].': '.$incomeResult["sum"].'</a></li>';
		  }  
		  echo $output;  
	 }
		
	
?>