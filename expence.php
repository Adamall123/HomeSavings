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
            <h1>Expence</h1>
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
		 <?php 
			if(isset($_SESSION['addedExpence'])){
				?><div class="alert alert-success" role="alert" style="max-width: 360px; margin:auto; text-align: center; margin-bottom:10px;">
				<i class="fas fa-shopping-cart" style="color: green";></i>
				 <?php  echo $_SESSION['addedExpence'];
				 unset($_SESSION['addedExpence']);?>
				</div>
			<?php }?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center-expence">
                    <div id="expensePanel">
                        <div id="upperExpensePanel">
                            <div id="upperExpensePanelText">
                                Adding Expense
                            </div>
                        </div>

                        <div class="lowerPanel">
							<?php 
								$sql = $db->query("SELECT id, name FROM expenses_category_assigned_to_users WHERE user_id = '$user_loggedin_id'");
								$expences = $sql->fetchAll();
								$sql2 = $db->query("SELECT id, name FROM payment_methods_assigned_to_users WHERE user_id = '$user_loggedin_id'");
								$paymentMethods = $sql2->fetchAll();
							?>
                            <form method="POST" action="addexpence.php">

                                <div class="inputPanel">
                                    <input id="inputAmount" onchange="checkLimit();" type="number" name="amount" step="0.01" placeholder="0.01" min="0.01" max="99999999.99" class="form-control" value="">
                                    <span id="categoryLimitWarning"></span>
                                </div>

                                <div class="inputPanel">
                                    <input type="date" name="date" class="form-control" id="enterDate" value="" required>
                                </div>
                                <div class="inputPanel">
                                    <select  id="inputCategory" class="form-control valid" name="expense_category_id" aria-invalid="false">
										<?php
										foreach($expences as $expense){ ?>
									
										 <option value="<?php echo $expense['id'];?>"><?php echo $expense['name'];?></option>
										<?php }
										?>
                                    </select>
                                </div>
                                <div class="inputPanel">
                                    <select class="form-control" name="payment_method_id">
										<?php
										foreach($paymentMethods as $paymentMethod){ ?>
										<option value="<?php echo $paymentMethod['id'];?>"><?php echo $paymentMethod['name'];?></option>
										<?php }
										?>
                                    </select>
                                </div>

                                <div class="inputPanel">
                                    <input type="text" name="comment" class="form-control" placeholder="Add comment to the income" value="">
                                </div>
                                <input type="submit" name="submit" class="btn btn-warning button1" value="ADD">
                                <input type="button" class="btn btn-warning button1" value="CANCEL">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
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
    </script>
</body>

</html>