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
					     if($stmt = $connection->query("SELECT name, SUM(amount)  FROM incomes, incomes_category_assigned_to_users WHERE incomes_category_assigned_to_users.id = incomes.income_category_assigned_to_user_id AND incomes.user_id = '$user_loggedin_id' AND date_of_income >= '$year-$month-01' AND date_of_income <= '$year-$month-$numberOfDaysOfSelectedMonth' GROUP BY name")){
						$php_data_array = Array(); // create PHP array
						while ($row = $stmt->fetch_row()) {
						   $php_data_array[] = $row; // Adding to array
						   }
						}else{
						echo $connection->error;
						}
				  } 
				  else if($_POST["date_id"] == 2)  
				  {  	
						if($stmt = $connection->query("SELECT name, SUM(amount)  FROM incomes, incomes_category_assigned_to_users WHERE incomes_category_assigned_to_users.id = incomes.income_category_assigned_to_user_id AND incomes.user_id = '$user_loggedin_id' AND date_of_income >= '$year-$lastmonth-01' AND date_of_income <= '$year-$lastmonth-$numberOfDaysOfSelectedMonth' GROUP BY name")){
						$php_data_array = Array(); // create PHP array
						while ($row = $stmt->fetch_row()) {
						   $php_data_array[] = $row; // Adding to array
						   }
						}else{
						echo $connection->error;
						}
				  }  
				   else if($_POST["date_id"] == 3)  
				  { 
						$currentDay = date('d');
					   if($stmt = $connection->query("SELECT name, SUM(amount)  FROM incomes, incomes_category_assigned_to_users WHERE incomes_category_assigned_to_users.id = incomes.income_category_assigned_to_user_id AND incomes.user_id = '$user_loggedin_id' AND date_of_income >= '$year-01-01' AND date_of_income <= '$year-$month-$currentDay' GROUP BY name")){
						$php_data_array = Array(); // create PHP array
						while ($row = $stmt->fetch_row()) {
						   $php_data_array[] = $row; // Adding to array
						   }
						}else{
						echo $connection->error;
						}
				  } 
				   else if($_POST["date_id"] == 4)  
				  {  
					   if($stmt = $connection->query("SELECT name, SUM(amount)  FROM incomes, incomes_category_assigned_to_users WHERE incomes_category_assigned_to_users.id = incomes.income_category_assigned_to_user_id AND incomes.user_id = '$user_loggedin_id' GROUP BY name")){
						$php_data_array = Array(); // create PHP array
						while ($row = $stmt->fetch_row()) {
						   $php_data_array[] = $row; // Adding to array
						   }
						}else{
						echo $connection->error;
						}
				  } 
					//print_r( $php_data_array);
					// You can display the json_encode output here. 
					//echo json_encode($php_data_array); 
					// Transfor PHP array to JavaScript two dimensional array 
					echo "<script>
							var my_2d_income = ".json_encode($php_data_array)."
					</script>";				  
			 }
		}
	}catch(Exception $e){
		
	}
?>

<script>
google.charts.load('current', {'packages':['corechart']});
      // Draw the pie chart when Charts is loaded.
      google.charts.setOnLoadCallback(draw_my_chart_incomes);
      // Callback that draws the pie chart
      function draw_my_chart_incomes() {
        // Create the data table .
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'name');
        data.addColumn('number', 'amount');
		for(i = 0; i < my_2d_income.length; i++)
		data.addRow([my_2d_income[i][0], parseInt(my_2d_income[i][1])]);
		// above row adds the JavaScript two dimensional array data into required chart format
		var options = {title:'Total Costs Incomes',
                       width:600,
                       height:500,
					   backgroundColor: '#38b6ff',
						is3D: true};

        // Instantiate and draw the chart
        var chart = new google.visualization.PieChart(document.getElementById('chart_div_incomes'));
        chart.draw(data, options);
      }
</script>