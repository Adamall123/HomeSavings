<?php
	//send logged in id user?
	session_start();
	$user_loggedin_id =  $_SESSION['id'];
	require_once "database.php";
	
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
            <h1>Settings</h1>
        </div>
	</header>
	<div class="container">
	<div class="topnav" id="myTopnav" >
       <a href="mainPage.php" class="mainPage" ><i class="fas fa-home" style="color:lightgray"></i> Home</a>
        <a href="balance.php" ><i class="fas fa-chart-pie" style="color:orange"></i> Balance</a>
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
        <div class="row">
            <div class="col-lg-6">
                <div id="profileDetails">
                    <div class="row">
                        <div class="col" style="border-right: 0.5px solid #38b6ff;">
                            <div id="overlay"><img src="resources/img/profile.png" alt="profile" /></div>
                        </div>
                        <div class="col">
                            <ul id="profileDetailsList">
                               <li>	Login:<?php
								$user = $db->query("SELECT username FROM users WHERE id = '$user_loggedin_id'");
								$result = $user->fetch();
								echo ucwords($result['username']); ?>	
							</li>
                                <li>Email:
								<?php
								$user = $db->query("SELECT email FROM users WHERE id = '$user_loggedin_id'");
								$result = $user->fetch();
								echo ucwords($result['email']); ?>	
								</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div id="profileSetting">
                    <ul id="profileSettingsList">
                            <li>Change Nick</li>
                            <li>Change E-mail</li>
                            <li>Change Password</li>
                    </ul>
                </div>
            </div>
        </div>
		
		<?php 
						if(isset($_SESSION['info'])){
							?><div class="alert alert-danger" role="alert" style="margin-top:20px; margin:auto; text-align: center;">
							 <?php  echo $_SESSION['info'];
							 unset($_SESSION['info']);?>
							</div>
			<?php }?>
		<?php 
						if(isset($_SESSION['addInfoOK'])){
							?><div class="alert alert-success" role="alert" style="margin-top:20px; margin:auto; text-align: center;">
							<i class="fas fa-plus" style="color: green"></i>
							 <?php  echo $_SESSION['addInfoOK'];
							 unset($_SESSION['addInfoOK']);?>
							</div>
			<?php }?>
			

        <div class="row">
            <div class="col-lg-4">
                <div class="Category" >
                    <header >
						<button style="color:white" class="CategoryHeader" onclick="showhide()">Incomes Categories
						<i style="color:white"  class="fas fa-arrow-down"></i>
						</button>
                    </header>
                    <div class="CategoryColumn" id="incomes">
                        <ul class="CategoryRow">
							<?php
						$incomesQuery = $db->query("SELECT id, name FROM incomes_category_assigned_to_users WHERE user_id = '$user_loggedin_id'");
						$defaultCategory = "Another";
						$incomes = $incomesQuery->fetchAll(); 
							foreach($incomes  as $income){
								echo "<li>{$income['name']}";?>
								<?php if($income['name']!= $defaultCategory){ ?>
								<div class='editDeleteSpan'>
										<a href="#editIncomeModal<?php echo $income['id']; ?>" data-toggle="modal" ><i class='fas fa-pencil-alt edit_btn'></i></a>  
										<a href="#delIncomeModal<?php echo $income['id']; ?>" data-toggle="modal" ><i class='far fa-trash-alt'></i></a> 
										<?php include('button.php'); ?>
								</div>
								<?php } ?>
							</li>
							<?php
							}
							?>
                        </ul>
                    </div>
                    <footer>
						<span><a  href="#addnew" data-toggle="modal" type="button" class="CategoryFooter">Add New Income</a></span>
					</footer>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="Category">
                    <header>
                        <div class="CategoryHeader">Expences Categories</div>
                    </header>
                    <div class="CategoryColumn">
                        <ul class="CategoryRow">
								<?php
						$expensesQuery = $db->query("SELECT id, name FROM expenses_category_assigned_to_users WHERE user_id = '$user_loggedin_id'");
						$expenses = $expensesQuery->fetchAll();
							foreach($expenses as $expense){
							?>
							<li>
								<?php echo ucwords($expense['name']); ?>
								<?php if($expense['name']!= $defaultCategory){ ?>
								<div class='editDeleteSpan'>
									<a href="#editExpenceModal<?php echo $expense['id']; ?>" data-toggle="modal" ><i class='fas fa-pencil-alt edit_btn'></i></a>  
									<a href="#delExpenceModal<?php echo $expense['id']; ?>" data-toggle="modal" ><i class='far fa-trash-alt'></i></a>
									<?php include('button.php'); ?>
								</div>
								<?php } ?>
							</li>
							<?php
							}
							?>
                        </ul>
                    </div>
                    <footer>
                        <span><a  href="#addnewexpence" data-toggle="modal" type="button" class="CategoryFooter">Add New Expence</a></span>
                    </footer>
                </div>
            </div>
			<div class="col-lg-4">
                <div class="Category">
                    <header>
                        <div class="CategoryHeader">Payment Methods</div>
                    </header>
                    <div class="CategoryColumn">
                        <ul class="CategoryRow">
							<?php
							$paymentMethodQuery = $db->query("SELECT id, name FROM payment_methods_assigned_to_users WHERE user_id = '$user_loggedin_id'");
							$paymentMethods = $paymentMethodQuery->fetchAll();
							foreach($paymentMethods as $paymentMethod){
								?>
								<li>
									<?php echo ucwords($paymentMethod['name']); ?>
									<div class='editDeleteSpan'>
										<a href="#editPaymentModal<?php echo $paymentMethod['id']; ?>" data-toggle="modal" ><i class='fas fa-pencil-alt edit_btn'></i></a>  
										<a href="#delPaymentModal<?php echo $paymentMethod['id']; ?>" data-toggle="modal" ><i class='far fa-trash-alt'></i></a>
										<?php include('button.php'); ?>
									</div>
								</li>
								<?php
								}
							?>
                        </ul>
						 <footer>
                        <span><a  href="#addnewpaymentmethod" data-toggle="modal" type="button" class="CategoryFooter">Add New Expence</a></span>
                    </footer>
                    </div>
        </div>
		<?php include('add_modal.php'); ?>
    </div>
	</main>
    <script>
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
		function showhide() {
		  var x = document.getElementById("incomes");
		  if (x.style.display === "none") {
			x.style.display = "block";
		  } else {
			x.style.display = "none";
		  }
		}
		function validateForm() {
		  var x = document.forms["insert_form"]["fincome"].value;
		  if (x == "") {
			alert("Category Name must be filled out");
			return false;
		  }
		}
    </script>
     <script src="vendors/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>