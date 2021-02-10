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
		}else {
			
			 function fill_incomes($connection,$user_loggedin_id)  
			 {  
				$month = date('m');
				$year = date('Y');
				$numberOfDaysOfSelectedMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
				$output = '';  
				  $sql = "SELECT name, SUM(amount) AS sum FROM incomes, incomes_category_assigned_to_users WHERE incomes_category_assigned_to_users.id = incomes.income_category_assigned_to_user_id AND incomes.user_id = '$user_loggedin_id' AND date_of_income >= '$year-$month-01' AND date_of_income <= '$year-$month-$numberOfDaysOfSelectedMonth' GROUP BY name";  
				  $result = mysqli_query($connection, $sql);  
				  while($row = mysqli_fetch_array($result))  
				  {  
					   $output .= '<li><a>';  
					   $output .= $row["name"].': '.$row["sum"].'';  
					   $output .=     '</a>';  
					   $output .=     '</li>';  
				  }  
				  return $output;  
			 }
			function fill_expences($connection,$user_loggedin_id)  
			 {  
				$month = date('m');
				$year = date('Y');
				$numberOfDaysOfSelectedMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
				$output = '';  
				  $sql = "SELECT name, SUM(amount) AS sum FROM expenses, expenses_category_assigned_to_users WHERE expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id AND expenses.user_id = '$user_loggedin_id' AND date_of_expense >= '$year-$month-01' AND date_of_expense <= '$year-$month-$numberOfDaysOfSelectedMonth' GROUP BY name";  
				  $result = mysqli_query($connection, $sql);  
				  while($row = mysqli_fetch_array($result))  
				  {  
					   $output .= '<li><a>';  
					   $output .= $row["name"].': '.$row["sum"].'';  
					   $output .=     '</a>';  
					   $output .=     '</li>';  
				  }  
				  return $output;  
			 }			 
		}
	}catch(Exception $e){
		
	}
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
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>
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
        <!--<div id="setDateRangeForm">
            <form id="dateForm" method="POST" action="#">
                <ul id="setDateRangeList">
                    <li>
                        <i class="far fa-calendar-check"></i><span style="font-size: 20px;"> Set date range of your transactions:</span>
                    </li>
                    <li class="line"> </li>
                    <li>
                        <input type="radio" class="timePeriodRadio"  name="selectedOption" id="currentMonthRadioID" value="currentMonthRadio" checked>
                        <label class="form-check-label" for="currentMonthRadio">Current Month</label>
                    </li>
                    <li>
                        <input type="radio" class="timePeriodRadio" name="selectedOption" value="previousMonthRadio" id="previousMonthRadio">
                        <label class="form-check-label" for="currentMonthRadio">Last Month</label>
                    </li>
                    <li>
                        <input type="radio" class="timePeriodRadio" name="selectedOption" value="currentYearRadio" id="currentYearRadio">
                        <label class="form-check-label" for="currentMonthRadio">Current Year</label>
                    </li>
                    <li>
                        <input type="radio" class="timePeriodRadio"  name="selectedOption" value="totalTimeRadio" id="totalTimeRadio">
                        <label class="form-check-label" for="currentMonthRadio">Total time</label>
                    </li>
                    <li>
                        <button type="button" class="btn btn-warning">Other Date Range</button>
                    </li>
                    <li id="otherPeriodOfTimeLabel">2021-01-01 : 2021-01-18</li>
					<button type="submit" name="check" class="btn btn-warning">Check!</button>
                </ul>
            </form>
        </div>
		<div>-->
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
			<section>
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
									echo fill_incomes($connection, $user_loggedin_id);
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
									echo fill_expences($connection, $user_loggedin_id);
								?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</section>
			<div style="clear: both;"></div>
			<section>
				<div id="balanceWindow" style="background-color: green;">
				<h6>
					 your balance is: 0.00 (change communication depending on status account)
					<br>
					Well done!
					</h6>
				</div>
			</section>
		
			<section>
				<h6>Results</h6>
				<div class="row">
					<div class="col-xl-6">
						 <div id="piechart_3d_income"></div>
					</div>
					<div class="col-xl-6">
						 <div id="piechart_3d_expence"></div>
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
                     $('#balanceWindow').html(data);  
                }  
				});  
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
    </script>
</body>

</html>