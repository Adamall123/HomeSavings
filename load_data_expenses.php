 <?php
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
			   $sql = $db->query("SELECT name, SUM(amount) AS sum FROM expenses, expenses_category_assigned_to_users WHERE expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id AND expenses.user_id = '$user_loggedin_id' AND date_of_expense >= '$year-$month-01' AND date_of_expense <= '$year-$month-$numberOfDaysOfSelectedMonth' GROUP BY name");  
		  } 
		  else if($_POST["date_id"] == 2)  
		  {  	
			   $lastmonth = date('m', strtotime("last month"));
			   $year = date('Y');
			   $sql = $db->query("SELECT name, SUM(amount) AS sum FROM expenses, expenses_category_assigned_to_users WHERE expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id AND expenses.user_id = '$user_loggedin_id' AND date_of_expense >= '$year-$lastmonth-01' AND date_of_expense <= '$year-$lastmonth-$numberOfDaysOfSelectedMonth' GROUP BY name");
		  }  
		   else if($_POST["date_id"] == 3)  
		  { 
			   $currentDay = date('d');
			   $sql = $db->query("SELECT name, SUM(amount) AS sum FROM expenses, expenses_category_assigned_to_users WHERE expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id AND expenses.user_id = '$user_loggedin_id' AND date_of_expense >= '$year-01-01' AND date_of_expense <= '$year-$month-$currentDay' GROUP BY name");
		  } 
		   else if($_POST["date_id"] == 4)  
		  {  
			   $sql = $db->query("SELECT name, SUM(amount) AS sum FROM expenses, expenses_category_assigned_to_users WHERE expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id AND expenses.user_id = '$user_loggedin_id'  GROUP BY name");
		  } 
		 $expensesResult = $sql->fetchAll();  
		  foreach($expensesResult as $expenseResult) 
		  {  
			   $output .= '<li><a>'.$expenseResult["name"].': '.$expenseResult["sum"].'</a></li>';  
		  }  
		  echo $output;  
	 }
		
	
?>