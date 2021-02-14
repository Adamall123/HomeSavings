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
				 if($stmt = $db->query("SELECT name, SUM(amount) AS sum FROM expenses, expenses_category_assigned_to_users WHERE expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id AND expenses.user_id = '$user_loggedin_id' AND date_of_expense >= '$year-$month-01' AND date_of_expense <= '$year-$month-$numberOfDaysOfSelectedMonth' GROUP BY name")){
				$php_data_array = Array(); // create PHP array
				while ($row = $stmt->fetch()) {
				   $php_data_array[] = $row; // Adding to array
				   }
				}else{
				echo $db->error;
				}
		  } 
		  else if($_POST["date_id"] == 2)  
		  {  	
				$lastmonth = date('m', strtotime("last month"));
				if($stmt = $db->query("SELECT name, SUM(amount) AS sum FROM expenses, expenses_category_assigned_to_users WHERE expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id AND expenses.user_id = '$user_loggedin_id' AND date_of_expense >= '$year-$lastmonth-01' AND date_of_expense <= '$year-$lastmonth-$numberOfDaysOfSelectedMonth' GROUP BY name")){
				$php_data_array = Array(); // create PHP array
				while ($row = $stmt->fetch()) {
				   $php_data_array[] = $row; // Adding to array
				   }
				}else{
				echo $db->error;
				}
		  }  
		   else if($_POST["date_id"] == 3)  
		  { 
				$currentDay = date('d');
			   if($stmt = $db->query("SELECT name, SUM(amount) AS sum FROM expenses, expenses_category_assigned_to_users WHERE expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id AND expenses.user_id = '$user_loggedin_id' AND date_of_expense >= '$year-01-01' AND date_of_expense <= '$year-$month-$currentDay' GROUP BY name")){
				$php_data_array = Array(); // create PHP array
				while ($row = $stmt->fetch()) {
				   $php_data_array[] = $row; // Adding to array
				   }
				}else{
				echo $db->error;
				}
		  } 
		   else if($_POST["date_id"] == 4)  
		  {  
			   if($stmt = $db->query("SELECT name, SUM(amount) AS sum FROM expenses, expenses_category_assigned_to_users WHERE expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id AND expenses.user_id = '$user_loggedin_id'  GROUP BY name")){
				$php_data_array = Array(); // create PHP array
				while ($row = $stmt->fetch()) {
				   $php_data_array[] = $row; // Adding to array
				   }
				}else{
				echo $db->error;
				}
		  } 
			//print_r( $php_data_array);
			// You can display the json_encode output here. 
			//echo json_encode($php_data_array); 
			// Transfor PHP array to JavaScript two dimensional array 
			echo "<script>
					var my_2d_expense = ".json_encode($php_data_array)."
			</script>";				  
	 }
		
?>
<script>
google.charts.load('current', {'packages':['corechart']});
      // Draw the pie chart when Charts is loaded.
      google.charts.setOnLoadCallback(draw_my_chart_expenses);
      // Callback that draws the pie chart
      function draw_my_chart_expenses() {
        // Create the data table .
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'name');
        data.addColumn('number', 'amount');
		for(i = 0; i < my_2d_expense.length; i++)
		data.addRow([my_2d_expense[i][0], parseInt(my_2d_expense[i][1])]);
		// above row adds the JavaScript two dimensional array data into required chart format
		var options = {title:'Total Costs Expenses',
                       width:600,
                       height:500,
					   backgroundColor: '#38b6ff',
						is3D: true};

        // Instantiate and draw the chart
        var chart = new google.visualization.PieChart(document.getElementById('chart_div_expenses'));
        chart.draw(data, options);
      }
</script>