 <?php
	//send logged in id user?
	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	try{
		$connection = new mysqli($host, $db_user,$db_password,$db_name);
		if($connection->connect_errno!=0){
				throw new Exception(mysqli_connect_errno());
		}
		else {
			$id = $_POST['date_id'];
			$month = date('m');
			$year = date('Y');
			$numberOfDaysOfSelectedMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			
			 $output = '';  
			 if(isset($_POST["date_id"]))  
			 {    
				  if($_POST["date_id"] == 1)  
				  {  
					   $sql = "SELECT name, SUM(amount) AS sum FROM expenses, expenses_category_assigned_to_users WHERE expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id AND expenses.user_id = '$user_loggedin_id' AND date_of_expense >= '$year-$month-01' AND date_of_expense <= '$year-$month-$numberOfDaysOfSelectedMonth' GROUP BY name";  
				  } 
				  else if($_POST["date_id"] == 2)  
				  {  	
					   $lastmonth = date('m', strtotime("last month"));
					   $year = date('Y');
					   $sql = "SELECT name, SUM(amount) AS sum FROM expenses, expenses_category_assigned_to_users WHERE expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id AND expenses.user_id = '$user_loggedin_id' AND date_of_expense >= '$year-$lastmonth-01' AND date_of_expense <= '$year-$lastmonth-$numberOfDaysOfSelectedMonth' GROUP BY name";
				  }  
				   else if($_POST["date_id"] == 3)  
				  { 
					   $currentDay = date('d');
					   $sql = "SELECT name, SUM(amount) AS sum FROM expenses, expenses_category_assigned_to_users WHERE expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id AND expenses.user_id = '$user_loggedin_id' AND date_of_expense >= '$year-01-01' AND date_of_expense <= '$year-$month-$currentDay' GROUP BY name";
				  } 
				   else if($_POST["date_id"] == 4)  
				  {  
					   $sql = "SELECT name, SUM(amount) AS sum FROM expenses, expenses_category_assigned_to_users WHERE expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id AND expenses.user_id = '$user_loggedin_id'  GROUP BY name";
				  } 
				  $result = mysqli_query($connection, $sql);  
				  while($row = mysqli_fetch_array($result))  
				  {  
					   $output .= '<li><a>'.$row["name"].': '.$row["sum"].'</a></li>';  
				  }  
				  echo $output;  
			 }
		}
	}catch(Exception $e){
		
	}
?>