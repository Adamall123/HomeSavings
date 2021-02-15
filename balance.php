<?php
	//send logged in id user?
	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	
	require_once "database.php";

			 	
	function fill_incomes($db,$user_loggedin_id)  
	{    
		$month = date('m');
		$year = date('Y');
		$numberOfDaysOfSelectedMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year); 
	  $output = '';  
	  $sql = $db->query("SELECT name, SUM(amount) AS sum FROM incomes, incomes_category_assigned_to_users WHERE incomes_category_assigned_to_users.id = incomes.income_category_assigned_to_user_id AND incomes.user_id = '$user_loggedin_id' AND date_of_income >= '$year-$month-01' AND date_of_income <= '$year-$month-$numberOfDaysOfSelectedMonth' GROUP BY name");  
	  $incomesResult = $sql->fetchAll();  
	  foreach($incomesResult as $incomeResult)
	  {  
		   $output .= '<li><a>';  
		   $output .= $incomeResult["name"].': '.$incomeResult["sum"].'';  
		   $output .=     '</a>';  
		   $output .=     '</li>';  
	  }  
	  return $output;  
	}
	function fill_expences($db,$user_loggedin_id)  
	{  
	$month = date('m');
	$year = date('Y');
	$numberOfDaysOfSelectedMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	$output = '';  
	  $sql = $db->query("SELECT name, SUM(amount) AS sum FROM expenses, expenses_category_assigned_to_users WHERE expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id AND expenses.user_id = '$user_loggedin_id' AND date_of_expense >= '$year-$month-01' AND date_of_expense <= '$year-$month-$numberOfDaysOfSelectedMonth' GROUP BY name");  
	  $expensesResult = $sql->fetchAll(); 
	  foreach($expensesResult as $expenseResult)
	  {  
		   $output .= '<li><a>';  
		   $output .= $expenseResult["name"].': '.$expenseResult["sum"].'';  
		   $output .=     '</a>';  
		   $output .=     '</li>';  
	  }  
	  return $output;  
	}
	function fill_balance($db,$user_loggedin_id)  
	{  
	$month = date('m');
	$year = date('Y');
	$numberOfDaysOfSelectedMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
	$output = '';  
	  $sqlSumIncomes = $db->query("SELECT SUM(incomes.amount) as sumIncomes FROM incomes WHERE incomes.user_id = '$user_loggedin_id' AND date_of_income >= '$year-$month-01' AND date_of_income <= '$year-$month-$numberOfDaysOfSelectedMonth' ");
		   $sqlSumExpenses = $db->query("SELECT SUM(expenses.amount) as sumExpenses FROM expenses WHERE expenses.user_id = '$user_loggedin_id' AND date_of_expense >= '$year-$month-01' AND date_of_expense <= '$year-$month-$numberOfDaysOfSelectedMonth' ");
	  $sumIncomesresult = $sqlSumIncomes->fetchAll();  
	  foreach($sumIncomesresult as $sumIncomeresult) 
	  {  
			$sumIncome = $sumIncomeresult["sumIncomes"];
	  }  
	  $sumExpensesresult = $sqlSumExpenses->fetchAll();  
	   foreach($sumExpensesresult as $sumExpenseresult)  
	  {  
			$sumExpense = $sumExpenseresult["sumExpenses"];
	  }
	  $sumFromIncomesExpenses = $sumIncome - $sumExpense;
	  if($sumFromIncomesExpenses >= 0){
		 $output .= '<div id="balanceWindow" ><h5>your balance is: '.$sumFromIncomesExpenses.' zł';  
		 $output .= '<br> <div class="line"> </div>Well done!</h5></div>';
	  }else {
		  
		 $output .= '<div id="balanceWindow" style="background-color:#cc7a00";><h5>your balance is: '.$sumFromIncomesExpenses.' zł';
		  $output .= '<br> <div class="line"> </div>Try to get beter incomes ! </h5></div>';
	  } 
	  return $output; 
	}	
	$month = date('m');
	$year = date('Y');
	$numberOfDaysOfSelectedMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year); 

	if($stmt = $db->query("SELECT name, SUM(amount)  FROM expenses, expenses_category_assigned_to_users WHERE expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id AND expenses.user_id = '$user_loggedin_id' AND date_of_expense >= '$year-$month-01' AND date_of_expense <= '$year-$month-$numberOfDaysOfSelectedMonth' GROUP BY name")){
		$php_data_array = Array(); // create PHP array
		while ($row = $stmt->fetch()) {
		   $php_data_array[] = $row; // Adding to array
		   }
		}else{
		echo $db->error;
		}
		//print_r( $php_data_array);
		// You can display the json_encode output here. 
		//echo json_encode($php_data_array); 
		// Transfor PHP array to JavaScript two dimensional array 
		echo "<script>
				var my_2d_expense = ".json_encode($php_data_array)."
		</script>";

	if($stmt = $db->query("SELECT name, SUM(amount)  FROM incomes, incomes_category_assigned_to_users WHERE incomes_category_assigned_to_users.id = incomes.income_category_assigned_to_user_id AND incomes.user_id = '$user_loggedin_id' AND date_of_income >= '$year-$month-01' AND date_of_income <= '$year-$month-$numberOfDaysOfSelectedMonth' GROUP BY name")){
		$php_data_array = Array(); // create PHP array
		while ($row = $stmt->fetch()) {
		   $php_data_array[] = $row; // Adding to array
		   }
		}else{
		echo $db->error;
		}
		//print_r( $php_data_array);
		// You can display the json_encode output here. 
		//echo json_encode($php_data_array); 
		// Transfor PHP array to JavaScript two dimensional array 
		echo "<script>
				var my_2d_income = ".json_encode($php_data_array)."
		</script>";
					
		

?>
<!DOCTYPE html> 
<html lang="en">  
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="resources/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital@0;1&display=swap" rel="stylesheet">
    <title>HomeSavings</title>
    <script src="resources/js/homesaves.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
      <header>
        <div class="container">
            <div id="overlay"><img src="resources/img/logoTree.gif" alt="logo" /></div>
            <h1>Balance </h1>
        </div>
	</header>
	<div class="container">
	<div class="topnav" id="myTopnav" >
       <a href="mainPage.php" class="mainPage" ><i class="fas fa-home" style="color:lightgray"></i> Home</a>
        <a class="balance.php" ><i class="fas fa-chart-pie" style="color:orange"></i> Balance</a>
        <a href="income.php" class="income " ><i class="fas fa-coins" style="color:yellow"></i> Add Income</a>
        <a href="expence.php" class="expence"><i class="fas fa-shopping-cart" style="color:lightgreen"></i> Add Expence</a>
       
             <a href="settings.php" class="settings topnav-right"><i class="fas fa-cogs" style="color:gray"></i> Setting</a>
            <a class="logout" href="logout.php" ><i class="fas fa-sign-out-alt"></i> Logout</a>
      
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
	</div>
	<main>
    <div class="container">
        
		<div id="setDateRangeForm">
		<i class="far fa-calendar-check"></i><span style="font-size: 20px;"> Set date range of your transactions:</span>
		<div class="line"> </div>        
		<div class="box">
			 <select name="dateCategory" id="dateCategory">  
                          <option value="1">Current Month </option>  
                          <option value="2">Last Month </option>  
                          <option value="3">This year </option>  
                          <option value="4">Total Time </option>  
                     </select>  
		</div>
		</div>
  
				<div class="row">
					<div class="col-lg-6">
						<div class="Category">
						
							<header>
								<div class="CategoryHeader"><h4>Incomes</h4></div>
							</header>
							<div class="CategoryColumn">
								<ul class="CategoryRow" id="incomes">
								<?php /*while($row=mysqli_fetch_array($result)) {?>
								<li><a><?php echo $row['name'];?>: <?php echo $row['sum']; ?></a></li>
								<?php }*/ 
									echo fill_incomes($db, $user_loggedin_id);
								?>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						 <div class="Category">
							<header>
								<div class="CategoryHeader"><h4>Expences</h4></div>
							</header>
							<div class="CategoryColumn">
								<ul class="CategoryRow" id="expenses">
								<?php /*while($row=mysqli_fetch_array($result)) {?>
								<li><a><?php echo $row['name'];?>: <?php echo $row['sum']; ?></a></li>
								<?php }*/ 
									echo fill_expences($db, $user_loggedin_id);
								?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
			<div style="clear: both;"></div>
			<div id="balance">
			<?php echo fill_balance($db,$user_loggedin_id); ?>
			
			</div>
			
			<section>
				
				<div class="row">
					<div class="col-xl-6">
						 <div id="chart_div_incomes"></div>
					</div>
					<div class="col-xl-6">
						 <div id="chart_div_expenses"></div>
					</div>
				</div>
			</section>
		</div>
	</div>
	</main>


    <script>
	  $(document).ready(function(){  
      $('#dateCategory').change(function(){  
           var date_id = $(this).val();  
           $.ajax({  
                url:"load_data.php",  
                method:"POST",  
                data:{date_id:date_id},  
                success:function(data){ 
                     $('#incomes').html(data);  
                }  
				});  
			});  
		});  
	 $(document).ready(function(){  
      $('#dateCategory').change(function(){  
           var date_id = $(this).val();  
           $.ajax({  
                url:"load_data_expenses.php",  
                method:"POST",  
                data:{date_id:date_id},  
                success:function(data){ 
                     $('#expenses').html(data);  
					
                }  
				});  
			});  
		}); 
		 $(document).ready(function(){  
      $('#dateCategory').change(function(){  
           var date_id = $(this).val();  
           $.ajax({  
                url:"load_data_balance.php",  
                method:"POST",  
                data:{date_id:date_id},  
                success:function(data){ 
                     $('#balance').html(data);  
                }  
				});  
			});  
		}); 
		$('#dateCategory').change(function(){  
           var date_id = $(this).val();  
           $.ajax({  
                url:"load_data_pie_chart.php",  
                method:"POST",  
                data:{date_id:date_id},  
                success:function(data){ 
                     $('#chart_div_incomes').html(data);  
					  console.log(data);
                }  
				});  
			});  
			$('#dateCategory').change(function(){  
           var date_id = $(this).val();  
           $.ajax({  
                url:"load_data_pie_chart_expenses.php",  
                method:"POST",  
                data:{date_id:date_id},  
                success:function(data){ 
                     $('#chart_div_expenses').html(data);  
					  console.log(data);
                }  
				});  
			});
		
		
		
	
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
		
		
		 google.charts.load('current', {'packages':['corechart']});
      // Draw the pie chart when Charts is loaded.
      google.charts.setOnLoadCallback(draw_my_chart_incomes);
      google.charts.setOnLoadCallback(draw_my_chart_expenses);
      // Callback that draws the pie chart
      function draw_my_chart_incomes() {
        // Create the data table .
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'name');
        data.addColumn('number', 'amount');
		for(i = 0; i < my_2d_income.length; i++)
		data.addRow([my_2d_income[i][0], parseInt(my_2d_income[i][1])]);
		// above row adds the JavaScript two dimensional array data into required chart format
		var options = {title:'Costs Incomes',
                       width:600,
                       height:500,
					   backgroundColor: '#38b6ff',
					   titleTextStyle: {color:'#FFFFFF'}, 
						is3D: true};

        // Instantiate and draw the chart
        var chart = new google.visualization.PieChart(document.getElementById('chart_div_incomes'));
        chart.draw(data, options);
      }
	  
	  function draw_my_chart_expenses() {
        // Create the data table .
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'name');
        data.addColumn('number', 'amount');
		for(i = 0; i < my_2d_expense.length; i++)
		data.addRow([my_2d_expense[i][0], parseInt(my_2d_expense[i][1])]);
		// above row adds the JavaScript two dimensional array data into required chart format
		var options = {title:'Costs Expenses',
                       width:600,
                       height:500,
					   titleTextStyle: {color:'#FFFFFF'}, 
					   backgroundColor: '#38b6ff',
						is3D: true};

        // Instantiate and draw the chart
        var chart = new google.visualization.PieChart(document.getElementById('chart_div_expenses'));
        chart.draw(data, options);
      }
		
    </script>
</body>

</html>