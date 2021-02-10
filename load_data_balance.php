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
			 $sumIncome = 0;
			 $sumExpense = 0;
			 if(isset($_POST["date_id"]))  
			 {    
				  if($_POST["date_id"] == 1)  
				  {  
					   $sqlSumIncomes = "SELECT SUM(incomes.amount) as sumIncomes FROM incomes WHERE incomes.user_id = '$user_loggedin_id' AND date_of_income >= '$year-$month-01' AND date_of_income <= '$year-$month-$numberOfDaysOfSelectedMonth' ";
					   $sqlSumExpenses = "SELECT SUM(expenses.amount) as sumExpenses FROM expenses WHERE expenses.user_id = '$user_loggedin_id' AND date_of_expense >= '$year-$month-01' AND date_of_expense <= '$year-$month-$numberOfDaysOfSelectedMonth' ";
					   
				  } 
				  else if($_POST["date_id"] == 2)  
				  {  	
					   $lastmonth = date('m', strtotime("last month"));
					   $sqlSumIncomes = "SELECT SUM(incomes.amount) as sumIncomes FROM incomes WHERE incomes.user_id = '$user_loggedin_id' AND date_of_income >= '$year-$lastmonth-01' AND date_of_income <= '$year-$lastmonth-$numberOfDaysOfSelectedMonth' ";
					   $sqlSumExpenses = "SELECT SUM(expenses.amount) as sumExpenses FROM expenses WHERE expenses.user_id = '$user_loggedin_id' AND date_of_expense >= '$year-$lastmonth-01' AND date_of_expense <= '$year-$lastmonth-$numberOfDaysOfSelectedMonth' ";
				  }  
				   else if($_POST["date_id"] == 3)  
				  { 
					   $currentDay = date('d');
					   $sqlSumIncomes = "SELECT SUM(incomes.amount) as sumIncomes FROM incomes WHERE incomes.user_id = '$user_loggedin_id' AND date_of_income >= '$year-$month-01' AND date_of_income <= '$year-$month-$currentDay' ";
					   $sqlSumExpenses = "SELECT SUM(expenses.amount) as sumExpenses FROM expenses WHERE expenses.user_id = '$user_loggedin_id' AND date_of_expense >= '$year-$month-01' AND date_of_expense <= '$year-$month-$currentDay' ";
				  } 
				   else if($_POST["date_id"] == 4)  
				  {  
					  $sqlSumIncomes = "SELECT SUM(incomes.amount) as sumIncomes FROM incomes WHERE incomes.user_id = '$user_loggedin_id' ";
					  $sqlSumExpenses = "SELECT SUM(expenses.amount) as sumExpenses FROM expenses WHERE expenses.user_id = '$user_loggedin_id'";
				  } 
				  $result = mysqli_query($connection, $sqlSumIncomes);  
				  while($row = mysqli_fetch_array($result))  
				  {  
						$sumIncome = $row["sumIncomes"];
				  }  
				  $result2 = mysqli_query($connection, $sqlSumExpenses);  
				  while($row = mysqli_fetch_array($result2))  
				  {  
						$sumExpense = $row["sumExpenses"];
				  }
				  $sumFromIncomesExpenses = $sumIncome - $sumExpense;
				  if($sumFromIncomesExpenses >= 0){
					 $output .= '<div id="balanceWindow" ><h5>your balance is: '.$sumFromIncomesExpenses.' zł';  
					 $output .= '<br> <div class="line"> </div>Well done!</h5></div>';
				  }else {
					  
					 $output .= '<div id="balanceWindow" style="background-color:#cc7a00";><h5>your balance is: '.$sumFromIncomesExpenses.' zł';
					  $output .= '<br> <div class="line"> </div>Try to get beter incomes ! </h5></div></h5></div>';
				  }

				  echo $output;  
			 }
		}
	}catch(Exception $e){
		
	}
?>